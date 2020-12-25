<?php








$pdo = DB::pdo();
$pdo
  ->prepare("INSERT INTO `users` (first_name, last_name, username, email, password, created_at) VALUES (?, ?, ?, ?, ?, ?)")
  ->execute(
    [
      $_POST["first_name"],
      $_POST["last_name"],
      $_POST["username"],
      $_POST["email"],
      $_POST["password"],
      date("Y-m-d H:i:s")
    ]
  );
