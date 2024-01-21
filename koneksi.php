<?php
class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }

    private function connect()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function executeQuery($query)
    {
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query gagal: " . $this->conn->error);
        }

        return $result;
    }

    public function fetchSingle($query)
    {
        $result = $this->executeQuery($query);
        return $result->fetch_assoc();
    }

    public function fetchAll($query)
    {
        $result = $this->executeQuery($query);
        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function escapeString($value)
    {
        return $this->conn->real_escape_string($value);
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}
$db = new Database("localhost", "root", "", "perpustakaan");
?>
