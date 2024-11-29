document.addEventListener("DOMContentLoaded", function () {
    // Xử lý "Xem thêm" và "Ẩn bớt" trong mô tả bài viết
    document.querySelectorAll(".show-more").forEach((button) => {
        button.addEventListener("click", function () {
            const postDescription = this.previousElementSibling;
            const isExpanded = postDescription.classList.toggle("expanded");
            this.textContent = isExpanded ? "Ẩn bớt" : "Xem thêm";
            postDescription.style.display = isExpanded
                ? "block"
                : "-webkit-box";
        });
    });

    // Xử lý like/unlike icon
    document
        .querySelectorAll(".post-actions img:first-child")
        .forEach((likeIcon) => {
            likeIcon.addEventListener("click", function () {
                this.src = this.src.includes("like_icon.svg")
                    ? "images/likefull_icon.svg"
                    : "images/like_icon.svg";
            });
        });

    // Xử lý slider
    const sliderWrappers = document.querySelectorAll(".slider-wrapper");

    sliderWrappers.forEach((sliderWrapper) => {
        const images = sliderWrapper.querySelectorAll(".post-img");
        let currentIndex = 0;

        // Cập nhật vị trí slider
        const updateSlider = () => {
            sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
        };

        // Thêm sự kiện click vào mỗi ảnh
        images.forEach((img, index) => {
            img.addEventListener("click", function () {
                // Tăng hoặc giảm currentIndex khi click vào ảnh
                currentIndex = (index + 1) % images.length;
                updateSlider();
            });
        });

        // Đảm bảo ảnh chuyển vòng quanh (đến ảnh đầu khi đến ảnh cuối)
        updateSlider();
    });

    // Xử lý Dropdown Menu cho profile-account
    const profileAccount = document.querySelector(".profile-account");
    const dropdownMenu = document.getElementById("dropdown-menu");
    if (profileAccount && dropdownMenu) {
        profileAccount.addEventListener("click", (event) => {
            event.stopPropagation();
            dropdownMenu.style.display =
                dropdownMenu.style.display === "block" ? "none" : "block";
        });

        window.addEventListener("click", (event) => {
            if (
                !profileAccount.contains(event.target) &&
                !dropdownMenu.contains(event.target)
            ) {
                dropdownMenu.style.display = "none";
            }
        });
    }

    // Hàm mở/đóng modal
    const toggleModal = (action) => {
        const modalContainer = document.querySelector(".modal-container");
        if (action === "open") {
            if (
                !document.body.classList.contains("google-user") &&
                !document.body.classList.contains("github-user")
            ) {
                modalContainer.style.display = "flex";
            }
        } else {
            modalContainer.style.display = "none";
        }
    };

    document
        .querySelector(".btn-cancel")
        .addEventListener("click", () => toggleModal("close"));
    document
        .querySelector(".modal-close")
        .addEventListener("click", () => toggleModal("close"));

    document.querySelectorAll(".dropdown-item").forEach((item) => {
        item.addEventListener("click", (e) => {
            if (e.target.textContent.trim() === "Thông tin cá nhân") {
                toggleModal("open");
            }
        });
    });

    // Xử lý dropdown menu ba chấm
    document.querySelectorAll(".three-dots-icon").forEach((icon) => {
        icon.addEventListener("click", function (event) {
            event.stopPropagation();
            const dropdownMenuPost = this.closest(".post-header").querySelector(
                ".dropdown-menu-post",
            );
            dropdownMenuPost.style.display =
                dropdownMenuPost.style.display === "block" ? "none" : "block";
        });
    });

    document.addEventListener("click", function (event) {
        document.querySelectorAll(".dropdown-menu-post").forEach((dropdown) => {
            if (
                !dropdown.contains(event.target) &&
                !event.target.matches(".three-dots-icon")
            ) {
                dropdown.style.display = "none";
            }
        });
    });

    // Xử lý thay đổi ảnh trong modal
    document.getElementById("edit").addEventListener("change", (event) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById("profileImage").src = e.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    // Xử lý lưu form profile
    document.querySelector(".btn-save").addEventListener("click", (event) => {
        event.preventDefault();
        document.getElementById("profile-form").submit();
    });

    // Xử lý bài viết của bản thân
    const currentUserId = document.body.getAttribute("data-user-id");

    // Toggledropdown và các mục sửa/xóa
    const toggleDropdownPost = (event) => {
        const postElement = event.target.closest(".post");
        const postOwnerId = postElement.getAttribute("data-post-owner-id");
        const dropdownMenu = postElement.querySelector(".dropdown-menu-post");
        const editPost = postElement.querySelector(".edit-post");
        const deletePost = postElement.querySelector(".delete-post");

        if (parseInt(postOwnerId) === currentUserId) {
            editPost.style.display = "block";
            deletePost.style.display = "block";
        } else {
            editPost.style.display = "none";
            deletePost.style.display = "none";
        }

        dropdownMenu.classList.toggle("show");
    };

    document.addEventListener("click", (event) => {
        if (
            !event.target.closest(".post-header") &&
            !event.target.closest(".dropdown-menu-post")
        ) {
            document
                .querySelectorAll(".dropdown-menu-post")
                .forEach((dropdown) => dropdown.classList.remove("show"));
        }
    });
});
