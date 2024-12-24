<?php
class Database
{
    public static $conn = null;
    public static function getConnection()
    {
        if (self::$conn == null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mohan_newdb";
            // create connection
            $conn = new mysqli($servername, $username,  $password, $dbname);
            if ($conn->connect_error) {
                die("Connection Failed:" . $conn->connect_error);
            } else {
                Database::$conn = $conn;
            }
        } else {
            return Database::$conn;
        }
    }
}
