<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">
    <title>Xác thực</title>
</head>
<body>
    <div class="main">
        <div class="verify-wrapper">
            <div class="verify-logo">
                <img src="{{ asset('images/image.png') }}" alt="">
            </div>
            <div class="verify-body">
                <p class="verify-title">Chào mừng bạn đến với website của Carry Team. Để xác thực tài khoản của bạn, vui lòng nhập mã kích hoạt:</p>
                <form method="POST" action="{{ route('verify') }}">
                @csrf
                    <div class="verify-form">
                        <div class="verify-group">
                            <input type="text" name="code_id" placeholder="Mã xác minh" autocomplete="off">
                        </div>
                        @if ($errors->has('code_id'))
                            <p class="verify-error">{{ $errors->first('code_id') }}</p>
                        @endif
                    </div>
                    <div class="verify-button">
                        <button>Xác minh</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</body>
</html>