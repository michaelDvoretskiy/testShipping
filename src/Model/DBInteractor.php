<?php

namespace Mdvor\TestOneNofw\Model;

use Mdvor\TestOneNofw\Config\DbConfig;
use mysqli;

class DBInteractor
{
    private $conn;

    function connect()
    {
        $servername = DbConfig::SERVERNAME;
        $username = DbConfig::USERNAME;
        $password = DbConfig::PASSWORD;
        $database = DbConfig::DB;

        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
           return false;
        } 
        
        return true;
    }

    function disconnect()
    {
        $this->conn->close();
    }

    function makeSelect($sql)
    {
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function runSQL($sql)
    {
        $this->conn->query($sql);
    }

    function escape($par)
    {
        return $this->conn->real_escape_string($par);
    }
}