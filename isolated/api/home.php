<?php

if (!isset($_SESSION["user_id"])) {
  exit;
}

header("Content-Type: application/json");

if (isset($_GET["action"])) {
  switch ($_GET["action"]) {
    case "get_group_list":   $json = get_group_list();   break;
    case "get_channel_list": $json = get_channel_list(); break;
    case "get_channel_chat_list": $json = get_channel_chat_list(); break;
    default:
      $json = ["status" => "error", "err" => "Invalid action"];
      break;
  }
}


echo json_encode($json, JSON_UNESCAPED_SLASHES);
exit;


function get_group_list()
{
  $userId = $_SESSION["user_id"];
  $pdo    = DB::pdo();
  $st     = $pdo->prepare(
"SELECT a.ugroup_id, a.name, a.username, a.created_at FROM ugroups AS a
INNER JOIN ugroup_members AS b ON a.ugroup_id = b.ugroup_id
INNER JOIN users AS c ON c.user_id = b.user_id
WHERE b.user_id = ?"
);
  $st->execute([$userId]);
  return $st->fetchAll(PDO::FETCH_ASSOC);
}

function get_channel_list()
{
  if (!isset($_GET["ugroup_id"])) {
    exit;
  }

  if (!is_string($_GET["ugroup_id"])) {
    exit;
  }

  $userId = $_SESSION["user_id"];
  $pdo    = DB::pdo();
  $st     = $pdo->prepare(
"SELECT d.ugroup_channel_id, d.ugroup_id, d.name, d.description FROM ugroups AS a
INNER JOIN ugroup_members AS b ON a.ugroup_id = b.ugroup_id
INNER JOIN users AS c ON c.user_id = b.user_id
INNER JOIN ugroup_channels AS d ON a.ugroup_id = d.ugroup_id 
WHERE b.user_id = ? AND a.ugroup_id = ?"
);
  $st->execute([$userId, $_GET["ugroup_id"]]);
  return $st->fetchAll(PDO::FETCH_ASSOC);
}

function get_channel_chat_list() {
  if (!isset($_GET["ugroup_channel_id"])) {
    exit;
  }

  if (!is_string($_GET["ugroup_channel_id"])) {
    exit;
  }

  $userId = $_SESSION["user_id"];
  $pdo    = DB::pdo();
  $st     = $pdo->prepare(
"SELECT a.ugroup_channel_msg_id AS id, a.content,
CONCAT(b.first_name,' ',b.last_name) AS sender_name, a.created_at
FROM ugroup_channel_msg AS a
INNER JOIN users AS b ON b.user_id = a.sender_id
INNER JOIN ugroup_channels AS c ON c.ugroup_channel_id = a.ugroup_channel_id
INNER JOIN ugroups AS d ON d.ugroup_id = c.ugroup_id
INNER JOIN ugroup_members AS e ON e.ugroup_id = d.ugroup_id
WHERE e.user_id = ? AND a.ugroup_channel_id = ?"
);
  $st->execute([$userId, $_GET["ugroup_channel_id"]]);
  return $st->fetchAll(PDO::FETCH_ASSOC);
}
