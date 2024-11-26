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
            $code_id = (string) Str::uuid();
            $user = $this->user->create([
                'email' => $params['email'],
                'password' => Hash::make($params['password']),
                'avatar' => 'https://placehold.co/400x400/png',
                'fullName' => 'NoName',
                'nickName' => 'noname',
                'code_id' => $code_id,  
                'expired_id' => Carbon::now()->addMinutes(5), 
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
        $user = User::where('code_id', $code_id)->first();

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

        $isPasswordValid = Hash::check($params['password'], $user->password);

        if (!$isPasswordValid) {
            return [
                'status' => false,
                'message' => 'Invalid password and email',
            ];
        }

        if (!$user->isActive) {
            return [
                'status' => false,
                'message' => 'Tài khoản chưa được kích hoạt.'
            ];
        }

        $token = $user->createToken('user')->plainTextToken;

        return [
            'status' => true,
            'access_token' => $token,
        ];
    }

    public function logoutWeb()
    {
        session()->forget('google_user');
        session()->forget('github_user');
        session()->forget('user');
        Auth::logout();

        return true;
    }
}