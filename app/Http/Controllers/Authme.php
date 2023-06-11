<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class Authme extends Authenticatable
{
    public function Register(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        auth()->login($user);

        $jsonData = [
            'output' => 'Success',
            'code' => 200,
            'data' => [
                'message' => '登陆成功',
            ],
        ];

        return Response::json($jsonData);
    }

    public function Login(Request $request): JsonResponse
    {
        // 获取参数
        $loginData = $request->only('email','password');
        if (Auth::attempt($loginData,true)) {
            // 登录成功
            $jsonData = [
                'output' => 'Success',
                'code' => 200,
                'data' => [
                    'message' => '登陆成功',
                ],
            ];
        } else {
            // 登陆失败
            $jsonData = [
                'output' => 'LoginFail',
                'code' => 403,
                'data' => [
                    'message' => '登陆失败',
                ],
            ];
        }
        return Response::json($jsonData);
    }
}
