<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @var bool
     */
    protected $user = false;

    /**
     * Make user's login attempt
     * @param $credentials
     * @return bool
     */
    public function doLogin ($credentials): bool
    {
        if ( Auth::attempt($credentials) ) {
            return true;
        }

        return false;
    }

    /**
     * Create user record
     *
     * @param $request
     * @return User
     */
    public static function userCreation ($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->save();

        return $user;
    }
}
