<?php
// procedural mysqli connection

/*function connectDB(){
    $connect = @mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME, DB_PORT);
    // if error
    if(mysqli_connect_errno()){
        return false;
    }
    // change charset
    mysqli_set_charset($connect,DB_CHARSET);

    return $connect;
}*/

//PDO

function connectPDO(){
    
    try{
        $connect = new PDO('mysql:host='.DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET.";port=".DB_PORT,DB_USER,DB_PWD);

        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        return $connect;
    }
    catch(PDOException $e){
        $erreur = $e->getCode();
        $erreur .= " : ";
        $erreur .= $e->getMessage();
        
        die($erreur);
    } 

    
}