<?php

//------- userConnected()
function userConnected(){
    if(isset($_SESSION['membre'])){
        return true;
    }else{
        return false;
    }
}

//------- adminConnected()
function adminConnected(){
    if(userConnected() && $_SESSION['membre']['statut'] == 1){
        return true;
    }else{
        return false;
    }
}

//----------------executeRequete 
function executeRequete($req, $param = array()) {  
    if (!empty($param)) { 
        foreach($param as $indice => $valeur){  
            $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES); 
        } 
    } 
 
    global $pdo;  
    $r = $pdo->prepare($req); 
    $succes = $r->execute($param); 
 
    if(!$succes) {  
        die('Erreur sur la requête SQL : ' . $r->errorInfo()[2] ); 
    } 
 
    return $r;  
 
} 



?>


