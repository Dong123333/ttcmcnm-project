<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  </head>
  <body>
    <div class="near-container">
      <!-- Sidebar -->
      <div>
        <div class="near-sidebar">
          <aside class="sidebar">
            <div class="logo-near">
              <a href="">
                <img src="{{ asset('img/logo_near.jpg') }}" alt="Logo" />
              </a>  
            </div>
            <ul class="menu">
              <li>
                <a href=""
                  ><img src="{{ asset('img/home_icon.svg') }}" alt="" />
                  <p>Trang Chủ</p></a
                >
              </li>
              <li>
                <a href=""
                  ><img src="{{ asset('img/search_icon.svg') }}" alt="" />
                  <p>Tìm Kiếm</p></a
                >
              </li>
              <li>
                <a href=""
                  ><img src="{{ asset('img/chat_icon.svg') }}" alt="" />
                  <p>Tin Nhắn</p></a
                >
              </li>
              <li>
                <a href=""
                  ><img src="{{ asset('img/bell_icon.svg') }}" alt="" />
                  <p>Thông Báo</p></a
                >
              </li>
              <li>
                <a href=""
                  ><img src="{{ asset('img/setting_icon.svg') }}" alt="Cài Đặt" />
                  <p>Cài Đặt</p></a
                >
              </li>
              <li>
                <a href="">
                  <img
                    src="https://via.placeholder.com/50"
                    alt="Trang Cá Nhân"
                    class="profile-img-side3"
                  />
                  <p>Trang Cá Nhân</p>
                </a>
              </li>
            </ul>
          </aside>
        </div>
      </div>
      <!-- Content -->
      <div class="main-content">
        <div class="post">
          <div class="post-header">
            <img
              src="https://via.placeholder.com/50"
              alt="Profile"
              class="post-profile-img"
            />
            <div class="post-info">
              <p class="post-name">thongmloe</p>
            </div>
          </div>
          <div class="post-content">
            <img
              src="https://via.placeholder.com/400x500"
              alt="Post Image"
              class="post-img"
            />
          </div>
          <div class="post-actions">
            <img src="{{ asset('img/like_icon.svg') }}" alt="Like" />
            <img src="{{ asset('img/comment_icon.svg') }}" alt="Comment" />
            <img src="{{ asset('img/send_icon.svg') }}" alt="Send" />
            <img src="{{ asset('img/save_icon.svg') }}" alt="Save" />
          </div>
          <div class="post-description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam
            ipsam doloribus, sit delectus tempore autem doloremque cupiditate
            necessitatibus amet vero itaque natus, aliquam qui libero sapiente
            ipsa vitae asperiores praesentium.
          </div>
          <span class="show-more">Xem thêm</span>
        </div>
        <div class="post">
          <div class="post-header">
            <img
              src="https://via.placeholder.com/50"
              alt="Profile"
              class="post-profile-img"
            />
            <div class="post-info">
              <p class="post-name">thongmloe</p>
            </div>
          </div>
          <div class="post-content">
            <img
              src="https://via.placeholder.com/400x500"
              alt="Post Image"
              class="post-img"
            />
          </div>
          <div class="post-actions">
            <img src="{{ asset('img/like_icon.svg') }}" alt="Like" />
            <img src="{{ asset('img/comment_icon.svg') }}" alt="Comment" />
            <img src="{{ asset('img/send_icon.svg') }}" alt="Send" />
            <img src="{{ asset('img/save_icon.svg') }}" alt="Save" />
          </div>
          <div class="post-description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam
            ipsam doloribus, sit delectus tempore autem doloremque cupiditate
            necessitatibus amet vero itaque natus, aliquam qui libero sapiente
            ipsa vitae asperiores praesentium.
          </div>
          <span class="show-more">Xem thêm</span>
        </div>
      </div>
      <div class="account-info">
        <div class="profile">
          <img
            src="https://via.placeholder.com/50"
            alt="Profile"
            class="profile-img"
          />
          <div class="profile-info">
            <h4 class="username">thongmloe</h4>
            <p class="fullname">Hoàng Văn Thông</p>
          </div>
          <a href="#" class="switch">Chuyển</a>
        </div>
      </div>
    </div>
    <!-- JavaScript -->
    <script>
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
          ".post-actions img:first-child"
        );

        likeIcons.forEach((likeIcon) => {
          likeIcon.addEventListener("click", function () {
            const currentIcon = this;

            if (currentIcon.src.includes("like_icon.svg")) {
              currentIcon.src = "{{ asset('img/likefull_icon.svg') }}";
            } else {
              currentIcon.src = "{{ asset('img/like_icon.svg') }}";
            }
          });
        });
      });
    </script>
  </body>
</html>
