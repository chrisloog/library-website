<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Author form</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <div id="container">
    <div class="header-footer">
      <a href="index.php">Books</a>&nbsp;|&nbsp;
      <a href="book-add.php">Add books</a>&nbsp;|&nbsp;
      <a href="author-list.php">Authors</a>&nbsp;|&nbsp;
      <a href="">Add authors</a>
    </div>

    <?php
    if (isset($_GET['msg']) && $_GET['msg'] === 'error') {
    ?>
      <div class="header-footer" id="error-message">
        Title should be between 3 and 23 characters!
      </div>
    <?php
    }
    ?>

    <main>
      <section>
        <form id="input-form" method="post">
          <?php
          if (isset($_GET['msg']) && $_GET['msg'] == 'edit') {
          ?>
            <input id="currentFirstName" name="currentFirstName" type="hidden" value="<?php echo $_GET['firstName'] ?>" />
            <input id="currentLastName" name="currentLastName" type="hidden" value="<?php echo $_GET['lastName'] ?>" />
            <input id="currentRating" name="currentRating" type="hidden" value="<?php echo $_GET['rating'] ?>" />
          <?php
          }
          ?>
          <div class="label-cell">
            <label for="name">First name:</label>
          </div>
          <div class="input-cell">
            <input id="name" name="firstName" value="<?php echo isset($_GET['firstName']) ? $_GET['firstName'] : ''; ?>" type="text" />
          </div>

          <div class="label-cell">
            <label for="last-name">Last name:</label>
          </div>
          <div class="input-cell">
            <input id="last-name" name="lastName" value="<?php echo isset($_GET['lastName']) ? $_GET['lastName'] : ''; ?>" type="text" />
          </div>

          <div class="label-cell">Rating:</div>
          <div class="input-cell">
            <label> <input type="radio" name="grade" value="1" <?php echo (isset($_GET['rating']) && $_GET['rating'] == 1) ? 'checked' : ''; ?> />1 </label>
            <label> <input type="radio" name="grade" value="2" <?php echo (isset($_GET['rating']) && $_GET['rating'] == 2) ? 'checked' : ''; ?> />2 </label>
            <label> <input type="radio" name="grade" value="3" <?php echo (isset($_GET['rating']) && $_GET['rating'] == 3) ? 'checked' : ''; ?> />3 </label>
            <label> <input type="radio" name="grade" value="4" <?php echo (isset($_GET['rating']) && $_GET['rating'] == 4) ? 'checked' : ''; ?> />4 </label>
            <label> <input type="radio" name="grade" value="5" <?php echo (isset($_GET['rating']) && $_GET['rating'] == 5) ? 'checked' : ''; ?> />5 </label>
          </div>

          <div class="flex-break"></div>
          <div class="label-cell"></div>
          <div class="input-cell button-cell">
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] = 'edit') {
            ?>
              <input name="submitButton" type="submit" class="danger" formaction="functions.php?cmd=author-delete" value="Kustuta" />
              <input name="submitButton" type="submit" formaction="functions.php?cmd=author-edit" value="Salvesta" />
            <?php
            } else {
            ?>
              <input name="submitButton" type="submit" formaction="functions.php?cmd=author-save" value="Salvesta" />
            <?php
            }
            ?>
        </form>
  </div>
  </section>
  </main>
  <div class="header-footer">
    Library Project
  </div>
  </div>
</body>

</html>