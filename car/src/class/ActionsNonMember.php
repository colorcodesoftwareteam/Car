<?php

include 'MemberSystem.php';

class ActionsNonMember {

    private $memSystem;
    private $data;

    function __construct() {
        $this->memSystem = new MemberSystem();
    }

    function register($data) {
        if ($this->memSystem->newMember($data))
            echo '<meta http-equiv="refresh" content="0; url=addMemberProfile.php">';
    }

    function setData($data) {
        $this->data = $data;
    }

    function process($action) {
        if ($action == 'register')
            $this->register($this->data);
    }

}
