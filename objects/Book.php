<?php

class Book {

    private $title;
    private $author;
    private $rating;

    public function __construct($title, $author, $rating) 
    {
        $this->title = $title;
        $this->author = $author;
        $this->rating = $rating;
    }

    public function __toString() 
    {
        return $this->title . ',' . $this->author . ',' . $this->rating;
    }

}