<?php

if (isset($_GET['cmd'])) {
    if ($_GET['cmd'] === 'author-save') {
        if (validateAuthor() === true) {
            saveAuthorToFile();
            header('Location: pages/author-list.php?msg=success');
        } else {
            header('Location: pages/author-add.php?msg=error' . createAuthorURL());
        }
    } else if ($_GET['cmd'] === 'book-save') {
        if (validateBookTitle() === true && validateBookAuthor() === true) {
            saveBookToFile();
            header('Location: index.php?msg=success');
        } else if (validateBookTitle() === false) {
            header('Location: pages/book-add.php?msg=titleError' . createBookURL());
        } else {
            header('Location: pages/book-add.php?msg=authorError' . createBookURL());
        }
    } else if ($_GET['cmd'] === 'book-delete') {
        deleteBook();
        header('Location: index.php?msg=success');
    } else if ($_GET['cmd'] === 'author-delete') {
        deleteAuthor();
        header('Location: pages/author-list.php?msg=success');
    } else if ($_GET['cmd'] === 'book-edit') {
        if (validateBookTitle() === true && validateBookAuthor() === true) {
            editBook();
            header('Location: index.php?msg=success');
        } else if (validateBookTitle() === false) {
            header('Location: pages/book-add.php?msg=titleError' . createBookURL());
        } else {
            header('Location: pages/book-add.php?msg=authorError' . createBookURL());
        }
    } else if ($_GET['cmd'] === 'author-edit') {
        if (validateAuthor() === true) {
            editAuthor();
            header('Location: pages/author-list.php?msg=success');
        } else {
            header('Location: pages/author-add.php?msg=error' . createAuthorURL());
        }
    }
}

function saveAuthorToFile(): void
{
    file_put_contents('authors.txt', authorEntryToString() . PHP_EOL, FILE_APPEND);
}

function saveBookToFile(): void
{
    file_put_contents('books.txt', bookEntryToString() . PHP_EOL, FILE_APPEND);
}

function deleteBook(): void
{
    $contents = file_get_contents('books.txt');
    $rows = explode(PHP_EOL, $contents);
    $result = "";
    foreach ($rows as $line) {
        if (!empty($line)) {
            if ($line != bookEntryToString()) {
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
    foreach ($rows as $line) {
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
    return !($firstnameLength < 1 || $firstnameLength > 21 || $lastnameLength < 2 || $lastnameLength > 22);
}

function validateBookTitle(): bool
{
    $titleLength = strlen($_POST['title']);
    return !($titleLength < 3 || $titleLength > 23);
}

function validateBookAuthor(): bool
{
    return !empty($_POST['bookAuthor']);
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

function createAuthorURL(): string
{
    return '&firstName=' . urlencode($_POST['firstName']) . '&lastName=' . urlencode($_POST['lastName']) . '&rating=' . urlencode($_POST['grade'] ?? 0);
}

function createBookURL(): string
{
    return '&title=' . urlencode($_POST['title']) . '&author=' . urlencode($_POST['bookAuthor']) . '&rating=' . urlencode($_POST['grade'] ?? 0);
}

function editAuthor(): void
{
    $contents = file_get_contents('authors.txt');
    $rows = explode(PHP_EOL, $contents);
    $result = "";

    $needle = $_POST['currentFirstName'] . ',' . $_POST['currentLastName'] . ',' . $_POST['currentRating'];

    foreach ($rows as $line) {
        if (!empty($line)) {
            if ($line != $needle) {
                $result .= $line . PHP_EOL;
            } else {
                $result .= authorEntryToString() . PHP_EOL;
            }
        }
    }
    file_put_contents('authors.txt', $result);
}

function editBook(): void
{
    $contents = file_get_contents('books.txt');
    $rows = explode(PHP_EOL, $contents);
    $result = "";

    $needle = $_POST['currentTitle'] . ',' . $_POST['currentAuthor'] . ',' . $_POST['currentRating'];

    foreach ($rows as $line) {

        if (!empty($line)) {
            if ($line != $needle) {
                $result .= $line . PHP_EOL;
            } else {
                $result .= bookEntryToString() . PHP_EOL;
            }
        }
    }
    file_put_contents('books.txt', $result);
}

function bookEntryToString(): string 
{
    return $_POST['title'] . ',' . $_POST['bookAuthor'] . ',' . $_POST['grade'] ?? 0;
}

function authorEntryToString(): string
{
    return $_POST['firstName'] . ',' . $_POST['lastName'] . ',' . $_POST['grade'] ?? 0;
}