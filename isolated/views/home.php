<!DOCTYPE html>
<html>
<head>
  <?php load_view("template/header", ["title" => "Login"]); ?>
  <link rel="stylesheet" type="text/css" href="assets/css/home.css?t=<?php echo time(); ?>"/>
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
        <h1>Loading...</h1>
      </div>
    </div>
    <div class="inl channel-list">
      <h3>Channel List</h3>
      <div id="group-list">
        <h1>Loading...</h1>
      </div>
    </div>
    <div class="inl main-handle">
      <h3>Chat</h3>
    </div>
  </div>
<script type="text/javascript">
function run_xhr(type, url, onload, data = null)
{
  let ch = new XMLHttpRequest;
  ch.withCredentials = true;
  ch.onload = onload;
  ch.open(type, url);
  ch.send(data);
}

function get_id(id)
{
  return document.getElementById(id);
}

function get_group_list() {
  let group_list = get_id("group-list");
  run_xhr("GET", "home.php?action=get_group_list", function () {
    let r = "", i, j = JSON.parse(this.responseText);
    for (i in j) {
      r +=
      '<div class="gl-data">'+
        '<div class="inlc gl-img-cg"><img class="gl-img" src=""/></div>'+
        '<div class="inlc gl-name">'+j[i].name+'<br/>@'+j[i].username+'</div>'+
      '</div>';
    }
    group_list.innerHTML = r;
  });
}

get_group_list();
</script>
</body>
</html>