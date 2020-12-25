<?php

final class DB
{

  /**
   * @var self
   */
  private static $self = NULL;

  /**
   * @var \PDO
   */
  private $pdo;

  /**
   * Constructor.
   */
  private function __construct()
  {
    $this->pdo = new \PDO(...PDO_PARAM);
    $this->pdo->exec("SET NAMES utf8mb4;");
  }

  /**
   * @return DB
   */
  public static function getInstance(): DB
  {
    return self::$self ?? (self::$self = new self);
  }

  /**
   * @return \PDO
   */
  public static function pdo(): \PDO
  {
    return self::getInstance()->pdo;
  }
}
