<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">
          <span class="material-symbols-outlined nav-icon">home</span>
          <span class="ms-2">ダッシュボード</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span class="material-symbols-outlined nav-icon">calendar_month</span>
          <span class="ms-2">予約</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user') }}">
          <span class="material-symbols-outlined nav-icon">group</span>
          <span class="ms-2">ユーザー</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span class="material-symbols-outlined nav-icon">settings</span>
          <span class="ms-2">設定</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
