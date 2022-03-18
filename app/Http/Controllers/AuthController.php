<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class AuthController extends Controller
{
    //
    public function showLoginView()
    {
        return response()->view('cms.auth.login');
    }
    public function login(Request $request)
    {
        $validator = Validator($request->all(),[
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $crednetials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard('admin')->attempt($crednetials, $request->input('remember'))) {
                return response()->json(['message' => 'Login Success'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Login failed check login crednetials'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
