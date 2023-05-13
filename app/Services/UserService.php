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
     * @return array
     */
    public function doLogin ($credentials): array
    {
        $token = Auth::attempt($credentials);
        if (!empty($token)) {
            $user = Auth::user();

            return [
                'user' => $user,
                'token' => $token
            ];
        }

        return [];
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
        $user->user_type_id = 2;
        $user->save();

        return $user;
    }
}
