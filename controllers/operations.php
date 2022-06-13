<?php


namespace Controllers;

include './../utils/connection.php';
class Operations
{

    public $username;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    private $table;
    private $company;
    public function __construct($tablename)
    {
        $this->table = $tablename;
    }
    public function checkIfNoOtherUsername($username)
    {
        $conn = $GLOBALS['conn'];
        $sql = "SELECT * FROM $this->table WHERE username = '$username'";
        $result = mysqli_query($conn, $sql) or die("Error in query: " . mysqli_error($conn));
        if (mysqli_num_rows($result) != 0) {
            return false;
        } else {
            return true;
        }
    }
    public function checkIfNoOtherEmail($email)
    {
        $conn = $GLOBALS['conn'];
        $sql = "SELECT * FROM $this->table WHERE email = '$email'";
        $result = mysqli_query($conn, $sql) or die("Error in query: " . mysqli_error($conn));
        if (mysqli_num_rows($result) != 0) {
            return false;
        } else {
            return true;
        }
    }
    public function checkIfNoOtherCompany($company)
    {
        $conn = $GLOBALS['conn'];
        $sql = "SELECT * FROM $this->table WHERE company = '$company'";
        $result = mysqli_query($conn, $sql) or die("Error in query: " . mysqli_error($conn));
        if (mysqli_num_rows($result) != 0) {
            return false;
        } else {
            return true;
        }
    }
    public function createAccount($username, $password, $email, $firstname, $lastname, $company)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->company = $company;
        $encryptedPassword = hash("SHA512", $this->password);
        $insert = mysqli_query($GLOBALS['conn'], "INSERT INTO users (username,company, password, email, firstname, lastname) VALUES ('$this->username', '$this->company','$encryptedPassword', '$this->email', '$this->firstname', '$this->lastname')") or die(mysqli_error($GLOBALS['conn']));
        if ($insert) {
            $createEntryTable = mysqli_query($GLOBALS['conn'], "CREATE TABLE entries_".$this->username ." IF NOT EXISTS (entry_id VARCHAR(255) DEFAULT UUID(),count int auto_increment PRIMARY KEY NOT NULL, date DATE DEFAULT current_timestamp() NOT NULL, title VARCHAR(70) NOT NULL,amount int NOT NULL, price int NOT NULL, description VARCHAR(1000) NOT NULL)") or die(mysqli_error($GLOBALS['conn']));
            if (!$createEntryTable) {
                echo "Error creating account! in operations";
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }
    public function login($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $encryptedPassword = hash("SHA512", $this->password);
        $login = mysqli_query($GLOBALS['conn'], "SELECT * FROM users WHERE username = '$this->username' AND password = '$encryptedPassword'") or die(mysqli_error($GLOBALS['conn']));
        if (mysqli_num_rows($login) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAccount($username)
    {
        $this->username = $username;
        $getAccount = mysqli_query($GLOBALS['conn'], "SELECT * FROM users WHERE username = '$this->username'") or die(mysqli_error($GLOBALS['conn']));
        if (mysqli_num_rows($getAccount) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getusers()
    {
        $getusers = mysqli_query($GLOBALS['conn'], "SELECT * FROM users") or die(mysqli_error($GLOBALS['conn']));
        if (mysqli_num_rows($getusers) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteAccount($username)
    {
        $this->username = $username;
        $deleteAccount = mysqli_query($GLOBALS['conn'], "DELETE FROM users WHERE username = '$this->username'") or die(mysqli_error($GLOBALS['conn'])) or die(mysqli_error($GLOBALS['conn']));
    }
    public function updateAccount($username, $password, $email, $firstname, $lastname)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $updateAccount = mysqli_query($GLOBALS['conn'], "UPDATE users SET password = '$this->password', email = '$this->email', firstname = '$this->firstname', lastname = '$this->lastname' WHERE username = '$this->username'") or die(mysqli_error($GLOBALS['conn']));
    }

    public function createEntry($username, $title, $text)
    {
        $this->username = $username;
        $this->title = $title;
        $this->text = $text;
        $insert = mysqli_query($GLOBALS['conn'], "INSERT INTO entries_$this->username (title, text) VALUES ('$this->title', '$this->text')") or die(mysqli_error($GLOBALS['conn']));
        if ($insert) {
            echo "Entry created successfully!";
        } else {
            echo "Error creating entry!";
        }
    }

    public function getEntries($username)
    {
        $this->username = $username;
        $getEntries = mysqli_query($GLOBALS['conn'], "SELECT * FROM entries_$this->username") or die(mysqli_error($GLOBALS['conn']));
        if (mysqli_num_rows($getEntries) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
