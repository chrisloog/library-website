<?php
require_once 'functions.php';
$authors = getData('authors.txt');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="container">
        <header>
            <div class="header-footer">
                <a href="index.php">Books</a>&nbsp;|&nbsp;
                <a href="book-add.php">Add books</a>&nbsp;|&nbsp;
                <a href="">Authors</a>&nbsp;|&nbsp;
                <a href="author-add.php">Add authors</a>
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
                    <div class="column left">First name</div>
                    <div class="column middle">Last name</div>
                    <div class="column right">Rating</div>
                </div>
                <hr>
                <?php
                foreach ($authors as $author) {
                    $authorLink = 'author-add.php?msg=edit&firstName=' . urlencode($author[0]) . '&lastName=' . urlencode($author[1]) . '&rating=' . urlencode($author[2]);
                ?>

                    <div class="row">
                        <div class="column left">
                            <a href=<?php echo $authorLink ?> id="book-link"><?php echo $author[0] ?></a>
                        </div>
                        <div class="column middle">
                            <?php echo $author[1] ?>
                        </div>
                        <div class="column right">
                            <?php echo $author[2] ?>
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