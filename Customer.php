<?php


class Customer
{
    private $id;
    private $fname;
    private $lname;

    function __construct($id, $fname, $lname) {
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
    }


}

class Member extends Customer {
    private $username;
    private $password;
    private $phoneNum;
    private $address;
    private $city;
    private $state;
    private $zip;
    private $email;

    function __construct($username, $password, $phoneNum, $address, $city, $state, $zip, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->phoneNum = $phoneNum;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->email = $email;
    }
}