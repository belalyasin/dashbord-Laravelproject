<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\User;
use Dotenv\Validator;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::with('specialty')->get();
        return response()->view('cms.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $specialties = Specialty::where('active', '=', true)->get();
        return response()->view('cms.users.create', ['specialties' => $specialties]);
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
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'specialty_id' => 'required|numeric|exists:specialties,id',
            'gender' => 'required|string|in:M,F'
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->specialty_id = $request->input('specialty_id');
            $user->gender = $request->input('gender');
            $user->password = Hash::make(12345);
            $isSaved = $user->save();
            return response()->json(["message" => $isSaved ? 'Created Successfuly' : 'Created Failed!'], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $specialties = Specialty::where('active', '=', true)->get();
        return response()->view('cms.users.update', ['specialties' => $specialties, 'users' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'specialty_id' => 'required|numeric|exists:specialties,id',
            'gender' => 'required|string|in:M,F'
        ]);
        if (!$validator->fails()) {
            // $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->specialty_id = $request->input('specialty_id');
            $user->gender = $request->input('gender');
            // $user->password = Hash::make(12345);
            $isSaved = $user->save();
            return response()->json(["message" => $isSaved ? 'Updated Successfuly' : 'Updated Failed!'], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $deleted = $user->delete();
        return response()->json(["message" => $deleted ? 'Delete Successfuly' : 'Delete Failde'], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
