function previewMultipleMedia(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('preview-container');
    const clearButton = document.getElementById('clear-preview');
    previewContainer.innerHTML = ''; // Xóa nội dung preview cũ

    const maxPreview = 4; // Giới hạn tối đa 4 file
    const fileArray = Array.from(files);

    // Thay đổi lớp CSS của container dựa trên số lượng file
    if (fileArray.length === 1) {
        previewContainer.className = 'single';
    } else if (fileArray.length === 2) {
        previewContainer.className = 'double';
    } else if (fileArray.length === 3) {
        previewContainer.className = 'triple';
    } else {
        previewContainer.className = 'quadruple';
    }

    // Hiển thị file
    fileArray.slice(0, maxPreview).forEach((file, index) => {
        const fileType = file.type;

        const container = document.createElement('div');
        container.style.position = 'relative';
        container.style.overflow = 'hidden';
        container.style.borderRadius = '8px';

        if (fileType.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            container.appendChild(img);
        } else if (fileType.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.style.width = '100%';
            video.style.height = '100%';
            video.style.objectFit = 'cover';
            container.appendChild(video);
        }

        // Thêm lớp phủ "+n" nếu có nhiều hơn 4 file
        if (index === maxPreview - 1 && fileArray.length > maxPreview) {
            const overlay = document.createElement('div');
            overlay.className = 'overlay';
            overlay.textContent = `+${fileArray.length - maxPreview}`;
            container.appendChild(overlay);
        }

        previewContainer.appendChild(container);
    });

    // Hiển thị nút "Clear" khi có file được chọn
    if (fileArray.length > 0) {
        clearButton.style.display = 'block';
    }
}

function clearPreview(event) {
    event.preventDefault(); // Ngăn chặn hành động mặc định của nút

    const previewContainer = document.getElementById('preview-container');
    const mediaInput = document.getElementById('media');
    const clearButton = document.getElementById('clear-preview');

    // Xóa nội dung container
    previewContainer.innerHTML = '<p style="color: #888; align-items: center; justify-content: center;"></p>';

    // Reset input file để cho phép chọn lại ảnh/video
    mediaInput.value = '';

    // Ẩn nút "Clear"
    clearButton.style.display = 'none';
}