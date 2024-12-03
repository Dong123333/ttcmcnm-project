// Hàm để hiển thị media từ database
function loadMediaFromDatabase(mediaList) {
    const previewContainer = document.getElementById("preview-container");
    previewContainer.innerHTML = ""; // Xóa nội dung cũ

    const maxPreview = 4;

    if (mediaList.length === 1) {
        previewContainer.className = "single";
    } else if (mediaList.length === 2) {
        previewContainer.className = "double";
    } else if (mediaList.length === 3) {
        previewContainer.className = "triple";
    } else {
        previewContainer.className = "quadruple";
    }

    mediaList.slice(0, maxPreview).forEach((media, index) => {
        const container = document.createElement("div");
        container.style.position = "relative";
        container.style.overflow = "hidden";
        container.style.borderRadius = "8px";

        if (media.media_type === "image") {
            const img = document.createElement("img");
            img.src = media.media_url;
            img.style.width = "100%";
            img.style.height = "100%";
            img.style.objectFit = "cover";
            container.appendChild(img);
        } else if (media.media_type === "video") {
            const video = document.createElement("video");
            video.src = media.media_url;
            video.controls = true;
            video.style.width = "100%";
            video.style.height = "100%";
            video.style.objectFit = "cover";
            container.appendChild(video);
        }

        if (index === maxPreview - 1 && mediaList.length > maxPreview) {
            const overlay = document.createElement("div");
            overlay.className = "overlay";
            overlay.textContent = `+${mediaList.length - maxPreview}`;
            container.appendChild(overlay);
        }

        previewContainer.appendChild(container);
    });
}

// Load media từ database khi trang được tải
document.addEventListener("DOMContentLoaded", function () {
    const mediaList = window.mediaList || [];
    loadMediaFromDatabase(mediaList);
});

// js/update_post.js
function previewMultipleMedia(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById("preview-container");
    const clearButton = document.getElementById("clear-preview");
    previewContainer.innerHTML = ""; // Xóa nội dung preview cũ

    const maxPreview = 4; // Giới hạn tối đa 4 file
    const fileArray = Array.from(files);

    // Thay đổi lớp CSS của container dựa trên số lượng file
    if (fileArray.length === 1) {
        previewContainer.className = "single";
    } else if (fileArray.length === 2) {
        previewContainer.className = "double";
    } else if (fileArray.length === 3) {
        previewContainer.className = "triple";
    } else {
        previewContainer.className = "quadruple";
    }

    // Hiển thị file
    fileArray.slice(0, maxPreview).forEach((file, index) => {
        const fileType = file.type;

        const container = document.createElement("div");
        container.style.position = "relative";
        container.style.overflow = "hidden";
        container.style.borderRadius = "8px";

        if (fileType.startsWith("image/")) {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.style.width = "100%";
            img.style.height = "100%";
            img.style.objectFit = "cover";
            container.appendChild(img);
        } else if (fileType.startsWith("video/")) {
            const video = document.createElement("video");
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.style.width = "100%";
            video.style.height = "100%";
            video.style.objectFit = "cover";
            container.appendChild(video);
        }

        // Thêm lớp phủ "+n" nếu có nhiều hơn 4 file
        if (index === maxPreview - 1 && fileArray.length > maxPreview) {
            const overlay = document.createElement("div");
            overlay.className = "overlay";
            overlay.textContent = `+${fileArray.length - maxPreview}`;
            container.appendChild(overlay);
        }

        previewContainer.appendChild(container);
    });

    // Hiển thị nút "Clear" khi có file được chọn
    if (fileArray.length > 0) {
        clearButton.style.display = "block";
    }
}
document.addEventListener("DOMContentLoaded", function () {
    const mediaList = window.mediaList || [];
    loadMediaFromDatabase(mediaList);
});

function handleClose() {
    window.location.href = "/home";
}
