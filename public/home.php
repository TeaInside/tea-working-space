<?php

require __DIR__."/../bootstrap/web.php";

if (isset($_SESSION["user_id"])) {
  load_view("home");
} else {
  header("Location: /login.php");
  exit;
}
