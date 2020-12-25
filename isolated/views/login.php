<!DOCTYPE html>
<html>
<head>
  <?php load_view("template/header", ["title" => "Login"]); ?>
  <link rel="stylesheet" type="text/css" href="assets/css/login.css"/>
</head>
<body>
  <div class="main-cage">
    <div class="login-cage">
      <h1>Login</h1>
      <form method="post" action="javascript:void(0);">
        <div class="in-label">Email or Username:</div>
        <div class="in-cage"><input type="text" name="username" required="1"/></div>
        <div class="in-label">Password:</div>
        <div class="in-cage"><input type="password" name="password" required="1"/></div>
        <div class="in-cage in-btn-login"><button>Login</button></div>
        <div class="in-register">Don't have an account? <a href="register.php?ref=login">Register</a></div>
      </form>
    </div>
  </div>
</body>
</html>