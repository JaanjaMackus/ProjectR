<?php


//$_SESSION['name_here'] = $_POST;
//$_SESSION['cart'] = array();
//$_SESSION['cart'][$id] = array('type' => 'foo', 'quantity' => 42);

$obligatais = "";
$otrapoga = "<button type='submit' name='submit' form='forma' value='submit'>Next</button></div>";
include 'dbh.php';
$select= "";
session_start();

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <script src="js/jQuery.js"></script>
    <script src="js/javascript.js"></script>
</head>
<body>
<div id="header" class="clear head">
    <h1><img src="images/Dairy.svg">ANWB <label></label><span>HEALTH</span></h1>
</div>

        <?php
        if (isset($_POST["submit"]) && ( end($_POST)== "back" || $_SESSION['obligatais']=="NULL" ||  isset($_POST[$_SESSION['obligatais']]) ) ){
                $_SESSION['obligatais'] = "NULL";
            foreach($_POST as $atbilde){

                      if($atbilde == "back"){
                        if($_SESSION['jautajumanr']>1){
                        $_SESSION['atbildes'][$_SESSION['jautajumanr']]= array();
                        foreach($_POST as $velreizatbilde){
                            if($velreizatbilde != "back"){
                                $_SESSION['atbildes'][$_SESSION['jautajumanr']] = $velreizatbilde;
                            }
                        }
                            $_SESSION['jautajumanr']--;
                            $selected = $_SESSION['atbildes'][$_SESSION['jautajumanr']];
                        }
                    }else if($atbilde == "submit"){
                        $_SESSION['atbildes'][$_SESSION['jautajumanr']]= array();
                        foreach($_POST as $velreizatbilde){
                            if($velreizatbilde != "submit"){
                                $_SESSION['atbildes'][$_SESSION['jautajumanr']] = $velreizatbilde;
                            }
                        }
                        $_SESSION['jautajumanr']++;
                          if(isset($_SESSION['atbildes'][$_SESSION['jautajumanr']])){
                              $selected = $_SESSION['atbildes'][$_SESSION['jautajumanr']];
                          }
                    }else if($atbilde == "done"){
                        $_SESSION['atbildes'][$_SESSION['jautajumanr']] = array();
                        foreach($_POST as $velreizatbilde){
                            if($velreizatbilde != "done"){
                                $_SESSION['atbildes'][$_SESSION['jautajumanr']] = $velreizatbilde;
                            }
                        }
                        $_SESSION['obligatais'] = "email";
                    }
        }
        }else{
            if(!isset($_SESSION['jautajumanr'])){
                $_SESSION['jautajumanr'] = 1;
            }
        }
        if(isset($_SESSION['obligatais']) && $_SESSION['obligatais'] == "email"){//pedejais step
            
            echo "<div id='vidus' class='neredzams'>
    <form action='rezultats.php' method='get' id='forma' class='formasforma'>
    <div class='entermail'>
        <h1>Enter your email and see your results!</h1>
        <p class='entermail'>We will generate and send pdf file with your test results on your email.</p>
        <input required name='email' placeholder='Type your email...' type='email'><br>
        <button name='submitatbildes' class='submit' form='forma' value='submitatbildes'>See My Results</button>
    </div>
    </form>
</div>";


        }else{
            echo "<div id='vidus'><form action='forma.php' method='post' id='forma'>";
            $jautajums = mysqli_query($conn, "select teksts, extra,obligats, veids from jautajumi, jautajumu_veidi where id_jautajums='".$_SESSION['jautajumanr']."' and jautajumu_veidi.id_veids = jautajumi.id_veids");
            $jautajumudaudzums = mysqli_query($conn, "select count(*) as 'count' from jautajumi;");
            $jautajumudaudzums = $jautajumudaudzums->fetch_assoc();
            $jautajumudaudzums = $jautajumudaudzums['count'];
            $jautajums = $jautajums->fetch_assoc();
            echo "<p>".$jautajums['teksts']."</p><span></span>";
            $atbildes = mysqli_query($conn, "select * from atbildes where id_jautajums = '".$_SESSION['jautajumanr']."' ");
            if($_SESSION['jautajumanr'] == $jautajumudaudzums){
                $otrapoga = "<button name='submit' class='submit' form='forma' value='done'>Submit</button></div>";
            }
            switch($jautajums['veids']){
case "gender":
                $obligatais = $jautajums['obligats'];
                $_SESSION['obligatais'] = $obligatais;
                if( $atbildes != false && mysqli_num_rows($atbildes) > 0){
                    while($atbilde = mysqli_fetch_assoc($atbildes)){
                        if( isset($selected) && $selected == $atbilde['atbilde']){
                            $select = "checked='checked'";
                        }else{
                            $select = "";
                        }
                        if($atbilde['atbilde']=="Male"){
                            echo "<label class='izvelne gendertekstsmale'><img class='bilde' src='images/Vitamin_quiz_men.svg'><input ".$select." type='radio' name='".$jautajums['veids']."' value='".$atbilde['atbilde']."'><p>".$atbilde['atbilde']."</p>
                            <span class='poga radiopoga'></span></label>";
                        }else{
                            echo "<label class='izvelne genderteksts'><img class='bilde' src='images/Vitamin_quiz_women.svg.svg'><input ".$select." type='radio' name='".$jautajums['veids']."' value='".$atbilde['atbilde']."'><p>".$atbilde['atbilde']."</p>
                            <span class='poga radiopoga'></span></label>";
                        }
                    }
                    echo " <div class='apaksa'><p>".$_SESSION['jautajumanr']."/".$jautajumudaudzums."</p>".$otrapoga."</form>";
                }
                break;
case "slider":
                    if(!isset($selected)){
                        $selected=($jautajums['extra']/2);
                    }
                    echo "<label><output id='sliderskaitlis'>".$selected."</output></label><input type='range' class='slider' id='slideris' value='".$selected."' min='1' max='".$jautajums['extra']."'name='".$jautajums['veids']."' oninput='sliderskaitlis.value = slideris.value'>
                    <div class='apaksa'>
                        <button name='submit' form='forma' value='back'>Back</button><p>".$_SESSION['jautajumanr']."/".$jautajumudaudzums."</p>".$otrapoga."</form>";
                break;
                
case "radio":
                $obligatais = $jautajums['obligats'];
                $_SESSION['obligatais'] = $obligatais;
                if( $atbildes != false && mysqli_num_rows($atbildes) > 0){
                    while($atbilde = mysqli_fetch_assoc($atbildes)){
                        if( isset($selected) && $selected == $atbilde['atbilde']){
                            $select = "checked='checked'";
                        }else{
                            $select = "";
                        }
                        echo "<label class='izvelne radioteksts'><input ".$select." type='radio' name='".$jautajums['veids']."' value='".$atbilde['atbilde']."'><p>".$atbilde['atbilde']."</p>
                        <span class='poga radiopoga'></span>
                        </label>";
                    }
                    echo "<div class='apaksa'>
                        <button name='submit' form='forma' value='back'>Back</button><p>".$_SESSION['jautajumanr']."/".$jautajumudaudzums."</p>".$otrapoga."</form>";
                }
                break;
                
case "checkbox":
                if( $atbildes != false && mysqli_num_rows($atbildes) > 0){
                    echo "<div class='atstarpe'></div>";
                    while($atbilde = mysqli_fetch_assoc($atbildes)){
                        if( isset($selected)){
                            if(is_array($selected)){
                                foreach($selected as $konkretais){
                                if($atbilde['atbilde'] == $konkretais){
                                    $select = "checked='checked'";
                                    break;
                                }else{
                                    $select = "";
                                }
                            }
                            }else{
                                if($atbilde['atbilde'] == $selected){
                                    $select = "checked='checked'";
                                    break;
                                }else{
                                    $select = "";
                                }
                            }
                        }else{
                            $select = "";
                        }
                        echo "<label class='izvelne checkteksts'><input ".$select." type='checkbox' name='".$jautajums['veids']."[]' value='".$atbilde['atbilde']."'><p>".$atbilde['atbilde']."</p>
                        <span class='poga checkpoga'></span>
                        </label>";
                    }
                    echo "<div class='apaksa'>
                        <button name='submit' form='forma' value='back'>Back</button><p>".$_SESSION['jautajumanr']."/".$jautajumudaudzums."</p>".$otrapoga."</form>";
                }
                break;
                
            }
            
            }

        
        ?>
    <div class="iekspuse"></div>
</div>
<div class="arpuse"></div>
</body>
</html>

