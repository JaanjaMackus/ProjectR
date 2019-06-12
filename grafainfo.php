<?php
$sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = 4 limit 500";
$result = $Datu_Baze->query($sql);
$dataPoints1 = array();

if ($result->num_rows > 0) {
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
$Datu_Baze->close();

?>
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