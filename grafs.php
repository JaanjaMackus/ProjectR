<?php
$Mervieniba1_Nosaukums = "";
$Mervieniba2_Nosaukums = "";
$datums1_value = "";
$datums2_value = "";
$h1 = "";
$h2 = "";
$m1 = "";
$m2 = "";
$s1 = "";
$s2 = "";
$Nosaukums = "";
$biezums = 1;
$intervals = "hour";
if(isset($_GET['filtrs'])){
    //05:29:38
    //SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = 1 AND Dates BETWEEN '2016-03-09 05:29:38' AND '2016-03-09 05:52:38'
    //2016-03-09 05:52:38    
    
    if(isset($_GET['datums1'])&& $_GET['datums1'] != 0 ){
        if(isset($_GET['h1'])&& $_GET['h1'] != 0 ){
            $h1 = $_GET['h1'];
        }else {$h1 = "0";}
        if(isset($_GET['m1'])&& $_GET['m1'] != 0 ){
            $m1 = $_GET['m1'];
        }else {$m1 = "0";}
        if(isset($_GET['s1'])&& $_GET['s1'] != 0 ){
            $s1 = $_GET['s1'];
        }else {$s1 = "0";}
        $datums1_value = $_GET['datums1'];
        $datums1 = "AND Dates BETWEEN '".$_GET['datums1']." ".$h1.":".$m1.":".$s1."'";
        if(isset($_GET['datums2']) && $_GET['datums2'] == 0){
            $datums1 = "AND Dates > '".$_GET['datums1']." ".$h1.":".$m1.":".$s1."'";
            $datums2 = "";
        }else if(isset($_GET['datums2']) && $_GET['datums2'] != 0){
            if(isset($_GET['h2'])&& $_GET['h2'] != 0 ){
                $h2 = $_GET['h2'];
            }else {$h2 = "0";}
            if(isset($_GET['m2'])&& $_GET['m2'] != 0 ){
                $m2 = $_GET['m2'];
            }else {$m2 = "0";}
            if(isset($_GET['s2'])&& $_GET['s2'] != 0 ){
                $s2 = $_GET['s2'];
            }else {$s2 = "0";}
            $datums2_value = $_GET['datums2'];
            $datums2 = " AND '".$_GET['datums2']." ".$h2.":".$m2.":".$s2."'";
        }else{
            $datums2 = "";
        }
    }else{
        $datums1 = "";
        if(isset($_GET['datums2']) && $_GET['datums2'] != 0){
            $datums2_value = $_GET['datums2'];
            if(isset($_GET['h2'])&& $_GET['h2'] != 0 ){
                $h2 = $_GET['h2'];
            }else {$h2 = "0";}
            if(isset($_GET['m2'])&& $_GET['m2'] != 0 ){
                $m2 = $_GET['m2'];
            }else {$m2 = "0";}
            if(isset($_GET['s2'])&& $_GET['s2'] != 0 ){
                $s2 = $_GET['s2'];
            }else {$s2 = "0";}
            $datums2 = " AND Dates < '".$_GET['datums2']." ".$h2.":".$m2.":".$s2."'";
        }else{
            $datums2 = "";
        }
    }

    $sql = "SELECT Dates, Vertiba FROM merijums Where ID_Mervieniba = ".$_GET['mervieniba1']." $datums1 $datums2 ";
    echo "<p>".$sql."</p><br>";
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
    
if(isset($_GET['intervals']) && $_GET['intervals'] != "" ){
    $intervals = $_GET['intervals'];
}else{
    $intervals = "hour";
}
if(isset($_GET['biezums']) && $_GET['biezums'] != 0){
    $biezums = $_GET['biezums'];
}else{
    $biezums = 1;
}
if(isset($_GET['Nosaukums']) && $_GET['Nosaukums'] != ""){
    $Nosaukums = $_GET['Nosaukums'];
}

}else if(isset($_GET['filtrs_Saglabat'])){
    if(isset($_SESSION['E_Pasts'])){
        $E_Pasts = $_SESSION['E_Pasts'];
        mysqli_set_charset($Datu_Baze,"utf8");
        $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$E_Pasts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Lietotajs = mysqli_fetch_assoc($Rezultats);
        if($Lietotajs){
            if(isset($_GET['intervals']) && $_GET['intervals'] != "" ){
                $intervals = $_GET['intervals'];
            }else{
                $intervals = "hour";
            }
            if(isset($_GET['biezums']) && $_GET['biezums'] != 0){
                $biezums = $_GET['biezums'];
            }else{
                $biezums = 1;
            }
            $ID_Konts = $Lietotajs['ID_Konts'];
            $ID_Projekts = $_GET['Apskatit'];
            $mervieniba1 = $_GET['mervieniba1'];
            $mervieniba2 = $_GET['mervieniba2'];
            $No_Datums = $_GET['datums1']." ".$_GET['h1'].":".$_GET['m1'].":".$_GET['s1'];
            $Lidz_Datums = $_GET['datums2']." ".$_GET['h2'].":".$_GET['m2'].":".$_GET['s2'];
            $Nosaukums = $_GET['Nosaukums'];
            
            $sql = "INSERT INTO atskaite(Nosaukums,ID_Mervieniba1, ID_Mervieniba2,  NO_Datums, Lidz_Datums, Datuma_Biezums, Datuma_Intervals, ID_Projekts, ID_Konts) values ('$Nosaukums', '$mervieniba1' , '$mervieniba2',  '$No_Datums', '$Lidz_Datums', $biezums, '$intervals', $ID_Projekts, $ID_Konts)";
            echo "<p>".$sql."</p><br>";
            $Rezultats = $Datu_Baze->query($sql);
            if(!$Rezultats){
                echo "neizdevās saglabāt filtru";
            }else{
                header("location: ".$_SERVER['HTTP_REFERER']);
            }
        }else{
            echo "neatrada lietotāju";
        }
        
    }else{
        echo "<h3 class='kluda'>Nepieciešams pieslēgties, lai saglabātu filtru, vai arī var saglabāt šīs lapas pilno adresi</h3><br>";
    }
    
}

