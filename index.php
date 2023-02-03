<?php
require_once 'functions.php';
$books = getData('books.txt');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="container">
        <header>
            <div class="header-footer">
                <a href="">Books</a>&nbsp;|&nbsp;
                <a href="pages/book-add.php">Add books</a>&nbsp;|&nbsp;
                <a href="pages/author-list.php">Authors</a>&nbsp;|&nbsp;
                <a href="pages/author-add.php">Add authors</a>
            </div>

            <?php
            if (isset($_GET['msg']) && $_GET['msg'] === 'success') {
            ?>
                <div class="header-footer" id="success-message">
                    Success!
                </div>
            <?php
            }
            ?>

        </header>
        <main>
            <section>
                <div class="row labels">
                    <div class="column left">Title</div>
                    <div class="column middle">Author</div>
                    <div class="column right">Rating</div>
                </div>
                <hr>

                <?php
                foreach ($books as $book) {
                    $bookLink = 'pages/book-add.php?msg=edit&title=' . urlencode($book[0]) . '&author=' . urlencode($book[1]) . '&rating=' . urlencode($book[2]);
                ?>
                    <div class="row">
                        <div class="column left">
                            <a href=<?php echo $bookLink ?> id="book-link"><?php echo $book[0] ?></a>
                        </div>
                        <div class="column middle">
                            <?php echo $book[1] ?>
                        </div>
                        <div class="column right">
                            <?php echo $book[2] ?>
                        </div>
                    </div>
                <?php
                }
                ?>

            </section>
        </main>
        <footer>
            <div class="header-footer">
                Library Project
            </div>
        </footer>
    </div>
</body>

</html>