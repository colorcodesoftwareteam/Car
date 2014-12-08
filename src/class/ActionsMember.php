<?php

include_once 'LoginSystem.php';

class ActionsMember {

    function __construct() {
        $this->logSystem = new LoginSystem();
    }

    function logout() {
        if ($this->logSystem->logout())
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
        }
    }

}
