<?php

namespace Classes;

use Classes\User;

class Owner extends User
{
    public function __construct($userName, $password)
    {
        parent::__construct($userName, $password);
    }


}