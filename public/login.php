<?php

require __DIR__."/../bootstrap/web.php";

if (isset($_GET["action"]) && ($_SERVER["REQUEST_METHOD"] === "POST")) {
  load_api("login");
  exit;
}

load_view("login");
