<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Interface</title>
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
  <div class="chat-container">
    <!-- Sidebar for contacts -->
    <div class="sidebar">
      <!-- Avatar của người dùng hiện tại -->
      @if(Auth::check())
      <div class="current-user">
        <img src="{{ Auth::user()->avatar }}" alt="User Avatar" class="user-avatar">
        <div class="user-info">
          <p class="username-current">{{ Auth::user()->nickName }}</p> <!-- Hiển thị nickName -->
          <span class="status">Primary | General</span>
        </div>
      </div>
      @endif
      <hr>
      <!-- Danh sách các user đang online -->
      <div class="contact-list">
        @foreach ($users as $user)
        <div class="contact" data-id="{{ $user->id }}" data-name="{{ $user->fullName }}" data-nickname="{{ $user->nickName}}">
          <img src="{{ $user->avatar }}" alt="Avatar" class="contact-avatar">
          <div class="contact-info">
            <p class="contact-username">{{ $user->fullName }}</p>
            <p class="contact-nickname">{{ $user->nickName }}</p>
          </div>
        </div>
        @endforeach
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
              <img src="" alt="Avatar" class="chat-avatar" id="chat-header-avatar">
              <div class="chat-user-info">
                <p class="chat-username" id="chat-header-username">Select a contact</p>
                <p class="chat-nickname" id="chat-header-nickname">...</p>
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
          <div class="chat-messages" id="chat-messages"></div>

          <!-- Chat Input -->
          <div class="chat-input">
            <form id="chat-form">
              <input type="text" id="message-input" placeholder="Type a message...">
              <button id="send-button">Send</button>
            </form>

          </div>
        </div>
      </div>
      <script>
        const contacts = document.querySelectorAll('.contact');
        const chatHeaderNickName = document.getElementById('chat-header-nickname');
        const chatHeaderUsername = document.getElementById('chat-header-username');
        const chatHeaderAvatar = document.getElementById('chat-header-avatar');
        const chatMessages = document.getElementById('chat-messages');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');
        const userId = '{{ Auth::user()->id }}';
        let receiverId;
        // Xử lý khi click vào contact
        contacts.forEach(contact => {
          contact.addEventListener('click', () => {
            receiverId = contact.dataset.id;
            const receiveNickName = contact.dataset.nickname;
            const receiverName = contact.dataset.name;
            const receiverAvatar = contact.querySelector('.contact-avatar')?.src;

            // Cập nhật thông tin người nhận
            // activeReceiverId = receiverId;
            chatHeaderNickName.textContent = receiveNickName;
            chatHeaderUsername.textContent = receiverName;
            chatHeaderAvatar.src = receiverAvatar;

            chatMessages.innerHTML = '';
            fetchMessages(receiverId);
          });
        });

        const pusher = new Pusher('2d9d4f7fa9155bbd373f', {
          cluster: 'ap1',
          forceTLS: true
        });

        // Lắng nghe kênh Pusher
        const channel = pusher.subscribe('chat');
        channel.bind('message.sent', function(data) {
          if (data.message.sender_id !== userId) {
            appendMessage(data.message.sender_id, data.message.content);
          }
        });

        // Xử lý gửi tin nhắn
        $('#chat-form').submit(function(e) {
          e.preventDefault();

          if (!receiverId) {
            alert('Vui lòng chọn người nhận trước khi gửi tin nhắn!');
            return;
          }

          const messageContent = messageInput.value.trim();

          if (messageContent === '') {
            alert('Nội dung tin nhắn không được để trống!');
            return;
          }

          $.post('/broadcast', {
            receiver_id: receiverId,
            content: messageContent,
            _token: '{{ csrf_token() }}'
          }).done(function(response) {
            // appendMessage(userId, messageContent); // Hiển thị tin nhắn của bản thân
            messageInput.value = ''; // Reset input
          }).fail(function(error) {
            alert('Failed to send message');
            console.error(error);
          });
        });

        // Hàm tải tin nhắn từ server
        function fetchMessages(receiverId) {
          $.get(`/messages/${receiverId}`)
            .done(function(messages) {
              messages.forEach(message => {
                appendMessage(message.sender_id, message.content);
              });
            })
            .fail(function(error) {
              console.error('Error loading messages:', error);
              alert('Failed to load messages');
            });
        }

        // Hàm thêm tin nhắn vào khung chat
        function appendMessage(senderId, messageContent) {
          const isSelf = senderId == userId;
          const messageElement = `<p class="${isSelf ? 'sent' : 'received'}">
                ${messageContent}
            </p>`;
          chatMessages.innerHTML += messageElement;
          chatMessages.scrollTop = chatMessages.scrollHeight; // Cuộn xuống cuối
        }
      </script>
      <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</body>

</html>