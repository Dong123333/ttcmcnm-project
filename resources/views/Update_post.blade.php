<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo bài viết</title>
    <link rel="stylesheet" href="{{ asset('css/Update_post.css') }}">
</head>
<body>
    <form action="/save-post" method="POST" class="modal">
        <div class="modal-header">
            <span class="modal-title">Cập nhật bài viết</span>
            <button type="button" class="btn-close" onclick="alert('Đóng modal')">✖</button>
        </div>

        <div class="modal-body">
            <div class="user-info">
                <img src="{{ asset('images/person.png') }}" alt="User Avatar">
                <div class="user-details">
                    <strong>Đỗ Trần Tuyến</strong>
                </div>
            </div>

            <textarea name="content" placeholder="Bạn đang nghĩ gì?" required></textarea>

            <div class="upload-box">
                <div id="preview-container">
                    <p style="color: #aaa;">Chưa có file nào được chọn.</p>
                </div>
                <label for="media" style="cursor: pointer; color: #4caf50; font-weight: bold; padding: 10px;">Chọn ảnh/video</label>
                <input type="file" id="media" name="media[]" accept="image/*,video/*" multiple style="display: none;" onchange="previewMultipleMedia(event)">
                <button id="clear-preview" onclick="clearPreview(event)" type="button" style="display: none; position: absolute; top: 10px; right: 10px; background: #f44336; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">X</button>
            </div>

            <div class="action-buttons">
                <div class="action-item">
                    <img src="{{ asset('images/local_image.png') }}" alt="Ảnh/Video">
                    <span>Ảnh/Video</span>
                </div>
                <div class="action-item">
                    <img src="{{ asset('images/tag_people.png') }}" alt="Gắn thẻ">
                    <span>Gắn thẻ người khác</span>
                </div>
                <div class="action-item">
                    <img src="{{ asset('images/smile_face.png') }}" alt="Cảm xúc">
                    <span>Cảm xúc/hoạt động</span>
                </div>
                <div class="action-item">
                    <img src="{{ asset('images/local.png') }}" alt="Check-in">
                    <span>Check in</span>
                </div>
            </div>

            <button type="submit" class="post-btn">Cập nhật</button>
        </div>
    </form>
    <script src="{{ asset('js/Create_post.js') }}"></script>
</body>
</html>
