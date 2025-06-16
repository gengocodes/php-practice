<?php
    $db_server = "localhost";
    $db_user = "gengo";
    $db_pass = "Iamgengolar9!";
    $db_name = "phpproject";
    $conn = "";

    try{
    $conn = mysqli_connect( 
        $db_server, 
        $db_user, 
        $db_pass, 
        $db_name);
    }
    catch(mysqli_sql_exception){
        echo "Could not connect! <br>";
    }



?>