<?php 
    session_start();
    $login_id = $_SESSION["id"];
    if($login_id == NULL){
      header("Location: /library/"); /* Redirect browser */
      exit();
    }
    session_destroy();
    echo '<script type="text/javascript">
    alert("You have logged out.");
    location.href = "../librarian/";
    </script>';
?>
