<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Models\UserLoan;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends BaseController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     */
    public function __construct ()
    {
        $this->userService = new UserService();
    }

    /**
     * User and admin Login via email and password
     *
     * @param UserLoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userLogin (UserLoginRequest $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|exists:sys_users,email',
            'password' => 'required|min:4|max:8',
        ]);
        $loginDetails = $this->userService->doLogin($request->only('email', 'password'), $request);

        if (!empty($loginDetails)) {
            return success($loginDetails);
        }

        return failure('Unauthorized');
    }
}
