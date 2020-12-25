<!DOCTYPE html>
<html>
<head>
  <?php load_view("template/header", ["title" => "Register"]); ?>
  <link rel="stylesheet" type="text/css" href="assets/css/register.css"/>
</head>
<body>
<div class="main-cage">
  <div class="register-cage">
    <h1>Create a New Account</h1>
    <form id="register-form" method="post" action="javascript:void(0);">
      <table class="reg-form-table">
        <thead></thead>
        <tbody>
          <tr><td><span class="req-span">*</span></td><td>First Name</td><td>:</td><td><input type="text" name="first_name" required="1"/></td></tr>
          <tr><td></td><td>Last Name</td><td>:</td><td><input type="text" name="last_name"/></td></tr>
          <tr><td><span class="req-span">*</span></td><td>Username</td><td>:</td><td><input type="text" name="username" required="1"/></td></tr>
          <tr><td><span class="req-span">*</span></td><td>Email</td><td>:</td><td><input type="email" name="email" required="1"/></td></tr>
          <tr><td><span class="req-span">*</span></td><td>Password</td><td>:</td><td><input type="password" name="password" required="1"/></td></tr>
          <tr><td><span class="req-span">*</span></td><td>Retype Password</td><td>:</td><td><input type="password" name="cpassword" required="1"/></td></tr>
          <tr><td colspan="4" align="center" class="td-tcenter">Captcha</td></tr>
          <tr><td colspan="4" align="center" class="td-tcenter"><div class="submit-cage"><button>Submit</button></div></td></tr>
          <tr><td colspan="4" align="center" class="td-tcenter">Already have an account? <a href="login.php?ref=register">Login</a></td></tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript">
function handleRegister() {
  let reg = gid("register-form");
  reg.addEventListener("submit", function () {
    let ch  = new XMLHttpRequest;
    ch.withCredentials = true;
    ch.onload = function () {
      alert(this.responseText);
    };
    ch.open("POST", "register.php?action=1");
    ch.send(new FormData(reg));
  });
}
window.onload = handleRegister;
</script>
</body>
</html>