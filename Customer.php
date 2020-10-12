<?php


class Customer
{
    private $id;
    private $fname;
    private $lname;
    private $phoneNum;
    private $address;
    private $city;
    private $state;
    private $zip;
    private $email;

    function __construct($id, $fname, $lname, $phoneNum, $address, $city, $state, $zip, $email) {
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->phoneNum = $phoneNum;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->email = $email;
    }


}

class Member extends Customer {
    private $username;
    private $password;

    function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
}