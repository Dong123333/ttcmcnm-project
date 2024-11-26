document.addEventListener("DOMContentLoaded", function () {
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
});
