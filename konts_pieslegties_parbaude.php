<?php
session_start();
$_SESSION['Sadala']='Konts';
$E_Pasts = "";
$Parole    = "";
$Kludas = array(); 

// datubāzes konekcija
include('db.php');

if(isset($_POST['Pieslegt_Lietotaju'])){
    $E_Pasts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['E_Pasts'])));
    $Parole = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Parole'])));

    if(empty($E_Pasts)){ $Kludas[]="Ievadiet E-pastu"; }
    if(empty($Parole)){ $Kludas[]="Ievadiet Paroli"; }
    
    if(count($Kludas) == 0){
        $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts='$E_Pasts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        if(mysqli_num_rows($Rezultats) > 0){
            $Konts = mysqli_fetch_array($Rezultats);
            if(password_verify($Parole, $Konts["Parole"])){
                $_SESSION['E_Pasts'] = $E_Pasts;
                header('location: konts.php?Saturs=1');
            }else{
                $Kludas[]="Nepareizs E-pasts vai parole";
            }
        }else{
            $Kludas[]="Nepareizs E-pasts vai parole";
        }
    }
}
?>