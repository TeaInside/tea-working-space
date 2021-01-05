<?php

if (!(
      isset($_POST["username"], $_POST["password"]) 
      && is_string($_POST["username"])
      && is_string($_POST["password"])
  )) {
  var_dump($_POST);
  exit;
}

header("Content-Type: application/json");

$email = $_POST["username"];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $query = "SELECT * FROM `users` WHERE `email` = ? AND `password` = ? LIMIT 1";
} else {
  $query = "SELECT * FROM `users` WHERE `username` = ? AND `password` = ? LIMIT 1";
}

$pdo = DB::pdo();
$st  = $pdo->prepare($query);
$st->execute([$email, $_POST["password"]]);

if ($r = $st->fetch(PDO::FETCH_ASSOC)) {
  $res = [
    "status"   => "ok",
    "redirect" => "home.php"
  ];
} else {
  $res = [
    "status"   => "invalid",
    "alert"    => "Wrong username or password!"
  ];
}

$_SESSION["user_id"] = $r["user_id"];

echo json_encode($res, JSON_UNESCAPED_SLASHES);
exit;
