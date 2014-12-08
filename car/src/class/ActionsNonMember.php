<?php

include_once 'MemberSystem.php';
include_once 'LoginSystem.php';

class ActionsNonMember {

    private $memSystem;
    private $logSystem;
    private $data;

    function __construct() {
        $this->memSystem = new MemberSystem();
        $this->logSystem = new LoginSystem();
    }

    function register($data) {
        if ($this->memSystem->newMember($data))
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }

    function login($data) {
        $this->logSystem->login($data);
    }

    function setData($data) {
        $this->data = $data;
    }

    function process($action) {
        switch ($action) {
            case 'register':
                $this->register($this->data);
                break;
            case 'login':
                $this->login($this->data);
                break;
        }
    }

}
