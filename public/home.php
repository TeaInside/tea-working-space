<?php

require __DIR__."/../bootstrap/web.php";

if (isset($_SESSION["user_id"])) {
  if (isset($_GET["action"])) {
    load_api("home");
    exit;
  }
  load_view("home");
} else {
  header("Location: /login.php");
  exit;
}
