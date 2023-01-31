<?php

class Author {

    private $firstName;
    private $lastName;
    private $rating;

    public function __construct($firstName, $lastName, $rating) 
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->rating = $rating;
    }

    public function __toString() 
    {
        return $this->firstName . ',' . $this->lastName . ',' . $this->rating;
    }

}