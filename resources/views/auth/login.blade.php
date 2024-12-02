<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Đăng nhập</title>
</head>
<body>
    <div class="main">
        <div class="login-wrapper">
            <div class="login-logo">
                <img src="{{ asset('images/image.png') }}" alt="">
            </div>
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="login-form">
                        <div class="login-group">
                            <input type="email" name="email"  value="{{ old('email') }}" placeholder="Email" autocomplete="off">
                        </div>
                        @if ($errors->has('email'))
                            <p class="login-error">{{ $errors->first('email') }}</p>
                        @endif
                        <div class="login-group">
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" autocomplete="off">
                            <div class="login-input-hidden" onclick="togglePassword()">
                                <img id="passwordIcon" src="{{ asset('images/eye-close.svg') }}" alt="">
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <p class="login-error">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="login-button">
                        <button>Đăng nhập</button>
                    </div>
                </form>
                <div class="login-forget-password">
                    <a href="">Bạn quên mật khẩu?</a>
                </div>
                <div class="login-divider">
                    <p>Hoặc</p>
                </div>
                <div class="login-social">
                    <form action="{{ url('login/google') }}" method="GET">
                        <button>
                            <div class="login-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><g fill="none"><rect width="256" height="256" fill="#f4f2ed" rx="60"/><path fill="#4285f4" d="M41.636 203.039h31.818v-77.273L28 91.676v97.727c0 7.545 6.114 13.636 13.636 13.636"/><path fill="#34a853" d="M182.545 203.039h31.819c7.545 0 13.636-6.114 13.636-13.636V91.675l-45.455 34.091"/><path fill="#fbbc04" d="M182.545 66.675v59.091L228 91.676V73.492c0-16.863-19.25-26.477-32.727-16.363"/><path fill="#ea4335" d="M73.455 125.766v-59.09L128 107.583l54.545-40.909v59.091L128 166.675"/><path fill="#c5221f" d="M28 73.493v18.182l45.454 34.091v-59.09L60.727 57.13C47.227 47.016 28 56.63 28 73.493"/></g></svg>
                            </div>
                            <span>Login with Gmail</span>
                        </button>
                    </form>
                    <form action="{{ url('login/github') }}" method="GET">
                        <button>
                            <div class="login-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><g fill-rule="evenodd" clip-rule="evenodd"><path d="M24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4ZM0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24Z"/><path d="M19.1833 45.4716C18.9898 45.2219 18.9898 42.9973 19.1833 38.798C17.1114 38.8696 15.8024 38.7258 15.2563 38.3667C14.437 37.828 13.6169 36.1667 12.8891 34.9959C12.1614 33.8251 10.5463 33.64 9.89405 33.3783C9.24182 33.1165 9.07809 32.0496 11.6913 32.8565C14.3044 33.6634 14.4319 35.8607 15.2563 36.3745C16.0806 36.8883 18.0515 36.6635 18.9448 36.2519C19.8382 35.8403 19.7724 34.3078 19.9317 33.7007C20.1331 33.134 19.4233 33.0083 19.4077 33.0037C18.5355 33.0037 13.9539 32.0073 12.6955 27.5706C11.437 23.134 13.0581 20.2341 13.9229 18.9875C14.4995 18.1564 14.4485 16.3852 13.7699 13.6737C16.2335 13.3589 18.1347 14.1343 19.4734 16.0001C19.4747 16.0108 21.2285 14.9572 24.0003 14.9572C26.772 14.9572 27.7553 15.8154 28.5142 16.0001C29.2731 16.1848 29.88 12.7341 34.5668 13.6737C33.5883 15.5969 32.7689 18.0001 33.3943 18.9875C34.0198 19.9749 36.4745 23.1147 34.9666 27.5706C33.9614 30.5413 31.9853 32.3523 29.0384 33.0037C28.7005 33.1115 28.5315 33.2855 28.5315 33.5255C28.5315 33.8856 28.9884 33.9249 29.6465 35.6117C30.0853 36.7362 30.117 39.948 29.7416 45.247C28.7906 45.4891 28.0508 45.6516 27.5221 45.7347C26.5847 45.882 25.5669 45.9646 24.5669 45.9965C23.5669 46.0284 23.2196 46.0248 21.837 45.8961C20.9154 45.8103 20.0308 45.6688 19.1833 45.4716Z"/></g></svg>
                            </div>
                            <span>Login with Github</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="login-footer">
                <p>Nếu bạn chưa có tài khoản, <a href="/signup">Đăng ký</a> ngay</p>
            </div>  
        </div> 
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>