<?php
// connect function
/*function connectUser($connect,$login,$pwd){
    // traitement des données
    $login = htmlspecialchars(strip_tags(trim($login)),ENT_QUOTES);
    $pwd = htmlspecialchars(strip_tags(trim($pwd)),ENT_QUOTES);
    // request
    $sql = "SELECT u.idusers, u.thename, d.iddroit, d.droit_name
	FROM users u
    INNER JOIN droit d 
		ON d.iddroit = u.droit_iddroit
    WHERE u.thename='$login' AND u.thepwd='$pwd';";
    $recup = mysqli_query($connect,$sql) or die(mysqli_error($connect));

    if(mysqli_num_rows($recup)){
        return mysqli_fetch_assoc($recup);
    }else{
        return false;
    }

}*/

function connectUser($connect,$login,$pwd){

    $login = htmlspecialchars(strip_tags(trim($login)),ENT_QUOTES);
    $pwd = htmlspecialchars(strip_tags(trim($pwd)),ENT_QUOTES);

    $sql = "SELECT u.idusers, u.thename, d.iddroit, d.droit_name
	FROM users u
    INNER JOIN droit d 
		ON d.iddroit = u.droit_iddroit
    WHERE u.thename='$login' AND u.thepwd = ?;";

    $prepare = $connect->prepare($sql);
    $prepare->bindValue(1,$pwd,PDO::PARAM_STR);
    $prepare->execute();

    if($prepare->rowCount()){
        return $prepare->fetch(PDO::FETCH_ASSOC);
    }
        return false;


}


// find all user (Rédacteur and administateur)
/*function AllUser($db){
    $sql="SELECT idusers, thename FROM users ORDER BY thename ASC;";
    $request = mysqli_query($db,$sql);
    return mysqli_fetch_all($request,MYSQLI_ASSOC);
}*/

function AllUser($db){

    $sql = $db->query("SELECT idusers, thename FROM users ORDER BY thename ASC");
    $recup = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $recup;
}