<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/logo_near.jpg') }}" type="image/x-icon">
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
                <a href="chat"
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
                <a href="{{ route('create') }}"
                  ><img src="{{ asset('images/plus_icon.svg') }}" alt="Cài Đặt" />
                  <p>Tạo</p></a
                >
              </li>
              <li>
                <a href="">
                  <img
                    src="{{ Auth::check() ? (Auth::user()->avatar ?? 'default-avatar.jpg') : 'default-avatar.jpg' }}"
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
        @foreach($posts as $post)
        <div class="post" data-post-id="{{ $post->id }}" data-post-owner-id="{{ $post->user_id }}">
          <div class="post-header">
            <img
              src="{{ $post->user->avatar }}"
              alt="Profile"
              class="post-profile-img"
            />
            <div class="post-info">
              <p class="post-name">{{ $post->user->nickName }}</p>
            </div>
            <span class="three-dots-icon" onclick="toggleDropdownPost(event)">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="2"></circle>
                <circle cx="19" cy="12" r="2"></circle>
                <circle cx="5" cy="12" r="2"></circle>
              </svg>
            </span>
            <div class="dropdown-menu-post">
              <ul>
                @if (Auth::user()->id == $post->user_id)
                <li>
                  <a class="dropdown-item-post edit-post" href="{{ route('edit', ['id' => $post->id]) }}">
                    <img src="{{ asset('images/pen_icon.svg') }}" alt="">
                    <p>Sửa bài viết</p>
                  </a>
                </li>
                <li>
                <form action="{{ route('posts.destroy', ['postId' => $post->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item-post delete-post" style="background: none; border: none; padding: 0; cursor: pointer;">
                      <img src="{{ asset('images/trash_icon.svg') }}" alt="">
                      <p>Xóa bài viết</p>
                  </button>
                </form>
                </li>
                @endif
                <li><a class="dropdown-item-post"><img src="{{ asset('images/save_icon copy.svg') }}" alt=""><p>Lưu bài viết</p></a></li>
              </ul>
            </div>
          </div>
          <div class="post-content">
            <div class="slider-wrapper" style="transform: translateX(0%);">
            @foreach ($post->media as $index => $media)        
              <div class="image-wrapper" style="width: 100%; height: 100%; display: flex;">
                <img src="{{ $media->media_url }}" alt="Post Image" class="post-img" data-index="{{ $index }}">
              </div>
            @endforeach
            </div>
            @if($post->media->count() > 1)
                  <div class="post-dot">
                      @for($i = 0; $i < $post->media->count(); $i++) 
                        <div class="dot" data-index="{{ $i }}"></div>
                      @endfor
                  </div>
            @endif
          </div>
          <div class="post-actions">
            <img src="{{ asset('images/like_icon.svg') }}" alt="Like" />
            <img src="{{ asset('images/comment_icon.svg') }}" alt="Comment" />
            <img src="{{ asset('images/send_icon.svg') }}" alt="Send" />
            <img src="{{ asset('images/save_icon.svg') }}" alt="Save" />
          </div>
          <div class="post-description">
            {{$post->content}}
          </div>
          <span class="show-more">Xem thêm</span>
        </div>
        @endforeach
      </div>
      <div class="account-info">
        <div class="profile-account">
          @if(Auth::check())
          <div class="profile">
            <img src="{{ Auth::user()->avatar ?? 'default-avatar.jpg' }}" alt="Profile" class="profile-img" />
            <div class="profile-info">
                <h4 class="username">{{ Auth::user()->nickName }}</h4>
                <p class="fullname">{{ Auth::user()->fullName }}</p>
            </div>
          </div>
          @endif
          <div id="dropdown-menu" class="dropdown-menu">
                <div class="dropdown-item">
                  <img src="{{ asset('images/user_icon.svg') }}" alt="">
                  <p>Thông tin cá nhân</p>
                </div>
                <div href="" class="dropdown-item">
                  <img src="{{ asset('images/global_icon.svg') }}" alt="">
                  <p>Ngôn ngữ</p>
                </div>
                <div href="" class="dropdown-item">
                  <img src="{{ asset('images/security_icon.svg') }}" alt="">
                  <p>Bảo mật</p>
                </div>
                <div href="" class="dropdown-item">
                  <img src="{{ asset('images/support_icon.svg') }}" alt="">
                  <p>Hỗ trợ</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="dropdown-item logout-button"><img src="{{ asset('images/logout_icon.svg') }}" alt=""><p>Đăng xuất</p></button>
                </form>
          </div>
        <div class="header-contact">
            <h3>Người liên hệ</h3>
        </div>
        <ul class="contact-list">
          @foreach($users as $user)
          <li class="contact-item online">
            <img src="{{ $user->avatar }}" alt="Avatar" class="avatar" />
            <div class="contact-info">
              <span class="contact-name">{{ $user->fullName }}</span>
              
            </div>
          </li>
          @endforeach
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
        <div class="modal-container" style="display: none;">
          <div class="modal">
            <div class="modal-header">
              <p class="modal-title">Sửa hồ sơ</p>
              <div class="modal-close" onclick="closeModal()">✖</div>
            </div>
            <form method="POST" action="{{ route('user-update-profile') }}" enctype="multipart/form-data" id="profile-form">
             @csrf
              <div class="modal-body">
                <div class="modal-section">
                  <p class="section-title">Ảnh hồ sơ</p>
                  <div class="profile-image-container">
                    <img id="profileImage" src="{{ Auth::user()->avatar ?? 'https://placehold.co/400x400' }}" alt="Profile" class="profile-image" />
                    <label for="edit" class="edit-icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="1em"
                        height="1em"
                        viewBox="0 0 24 24"
                      >
                        <g
                          fill="none"
                          stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                        >
                          <path stroke-dasharray="20" stroke-dashoffset="20" d="M3 21h18">
                            <animate
                              fill="freeze"
                              attributeName="stroke-dashoffset"
                              dur="0.2s"
                              values="20;0"
                            />
                          </path>
                          <path
                            stroke-dasharray="48"
                            stroke-dashoffset="48"
                            d="M7 17v-4l10 -10l4 4l-10 10h-4"
                          >
                            <animate
                              fill="freeze"
                              attributeName="stroke-dashoffset"
                              begin="0.2s"
                              dur="0.6s"
                              values="48;0"
                            />
                          </path>
                          <path stroke-dasharray="8" stroke-dashoffset="8" d="M14 6l4 4">
                            <animate
                              fill="freeze"
                              attributeName="stroke-dashoffset"
                              begin="0.8s"
                              dur="0.2s"
                              values="8;0"
                            />
                          </path>
                        </g>
                      </svg>
                    </label>
                    <input
                      id="edit"
                      type="file"
                      accept="image/*"
                      onchange="handleImageChange(event)"
                      class="hidden"
                      name="avatar"
                    />  
                  </div>
                </div>
                <div class="modal-section">
                  <p class="section-title">Tên</p>
                  <div>
                    <input id="name" type="text" class="input-field" placeholder="Tên của bạn" value="{{ Auth::user()->fullName }}" name="fullName"/>
                    <p class="hint">Bạn chỉ có thể thay đổi tên 7 ngày một lần.</p>
                  </div>
                </div>
                <div class="modal-section">
                  <p class="section-title">Biệt danh</p>
                  <div>
                    <input id="nickname" type="text" class="input-field" placeholder="Biệt danh của bạn" value="{{ Auth::user()->nickName }}" name="nickName"/>
                    <p class="hint">
                      Nickname chỉ có thể bao gồm chữ cái, chữ số, dấu gạch dưới và dấu
                      chấm.
                    </p>
                  </div>
                </div>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-cancel" onclick="closeModal()">Hủy</button>
              <button type="submit" class="btn btn-save">Lưu</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript -->
    <script src="{{ asset('js/home.js') }}"></script>
  </body>
</html>
