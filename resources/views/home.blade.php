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
                <img src="{{ asset('images/logo_near.jpg') }}" alt="Logo" />
              </a>  
            </div>
            <ul class="menu">
              <li>
                <a href=""
                  ><img src="{{ asset('images/home_icon.svg') }}" alt="" />
                  <p>Trang Chủ</p></a
                >
              </li>
              <li>
                <a href=""
                  ><img src="{{ asset('images/search_icon.svg') }}" alt="" />
                  <p>Tìm Kiếm</p></a
                >
              </li>
              <li>
                <a href="/chat"
                  ><img src="{{ asset('images/chat_icon.svg') }}" alt="" />
                  <p>Tin Nhắn</p></a
                >
              </li>
              <li>
                <a href=""
                  ><img src="{{ asset('images/bell_icon.svg') }}" alt="" />
                  <p>Thông Báo</p></a
                >
              </li>
              <li>
                <a href="/create-post"
                  ><img src="{{ asset('images/plus_icon.svg') }}" alt="Cài Đặt" />
                  <p>Tạo</p></a
                >
              </li>
              <li>
                <a href="">
                  <img
                    src="https://placehold.co/400x400/png"
                    alt="Trang Cá Nhân"
                    class="profile-img-side3"
                  />
                  <p>Trang Cá Nhân</p>
                </a>
              </li>
              <li>
                <a href=""
                  ><img src="{{ asset('images/setting_icon.svg') }}" alt="Cài Đặt" />
                  <p>Cài Đặt</p></a
                >
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
              src="https://placehold.co/50x50/png"
              alt="Profile"
              class="post-profile-img"
            />
            <div class="post-info">
              <p class="post-name">thongmloe</p>
            </div>
          </div>
          <div class="post-content">
            <button class="slider-btn prev">❮</button>
            <div class="slider-wrapper">
              <img src="https://placehold.co/600x600/png?text=Image+1" alt="Image 1" class="post-img" />
              <img src="https://placehold.co/600x600/png?text=Image+2" alt="Image 2" class="post-img" />
              <img src="https://placehold.co/600x600/png?text=Image+3" alt="Image 3" class="post-img" />
            </div>
            <button class="slider-btn next">❯</button>
          </div>
          <div class="post-actions">
            <img src="{{ asset('images/like_icon.svg') }}" alt="Like" />
            <img src="{{ asset('images/comment_icon.svg') }}" alt="Comment" />
            <img src="{{ asset('images/send_icon.svg') }}" alt="Send" />
            <img src="{{ asset('images/save_icon.svg') }}" alt="Save" />
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
              src="https://placehold.co/50x50/png"
              alt="Profile"
              class="post-profile-img"
            />
            <div class="post-info">
              <p class="post-name">thongmloe</p>
            </div>
          </div>
          <div class="post-content">
            <button class="slider-btn prev">❮</button>
            <div class="slider-wrapper">
              <img src="https://placehold.co/600x600/png?text=Image+1" alt="Image 1" class="post-img" />
              <img src="https://placehold.co/600x600/png?text=Image+2" alt="Image 2" class="post-img" />
              <img src="https://placehold.co/600x600/png?text=Image+3" alt="Image 3" class="post-img" />
            </div>
            <button class="slider-btn next">❯</button>
          </div>
          <div class="post-actions">
            <img src="{{ asset('images/like_icon.svg') }}" alt="Like" />
            <img src="{{ asset('images/comment_icon.svg') }}" alt="Comment" />
            <img src="{{ asset('images/send_icon.svg') }}" alt="Send" />
            <img src="{{ asset('images/save_icon.svg') }}" alt="Save" />
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
            src="https://placehold.co/50x50/png"
            alt="Profile"
            class="profile-img"
          />
          <div class="profile-info">
            <h4 class="username">thongmloe</h4>
            <p class="fullname">Hoàng Văn Thông</p>
          </div>
          <a href="/login" class="switch">Đăng Xuất</a>
        </div>
        <div class="header-contact">
            <h3>Người liên hệ</h3>
        </div>
        <ul class="contact-list">
          <li class="contact-item online">
            <img src="https://placehold.co/40x40/png?text=Image+1" alt="Avatar" class="avatar" />
            <div class="contact-info">
              <span class="contact-name">Nguyễn Thị Trà My</span>
              <span class="contact-status">Trực tuyến</span>
            </div>
          </li>
          <li class="contact-item online">
            <img src="https://placehold.co/40x40/png?text=Image+1" alt="Avatar" class="avatar" />
            <div class="contact-info">
              <span class="contact-name">Giang Nam</span>
              <span class="contact-status">Trực tuyến</span>
            </div>
          </li>
          <li class="contact-item online">
            <img src="https://placehold.co/40x40/png?text=Image+1" alt="Avatar" class="avatar" />
            <div class="contact-info">
              <span class="contact-name">Hồ Bá Đông</span>
              <span class="contact-status">Trực tuyến</span>
            </div>
          </li>
          <li class="contact-item offline">
            <img src="https://placehold.co/40x40/png?text=Image+1" alt="Avatar" class="avatar" />
            <div class="contact-info">
              <span class="contact-name">Nguyễn Thị Lan Ánh</span>
              <span class="contact-status">Ngoại tuyến</span>
            </div>
          </li>
          <li class="contact-item offline">
            <img src="https://placehold.co/40x40/png?text=Image+2" alt="Avatar" class="avatar" />
            <div class="contact-info">
              <span class="contact-name">Dang Anh Thu</span>
              <span class="contact-status">Ngoại tuyến</span>
            </div>
          </li>
          <li class="contact-item offline">
            <img src="https://placehold.co/40x40/png?text=Image+1" alt="Avatar" class="avatar" />
            <div class="contact-info">
              <span class="contact-name">Hữu Luu</span>
              <span class="contact-status">Ngoại tuyến</span>
            </div>
          </li>
        </ul>
        <div class="contact-footer">
          <p>
            <a href="#">Giới thiệu</a> ·
            <a href="#">Trợ giúp</a> ·
            <a href="#">Báo chí</a> ·
            <a href="#">API</a> ·
            <a href="#">Việc làm</a> ·
            <a href="#">Quyền riêng tư</a> ·
            <a href="#">Điều khoản</a> ·
            <a href="#">Vị trí</a> ·
            <a href="#">Ngôn ngữ</a>
          </p>
          <p>
            VanThong đã xác minh
          </p>
          <p>
            © 2050 NEAR FROM WTF
          </p>
        </div>
      </div>
    </div>
    <!-- JavaScript -->
    <script src="{{ asset('js/home.js') }}"></script>
  </body>
</html>
