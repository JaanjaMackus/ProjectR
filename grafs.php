<?php
$Mervieniba1_Nosaukums = "";
$Mervieniba2_Nosaukums = "";
if(isset($_GET['filtrs'])){
    //05:29:38
    //SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = 1 AND Dates BETWEEN '2016-03-09 05:29:38' AND '2016-03-09 05:52:38'
    //2016-03-09 05:52:38
    if(isset($_GET['datums1'])&& $_GET['datums1'] != 0 ){
        $datums1 = "AND Dates BETWEEN '".$_GET['datums1']."'";
    }else{
        $datums1 = "";
    }
    if(isset($_GET['datums2']) && $_GET['datums2'] != 0){
        $datums2 = " AND '".$_GET['datums2']."'";
    }else{
        $datums2 = "";
    }

    $sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = ".$_GET['mervieniba1']." $datums1 $datums2 ";
    echo $sql;
    $Rezultats = $Datu_Baze->query($sql);
    $dataPoints1 = array();
    if($Rezultats){
        if ($Rezultats->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_row($Rezultats)) {
                $dataPoints1[] = array("x" => (strtotime($row[0])*999.9975305), "y" => $row[1]); 
            }
        }
    }
    $sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = ".$_GET['mervieniba2']." $datums1 $datums2 ";
    $Rezultats2 = $Datu_Baze->query($sql);
    $dataPoints2 = array();
    if($Rezultats2){
        if ($Rezultats2->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_row($Rezultats2)) {
                $dataPoints2[] = array("x" => (strtotime($row[0])*999.9975305), "y" => $row[1]); 
            }
        }    
    }
    
}else{


    $sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = 4 limit 500";
    $Rezultats = $Datu_Baze->query($sql);
    $dataPoints1 = array();

    if ($Rezultats->num_rows > 0) {
        // output data of each row
        while($row = mysqli_fetch_row($Rezultats)) {
            $dataPoints1[] = array("x" => (strtotime($row[0])*1000), "y" => $row[1]); 
        }
    }

    $sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = 5 limit 500";
    $Rezultats2 = $Datu_Baze->query($sql);
    $dataPoints2 = array();
    if ($Rezultats2->num_rows > 0) {
        // output data of each row
        while($row = mysqli_fetch_row($Rezultats2)) {
            $dataPoints2[] = array("x" => (strtotime($row[0])*1000), "y" => $row[1]); 
        }
    }

}

?>
    <form method="get">
        <input type="hidden" name="Apskatit" value="<?php echo $ID_Projekts; ?>">
        <p class="filtrs">
        <select name="mervieniba1">
        <option value="">--Tukš--</option>
        <?php
        $sql = "SELECT DISTINCT ID_Mervieniba FROM merijums WHERE ID_Projekts = $ID_Projekts";
        $Rezultats = $Datu_Baze->query($sql);
        if ($Rezultats->num_rows > 0) {
            while($Mervieniba = mysqli_fetch_row($Rezultats)) {
                $sql = "SELECT Mervieniba FROM mervieniba Where ID_Mervieniba = ".$Mervieniba[0];
                $Mer_Rezultats = $Datu_Baze->query($sql);
                if ($Mer_Rezultats->num_rows > 0) {
                    $MerRezultats = mysqli_fetch_row($Mer_Rezultats);
                    $Mervienibas_Vards = $MerRezultats[0];
                }else{
                    $Mervienibas_Vards = " ";
                }
                if(isset($_GET['mervieniba1']) && $_GET['mervieniba1'] == $Mervieniba[0] ){
                    $selected = "selected";
                    $Mervieniba1_Nosaukums = $Mervienibas_Vards;
                }else{
                    $selected = "";
                }
                echo "<option ".$selected." value='".$Mervieniba[0]."'> ".$Mervienibas_Vards."</option>";
            }
        }
        ?>
        </select>
        <select name="mervieniba2">
        <option value="">--Tukš--</option>
        <?php
        $sql = "SELECT DISTINCT ID_Mervieniba FROM merijums WHERE ID_Projekts = $ID_Projekts";
        $Rezultats = $Datu_Baze->query($sql);
        if ($Rezultats->num_rows > 0) {
            while($Mervieniba = mysqli_fetch_row($Rezultats)) {
                $sql = "SELECT Mervieniba FROM mervieniba Where ID_Mervieniba = ".$Mervieniba[0];
                $Mer_Rezultats = $Datu_Baze->query($sql);
                if ($Mer_Rezultats->num_rows > 0) {
                    $MerRezultats = mysqli_fetch_row($Mer_Rezultats);
                    $Mervienibas_Vards = $MerRezultats[0];
                }else{
                    $Mervienibas_Vards = " ";
                }
                if(isset($_GET['mervieniba2']) && $_GET['mervieniba2'] == $Mervieniba[0] ){
                    $selected = "selected";
                    $Mervieniba2_Nosaukums = $Mervienibas_Vards;
                }else{
                    $selected = "";
                }
                echo "<option ".$selected." value='".$Mervieniba[0]."'> ".$Mervienibas_Vards."</option>";
            }
        }
        ?>
        </select>
        </p>
        <p class="filtrs">
        <span class="Otra_Rinda">Datums NO: <input name="datums1" type="date"></span>
        H: <input name="h1" type="number" min="0" max="23" placeholder="00">
        M: <input name="m1" type="number" min="0" max="59" placeholder="00">
        S: <input name="s1" type="number" min="0" max="59" placeholder="00">
        </p>
        
        <p class="filtrs">
        <span class="Otra_Rinda">Datums LĪDZ: <input name="datums2" type="date"></span>
        H: <input name="h2" type="number" min="0" max="23" placeholder="00">
        M: <input name="m2" type="number" min="0" max="59" placeholder="00">
        S: <input name="s2" type="number" min="0" max="59" placeholder="00">
        </p>
        
        
        <input class='Ievade_Poga' name="filtrs" type="submit" value="Filtrēt">

    </form>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
    function grafs() {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        zoomEnabled: true,
        title:{
            text: "Dati no DB" // Jauzstaisa lai nosaukums ir izvele dropdown veida vai input veida
        },
        axisX:{
            valueFormatString: "YYYY-MM-DD HH:mm:ss",
            intervalType: "hour", // Jauzstaisa lai ir izvele dropdown veida "second" "minute" "hour" "day"
            interval: 4, // Jauzstaisa lai ir izvele dropdown veida - intervals starp nakamo datumu/laiku
            title: "Datums"
        },
        axisY:{
            title: "<?php echo $Mervieniba1_Nosaukums;  ?>",
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC",
        },
        axisY2:{
            title: "<?php echo $Mervieniba2_Nosaukums;  ?>",
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
        toolTip:{
            shared: true
        },
        data: [{
            type: "line",
            name: "Mervieniba 1", // Jauzstaisa lai nosaukums ir izvele dropdown veida
            markerSize: 0,
            toolTipContent: "Laiks Mer.1: {x} <br>{name}: {y} W/m", // Jauzstaisa lai [W/m] ir izvele dropdown veida
            showInLegend: true,
            xValueType: "dateTime",
            xValueFormatString: "HH:mm:ss",
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        },{
            type: "line",
            axisYType: "secondary",
            name: "Mervieniba 2",
            markerSize: 0,
            toolTipContent: "Laiks Mer.2: {x} <br>{name}: {y} KPH", // Jauzstaisa lai KPH ir izvele dropdown veida
            showInLegend: true,
            xValueType: "dateTime",
            xValueFormatString: "HH:mm:ss",
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
<div id="chartContainer" style="grafs"></div>
<script type="text/javascript">grafs()</script>



    









