<?php

include 'MemberSystem.php';

class ActionsNonMember {

    private $memSystem;

    function __construct($action) {
        $this->memSystem = new MemberSystem();
        if ($action == 'register')
            $this->register();
    }

    function register() {
        $this->memSystem->newMember();
        //echo '<meta http-equiv="refresh" content="2; url=addMemberProfile.php">';
    }

}
