<?php

include './../utils/connection.php';

class Operations
{

    public $username;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    private $table;
    public function __construct($tablename){
        $this->table = $tablename;
    }

    public function createAccount($username, $password, $email, $firstname, $lastname)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $insert = mysqli_query($GLOBALS['conn'], "INSERT INTO accounts (username, password, email, firstname, lastname) VALUES ('$this->username', '$this->password', '$this->email', '$this->firstname', '$this->lastname')");
    }
    public function login($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $login = mysqli_query($GLOBALS['conn'], "SELECT * FROM accounts WHERE username = '$this->username' AND password = '$this->password'");
        if (mysqli_num_rows($login) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAccount($username)
    {
        $this->username = $username;
        $getAccount = mysqli_query($GLOBALS['conn'], "SELECT * FROM accounts WHERE username = '$this->username'");
        if (mysqli_num_rows($getAccount) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAccounts()
    {
        $getAccounts = mysqli_query($GLOBALS['conn'], "SELECT * FROM accounts");
        if (mysqli_num_rows($getAccounts) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteAccount($username)
    {
        $this->username = $username;
        $deleteAccount = mysqli_query($GLOBALS['conn'], "DELETE FROM accounts WHERE username = '$this->username'");
    }
    public function updateAccount($username, $password, $email, $firstname, $lastname)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $updateAccount = mysqli_query($GLOBALS['conn'], "UPDATE accounts SET password = '$this->password', email = '$this->email', firstname = '$this->firstname', lastname = '$this->lastname' WHERE username = '$this->username'");
    }

}
