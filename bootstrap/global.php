<?php

function myInternalAutoloader($class)
{
  if (file_exists($f = BASE_PATH."/src/classes/".str_replace("\\", "/", $class).".php")) {
    require $f;
  }
}

require __DIR__."/../config.php";
spl_autoload_register("myInternalAutoloader");

require BASE_PATH."/src/helpers/global.php";
