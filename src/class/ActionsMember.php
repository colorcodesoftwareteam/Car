<?php

include_once 'LoginSystem.php';
include_once 'MemberSystem.php';

class ActionsMember {

    private $data;
    private $logSystem;
    private $memSystem;

    function __construct() {
        $this->logSystem = new LoginSystem();
        $this->memSystem = new MemberSystem();
    }

    function logout() {
        if ($this->logSystem->logout())
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }

    function updateProfile() {
        if ($this->memSystem->editMember($this->data))
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }

    function setData($data) {
        $this->data = $data;
    }

    function process($action) {
        switch ($action) {

            case 'logout':
                $this->logout();
                break;
            case 'updateprofile':
                $this->updateProfile();
                break;
        }
    }

}
