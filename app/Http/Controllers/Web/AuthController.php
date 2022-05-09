<?php

namespace App\Http\Controllers\Web;

use App\Enums\DBConstant;
use App\Http\Controllers\Web\Portal\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Common\LoginRequest;
use App\Enums\ErrorType;
use JWTAuth;
use Exception;
use App\Services\UserService;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    protected function guard()
    {
        return Auth::guard('client');
    }

    public function showLoginForm()
    {
        if (!empty(auth('client')->user())) {
            return redirect()->route('client.home');
        }

        return view('client.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $error = "メールアドレスまたは、 パスワードが間違っています";
        $email = $credentials['email'];

        $is_auth = $this->userService->checkUser($credentials['email']);
        if (!$is_auth) return view('client.login', compact("error", "email"));
        
        if (Auth::guard('client')->attempt($credentials)) {
            if (isset($request->league)) {
                return redirect(route('client.home') . "?league=" . $request->league);
            }

            return redirect()->route('client.home');
        }
        
        return view('client.login', compact("error", "email"));
    }

    public function logout()
    {
        Auth::guard('client')->logout();

        return redirect()->route( 'client.login' );
    }

    protected function loggedOut(Request $request) {
        return redirect()->route('home');
    }
}
