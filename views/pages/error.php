<div class="container text-center">
    <?php
    echo 'Error! An error occurred. Please try again! <br>';
    if (isset($message)) {
        echo 'Message error: ' . $message;
    }
    ?>
    <a href="./index.php?controller=pages&action=home">Visit Home!</a>
</div>
