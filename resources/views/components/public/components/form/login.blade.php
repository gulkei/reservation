<form action="{{$route}}" method="post" class="form">
  @csrf
  @error('all')
  <p class="form__error">{{$message}}</p>
  @enderror
  <div class="form__group">
    <label for="">メールアドレス</label>
    <input type="email" name="email" required value="{{old('email')}}">
  </div>
  <div class="form__group">
    <label for="">パスワード</label>
    <input type="password" name="password" required>
  </div>
  <p class="form__attention">※パスワードを忘れた方は<a href="#">こちら</a></p>
  <div class="button-wrap margin-top-helper">
    <input type="submit" class="button" value="ログイン">
  </div>
</form>
