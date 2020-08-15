<?php

namespace App\Http\Controllers\Pages;

use App\Eloquents\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /** @var User */
        $user = Auth::user();
        $bearer = $user->api_token;

        $viewData['bearer'] = $bearer;
        return view('admin.index', $viewData);
    }
}
