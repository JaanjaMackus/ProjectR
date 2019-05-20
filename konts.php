<?php include('konts_parbaude.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Datu Vizualizēšana</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>


<body>
    <?php include('nav.php');
    
    if(isset($_SESSION['Lietotajvards'])){
        echo "<div id='Atstarpe'></div><div class='Saturs Saturs_Smalks'>";
        include('konts_nav.php');
        
        
    }else{
        include('pieslegties.php');
    } ?>        
        
</body>
    
</html>
