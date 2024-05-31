<?php
/**
 * Author: PFinal南丞
 * Date: 2024/5/20
 * Email: <lampxiezi@163.com>
 */


class DatabaseUtils
{
    protected array $config;
    protected ?mysqli $db;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->db     = $this->getConnection();
    }

    // Method to get the database connection
    public function getConnection(): mysqli|false|null
    {
        $conn = mysqli_connect($this->config['host'], $this->config['username'], $this->config['password'], $this->config['dbname']);
        // Check connection
        if (!$conn) {
            echo("Connection failed: " . mysqli_connect_error());
            return false;
        }
        return $conn;
    }


    // Method to get query result
    public function getQueryResult(string $sql): array|false
    {
        $result = mysqli_query($this->db, $sql);
        if ($result === false) {
            return false;
        }
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // Method to insert data
    public function insertData($sql)
    {
        if (mysqli_query($this->db, $sql)) {
            return mysqli_affected_rows($this->db);
        } else {
            echo "Insert error: " . mysqli_error($this->db);
            return false;
        }
    }

    // Method to update data
    public function updateData($sql): false|int|string
    {
        if (mysqli_query($this->db, $sql)) {
            return mysqli_affected_rows($this->db);
        } else {
            echo "Update error: " . mysqli_error($this->db);
            return false;
        }
    }

    // Method to delete data
    public function deleteData($sql): false|int|string
    {
        if (mysqli_query($this->db,$sql)) {
            return mysqli_affected_rows($this->db);
        } else {
            echo "Delete error: " . mysqli_error($this->db);
            return false;
        }
    }
}

/**
 * $host     = 'localhost';  // Your database host
 * $db_name  = 'db_product_preview';  // Your database name
 * $username = 'root';  // Your database username
 * $password = '';  // Empty password
 */