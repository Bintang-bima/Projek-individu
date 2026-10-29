<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Sign In & Sign Up
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <section>
        <div class="modal-body">
          <div class="w3_login_module">
            <div class="module form-module">
              <div class="toggle"><i class="fa fa-times fa-pencil"></i>
              <div class="tooltip">Click Me</div>
              </div>

              @if ($errors->any())
                <div style="padding:6px 15px">
                  <div style="background:#f2dede; border:1px solid #ebccd1; color:#a94442; padding:6px 10px; font-size:12px">
                    <ul style="margin:0; padding-left:16px">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              @endif

              <div class="form" id="login-form-box">
              <h3>Login to your account</h3>
              <form action="{{ route('login.attempt') }}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="submit" value="Login">
              </form>
              <p style="text-align:center; font-size:12px; margin:4px 0 0">
                <a href="{{ route('login') }}">Buka halaman login</a> |
                <a href="#" onclick="openRegisterForm(); return false;">Create an account</a>
              </p>
              </div>
              <div class="form" id="register-form-box" style="display:none">
              <h3>Create an account</h3>
              <form action="{{ route('register.attempt') }}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required="">
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required="">
                <input type="password" name="password" placeholder="Password (min. 8 karakter)" required="">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required="">
                <input type="number" name="umur" placeholder="Umur (opsional)" min="1" max="120" value="{{ old('umur') }}">
                <input type="text" name="alamat" placeholder="Alamat (opsional)" value="{{ old('alamat') }}">
                <input type="submit" value="Register">
              </form>
              </div>
              <div class="cta"><a href="{{ route('login') }}">Forgot your password? Reset via admin</a></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script>
  function openRegisterForm() {
    $('#myModal').modal('show');
    $('#login-form-box').hide();
    $('#register-form-box').show();
  }
  $('.toggle').click(function(){
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms
    $('#login-form-box, #register-form-box').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
    }, "slow");
  });
  @if ($errors->any())
    // Show the modal and the correct form when returning with validation errors
    $(document).ready(function(){
      $('#myModal').modal('show');
      @if ($errors->has('name') || $errors->has('password_confirmation') || $errors->has('umur') || $errors->has('alamat'))
        $('#login-form-box').hide();
        $('#register-form-box').show();
      @endif
    });
  @endif
</script>