?>
    <form method="get">
        <input type="hidden" name="Apskatit" value="<?php echo $ID_Projekts; ?>">
        <p class="filtrs">
        <span class="Otra_Rinda">
        Mērvienība 1: 
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
        Mērvienība 2:
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
        </span>
        Datuma biežums: 
        <select name="intervals">
            <option <?php if($intervals == "second"){echo "selected";} ?> value="second">Sekunde</option>
            <option <?php if($intervals == "minute"){echo "selected";} ?> value="minute">Minūte</option>
            <option <?php if($intervals == "hour"){echo "selected";} ?> value="hour">Stunda</option>
            <option <?php if($intervals == "day"){echo "selected";} ?> value="day">Diena</option>
            
        </select>
        <input value="<?php echo $biezums; ?>" name="biezums" type="number" min="1"  placeholder="00">
        </p>
        <p class="filtrs">
        <span class="Otra_Rinda">Datums NO: <input value="<?php echo $datums1_value ?>" name="datums1" type="date"></span>
        H: <input value="<?php echo $h1 ?>" name="h1" type="number" min="0" max="23" placeholder="00">
        M: <input value="<?php echo $m1 ?>" name="m1" type="number" min="0" max="59" placeholder="00">
        S: <input value="<?php echo $s1 ?>" name="s1" type="number" min="0" max="59" placeholder="00">
        </p>
        
        <p class="filtrs">
        <span class="Otra_Rinda">Datums LĪDZ: <input value="<?php echo $datums2_value ?>" name="datums2" type="date"></span>
        H: <input value="<?php echo $h2 ?>" name="h2" type="number" min="0" max="23" placeholder="00">
        M: <input value="<?php echo $m2 ?>" name="m2" type="number" min="0" max="59" placeholder="00">
        S: <input value="<?php echo $s2 ?>" name="s2" type="number" min="0" max="59" placeholder="00">
        </p>
        <p class="filtrs">
        <input value="<?php echo $Nosaukums; ?>" name="Nosaukums" type="text" placeholder="Filtra Nosaukums">
        </p>
        
        
        <input class='Saura_Poga Ievade_Poga' name="filtrs" type="submit" value="Filtrēt">
        <input class='Saura_Poga Ievade_Poga' name="filtrs_Saglabat" type="submit" value="Saglabāt filtru">

    </form>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
    function grafs() {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        zoomEnabled: true,
        title:{
            //text: "Dati no DB" // Jauzstaisa lai nosaukums ir izvele dropdown veida vai input veida
        },
        axisX:{
            valueFormatString: "YYYY-MM-DD HH:mm:ss",
            intervalType: "<?php echo $intervals; ?>",
            interval: <?php echo $biezums; ?>,
            title: "Datums"
        },
        axisY:{
            title: "<?php echo $Mervieniba1_Nosaukums; ?>",
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC",
        },
        axisY2:{
            title: "<?php echo $Mervieniba2_Nosaukums; ?>",
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
            name: "<?php echo $Mervieniba1_Nosaukums; ?>",
            markerSize: 0,
            toolTipContent: "Laiks Mer.1: {x} <br>{name}: {y}",
            showInLegend: true,
            xValueType: "dateTime",
            xValueFormatString: "HH:mm:ss",
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        },{
            type: "line",
            axisYType: "secondary",
            name: "<?php echo $Mervieniba2_Nosaukums; ?>",
            markerSize: 0,
            toolTipContent: "Laiks Mer.2: {x} <br>{name}: {y}",
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
<div class="Atstarpe_Maza"></div>
<?php if(!isset($_GET['filtrs'])){
    echo "<br><br><h3>Izvēlieties vismaz vienu mērvienību, lai redzētu grafu</h3>";
} ?>
<div id="chartContainer" style="grafs"></div>
<script type="text/javascript">grafs()</script>



    









