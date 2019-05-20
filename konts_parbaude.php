<?php
session_start();
$Lietotajvards = "";
$Parole    = "";
$Kludas = array(); 

// datubāzes konekcija
$Datu_Baze = mysqli_connect('localhost', 'root', '', 'registration');

if(isset($_POST['Pieslegt_Lietotaju'])){
    $Lietotajvards = mysqli_real_escape_string($Datu_Baze, $_POST['Lietotajvards']);
    $Parole = mysqli_real_escape_string($Datu_Baze, $_POST['Parole']);

    if(empty($Lietotajvards)){ $Kludas[]="Ievadiet Lietotājvārdu"; }
    if(empty($Parole)){ $Kludas[]="Ievadiet Paroli"; }

    if(count($Kludas) == 0){
        $Pieprasijums = "SELECT * FROM konts WHERE Lietotajvards='$Lietotajvards'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        if(mysqli_num_rows($Rezultats) > 0){
            $Konts = mysqli_fetch_array($Rezultats);
            if(password_verify($Parole, $Konts["Parole"])){
                $_SESSION['Lietotajvards'] = $Lietotajvards;
                $_SESSION['success'] = "You are now logged in";
                header('location: konts.php');
            }else{
                $Kludas[]="Nepareizs lietotājvārds vai parole";
            }
        }else{
            $Kludas[]="Nepareizs lietotājvārds vai parole";
        }
    }
}

?>