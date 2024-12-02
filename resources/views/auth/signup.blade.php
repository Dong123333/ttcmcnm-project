<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <title>Đăng ký</title>
</head>
<body>
    <div class="main">
        <div class="signup-wrapper">
            <div class="signup-logo">
            <img src="{{ asset('images/image.png') }}" alt="">
            </div>
            <div class="signup-body">
            <form method="POST" action="{{ route('register') }}">
            @csrf
                <div class="signup-form">
                    <div class="signup-group">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="off">
                    </div>
                    @if ($errors->has('email'))
                        <p class="signup-error">{{ $errors->first('email') }}</p>
                    @endif
                    
                    <div class="signup-group">
                        <input type="password" name="password" id="password" placeholder="Mật khẩu" autocomplete="off">
                        <div class="signup-input-hidden" onclick="togglePassword()">
                            <img id="passwordIcon" src="{{ asset('images/eye-close.svg') }}" alt="">
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <p class="signup-error">{{ $errors->first('password') }}</p>
                    @endif

                    <div class="signup-group">
                        <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Nhập lại mật khẩu" autocomplete="off">
                        <div class="signup-input-hidden" onclick="toggleConfirmPassword()">
                            <img id="confirmPasswordIcon" src="{{ asset('images/eye-close.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="signup-button">
                    <button type="submit">Đăng ký</button>
                </div>
            </form>
            </div>
            <div class="signup-footer">

                <p>Nếu bạn đã có tài khoản, <a href="/login">Đăng nhập</a> ngay</p>
            </div>
            
        </div>
    </div>
    <script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>