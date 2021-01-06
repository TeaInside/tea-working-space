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
      <h1>Welcome "<?php echo e($name); ?>" to Tea Working Space</h1>
    </div>
    <div class="inl group-list">
      <h3>Group List</h3>
      <div id="group-list">
        <h1>Loading...</h1>
      </div>
    </div>
    <div class="inl channel-list" id="chan_cage" style="display:none;">
      <a href="javascript:void(0);" onclick="close_channel_list();">Close</a>
      <h3>Channel List</h3>
      <div id="channel-list">
      </div>
    </div>
    <div class="inl main-handle">
      <div class="main-nav">
        <div class="mnl inl"><button onclick="open_home();">Home</button></div>
        <div class="mnl inl"><button onclick="open_chat();">Chat</button></div>
      </div>
      <div class="chat-cage" id="chat-cage" style="display:none;">
        <div>Chat in #<span id="channel_name"></span></div>
        <div class="chat-chk-ls" id="chat-chk-ls">
        </div>
        <div class="text-cage">
          <textarea id="chat_text" placeholder="Enter text here..."></textarea>
          <button onclick="send_chat();">Send</button>
        </div>
      </div>
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

function escapeHtml(unsafe) {
  return unsafe
   .replace(/&/g, "&amp;")
   .replace(/</g, "&lt;")
   .replace(/>/g, "&gt;")
   .replace(/"/g, "&quot;")
   .replace(/'/g, "&#039;");
}

let act_ugroup_id = null;
let act_ugroup_channel_id = null;
let last_chat_id = 0;

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
        '<div class="inlc gl-img-cg"><img class="gl-img" src="assets/img/group.png"/></div>'+
        '<div class="inlc gl-name">'+escapeHtml(j[i].name)+'<br/>@'+j[i].username+'</div>'+
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
      '<div class="cl-data" onclick="handle_channel_click(this, '+j[i].ugroup_channel_id+', \''+encodeURIComponent(j[i].name)+'\');">'+
        '<div class="inlc gl-img-cg"><img class="gl-img" src="assets/img/hashtag.png"/></div>'+
        '<div class="inlc gl-name">#'+escapeHtml(j[i].name)+'</div>'+
      '</div>';
    }
    channel_list.innerHTML = r;
  });
}

function get_channel_chat_list(id) {
  let ccl = get_id("chat-chk-ls");
  ccl.innerHTML = "<h1>Loading...</h1>";
  run_xhr("GET", "home.php?action=get_channel_chat_list&ugroup_channel_id="+id, function () {
    let json = JSON.parse(this.responseText);
    let i, r = "";
    for (i in json) {
      r +='<div class="chat-ls"><p><b>'+escapeHtml(json[i].sender_name)+': </b>'+escapeHtml(json[i].content)+'</p></div>'
    }
    last_chat_id = json.length ? json[i].id : 0;
    ccl.innerHTML = r;
    act_ugroup_channel_id = id;
  });
}

function handle_group_click(el, id) {
  let x = document.getElementsByClassName("gl-data");
  for (let i = 0; i < x.length; i++) {
    x[i].style["background-color"] = "#fff";
  }
  el.style["background-color"] = "#d4f4cb";
  get_channel_list(id);
  act_ugroup_id = id;
}

function handle_channel_click(el, id, name) {
  let x = document.getElementsByClassName("cl-data");
  for (let i = 0; i < x.length; i++) {
    x[i].style["background-color"] = "#fff";
  }
  el.style["background-color"] = "#d4f4cb";
  get_channel_chat_list(id);
  get_id("channel_name").innerHTML = name;
  get_id("chat-cage").style.display = "";
}

function send_chat_data(group_id, channel_id, content) {
  let ccl = get_id("chat-chk-ls");
  
  run_xhr("POST", "home.php?action=send_chat_data&ugroup_id="+group_id+"&ugroup_channel_id="+channel_id, function () {
    // let json = JSON.parse(this.responseText);
    // ccl.innerHTML += '<div class="chat-ls"><p><b>'+escapeHtml(json.sender_name)+': </b>'+escapeHtml(json.content)+'</p></div>';
    // ccl.scrollTop = ccl.scrollHeight;
    // last_chat_id = json.id;
  }, JSON.stringify({content: content}));
}

function send_chat() {
  let ccl = get_id("chat-chk-ls");
  let ctext = get_id("chat_text");
  send_chat_data(act_ugroup_id, act_ugroup_channel_id, ctext.value);
  ctext.value = "";
}

function resolve_chat_data(callback) {
  let ccl = get_id("chat-chk-ls");
  run_xhr("GET", "home.php?action=get_channel_chat_list&ugroup_channel_id="+act_ugroup_channel_id+"&last_chat_id="+last_chat_id, function () {
    let json = JSON.parse(this.responseText);
    let i, r = "";
    for (i in json) {
      r +='<div class="chat-ls"><p><b>'+escapeHtml(json[i].sender_name)+': </b>'+escapeHtml(json[i].content)+'</p></div>'
    }
    ccl.innerHTML += r;

    if (json.length > 0) {
      last_chat_id = json[i].id;
      ccl.scrollTop = ccl.scrollHeight;
    }
    callback();
  });
}

let interval = setInterval(function () {
  if (act_ugroup_channel_id) {
    clearInterval(interval);
    let recursive = function() {
      resolve_chat_data(function () {
        setTimeout(recursive, 500);
      });
    };
    recursive();
  }
}, 500);

function open_home() {

}

function open_chat() {

}

function close_channel_list() {
  get_id("chan_cage").style.display = "none";
}

get_group_list();
</script>
</body>
</html>