<?php

class Model
{
  protected $connection;

  public function __construct(PDO $connection = null)
  {
    $this->message = "`". DB_NAME ."`.`message`";

    $this->connection = $connection;
    if ($this->connection === null) {
      try {
        $options = array(
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );

        $this->connection = new PDO(
          'mysql:host=' . DB_HOST . ';port=' . DB_PORT. ';charset=utf8;dbname=' . DB_NAME,
          DB_USER,
          DB_PASS,
          $options
        );
      } catch (PDOException $ex) {
        throw $ex;
      }
    }
  }

  function __destruct() {
    $this->connection = null;
  }

  public function find()
  {
    $stmt = $this->connection->prepare("
      SELECT
        $this->message.`id`,
        $this->message.`name`,
        $this->message.`phone`,
        $this->message.`email`,
        $this->message.`message`

        FROM $this->message
    ");

    try {
      if( $stmt->execute() ) {
        return $stmt->fetchAll();
      }
    } catch (PDOException $ex) {
      return false;
    }
  }

  public function insert($name, $phone, $email, $message)
  {
    $stmt = $this->connection->prepare("
      INSERT INTO $this->message
        (`name`, `phone`, `email`, `message`)
        VALUES(:name, :phone, :email, :message)
    ");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);

    try {
      return $stmt->execute();
    } catch (PDOException $ex) {
      return false;
    }
  }
}