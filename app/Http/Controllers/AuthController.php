<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class AuthController extends Controller
{
    //
    public function showLoginView(Request $request)
    {
        $request->request->add(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,user',
        ]);

        $request->session()->put('guard', $request->input('guard'));
        if (!$validator->fails()) {
            return response()->view('cms.auth.login');
        } else {
            abort(Response::HTTP_NOT_FOUND, 'The page you have requested is not found');
        }
    }
    public function login(Request $request)
    {
        $validator = Validator([
            // 'email' => 'required|email|exists:admins,email',
            'email' => 'required|email',
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean',
        ]);
        $guard = session()->get('guard');
        if (!$validator->fails()) {
            $crednetials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard($guard)->attempt($crednetials, $request->input('remember'))) {
                return response()->json(['message' => 'Login Success'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Login failed check login crednetials'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function logout(Request $request)
    {
        // dd('logout');
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login', $guard);
    }
}
