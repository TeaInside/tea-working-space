<?php

require __DIR__."/../bootstrap/web.php";

if (isset($_GET["action"]) && ($_SERVER["REQUEST_METHOD"] === "POST")) {
  load_api("register");
  exit;
}

load_view("register");
