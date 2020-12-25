<?php

/**
 * @param string $__name
 * @param array  $__vars
 * @return mixed
 */
function load_view(string $__name, array $__vars = [])
{
  extract($__vars);
  require VIEW_PATH."/".$__name.".php";
}


/**
 * @param string $str
 * @return string
 */
function e(string $str): string
{
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}
