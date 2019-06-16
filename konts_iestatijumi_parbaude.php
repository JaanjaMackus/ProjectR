<?php
// datubāzes konekcija
include('db.php');

$Vards = "";
$Uzvards = "";
$E_Pasts    = "";
$Kludas = array();
$Vecais_E_Pasts = $_SESSION['E_Pasts'];

$Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$Vecais_E_Pasts'";
$Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
if(mysqli_num_rows($Rezultats) > 0){
    $Konts = mysqli_fetch_array($Rezultats);
    $Vards = $Konts["Vards"];
    $Uzvards = $Konts["Uzvards"];
    $E_Pasts = $Konts["E_Pasts"];
}else{
    $Kludas[]="Radās kļūda meklējot jūsu datus";
}



// Lietotāja rediģēšana
if (isset($_POST['Saglabat_Izmainas'])){
    // paņem visus datus no lietotāja izmantjot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Vards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Vards'])));
    $Uzvards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Uzvards'])));
    $E_Pasts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['E_Pasts'])));
    $Parole_1 = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Parole_1'])));
    $Parole_2 = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Parole_2'])));

    // Lietotāja datu pārbaude
    if(empty($Vards)){ $Kludas[]="nepieciešams Vārds"; }
    if(strlen($Vards) > '20'){ $Kludas[]="vārds ir garāks par 20 simboliem"; }
    if(empty($Uzvards)){ $Kludas[]="nepieciešams Uzvārds"; }
    if(strlen($Uzvards) > '20'){ $Kludas[]="uzvārds ir garāks par 20 simboliem"; }
    if(empty($E_Pasts)){ $Kludas[]="nepieciešams E-Pasts"; }
    if(strlen($E_Pasts) > '50'){ $Kludas[]="E-Pasts ir garāks par 50 simboliem"; }

    // E-pasta pieejamības pārbaude
    if($Vecais_E_Pasts != $E_Pasts){
        $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts='$E_Pasts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Lietotajs = mysqli_fetch_assoc($Rezultats);
        if($Lietotajs){
            if ($Lietotajs['E_Pasts'] === $E_Pasts){
                $Kludas[]="E-pasts jau tiek izmantots citā kontā";
            }
        }
    }
    // Ja nav ievadīta jauna parole
    if(empty($Parole_1) && empty($Parole_2)){
        // ja nav kļūdu tad rediģē lietotāju
        if (count($Kludas) == 0){
            $Pieprasijums = "UPDATE konts set Vards='$Vards', Uzvards='$Uzvards', E_Pasts='$E_Pasts' where E_Pasts='$Vecais_E_Pasts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            if($Rezultats){
                $_SESSION['E_Pasts'] = $E_Pasts;
                $Kludas[]="IZDEVĀS konta rediģēšana !!!";
            }else{
                $Kludas[]="neizdevās konta rediģēšana";
            }
        }   
    //Ja ievadīta jauna parole
    }else if(!empty($Parole_1) && !empty($Parole_2) && $Parole_1 == $Parole_2){
        if(strlen($Parole_1) < '10'){ $Kludas[]="parolei jābūt vismaz 10 simbolu garumā"; }
        if(strlen($Parole_1) > '30'){ $Kludas[]="parole ir garāka par 30 simboliem"; 
        }else{
            if(!preg_match("#[0-9]+#",$Parole_1)){ $Kludas[]="nepieciešams cipars parolē"; }
            if(!preg_match("#[A-Z]+#",$Parole_1)){ $Kludas[]="nepieciešams lielais burts parolē"; }
            if(!preg_match("#[a-z]+#",$Parole_1)){ $Kludas[]="nepieciešams mazais burts parolē"; }
        }
        
        // ja nav kļūdu tad rediģē lietotāju
        if (count($Kludas) == 0){
            $Parole = password_hash($Parole_1, PASSWORD_DEFAULT);
            $Pieprasijums = "UPDATE konts set Vards='$Vards', Uzvards='$Uzvards', E_Pasts='$E_Pasts', Parole='$Parole'  where E_Pasts='$Vecais_E_Pasts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            if($Rezultats){
                $_SESSION['E_Pasts'] = $E_Pasts;
                $Kludas[]="IZDEVĀS konta rediģēšana !!!";
            }else{
                $Kludas[]="neizdevās konta rediģēšana";
            }
        }
        
        
    }else{ $Kludas[]="Ievadītās paroles nesakrīt"; }
}


