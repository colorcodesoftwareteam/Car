<?php

include_once 'LoginSystem.php';
include_once 'MemberSystem.php';
include_once 'ManageCar.php';

class ActionsMember {

    private $data;
    private $logSystem;
    private $memSystem;
    private $mCar;

    function __construct() {
        $this->logSystem = new LoginSystem();
        $this->memSystem = new MemberSystem();
        $this->mCar = new ManageCar();
    }

    function logout() {
        if ($this->logSystem->logout())
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }

    function updateProfile() {
        if ($this->memSystem->editMember($this->data))
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }

    function chooseCarByNewCar() {
        $brandid = $this->data['POST']['brandid'];
        $modelid = $this->data['POST']['modelid'];
        $caryear = $this->data['POST']['caryear'];
        $bodynumber = $this->data['POST']['bodynumber'];
        $cylinder = $this->data['POST']['cylinder'];
        $fueltank = $this->data['POST']['fueltank'];
        $files = $this->data['FILES']['files'];

        if ($this->mCar->add($brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank)) {
            $lastRow = $this->mCar->getLastCar();

            for ($i = 0; $i < 10; $i++) {
                if ($files['name'][$i] == '') {
                    continue;
                }
                $folder = 'img/upload/';
                $name = $files['name'][$i];
                $ext = explode('.', $name);
                $newname = $ext[0] . '_' . date('YmdHis') . '.' . $ext[1];
                $path = $folder . $newname;

                move_uploaded_file($files['tmp_name'][$i], $path);

                $this->mCar->addImage($lastRow->id, $name, $path);
            }
            
             $_SESSION['car2'] = $this->mCar->getCarById($lastRow->id);
             echo '<meta http-equiv="refresh" content="0; url=carCompare.php">';
        }
    }

    function chooseCar1() {
        $_SESSION['car1'] = $this->mCar->getCarById($this->data['GET']['carid']);
        echo '<meta http-equiv="refresh" content="0; url=carCompare.php">';
    }

    function chooseCar2() {
        $_SESSION['car2'] = $this->mCar->getCarById($this->data['GET']['carid']);
        echo '<meta http-equiv="refresh" content="0; url=carCompare.php">';
    }

    function chooseCarAgain() {
        unset($_SESSION['car1']);
        unset($_SESSION['car2']);
        echo '<meta http-equiv="refresh" content="0; url=carCompare.php">';
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
            case 'choosecar1':
                $this->chooseCar1();
                break;
            case 'choosecar2':
                $this->chooseCar2();
                break;
            case 'choosecaragain':
                $this->chooseCarAgain();
                break;
            case 'choosecarbynewcar':
                $this->chooseCarByNewCar();
                break;
        }
    }

}
