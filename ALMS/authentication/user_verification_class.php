<?php
class UserVerification
{
    private $connection = null;

    private function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "athene_lms";
        // Create connection
        $con = new mysqli($servername, $username, $password, $database);
        return $con;

    }

    private function disconnect()
    {
        $this->connection->close();
    }
    function checkUserId($userid, $usertype)
    {
        $this->connection = $this->connect();
        if ($usertype == "Admin") {
            $sql = "select adm_id from admin where adm_id = '$userid'";
            if ($result = mysqli_query($this->connection, $sql)) {
                if ($result->num_rows == 1) {
                    $this->disconnect();
                    return true;
                }
            }
        } else if ($usertype == "Teacher") {
            $sql = "select tchr_id from teacher where tchr_id = '$userid'";
            if ($result = mysqli_query($this->connection, $sql)) {
                if ($result->num_rows == 1) {
                    $this->disconnect();
                    return true;
                }
            }
        } else if ($usertype == "Student") {
            $sql = "select stud_id from student where stud_id = '$userid'";
            if ($result = mysqli_query($this->connection, $sql)) {
                if ($result->num_rows == 1) {
                    $this->disconnect();
                    return true;
                }
            }
        }
        $this->disconnect();
        return false;
    }



}

?>