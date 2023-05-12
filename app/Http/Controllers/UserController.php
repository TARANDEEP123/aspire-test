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

        if ( $this->userService->doLogin($request->only('email', 'password'), $request) ) {
            $request->session()->regenerate();

            return redirect('/userHomePage');
        }

        return redirect('/')->with('failure', 'Login again');
    }


    /**
     * User and admin Login via email and password
     *
     * @param UserLoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function adminLogin (UserLoginRequest $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|exists:sys_users,email',
            'password' => 'required|min:4|max:8',
        ]);

        $check = User::where('email', $request->email)->first();
        if ( $check && $check->id === 1 ) {
            if ( $this->userService->doLogin($request->only('email', 'password'), $request) ) {
                $request->session()->regenerate();

                return redirect('/adminHomePage');
            }
        }

        return redirect('/admin')->with('failure', 'Your are not admin');
    }

    /**
     * Create user from sign-up API or Admin API
     *
     * @param UserCreationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createUser (UserCreationRequest $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|unique:sys_users',
            'password' => 'required|min:4|max:8',
        ]);

        $this->userService->userCreation($request);

        return redirect()->route('userHomePage')->with('failure', 'LoginSuccessful');
    }

    /**
     * This logout current user from system
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout ()
    {
        $authId = Auth::id();
        Auth::logout();

        if ( $authId === 1 ) {
            return redirect('admin/')->with('success', 'Thank you for your visit ');
        } else {
            return redirect('/')->with('success', 'Thank you for your visit ');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function returnAdminHomePage ()
    {
        return view('admin.home')->with([
            'data' => UserLoan::with(['user', 'loan_type'])
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }
}
