'use strict';

/**
 * 予約menuをgetパラメータに反映させる
 * TODO: リファクタリング
 */
const radios = document.getElementsByName("menu");
let key;
let menu;

// 初期値を設定
// radioが変更されたら値を取得
radios.forEach(
  radio => {
    if (!key || !menu) {
      key = radio.getAttribute('name');
      menu = radio.value;
    }

    radio.addEventListener('change',
      el => {
        key = el.target.getAttribute('name');
        menu = el.target.value;
      }
    );
  }
);

// 予約日付リンクにgetパラメータ付与
const reserveLinks = document.querySelectorAll("table tbody a");
reserveLinks.forEach(
  reserveLink => reserveLink.addEventListener('click',
    e => {
      e.preventDefault();
      const link = e.target.href + `&${key}=${menu}`;
      window.location.href = link;
    }
  )
  );
