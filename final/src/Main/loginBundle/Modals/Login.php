<?php
namespace Main\loginBundle\Modals;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login
{
    private $mode;
    private $username;
    private $password;
    
    function getMode() {
        return $this->mode;
    }

    function getUsername() {
        return $this->username;
    }

    function setMode($mode) {
        $this->mode = $mode;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getPassword() {
        return $this->password;
    }

     
}

?>