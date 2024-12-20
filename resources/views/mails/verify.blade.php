<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác minh email</title>
</head>
<body
    style='margin: 0; padding: 0; min-width: 100%; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; background-color: #FAFAFA; color: #222222;'
  >
    <div style='max-width: 600px; margin: 0 auto;'>
      <div style='background-color: #0070f3; padding: 24px; color: #ffffff;'>
        <h1
          style='font-size: 24px; font-weight: 700; line-height: 1.25; margin-top: 0; margin-bottom: 15px; text-align: center;'
        >Chào mừng đến với website của Carry Team</h1>
      </div>
      <div style='padding: 24px; background-color: #ffffff;'>
        <p style='margin-top: 0; margin-bottom: 24px;'>Chào {{ $user->email }},</p>
        <p style='margin-top: 0; margin-bottom: 24px;'>Cảm ơn bạn đã đăng ký website của tôi. Để kích hoạt tài khoản của bạn, vui lòng sử dụng mã kích hoạt sau:</p>
        <h2
          style='font-size: 20px; font-weight: 700; line-height: 1.25; margin-top: 0; margin-bottom: 15px; text-align: center;'
        >{{ $code_id }}</h2>
        <p style='margin-top: 0; margin-bottom: 24px;'>Vui lòng nhập mã này vào trang kích hoạt trong vòng 5 phút tới.</p>
        <p style='margin-top: 0; margin-bottom: 24px;'>Nếu bạn không đăng ký đối với tài khoản này, vui lòng bỏ qua email này.</p>
      </div>
      <div style='background-color: #f6f6f6; padding: 24px;'>
        <p style='margin-top: 0; margin-bottom: 24px;'>Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi</p>
      </div>
    </div>
  </body>
</html>
