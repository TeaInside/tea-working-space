<!DOCTYPE html>
<html>
<head>
  <?php load_view("template/header", ["title" => "Login"]); ?>
  <link rel="stylesheet" type="text/css" href="assets/css/home.css"/>
</head>
<body>
  <div class="btn-cage">
    <a href="logout.php"><button>Logout</button></a>
  </div>
  <div class="main-cage">
    <div class="h1-cage">
      <h1>Welcome to Tea Working Space</h1>
    </div>
    <div class="inl group-list">
      <h3>Group List</h3>
      <div id="group-list">
        <div class="gl-data">
          <div class="inlc gl-img-cg"><img class="gl-img" src=""/></div>
          <div class="inlc gl-name">Group 1</div>
        </div>
      </div>
    </div>
    <div class="inl main-handle"></div>
  </div>
</body>
</html>