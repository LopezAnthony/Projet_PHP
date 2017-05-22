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
        if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1){
            return true;
        }else{
            return false;
        }
    }
?>
