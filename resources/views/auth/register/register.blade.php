<x-guest-layout>
  <form action="{{ route('registerPost') }}" method="POST">
    <div class="register-wrapper">
      <div class="register_form">
          <div class="d-flex mt-3 name-group" style="gap: 30px; justify-content: space-between;">
            <div class="name-box">
            @error('over_name')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
            @enderror
              <label class="d-block m-0" style="font-size:13px">姓</label>
              <div class="border-bottom border-primary">
                <input type="text" class="border-0 over_name" name="over_name">
              </div>
            </div>
            <div class="name-box">
            @error('under_name')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
            @enderror
              <label class=" d-block m-0" style="font-size:13px">名</label>
              <div class="border-bottom border-primary">
                <input type="text" class="border-0 under_name" name="under_name">
              </div>
            </div>
          </div>
          <div class="d-flex mt-3 name-group" style="gap: 30px; justify-content: space-between;">
            <div class="name-box">
            @error('over_name_kana')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
            @enderror
              <label class="d-block m-0" style="font-size:13px">セイ</label>
              <div class="border-bottom border-primary">
                <input type="text" class="border-0 over_name_kana" name="over_name_kana">
              </div>
            </div>
            <div class="name-box">
            @error('under_name_kana')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
            @enderror
              <label class="d-block m-0" style="font-size:13px">メイ</label>
              <div class="border-bottom border-primary">
                <input type="text" class="border-0 under_name_kana" name="under_name_kana">
              </div>
            </div>
          </div>
          <div class="mt-3">
            @error('mail_address')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
            @enderror
            <label class="m-0 d-block" style="font-size:13px">メールアドレス</label>
            <div class="border-bottom border-primary">
              <input type="mail" class="w-100 border-0 mail_address" name="mail_address">
            </div>
          </div>
        <div class="mt-3 d-flex sex-group" style="gap:10px; justify-content:space-between;">
            @error('sex')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
            @enderror
          <div class="radio-box">
            <input type="radio" name="sex" class="sex" value="1">
            <label style="font-size:13px">男性</label>
          </div>
          <div class="radio-box">
            <input type="radio" name="sex" class="sex" value="2">
            <label style="font-size:13px">女性</label>
          </div>
          <div class="radio-box">
            <input type="radio" name="sex" class="sex" value="3">
            <label style="font-size:13px">その他</label>
          </div>
        </div>

          <div class="mt-3 birthday-group">
          @error('birth_day')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
            @enderror
          <label class="d-block m-0" style="font-size:13px">生年月日</label>
          <div class="d-flex birthday-box-group" style="gap:10px; justify-content:space-between;">
            <div class="birthday-box">
              <select class="old_year border-bottom border-primary" name="old_year">
                <option value="none">-----</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
              </select>
            <label style="font-size:13px">年</label>
            </div>
            <div class="birthday-box">
              <select class="old_month border-bottom border-primary" name="old_month">
                <option value="none">-----</option>
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
              <label style="font-size:13px">月</label>
            </div>
            <div class="birthday-box">
              <select class="old_day border-bottom border-primary" name="old_day">
                <option value="none">-----</option>
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>
              <label style="font-size:13px">日</label>
            </div>
          </div>
        </div>

        <div class="mt-3 role-group">
          @error('role')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
          @enderror
          <label class="d-block m-0" style="font-size:13px">役職</label>
          <div class="d-flex role-box-group" style="gap:10px; justify-content:space-between;">
            <div class="role-box">
              <input type="radio" name="role" class="admin_role role" value="1">
              <label style="font-size:13px">教師(国語)</label>
            </div>
            <div class="role-box">
              <input type="radio" name="role" class="admin_role role" value="2">
              <label style="font-size:13px">教師(数学)</label>
            </div>
            <div class="role-box">
              <input type="radio" name="role" class="admin_role role" value="3">
              <label style="font-size:13px">教師(英語)</label>
            </div>
            <div class="role-box">
              <input type="radio" name="role" class="other_role role" value="4">
              <label style="font-size:13px" class="other_role">生徒</label>
            </div>
          </div>
        </div>

        <div class="select_teacher d-none subject-group">
          <label class="d-block m-0" style="font-size:13px">選択科目</label>
          <div class="d-flex subject-box-group" style="gap:10px; justify-content:space-between;">
          @foreach($subjects as $subject)
            <div class="subject-box">
              <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
              <label style="font-size:13px">{{ $subject->subject }}</label>
            </div>
          @endforeach
          </div>
        </div>
        <div class="mt-3">
          @error('password')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
          @enderror
          <label class="d-block m-0" style="font-size:13px">パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password" name="password">
          </div>
        </div>
        <div class="mt-3">
          @error('password_confirmation')
            <p class="text-danger m-0" style="font-size: 10px;">{{ $message }}</p>
          @enderror
          <label class="d-block m-0" style="font-size:13px">確認用パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password_confirmation" name="password_confirmation">
          </div>
        </div>
        <div class="mt-5 text-right">
          <input type="submit" class="btn btn-primary register_btn" disabled value="新規登録" onclick="return confirm('登録してよろしいですか？')">
        </div>
        <div class="text-center">
          <a href="{{ route('loginView') }}">ログインはこちら</a>
        </div>
      </div>
      {{ csrf_field() }}
    </div>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</x-guest-layout>
