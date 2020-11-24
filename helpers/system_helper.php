<?php
    //Redirection vers page
    function redirect($page = FALSE, $message = NULL, $message_type = NULL) {

        if(is_string($page)) {
            $location= $page;
        } else {
            $location = $_SERVER['SCRIPT_NAME'];
        }

        // Verifier Message
        if($message!=NULL) {
            // Assigner message
            $_SESSION['message']= $message;
        }
        // Verifier Type
        if($message_type!=NULL) {
            // Assigner type message
            $_SESSION['message_type']= $message_type;
        }

        // Redirection
        header('location: '.$location);
        exit;
    }

    // Afficher le message
    function displayMessage(){

        if(!empty($_SESSION['message'])) {

            // Assigner variable message
            $message = $_SESSION['message'];

            if(!empty($_SESSION['message_type'])) {
                // Assigner variable type
                $message_type = $_SESSION['message_type'];
                // Output
                if ($message_type == 'error') {
                    echo '<div class="alert alert-danger">' .$message.'</div>';
                } else {
                    echo '<div class="alert alert-success">' .$message.'</div>';
                }
            }

            // Reset message
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        } else {
            echo '';
        }
    }
?>


