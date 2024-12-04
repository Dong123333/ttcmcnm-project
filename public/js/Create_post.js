function previewMultipleMedia(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById("preview-container");
    const clearButton = document.getElementById("clear-preview");
    previewContainer.innerHTML = ""; 
    const maxPreview = 4; 
    const fileArray = Array.from(files);

    if (fileArray.length === 1) {
        previewContainer.className = "single";
    } else if (fileArray.length === 2) {
        previewContainer.className = "double";
    } else if (fileArray.length === 3) {
        previewContainer.className = "triple";
    } else {
        previewContainer.className = "quadruple";
    }

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

        if (index === maxPreview - 1 && fileArray.length > maxPreview) {
            const overlay = document.createElement("div");
            overlay.className = "overlay";
            overlay.textContent = `+${fileArray.length - maxPreview}`;
            container.appendChild(overlay);
        }

        previewContainer.appendChild(container);
    });

    if (fileArray.length > 0) {
        clearButton.style.display = "block";
    }
}

function clearPreview(event) {
    event.preventDefault(); 
    const previewContainer = document.getElementById("preview-container");
    const mediaInput = document.getElementById("media");
    const clearButton = document.getElementById("clear-preview");

    previewContainer.innerHTML =
        '<p style="color: #888; align-items: center; justify-content: center;"></p>';

    mediaInput.value = "";

    clearButton.style.display = "none";
}

function handleClose() {
    window.location.href = "/home";
}
