<?php

if (!isset($_SESSION["user_id"])) {
  exit;
}

header("Content-Type: application/json");

if (isset($_GET["action"])) {
  switch ($_GET["action"]) {
    case "get_group_list":
      $json = get_group_list();
      break;
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
INNER JOIN ugroup_members AS b ON b.ugroup_id = a.ugroup_id
INNER JOIN users AS c ON c.user_id = b.user_id
WHERE b.user_id = ?"
);
  $st->execute([$userId]);
  return $st->fetchAll(PDO::FETCH_ASSOC);
}
