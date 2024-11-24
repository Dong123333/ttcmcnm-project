<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <title>Signup</title>
</head>
<body>
    <div class="main">
        <div class="signup-wrapper">
            <div class="signup-logo">
            <img src="{{ asset('images/image.png') }}" alt="">
            </div>
            <div class="signup-body">
                <div class="signup-form">
                    <div class="signup-group">
                        <input type="text" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="signup-group">
                        <input type="password" id="password" placeholder="Mật khẩu" autocomplete="off">
                        <button class="signup-input-hidden" onclick="togglePassword()">
                            <img id="passwordIcon" src="{{ asset('images/eye-close.svg') }}" alt="">
                        </button>
                    </div>
                    <div class="signup-group">
                        <input type="password" id="confirmPassword" placeholder="Nhập lại mật khẩu" autocomplete="off">
                        <button class="signup-input-hidden" onclick="toggleConfirmPassword()">
                            <img id="confirmPasswordIcon" src="{{ asset('images/eye-close.svg') }}" alt="">
                        </button>
                    </div>
                </div>
                <div class="signup-button">
                    <button>Đăng ký</button>
                </div>
        
            </div>
            <div class="signup-footer">

                <p>Nếu bạn đã có tài khoản, <a href="/login">Đăng nhập</a> ngay</p>
            </div>
            
        </div>
       
        
    </div>
    <script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>