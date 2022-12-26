<?php
class dbConnection
{
    private $servername = "127.0.0.1:3306";
    private $username = "root";
    private $password = "eldl";
    private $dbname = "botstore_test";

    // private $servername = "host188.vietnix.vn";
    // private $username = "botstore";
    // private $password = "[0R8sdG8Zj0X!u";
    // private $dbname = "botstore_shop";

    public function __construct()
    {
    }

    public function getConnection()
    {
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // echo "Connected successfully";

        return $conn;
    }
}
