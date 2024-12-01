<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Requests\Web\Auth\RegisterRequest;
use App\Http\Requests\Web\Auth\VerifyRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function showVerifyForm()
    {
        return view('auth.verify');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(RegisterRequest $registerRequest)
    {
        $params = $registerRequest->validated();
        $result = $this->authService->register($params);

        if ($result) {
            return redirect()->route('form_verify');
        }

        return back()->withErrors(['error' => 'Đăng ký thất bại!']);
    }

    public function verify(VerifyRequest $verifyRequest)
    {
        $code_id = $verifyRequest->input('code_id');
        $isVerified = $this->authService->verifyCode($code_id);
        if ($isVerified) {
            return redirect()->route('form_login');
        } else {
            return back()->withErrors(['code_id' => 'Mã xác thực không hợp lệ hoặc đã hết hạn.']);
        }
    }

    public function login(LoginRequest $loginRequest)
    {
        $params = $loginRequest->validated();
        
        if (Auth::attempt($params)) {
            $user = Auth::user();
            session(['user' => $user]);

            return redirect()->route('home');
        }

        return redirect()->route('form_login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->user();

            if (!$googleUser) {
                return redirect()->route('form_login')->withErrors(['error' => 'Không thể lấy thông tin từ Google.']);
            }

            $isUser = $this->authService->handleGoogle($googleUser);
            if($isUser) {
                return redirect()->route('home');
            }else {
                return redirect()->route('form_login');
            }
        } catch (\Exception $e) {
            return redirect()->route('form_login')->withErrors(['error' => 'Đăng nhập với Google thất bại.']);
        }
    }

    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')
            ->stateless()
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->user();
            if (!$githubUser) {
                return redirect()->route('form_login')->withErrors(['error' => 'Không thể lấy thông tin từ Github.']);
            }
            $isUser = $this->authService->handleGithub($githubUser);
            if($isUser) {
                return redirect()->route('home');
            } else {
                return redirect()->route('form_login');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Không thể lấy thông tin từ GitHub']);
        }
    }


    public function logout()
    {
        $result = $this->authService->logoutWeb();

        if ($result) {
            return redirect()->route('form_login');
        }
    }

}
