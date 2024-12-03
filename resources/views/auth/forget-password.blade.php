<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/forget-password.css') }}">
    <title>Quên mật khẩu</title>
</head>
<body>
    <div class="main">
        <div class="forget-password-wrapper">
            <div class="forget-password-logo">
                <img src="{{ asset('images/image.png') }}" alt="">
            </div>
            <div class="forget-password-body">
                <p class="forget-password-title">Vui lòng nhập email của bạn để lấy lại mật khẩu:</p>
                <form method="POST" action="{{ route('forget-password') }}">
                @csrf
                    <div class="forget-password-form">
                        <div class="forget-password-group">
                            <input type="email" name="email" placeholder="Email" autocomplete="off">
                        </div>
                        @if ($errors->has('email'))
                            <p class="forget-password-error">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="forget-password-button">
                        <button>Tiếp</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</body>
</html>