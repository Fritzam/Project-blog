<?php

namespace Classes;

class User
{
    private $userName, $password;

    public function __construct($userName, $password) {
        $this->userName = $userName;
        $this->password = $password;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getFunction() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

}