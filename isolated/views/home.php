<!DOCTYPE html>
<html>
<head>
  <?php load_view("template/header", ["title" => "Home"]); ?>
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
    <div class="inl channel-list" id="chan_cage" style="display:none;">
      <h3>Channel List</h3>
      <div id="channel-list">
      </div>
    </div>
    <div class="inl main-handle">
      <h3>Chat</h3>
    </div>
  </div>
<script type="text/javascript">
function run_xhr(type, url, onload, data = null) {
  let ch = new XMLHttpRequest;
  ch.withCredentials = true;
  ch.onload = onload;
  ch.open(type, url);
  ch.send(data);
}

function get_id(id) {
  return document.getElementById(id);
}

function get_group_list() {
  let group_list = get_id("group-list");
  run_xhr("GET", "home.php?action=get_group_list", function () {
    let r = "", i, j = JSON.parse(this.responseText);
    for (i in j) {
      r +=
      '<div class="gl-data" onclick="handle_group_click(this, '+j[i].ugroup_id+');">'+
        '<div class="inlc gl-img-cg"><img class="gl-img" src=""/></div>'+
        '<div class="inlc gl-name">'+j[i].name+'<br/>@'+j[i].username+'</div>'+
      '</div>';
    }
    group_list.innerHTML = r;
  });
}

function get_channel_list(id) {
  get_id("chan_cage").style.display = "";
  let channel_list = get_id("channel-list");
  channel_list.innerHTML = "<h1>Loading...</h1>";
  run_xhr("GET", "home.php?action=get_channel_list&ugroup_id="+id, function () {
    let r = "", i, j = JSON.parse(this.responseText);
    for (i in j) {
      r +=
      '<div class="gl-data" onclick="handle_group_click(this, '+j[i].ugroup_channel_id+');">'+
        '<div class="inlc gl-img-cg"><img class="gl-img" src="assets/img/hashtag.png"/></div>'+
        '<div class="inlc gl-name">#'+j[i].name+'</div>'+
      '</div>';
    }
    channel_list.innerHTML = r;
  });
}

function handle_group_click(el, id) {
  let x = document.getElementsByClassName("gl-data");
  for (let i = 0; i < x.length; i++) {
    x[i].style["background-color"] = "#fff";
  }
  el.style["background-color"] = "#d4f4cb";
  get_channel_list(id);
}

get_group_list();
</script>
</body>
</html>