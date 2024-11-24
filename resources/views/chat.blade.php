<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Chat</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>
  <div class="chat-container">
    <!-- Sidebar for contacts -->
    <div class="sidebar">
      <!-- Avatar của người dùng hiện tại -->
      <div class="current-user">
            <img src="https://via.placeholder.com/60" alt="User Avatar" class="user-avatar">
            <div class="user-info">
                <p class="username-current">quocvuongx_</p>
                <span class="status">Primary | General</span>
            </div>
        </div>
        <hr>

      <div class="online-users">
        <div class="online-user">
          <div class="avatar-wrapper">
            <img src="https://via.placeholder.com/60" alt="User Avatar" class="avatar">
            <div class="online-indicator"></div>
              </div>
              <p class="username">Vương</p>
          </div>
        <div class="online-user">
          <div class="avatar-wrapper">
            <img src="https://via.placeholder.com/60" alt="User Avatar" class="avatar">
            <div class="online-indicator"></div>
              </div>
              <p class="username">Bắp</p>
          </div>
        <div class="online-user">
          <div class="avatar-wrapper">
            <img src="https://via.placeholder.com/60" alt="User Avatar" class="avatar">
            <div class="online-indicator"></div>
          </div>
            <p class="username">thongloe</p>
          </div>
            <!-- Add more users here -->
        </div>
        <!-- Danh sách các user đang online -->
        <div class="contact-list">
            <div class="contact active">
                <img src="https://via.placeholder.com/40" alt="Avatar" class="contact-avatar">
                <div class="contact-info">
                    <p class="contact-name">Kha Nguyen</p>
                    <span class="contact-status">Active 9m ago</span>
                </div>
            </div>
            <div class="contact">
                <img src="https://via.placeholder.com/40" alt="Avatar" class="contact-avatar">
                <div class="contact-info">
                    <p class="contact-name">Khánh Nguyễn</p>
                    <span class="contact-status">Active 1h ago</span>
                </div>
            </div>
            <div class="contact">
                <img src="https://via.placeholder.com/40" alt="Avatar" class="contact-avatar">
                <div class="contact-info">
                    <p class="contact-name">Hồ Bá Đông</p>
                    <span class="contact-status">Active 11m ago</span>
                </div>
            </div>
            <!-- Add more contacts -->
        </div>
    </div>

    <!-- Chat box -->
    <div class="chat-box">
        <div class="chat-container">
    <!-- Chat Box -->
    <div class="chat-box">
      <!-- Chat Header -->
      <div class="chat-header">
        <div class="chat-header-left">
          <img src="https://via.placeholder.com/40" alt="Avatar" class="chat-avatar">
          <div class="chat-user-info">
            <p class="chat-username">Kha Nguyen</p>
            <p class="chat-status">Active 15m ago</p>
          </div>
        </div>
        <div class="chat-header-right">
            <button class="chat-icon-btn">
                <span class="iconify" data-icon="mdi:phone-outline" data-inline="false"></span>
            </button>
            <button class="chat-icon-btn">
                <span class="iconify" data-icon="mdi:video-outline" data-inline="false"></span>
            </button>
            <button class="chat-icon-btn">
                <span class="iconify" data-icon="mdi:information-outline" data-inline="false"></span>
            </button>
        </div>
      </div>

      <!-- Chat Messages -->
      <div class="chat-messages" id="chat-messages">
        <!-- Example Messages -->
        <div class="message received">Haha, ốp lưng của m định vàng hay kim cương vậy</div>
        <div class="message sent">Mua ốp lưng tặng coin meme đi</div>
        <div class="message received">Dạ, nào anh làm cho em hùn vốn với</div>
      </div>

      <!-- Chat Input -->
      <div class="chat-input">
        <input type="text" id="message-input" placeholder="Type a message...">
        <button id="send-button">Send</button>
      </div>
    </div>
  </div>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</body>
</html>
