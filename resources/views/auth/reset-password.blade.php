<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <div class="main">
        <div class="reset-password-wrapper">
            <div class="reset-password-logo">
                <img src="{{ asset('images/image.png') }}" alt="">
            </div>
            <div class="reset-password-body">
            <p class="reset-password-title">Chào mừng bạn đến với website của Carry Team. Để đổi mật khẩu, vui lòng nhập mã kích hoạt được gửi ở email của bạn</p>
                <form method="POST" action="{{ route('reset-password') }}">
                @csrf
                    <div class="reset-password-form">
                    
                        <div class="reset-password-group">
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" autocomplete="off">
                            <div class="reset-password-input-hidden" onclick="togglePassword()">
                                <img id="passwordIcon" src="{{ asset('images/eye-close.svg') }}" alt="">
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <p class="reset-password-error">{{ $errors->first('password') }}</p>
                        @endif

                        <div class="reset-password-group">
                            <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Nhập lại mật khẩu" autocomplete="off">
                            <div class="reset-password-input-hidden" onclick="toggleConfirmPassword()">
                                <img id="confirmPasswordIcon" src="{{ asset('images/eye-close.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="reset-password-group">
                            <input type="text" name="code_id" placeholder="Mã xác minh" autocomplete="off">
                        </div>
                        @if ($errors->has('code_id'))
                            <p class="reset-password-error">{{ $errors->first('code_id') }}</p>
                        @endif
                    </div>
                    <div class="reset-password-button">
                        <button>Xác nhận</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    <script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>