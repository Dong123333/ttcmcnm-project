<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Chat</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="chat-container">
        <!-- Sidebar với danh sách người dùng -->
        <div class="chat-sidebar">
            <div class="chat-header">
                <h3>Gần đây</h3>
            </div>
            <ul class="chat-list">
                <li class="chat-item active">
                    <div class="avatar">👤</div>
                    <div class="chat-info">
                        <p class="chat-name">Hồ Bá Đông</p>
                        <p class="chat-last-message">Dạ anh</p>
                    </div>
                    <div class="chat-time">14/11/2024</div>
                </li>
                <li class="chat-item">
                    <div class="avatar">⚠️</div>
                    <div class="chat-info">
                        <p class="chat-name">Hoàng Văn Thông</p>
                        <p class="chat-last-message">Chào anh</p>
                    </div>
                    <div class="chat-time">20/6/2024</div>
                </li>
                <!-- Các mục khác -->
            </ul>
        </div>

        <!-- Nội dung cuộc trò chuyện -->
        <div class="chat-content">
            <div class="chat-header">
                <p>Hồ Bá Đông <span class="status">Online</span></p>
            </div>
            <div class="chat-messages" id="chat-messages">
                <div class="message">
                    <p><strong>Hồ Bá Đông:</strong> Dạ anh</p>
                </div>
                <div class="message">
                    <p><strong>Hồ Bá Đông:</strong> Done xong rồi đó ạ</p>
                </div>
                <!-- Các tin nhắn khác -->
            </div>
            <div class="chat-input">
                <input type="text" id="chat-input" placeholder="Type a message">
                <button id="send-button">➤</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
