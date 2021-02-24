<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\UserIndexRequest;
use App\Http\Responses\Api\Users\UserResponse;
use App\Http\Responses\Api\PaginatorResponse;
use Illuminate\Http\Request;
use Ome\Auth\Interfaces\UseCases\ExtractUsers\ExtractUsersRequest;
use Ome\Auth\Interfaces\UseCases\ExtractUsers\ExtractUsersUseCase;

class UserResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        UserIndexRequest $request,
        ExtractUsersUseCase $extractUsersUseCase
    ) {
        $page = $request->page ?? 0;
        $result = $extractUsersUseCase->interact(
            new ExtractUsersRequest($page)
        );

        $responses = [];
        foreach ($result->getUsers() as $user) {
            $responses[] = new UserResponse(
                $user->getId(),
                $user->getUsername(),
                $user->getDiscordId(),
                $user->getTwitchIds()
            );
        }

        return new PaginatorResponse(
            $page,
            $result->getHasNext(),
            $responses
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
