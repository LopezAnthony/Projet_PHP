<?php
function debug($d, $mode = 1)
{
	echo '<div style="background: orange; padding: 5px; z-index: 1000;">';
	$trace = debug_backtrace();
	echo 'debug demandé dans le fichier ' . $trace[0]['file'] . ' à la ligne ' . $trace[0]['line'];
	// echo '<pre>'; print_r($trace); echo '</pre>';
		if($mode == 1) 
		{
			echo '<pre>'; print_r($d); echo '</pre>';
		}
		else
		{
			var_dump($d);
		}
	echo '</div>';
}

function dd($d, $mode = 1)
{
	echo '<div style="background: orange; padding: 5px; z-index: 1000;">';
	$trace = debug_backtrace();
	echo 'debug demandé dans le fichier ' . $trace[0]['file'] . ' à la ligne ' . $trace[0]['line'];
	// echo '<pre>'; print_r($trace); echo '</pre>';
		if($mode == 1) 
		{
			echo '<pre>'; print_r($d); echo '</pre>';
		}
		else
		{
			var_dump($d);
		}
	echo '</div>';
    die();
}

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

function validateDate($date, $format = 'Y-m-d H:i')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
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


