<?php

function myInternalAutoloader($class)
{
  $class = str_replace("\\", "/", $class);
  if (file_exists($f = BASE_PATH."/src/classes/".$class.".php")) {
    require $f;
  }
}

require __DIR__."/../config.php";
spl_autoload_register("myInternalAutoloader");
