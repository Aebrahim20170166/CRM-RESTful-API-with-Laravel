<?php

namespace Crm\User\Services;

use Crm\User\Models\User;
use Crm\User\Request\UserCreation;
use Crm\User\Events\UserCreation as UserCreationEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserService
{
    public function index(Request $request)
    {
        return User::all();
    }

    public function show(int $userId)
    {
        return User::find($userId);
    }

    public function  create(UserCreation $request): ?User
    {

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        event(new UserCreationEvent($user));

        return $user;
    }

    public function  update(Request $request, int $userId)
    {
        $user = User::find($userId);
        if (! $user)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('username'));
        $user->save();

        return $user;
    }

    public function  delete(Request $request, int $userId)
    {
        $user = User::find($userId);
        if (! $user)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }
        $user->delete();
        return response()->json(['status' => 'deleted'], ResponseAlias::HTTP_OK);
    }
}
