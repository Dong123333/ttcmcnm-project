<?php
namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;

class AuthService {
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($params)
    {
        try { 
            $existingUser = $this->user->where('email', $params['email'])->first();
            if ($existingUser && strpos($existingUser->code_id, 'google_') !== false) {
                return back()->withErrors(['email' => 'This email is already associated with a Google account.']);
            }
            if ($existingUser && strpos($existingUser->code_id, 'github_') !== false) {
                return back()->withErrors(['email' => 'This email is already associated with a GitHub account.']);
            }           
            $code_id = (string) Str::uuid();
            $user = $this->user->create([
                'email' => $params['email'],
                'password' => Hash::make($params['password']),
                'avatar' => 'https://placehold.co/400x400/png',
                'fullName' => 'NoName',
                'nickName' => 'noname',
                'code_id' => $code_id,  
                'expired_id' => Carbon::now()->addMinutes(5), 
                'isActive' => false
            ]);

            Mail::to($user->email)->send(new VerificationMail($user, $code_id));
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }

    public function verifyCode($code_id)
    {
        $user = $this->user->where('code_id', $code_id)->first();

        if (!$user) {
            return false;
        }

        if (Carbon::now()->greaterThan($user->expired_at)) {
            return false;
        }
        $user->update(['isActive' => true]);
        return true;
    }

    public function login($params)
    {
        $user = $this->user->where('email', $params['email'])->first();
        if ($user) {
            if (strpos($user->code_id, 'google_') !== false || strpos($user->code_id, 'github_') !== false) {
                return redirect()->route('login')->withErrors(['email' => 'Email này đã được sử dụng với Google hoặc GitHub.']);
            }
            $isPasswordValid = Hash::check($params['password'], $user->password);
            if (!$isPasswordValid) {
                return redirect()->route('login')->withErrors(['password' => 'Mật khẩu không chính xác.']);
            } 
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Email chưa được đăng ký.']);
        }
        return $user;
    }

    public function handleGoogle($socialUser)
    {
        $user = $this->user->where('email', $socialUser->getEmail())->first();
        if ($user) {
            if (strpos($user->code_id, 'google_') === false) {
                return redirect()->route('login')->withErrors(['email' => 'This email is already associated with another authentication method.']);
            }
            Auth::login($user);
        } else {
            $user = $this->user->create([
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
                'code_id' => 'google_' . $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'fullName' => $socialUser->getName(),
                'nickName' => $socialUser->getEmail(),
                'isActive' => true,
            ]);
        }
        Auth::login($user);
        return $user;
    }

    public function handleGithub($socialUser)
    {
        $user = $this->user->where('email', $socialUser->getEmail())->first();
        if ($user) {
            if (strpos($user->code_id, 'github_') === false) {
                return redirect()->route('login')->withErrors(['email' => 'This email is already associated with another authentication method.']);
            }
            Auth::login($user);
        } else {
            $user = $this->user->create([
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
                'code_id' => 'github_' . $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'fullName' => $socialUser->getName(),
                'nickName' => $socialUser->getNickName(),
                'isActive' => true,
            ]);
        }
        Auth::login($user);
        return $user;
    }

    public function forgetPassword($params)
    {
        try { 
            $user = $this->user->where('email', $params['email'])->first();

            if (!$user) {
                return redirect()->route('form_forget-password')->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
            }
    
            if (!empty($user->code_id)) {
                if (strpos($user->code_id, 'google_') !== false) {
                    return redirect()->route('form_forget-password')->withErrors(['email' => 'Email này đã được sử dụng với Google.']);
                }
                if (strpos($user->code_id, 'github_') !== false) {
                    return redirect()->route('form_forget-password')->withErrors(['email' => 'Email này đã được sử dụng với GitHub.']);
                }
            }
    
            $code_id = (string) Str::uuid();
            $expired_at = Carbon::now()->addMinutes(5);
    
            $user->update([
                'code_id' => $code_id,
                'expired_id' => $expired_at,
            ]);
    
            Mail::to($user->email)->send(new VerificationMail($user, $code_id));
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }

    public function resetPassword($params)
    {
        $user = $this->user->where('code_id', $params['code_id'])->first();

        if (!$user) {
            return false;
        }

        if (Carbon::now()->greaterThan($user->expired_at)) {
            return false;
        }
        $user->update([
           'password' => Hash::make($params['password']),
        ]);
        return true;
    }

    public function logoutWeb()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return true;
    }
}