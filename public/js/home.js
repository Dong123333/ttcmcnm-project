document.addEventListener("DOMContentLoaded", function () {
    // Xử lý "Xem thêm" và "Ẩn bớt" trong mô tả bài viết
    const showMoreButtons = document.querySelectorAll(".show-more");

    showMoreButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const postDescription = this.previousElementSibling;

            if (postDescription.classList.contains("expanded")) {
                postDescription.classList.remove("expanded");
                this.textContent = "Xem thêm";
                postDescription.style.display = "-webkit-box";
            } else {
                postDescription.classList.add("expanded");
                this.textContent = "Ẩn bớt";
                postDescription.style.display = "block";
            }
        });
    });

    // Xử lý like/unlike icon
    const likeIcons = document.querySelectorAll(
        ".post-actions img:first-child",
    );

    likeIcons.forEach((likeIcon) => {
        likeIcon.addEventListener("click", function () {
            const currentIcon = this;

            if (currentIcon.src.includes("like_icon.svg")) {
                currentIcon.src = "images/likefull_icon.svg";
            } else {
                currentIcon.src = "images/like_icon.svg";
            }
        });
    });

    // Xử lý slider
    const sliderWrappers = document.querySelectorAll(".slider-wrapper");

    sliderWrappers.forEach((sliderWrapper) => {
        const images = sliderWrapper.querySelectorAll(".post-img");
        const prevBtn =
            sliderWrapper.parentElement.querySelector(".slider-btn.prev");
        const nextBtn =
            sliderWrapper.parentElement.querySelector(".slider-btn.next");
        let currentIndex = 0;

        const updateSlider = () => {
            sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
        };

        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % images.length;
            updateSlider();
        });

        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateSlider();
        });

        updateSlider();
    });

    // Xử lý Dropdown Menu cho profile-account
    const profileAccount = document.querySelector(".profile-account");
    const dropdownMenu = document.getElementById("dropdown-menu");

    if (profileAccount && dropdownMenu) {
        profileAccount.addEventListener("click", function (event) {
            event.stopPropagation(); // Ngăn sự kiện lan truyền

            dropdownMenu.style.display =
                dropdownMenu.style.display === "block" ? "none" : "block";
        });

        window.addEventListener("click", function (event) {
            if (
                !profileAccount.contains(event.target) &&
                !dropdownMenu.contains(event.target)
            ) {
                dropdownMenu.style.display = "none";
            }
        });
    }

    // Hàm mở modal
    function openModal() {
        if (
            !document.body.classList.contains("google-user") &&
            !document.body.classList.contains("github-user")
        ) {
            document.querySelector(".modal-container").style.display = "flex";
        }
    }

    // Hàm đóng modal
    document.querySelector(".btn-cancel").addEventListener("click", closeModal);

    function closeModal() {
        const modalContainer = document.querySelector(".modal-container");
        if (modalContainer) {
            modalContainer.style.display = "none";
        }
    }

    // Thêm sự kiện vào phần tử "Thông tin cá nhân"
    document.querySelectorAll(".dropdown-item").forEach((item) => {
        item.addEventListener("click", (e) => {
            if (
                e.target &&
                e.target.textContent.trim() === "Thông tin cá nhân"
            ) {
                openModal(); // Mở modal
            }
        });
    });

    // Thêm sự kiện đóng modal khi nhấn vào nút "✖"
    document
        .querySelector(".modal-close")
        .addEventListener("click", closeModal);

    // Tìm tất cả các biểu tượng ba chấm
    const threeDotsIcons = document.querySelectorAll(".three-dots-icon");

    // Thêm sự kiện click vào mỗi biểu tượng ba chấm
    threeDotsIcons.forEach((icon) => {
        icon.addEventListener("click", function (event) {
            // Ngừng sự kiện lan truyền để ngăn không đóng dropdown ngay lập tức
            event.stopPropagation();

            // Lấy dropdown menu liên quan đến biểu tượng ba chấm đã nhấn
            const dropdownMenuPost = this.closest(".post-header").querySelector(
                ".dropdown-menu-post",
            );

            // Kiểm tra và thay đổi trạng thái hiển thị của dropdown menu
            if (dropdownMenuPost.style.display === "block") {
                dropdownMenuPost.style.display = "none"; // Nếu đang mở thì đóng
            } else {
                dropdownMenuPost.style.display = "block"; // Nếu đang đóng thì mở
            }
        });
    });

    // Đóng dropdown menu khi click ra ngoài
    document.addEventListener("click", function (event) {
        const dropdownMenus = document.querySelectorAll(".dropdown-menu-post");
        dropdownMenus.forEach(function (dropdown) {
            if (
                !dropdown.contains(event.target) &&
                !event.target.matches(".three-dots-icon")
            ) {
                dropdown.style.display = "none"; // Đóng menu nếu click ngoài
            }
        });
    });

    // Xử lý nhấn nút lưu để load ảnh và thông tin
    document
        .querySelector(".btn-save")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Ngừng hành động mặc định (submit)
            document.getElementById("profile-form").submit(); // Gửi form
        });
    document
        .getElementById("edit")
        .addEventListener("change", handleImageChange);
    function handleImageChange(event) {
        const file = event.target.files[0]; // Lấy file đã chọn
        if (file) {
            const reader = new FileReader(); // Tạo đối tượng FileReader
            reader.onload = function (e) {
                const profileImage = document.getElementById("profileImage");
                profileImage.src = e.target.result; // Cập nhật thuộc tính src của ảnh
            };
            reader.readAsDataURL(file); // Đọc file dưới dạng URL
        }
    }
});
