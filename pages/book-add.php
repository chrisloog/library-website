<?php require_once '../functions.php';
$authors = getData('../authors.txt'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book form</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div id="container">
        <header>
            <div class="header-footer">
                <a href="../index.php">Books</a>&nbsp;|&nbsp;
                <a href="">Add books</a>&nbsp;|&nbsp;
                <a href="author-list.php">Authors</a>&nbsp;|&nbsp;
                <a href="author-add.php">Add authors</a>
            </div>

            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'titleError') : ?>
                <div class="header-footer" id="error-message">Title should be between 3 and 23 characters!</div>
            <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'authorError') : ?>
                <div class="header-footer" id="error-message">Please add an author to your book.</div>
            <?php endif; ?>
        </header>

        <main>
            <section>
                <form id="input-form" method="post">
                    <div class="label-cell">
                        <label for="title">Pealkiri:</label>
                    </div>
                    <div class="input-cell">
                        <input id="title" name="title" value="<?= isset($_GET['title']) ? urldecode($_GET['title']) : ''; ?>" type="text" />
                    </div>

                    <div class="label-cell">
                        <label for="bookAuthor">Autor:</label>
                    </div>
                    <div class="input-cell">
                        <select name="bookAuthor" id="bookAuthor">
                            <?php if (isset($_GET['msg'])) : ?>
                                <option><?= urldecode($_GET['author']) ?></option>
                            <?php else : ?>
                                <option></option>
                            <?php endif;
                            if (!empty($authors)) :
                                foreach ($list as $item) : echo
                                    <<<ITEM
                                            <option>$item[0] $item[1]</option>
                                        ITEM;
                                endforeach;
                            endif; ?>
                        </select>
                    </div>

                    <div class="label-cell">Hinne:</div>
                    <div class="input-cell">
                        <label> <input type="radio" name="grade" value="1" <?= (isset($_GET['rating']) && $_GET['rating'] == 1) ? 'checked' : ''; ?> />1 </label>
                        <label> <input type="radio" name="grade" value="2" <?= (isset($_GET['rating']) && $_GET['rating'] == 2) ? 'checked' : ''; ?> />2 </label>
                        <label> <input type="radio" name="grade" value="3" <?= (isset($_GET['rating']) && $_GET['rating'] == 3) ? 'checked' : ''; ?> />3 </label>
                        <label> <input type="radio" name="grade" value="4" <?= (isset($_GET['rating']) && $_GET['rating'] == 4) ? 'checked' : ''; ?> />4 </label>
                        <label> <input type="radio" name="grade" value="5" <?= (isset($_GET['rating']) && $_GET['rating'] == 5) ? 'checked' : ''; ?> />5 </label>
                    </div>
                    <div class="flex-break"></div>
                    <div class="label-cell"></div>

                    <div class="input-cell button-cell">
                        <?php if (isset($_GET['msg']) && $_GET['msg'] = 'edit') : ?>
                            <input id="currentTitle" name="currentTitle" type="hidden" value="<?php echo $_GET['title'] ?>" />
                            <input id="currentAuthor" name="currentAuthor" type="hidden" value="<?php echo $_GET['author'] ?>" />
                            <input id="currentRating" name="currentRating" type="hidden" value="<?php echo $_GET['rating'] ?>" />
                            <input name="submitButton" type="submit" class="danger" formaction="../functions.php?cmd=book-delete" value="Kustuta" />
                            <input name="submitButton" type="submit" formaction="../functions.php?cmd=book-edit" value="Salvesta" />
                        <?php else : ?>
                            <input name="submitButton" type="submit" formaction="../functions.php?cmd=book-save" value="Salvesta" />
                        <?php endif; ?>
                    </div>
                </form>
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