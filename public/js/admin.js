'use strict';

/**
 * sidebarの色替え
 */

// urlを取得
const pathname = location.pathname;
// sidebarからdata-urlを取得
const navLinks = document.querySelectorAll('.nav-link');
// 対象のurlのsidebarメニューを色つける
document.addEventListener('DOMContentLoaded', function () {
  navLinks.forEach(function (navLink) {
    let url = navLink.dataset.url;
    if (pathname.includes(url)) {
      navLink.classList.add('active');
    }
  });
});
