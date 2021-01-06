<?php

require __DIR__."/../bootstrap/web.php";

if (isset($_SESSION["user_id"])) {
  if (isset($_GET["action"])) {
    load_api("home");
    exit;
  }

  $userId = $_SESSION["user_id"];
  $pdo = DB::pdo();
  $st  = $pdo->prepare("SELECT CONCAT(first_name,' ',last_name) AS name FROM users WHERE user_id = ?");
  $st->execute([$userId]);
  $r = $st->fetch(PDO::FETCH_ASSOC);
  unset($st, $pdo);
  load_view("home", ["name" => $r["name"]]);
} else {
  header("Location: /login.php");
  exit;
}
