
<?php
    session_start();
    session_destroy(); //--> Del toàn bộ info trong Session
    $url = 'index.php'; //--> navigate tới index
    header('Location: ' . $url);
?>
