<?php
$Nosaukums = "";
$Apraksts_Iss = "";
$Apraksts = "";
$E_Pasts    = "";
$Kludas = array(); 

// datubāzes konekcija
include('db.php');
// Lietotāja reģistrācija
if(isset($_POST['Saglabat_Projektu'])){
    // paņem visus datus no lietotāja izmantojot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Nosaukums = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Nosaukums'])));
    $Apraksts_Iss = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts_Iss'])));
    $Apraksts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts'])));
    
    $_SESSION['Projekta_Nosaukums']=$Nosaukums;
    $_SESSION['Projekta_Apraksts_Iss']=$Apraksts_Iss;
    $_SESSION['Projekta_Apraksts']=$Apraksts;
    $ID_Projekts = $_SESSION['Projekta_ID'];
    
    // Lietotāja datu pārbaude
    if(empty($Nosaukums)){ $Kludas[]="nepieciešams Nosaukums"; }
    if(empty($Apraksts_Iss)){ $Kludas[]="nepieciešams Īss apraksts"; }
    if(empty($Apraksts)){ $Kludas[]="nepieciešams apraksts"; }

    // vārda pieejamības pārbaude
    $Pieprasijums = "SELECT * FROM projekts WHERE Nosaukums='$Nosaukums'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $projekts = mysqli_fetch_assoc($Rezultats);
    if($projekts){
        if($projekts['ID_Projekts'] == $ID_Projekts){
        }else if ($projekts['Nosaukums'] === $Nosaukums){
            $Kludas[]="Projekts ar šādu nosaukumu jau eksistē";
        }
    }

    // ja nav kļūdu tad saglabā izmaiņas projektā
    if (count($Kludas) == 0) {
        $E_Pasts = $_SESSION['E_Pasts'];
        $Pieprasijums = "SELECT ID_Konts FROM konts WHERE E_Pasts='$E_Pasts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Lietotajs = mysqli_fetch_assoc($Rezultats);
        if($Lietotajs){
            mysqli_set_charset($Datu_Baze,"utf8");
            $Lietotajs = $Lietotajs['ID_Konts'];
            $Pievienojamais = "UPDATE projekts SET Nosaukums='$Nosaukums', Apraksts_Iss='$Apraksts_Iss', Apraksts='$Apraksts ' WHERE ID_Konts=$Lietotajs AND ID_Projekts=$ID_Projekts";
            $labosana = mysqli_query($Datu_Baze, $Pievienojamais);
            if($labosana){
                    header('location: konts.php?Saturs=2');
            }else{
                $Kludas[]="radās kļūda labojot projektu, mēģiniet vēlāk";
            }          
        }else{
            $Kludas[]="neizdevās iegūt lietotāja ID, mēģiniet iziet un ieiet savā kontā";
        }
    }
}else if(isset($_POST['Atcelt_Projektu'])){
    
    unset($_SESSION['Projekta_Apraksts_Iss']);
    unset($_SESSION['Projekta_Apraksts']);
    unset($_SESSION['Dalibnieks_ID']);
    unset($_SESSION['Projekta_Nosaukums']);
    unset($_SESSION['Projekta_ID']);
    session_write_close();
    header('location: konts.php?Saturs=2');
    
    
}else if(isset($_POST['Dzest_Projektu'])){
    
    $ID_Projekts = $_SESSION['Projekta_ID'];
    $Pieprasijums = "DELETE FROM projekts WHERE ID_Projekts=$ID_Projekts LIMIT 1";
    echo $Pieprasijums;
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    if($Rezultats){
        header('location: konts.php?Saturs=2');
    }else{
        echo "Neizdevās izdzēst";
    }
    

}else if(isset($_POST['Publicet_Projektu'])){
    $ID_Projekts = $_SESSION['Projekta_ID'];
    $Pieprasijums = "UPDATE projekts SET VaiPublisks=2 WHERE ID_Projekts=$ID_Projekts";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    if(!$Rezultats){
        echo "neizdevās projekta publicēšanas pieprase";
    }
    
    
    
}else if(isset($_POST['Privatizet_Projektu'])){
    $ID_Projekts = $_SESSION['Projekta_ID'];
    $Pieprasijums = "UPDATE projekts SET VaiPublisks=0 WHERE ID_Projekts=$ID_Projekts";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    if(!$Rezultats){
        echo "neizdevās projekta privatizēšanas pieprase";
    }
    
    
    
}else if(isset($_POST['Saglabat_Dalibnieku'])){
    // paņem visus datus no lietotāja izmantojot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Vards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Vards'])));
    $Uzvards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Uzvards'])));
    $Apraksts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts'])));
    if(empty($Vards)){ $Kludas[]="nepieciešams vārds"; }
    if(empty($Uzvards)){ $Kludas[]="nepieciešams uzvārds"; }
    if(empty($Apraksts)){ $Kludas[]="nepieciešams apraksts"; }
    
    // ja nav kļūdu tad saglabā izmaiņas dalībniekam
    if (count($Kludas) == 0) {
        $ID_Projekts = $_SESSION['Projekta_ID'];
        $ID_Dalibnieks = $_SESSION['Dalibnieks_ID'];
        unset($_SESSION['Dalibnieks_ID']);
        mysqli_set_charset($Datu_Baze,"utf8");
        $Pievienojamais = "UPDATE dalibnieks SET Vards='$Vards', Uzvards='$Uzvards', Apraksts='$Apraksts ' WHERE ID_Dalibnieks=$ID_Dalibnieks AND ID_Projekts=$ID_Projekts";
        $labosana = mysqli_query($Datu_Baze, $Pievienojamais);
        if($labosana){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            //header('location: konts.php?Saturs=2');
        }else{
            $Kludas[]="radās kļūda labojot Dalibnieku, mēģiniet vēlāk";
        }          
    }
    
    
}else if(isset($_POST['Saglabat_Pievienoto_Dalibnieku'])){
    // paņem visus datus no lietotāja izmantojot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Vards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Vards'])));
    $Uzvards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Uzvards'])));
    $Apraksts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts'])));
    if(empty($Vards)){ $Kludas[]="nepieciešams vārds"; }
    if(empty($Uzvards)){ $Kludas[]="nepieciešams uzvārds"; }
    if(empty($Apraksts)){ $Kludas[]="nepieciešams apraksts"; }
    
    // ja nav kļūdu tad saglabā izmaiņas dalībniekam
    if (count($Kludas) == 0){
        $ID_Projekts = $_SESSION['Projekta_ID'];
        mysqli_set_charset($Datu_Baze,"utf8");
        $Pievienojamais = "INSERT INTO dalibnieks (Vards, Uzvards, Apraksts, ID_Projekts) values ('$Vards', '$Uzvards', '$Apraksts', $ID_Projekts)";
        echo $Pievienojamais;
        $pievienosana = mysqli_query($Datu_Baze, $Pievienojamais);
        if($pievienosana){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            //header('location: konts.php?Saturs=2');
        }else{
            $Kludas[]="radās kļūda pievienojot Dalibnieku, mēģiniet vēlāk";
        }          
    }
    
    
}else if(isset($_POST['Dzest_Dalibnieku'])){
    $Nosaukums = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Nosaukums'])));
    $Apraksts_Iss = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts_Iss'])));
    $Apraksts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts'])));
    $_SESSION['Projekta_Nosaukums']=$Nosaukums;
    $_SESSION['Projekta_Apraksts_Iss']=$Apraksts_Iss;
    $_SESSION['Projekta_Apraksts']=$Apraksts;
    
    $ID_Dalibnieks = $_POST['Dzest_Dalibnieku'];
    $Pieprasijums = "DELETE FROM dalibnieks WHERE ID_Dalibnieks=$ID_Dalibnieks LIMIT 1";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    if($Rezultats){
    }else{
        echo "Neizdevās izdzēst";
    }
    
}else if(isset($_POST['Atcelt_Darbibu'])){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
}





