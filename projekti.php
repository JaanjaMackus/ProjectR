<?php

session_start();
$_SESSION['Sadala']='Projekti';

// datubāzes konekcija
include('db.php');










$sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = 4 limit 500";
$result = $Datu_Baze->query($sql);
$dataPoints1 = array();

if($result->num_rows > 0){
	// output data of each row
	while($row = mysqli_fetch_row($result)) {
		$dataPoints1[] = array("x" => (strtotime($row[0])*1000), "y" => $row[1]); 
	}
}

$sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = 5 limit 500";
$result2 = $Datu_Baze->query($sql);
$dataPoints2 = array();

if ($result2->num_rows > 0) {
	// output data of each row
	while($row = mysqli_fetch_row($result2)) {
		$dataPoints2[] = array("x" => (strtotime($row[0])*1000), "y" => $row[1]); 
	}
}

















?>
<!DOCTYPE html>
<html>
<head>
    <title>Datu Vizualizēšana</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        
    
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
function grafs() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Dati no DB" // Jauzstaisa lai nosaukums ir izvele dropdown veida vai input veida
	},
	axisX:{
		valueFormatString: "HH:mm:ss",
		intervalType: "minute", // Jauzstaisa lai ir izvele dropdown veida "minute" "hour" "day"
		interval: 30, // Jauzstaisa lai ir izvele dropdown veida - intervals starp nakamo datumu/laiku
		title: "Laiks"
	},
	axisY:{
		title: "Vertiba 1", // Jauzstaisa lai nosaukums ir izvele dropdown veida
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2:{
		title: "Vertiba 2", // Jauzstaisa lai nosaukums ir izvele dropdown veida
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E",
		includeZero: false
	},
	legend:{
		cursor: "pointer",
		dockInsidePlotArea: true,
		itemclick: toggleDataSeries
	},
	data: [{
		type: "line",
		name: "Mervieniba 1", // Jauzstaisa lai nosaukums ir izvele dropdown veida
		markerSize: 0,
		toolTipContent: "Datums: {x} <br>{name}: {y} W/m", // Jauzstaisa lai [W/m] ir izvele dropdown veida
		showInLegend: true,
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		axisYType: "secondary",
		name: "Mervieniba 2",
		markerSize: 0,
		toolTipContent: "Datums: {x} <br>{name}: {y} KPH", // Jauzstaisa lai KPH ir izvele dropdown veida
		showInLegend: true,
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
    
    
</head>


<body>
    <?php include('nav.php'); ?>
    <div class="Atstarpe"></div>
    <?php
        
    if(isset($_POST['Publicesana'])){
        echo "<form class='Saturs Saturs_Smalks' method='post'>";
        $ID_Projekts = $_POST['ID_Projekts'];
        if($_POST['Publicesana']=='Noraidit'){
        // Noraida projekta publicesanu
            $Pieprasijums = "UPDATE projekts SET VaiPublisks=0 WHERE ID_Projekts='$ID_Projekts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            if(mysqli_affected_rows($Datu_Baze) > 0){
                header('Location: konts.php?Saturs=5');
            }else{
                echo "Neizdevās noraidīt projektu";
            }
        }else{
        // Apstiprina projekta publicesanu
            $Pieprasijums = "UPDATE projekts SET VaiPublisks=1 WHERE ID_Projekts='$ID_Projekts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            if(mysqli_affected_rows($Datu_Baze) > 0){
                header('Location: konts.php?Saturs=5');
            }else{
                echo "Neizdevās apstiprināt projektu";
            }
        }
        echo "</form>";
    }else if(isset($_POST['Apskatit']) || isset($_GET['Apskatit'])) {
        echo "<div class='Saturs Saturs_Smalks'>";
        if(isset($_POST['Apskatit'])){
            $ID_Projekts = $_POST['Apskatit'];
        }else{
            $ID_Projekts = $_GET['Apskatit'];
        }
        mysqli_set_charset($Datu_Baze,"utf8");
        // Projekta datu iegūšana
        $Pieprasijums = "SELECT * FROM projekts WHERE ID_Projekts='$ID_Projekts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Projekts = mysqli_fetch_assoc($Rezultats);
        if($Projekts){
            if($Projekts['VaiPublisks']==1){
////////////ja ir publisks projekts
                include('projekti_paradit.php');
                ?>
    </div>
<div class="Vizualizesanai">
    <?php include('grafs.php'); ?> 

</div><?php
        }else{
/////////ja nav publisks projekts
            $E_Pasts = $_SESSION['E_Pasts'];
            mysqli_set_charset($Datu_Baze,"utf8");
            $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$E_Pasts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            $Lietotajs = mysqli_fetch_assoc($Rezultats);
            if($Lietotajs){
                
                if($Lietotajs['Tiesibas'] == 1){
                    include('projekti_paradit.php');
                    ?>
    </div>
<div class="Vizualizesanai">
    <?php include('grafs.php'); ?>     

</div>
                    <input type="hidden" name="ID_Projekts" value="<?php echo $ID_Projekts; ?>">
                    <button class='konts_poga' type='submit' name='Publicesana' value='Noraidit'>Noraidīt</button>
                    <button class='konts_poga' type='submit' name='Publicesana' value='Apstiprinat'>Apstiprināt</button>
                    <?php
                }else if($Lietotajs['ID_Konts'] == $Projekts['ID_Konts']){
                    include('projekti_paradit.php');
?>
</div>
<div class="Vizualizesanai">
    <?php include('grafs.php'); ?>     
</div><?php
                }else{
                    echo "<h3>Jums nav atļauta piekļuve šim projektam</h3>";
                }
            }   





        }
    }else{
        echo "Neizdevās atrast izvēlēto projektu, mēģiniet vēlreiz";
    }
    }else{
        echo "<form class='Saturs Saturs_Smalks' method='post'>";
        mysqli_set_charset($Datu_Baze,"utf8");
        $Pieprasijums = "SELECT * FROM projekts WHERE VaiPublisks=1";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        while($projekts = mysqli_fetch_assoc($Rezultats)){
            echo "
            <div class='Projekts Konta_teksts Projekts_Izstiepts'>
                <h3>" . $projekts['Nosaukums'] . "</h3>
                <p>".$projekts['Apraksts_Iss']."
                <br><br><button class='konts_poga' type='submit' name='Apskatit' value=".$projekts['ID_Projekts'].">Apskatīt projektu</button></p>
            </div>";
        }
        echo "</form>";
    }
    ?>
        
 
</body>
    
</html>
