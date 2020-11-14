<?php

namespace App\Infrastructure\Queries\Twitter;

use App\Exceptions\InvalidConfigurationException;
use App\Facades\Logger;
use Illuminate\Support\Facades\Cache;
use mpyw\Co\CURLException;
use mpyw\Cowitter\Client;
use mpyw\Cowitter\HttpException;
use mpyw\Cowitter\Response;
use Ome\Twitter\Entities\Tweet;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Dto\TweetDto;
use Ome\Twitter\Interfaces\Queries\TimelineQuery;

class TwitterTimelineQuery implements TimelineQuery
{
    protected Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function fetch(): array
    {
        if (Cache::has(self::class)) {
            return Cache::get(self::class);
        }

        Logger::debug('string', 'Twitter.Query', 'Call Twitter API for refreshing timeline');

        $endpoint = 'statuses/user_timeline';
        $screenName = config('services.twitter.screen_name');
        if (is_null($screenName)) {
            throw new InvalidConfigurationException('services.twitter.screen_name', $screenName);
        }
        $parameter = [
            'screen_name' => config('services.twitter.screen_name')
        ];

        try {
            /** @var Response */
            $response = $this->client->get($endpoint, $parameter, true);
            $timeline = json_decode($response->getRawContent(), true);
        } catch (HttpException $e) {
            Logger::error('string', 'Twitter.Query', 'Bad response from Twitter.');
            Logger::error('string', 'Twitter.Query', $e->getStatusCode() . ' - ' . $e->getMessage());
            return [];
        } catch (CURLException $e) {
            Logger::error('string', 'Twitter.Query', $e->getCode() . ' - ' . $e->getMessage());
            return [];
        }

        $tweetDtoList = [];
        foreach ($timeline as $tweetJson) {
            $tweet = Tweet::createFromApiJson($tweetJson);
            $medias = TwitterMedia::createMediasFromTweetApiJson($tweetJson);
            $tweetDtoList[] = new TweetDto($tweet, $medias);
        }

        Cache::put(self::class, $tweetDtoList, 5);
        return $tweetDtoList;
    }
}
