<?php

define("DB_HOST", "localhost");
define("DB_DATABASE", "news_site");
define("DB_USER", "root");
define("DB_PASS", null);

class Connection extends PDO
{
    private $connect;

    public function __construct()
    {
        try {
            $this->connect = parent::__construct("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASS);
        } catch (PDOException $error) {
            return die("Falha na conexão: " . $error->getMessage());
        }
    }

    public function __destruct()
    {
        $this->connect = null;
    }

    //MYSQLI
    // public function __construct()
    // {
    //     $connect = mysqli_connect(DB_HOST, DB_DATABASE, DB_USER, DB_PASS);

    //     if (!$connect) {
    //         die("Falha na conexão: " . mysqli_connect_error());
    //     }
    // }

    // public function __destruct()
    // {
    //     if (is_resource($this->connect) && get_resource_type($this->connect) === 'mysql link') {
    //         mysqli_close($this->connect);
    //     }
    // }
}