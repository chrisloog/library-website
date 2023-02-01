<?php

require_once 'Author.php';
require_once 'Book.php';

if (isset($_GET['cmd'])) {
    if ($_GET['cmd'] === 'author-save') {
        if (validateAuthor() === true) {
            saveAuthorToFile();
            header('Location: author-list.php?msg=success');
        } else {
            header('Location: author-add.php?msg=error' . createAuthorURL());
        }
    } else if ($_GET['cmd'] === 'book-save') {
        if (validateBookTitle() === true && validateBookAuthor() === true) {
            saveBookToFile();
            header('Location: index.php?msg=success');
        } else if (validateBookTitle() === false) {
            header('Location: book-add.php?msg=titleError' . createBookURL());
        } else {
            header('Location: book-add.php?msg=authorError' . createBookURL());
        }
    } else if ($_GET['cmd'] === 'book-delete') {
        deleteBook();
        header('Location: index.php?msg=success');
    } else if ($_GET['cmd'] === 'author-delete') {
        deleteAuthor();
        header('Location: author-list.php?msg=success');
    } else if ($_GET['cmd'] === 'book-edit') {
        if (validateBookTitle() === true && validateBookAuthor() === true) {
            editBook();
            header('Location: index.php?msg=success');
        } else if (validateBookTitle() === false) {
            header('Location: book-add.php?msg=titleError' . createBookURL());
        } else {
            header('Location: book-add.php?msg=authorError' . createBookURL());
        }
    } else if ($_GET['cmd'] === 'author-edit') {
        if (validateAuthor() === true) {
            editAuthor();
            header('Location: author-list.php?msg=success');
        } else {
            header('Location: author-add.php?msg=error' . createAuthorURL());
        }
    }
}

function saveAuthorToFile(): void
{
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $rating = $_POST['grade'] ?? 0;
    $filename = 'authors.txt';
    file_put_contents($filename, new Author($firstName, $lastName, $rating) . PHP_EOL, FILE_APPEND);
}

function saveBookToFile(): void
{
    $title = $_POST['title'];
    $author = $_POST['bookAuthor'];
    $rating = $_POST['grade'] ?? 0;
    $filename = 'books.txt';
    $content = $title . ',' . $author . ',' . $rating . PHP_EOL;
    file_put_contents($filename, $content, FILE_APPEND);
}

function deleteBook(): void
{
    $contents = file_get_contents('books.txt');
    $rows = explode(PHP_EOL, $contents);
    $result = "";

    $title = $_POST['title'];
    $author = $_POST['bookAuthor'];
    $rating = $_POST['grade'] ?? 0;

    $needle = $title . ',' . $author . ',' . $rating;

    foreach ($rows as $line) {

        if (!empty($line)) {
            if ($line != $needle) {
                $result .= $line . PHP_EOL;
            }
        }
    }
    file_put_contents('books.txt', $result);
}

function deleteAuthor(): void
{
    $contents = file_get_contents('authors.txt');
    $rows = explode(PHP_EOL, $contents);

    $result = "";

    foreach($rows as $line){
        if (!empty($line)) {
            if (strpos($line, $_POST['firstName']) === false && strpos($line, $_POST['lastName']) === false) {
                $result .= $line . PHP_EOL;
            }
        }
    }
    file_put_contents('authors.txt', $result);
}

function validateAuthor(): bool
{
    $firstnameLength = strlen($_POST['firstName']);
    $lastnameLength = strlen($_POST['lastName']);
    if ($firstnameLength < 1 || $firstnameLength > 21 || $lastnameLength < 2 || $lastnameLength > 22) {
        return false;
    }
    return true;
}

function validateBookTitle(): bool
{
    $titleLength = strlen($_POST['title']);
    if ($titleLength < 3 || $titleLength > 23) {
        return false;
    }
    return true;    
}

function validateBookAuthor(): bool
{
    if (empty($_POST['bookAuthor'])) {
        return false;
    }
    return true;
}

function getData($file): array 
{
    $rows = array();
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
    return $rows;
}

function createAuthorURL() : string
{
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $rating = $_POST['grade'] ?? 0;
    $result = '&firstName=' . urlencode($firstName) . '&lastName=' . urlencode($lastName) . '&rating=' . urlencode($rating);
    return $result;
}

function createBookURL() : string
{
    $title = $_POST['title'];
    $author = $_POST['bookAuthor'];
    $rating = $_POST['grade'] ?? 0;
    $result = '&title=' . urlencode($title) . '&author=' . urlencode($author) . '&rating=' . urlencode($rating);
    return $result;
}

function editAuthor() : void
{
    
}

function editBook() : void
{
    // implement
}