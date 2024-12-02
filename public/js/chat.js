const contacts = document.querySelectorAll('.contact');
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
            const receiverName = contact.dataset.name;
            const receiverAvatar = contact.querySelector('.contact-avatar')?.src;

            // Cập nhật thông tin người nhận
            // activeReceiverId = receiverId;
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