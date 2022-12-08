<?php

declare(strict_types=1);

namespace App\Config;

class App
{
    public $db_connection = "mysql";
    public $db_host = "127.0.0.1";
    public $db_database = "DB";
    public $db_username = "root";
    public $db_password;

    public function connect()
    {
        $connection = new \mysqli($this->db_host, $this->db_username, $this->db_password);

        if ($connection->connect_error) {
            echo "Connection failed: " . $connection->connect_error;
        }
        return $connection;
    }
}
