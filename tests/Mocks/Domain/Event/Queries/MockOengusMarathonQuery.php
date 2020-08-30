<?php

namespace Tests\Mocks\Domain\Event\Queries;

use Ome\Event\Entities\OengusMarathon;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;

class MockOengusMarathonQuery implements OengusMarathonQuery
{
    public function fetch(string $id): OengusMarathon
    {
        $json = json_decode('{
            "id": "rta1kagawa",
            "name": "RTA 1n Kagawa Online",
            "creator": {
              "id": 177,
              "username": "Cma",
              "usernameJapanese": "",
              "enabled": true,
              "roles": [
                "ROLE_USER"
              ],
              "twitterName": "cma2819",
              "twitchName": "cma2819",
              "speedruncomName": "Cma",
              "atLeastOneAccountSynchronized": true,
              "emailPresentForExistingUser": true
            },
            "startDate": "2020-03-07T01:00:07Z",
            "endDate": "2020-03-08T13:48:07Z",
            "submissionsStartDate": null,
            "submissionsEndDate": null,
            "description": "*応募一覧をスマートフォンからご確認される方は[こちら](https://script.google.com/macros/s/AKfycbzPDDT9KD1X8Ck8IVe_UcdW9LAS8CoslEaF813ZoR49CTUMvf8/exec)*\n\n# イベントについて\n\nRTA 1n Kagawa Onlineは「1時間以内でRTA」をテーマにしたRTAマラソンイベントです。\n全ての採用作品を1時間以内で完走可能なものに限定し、RTAを各プレイヤーが連続で行います。\n\n各プレイヤーが自宅からRTAを行っている様子をオンライン上で配信します。\n\n## 開催日時\n\n2020/03/07 10:00 - 22:00, 2020/03/08 10:00 - 22:00\n\n※申請状況に応じて時間は前後します。03/07 22:00～03/08 10:00も時間の設定が可能となっていますので、参加可能な方は設定いただけると調整がしやすく助かります。\n\n## 募集期間\n\n2020/01/18 00:00 - 2020/02/02 23:59\n\n# RTAの申請について\n\n今回のイベントで採用されるRTAは、「自己ベストが1時間以内のもの」に限定します。\n\n予定タイムではなく自己ベストが基準となっているのは、「1時間以内に完走可能」というテーマに則ること、1時間以内を目指すあまりギリギリの予定タイムで申請されることを防ぐことが大きな理由です。\n\n申請される際には、参考動画として、\n\n- 1時間以内に完走されていることがわかるRTA動画\n- 1時間以上かけて完走している動画と、1時間以内のタイムが認証されているSpeedrun.comのページURL\n\nのいずれかを提出してください。\n\n上記を満たしていないものについては採用の対象外とさせていただくことがあります。\nまた、応募数によっては全てのRTAを採用できないこともありますので、ご了承ください。\n\nRTAの申請にはOengus（ https://oengus.io ）を利用します。Discordと連携済みのアカウントで申請してください。\nOengusに関する質問は随時運営にお伝えください。\n\n# 申請される前に\n\n**プレイヤーで申請される方は下記をご一読ください。**\n\n## 当日の配信について\n\n他のRTAオンラインマラソンイベントと同様に、イベント当日はプレイヤーの方々にRTAの様子を配信していただきます。\n\n配信は個人のチャンネルではなく、イベント側で指定した配信先に配信を行っていただきます。配信サイト・配信先URL等は採用後にご案内しますが、配信においては下記の基準を達成できることを確認してください。\n\nSDゲーム（PS2、Wiiやそれ以前の、映像アスペクト比が4:3のゲーム）の場合\n\n- 解像度640*480以上\n- 30fps以上\n- 映像ビットレート1Mbps、音声ビットレート128Kbps以上\n\nHDゲーム（PS3、WiiUやそれ以降の、映像アスペクト比が16:9のゲーム）もしくはDS、3DS等の複数画面を利用するゲーム\n\n- 解像度1280*720以上\n- 30fps以上\n- 映像ビットレート2Mbps、音声ビットレート128kbps以上\n\n配信の品質について、ご不明点ご質問等はいつでもお気軽にお問い合わせください。\n\n## レースについて\n\nレースのように、複数人のRTAを同時に行うものも申請可能です。\nその場合は、Oengus上で複数人プレイの申請を行ってください。\n\n申請ページの「Type」欄にて、「Race」を選択します。他の欄を通常通り入力した後「送信」を行うと、招待コードが表示されます。\n\nレースに参加する他のプレイヤーは、招待コードを入力して同一の申請に参加することができます。\n\nレース相手のプレイヤーと招待コードを共有することで、レースの申請ができます。\n\n## 採用後のご連絡について\n\nゲーム採用後のご連絡はDiscordにて行いますので、イベントDiscordへの参加をお願いいたします。\n\n## いただいたご質問と回答\n\n### TwitchやTwitterの情報は応募時に不要ですか？\n\n配信に表示するTwitchやTwitterの情報は、Oengusのアカウントで設定されているものを利用しますので、応募時の入力は不要です。（項目もありません）\n\n### レースの最大人数はいくつでしょうか？\n\n2人までとしています。3人以上の応募はOengus上でもできなくなっています。\n\n### エミュレータでの応募・参加は大丈夫ですか？\n\nコミュニティ内で一般的であり、かつSpeedrun.comで認証されている記録があるものでしたら参加可能です。\n(心配でしたらDiscordで個別にお問い合わせください。)\n\n### 複数申請した場合、複数採用されることはありますか？\n\n同じゲームの別カテゴリの場合、基本的にはありません。\n別ゲームの場合、可能性はありますがそこまで高くはありません。できるだけ多くの人に出てもらいたいと思っているためです。\n\n### カメラ使った場合は配信に映してもらえますか？\n\n相談していただければ検討いたします。\n\n### 解説は走者と別に呼んでも良いんですか？\n\nはい、問題ありません。ゲーム確定後に別途応募フォームを用意いたします。\n\n### 解説ではなく、ガヤ的な感じな人を呼んでも大丈夫ですか？\n\nはい、よほどRTAやゲームに関する内容からかけ離れない限りは大丈夫です。\n\n### 申請のカテゴリー概要に計測タイミングは書いたほうがいいですか？\n\nどちらでも構いません。ゲーム決定後に別途追加で情報をいただくことになります。\n\n### 自己べが1時間前後なら準備時間含めて1時間10分とかでもいいってことですか\n\nはい、大丈夫です。「自己べストが1時間以内のもの」であれば、予定タイムは1時間を越えても問題ありません。\n\n### 配信はR1K用のチャンネルでやりますか？\n\nはい、こちらのチャンネルで行います（ https://www.twitch.tv/ome_speedrun/ ）\n\n## お問合せ\n\nご質問等はイベントDiscordにてお願いいたします。\n\n## Credit\n\n- 楠木鳥夜 氏：本イベントの企画原案\n",
            "onsite": false,
            "location": null,
            "language": "ja",
            "maxGamesPerRunner": 3,
            "maxCategoriesPerGame": 3,
            "hasMultiplayer": true,
            "maxNumberOfScreens": 2,
            "twitch": "ome_speedrun",
            "twitter": "ome_speedrun",
            "discord": "RwafsH2",
            "country": null,
            "discordPrivacy": false,
            "submitsOpen": false,
            "defaultSetupTime": "PT10M",
            "selectionDone": true,
            "scheduleDone": true,
            "donationsOpen": true,
            "isPrivate": false,
            "videoRequired": true,
            "unlimitedGames": false,
            "unlimitedCategories": false,
            "emulatorAuthorized": true,
            "moderators": [
              {
                "id": 182,
                "username": "toyomana",
                "usernameJapanese": "とよまな",
                "enabled": true,
                "roles": [
                  "ROLE_USER"
                ],
                "twitterName": "ToyoManaRUNs",
                "twitchName": "toyomana",
                "speedruncomName": "toyomana",
                "atLeastOneAccountSynchronized": true,
                "emailPresentForExistingUser": true
              },
              {
                "id": 187,
                "username": "Yutori",
                "usernameJapanese": "ゆとりん",
                "enabled": true,
                "roles": [
                  "ROLE_USER"
                ],
                "twitterName": "M_YTR_FRMK",
                "twitchName": "mechayutori",
                "speedruncomName": "Yutori",
                "atLeastOneAccountSynchronized": true,
                "emailPresentForExistingUser": true
              },
              {
                "id": 361,
                "username": "ypno_ny",
                "usernameJapanese": "",
                "enabled": true,
                "roles": [
                  "ROLE_USER"
                ],
                "twitterName": "ypno_ny",
                "twitchName": "ypno_ny",
                "speedruncomName": "ypno_ny",
                "atLeastOneAccountSynchronized": true,
                "emailPresentForExistingUser": true
              },
              {
                "id": 400,
                "username": "MiraiScarlet",
                "usernameJapanese": null,
                "enabled": true,
                "roles": [
                  "ROLE_USER"
                ],
                "twitterName": "Mirai_Scarlet",
                "twitchName": "miraiscarlet",
                "speedruncomName": "MiraiScarlet",
                "atLeastOneAccountSynchronized": true,
                "emailPresentForExistingUser": true
              }
            ],
            "hasIncentives": false,
            "canEditSubmissions": false,
            "questions": [
              {
                "id": 102,
                "label": "ニコニココミュニティID（coを含むURL末尾のID）",
                "fieldType": "TEXT",
                "required": false,
                "options": [],
                "questionType": "SUBMISSION",
                "description": null,
                "position": 102
              },
              {
                "id": 106,
                "label": "Youtubeチャンネル名（URLではなくチャンネル名をお願いします）",
                "fieldType": "TEXT",
                "required": false,
                "options": [],
                "questionType": "SUBMISSION",
                "description": null,
                "position": 106
              }
            ],
            "hasDonations": false,
            "payee": null,
            "supportedCharity": null,
            "donationCurrency": null,
            "donationWebhook": null,
            "youtube": null,
            "donationsTotal": null,
            "hasSubmitted": false
          }', true);

        $json['id'] = $id;
        return OengusMarathon::createFromApiJson($json);
    }
}
