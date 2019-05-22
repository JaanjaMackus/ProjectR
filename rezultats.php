<?php


include 'dbh.php';
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
<div id="header" class="clear">
    <h1><img src="images/Dairy.svg">ANWB <label></label><span>HEALTH</span></h1>
</div>

<?php
    
function atbildesskaits($jaut) {
    switch($jaut){
        case 5: $GLOBALS['behavior']++; break;
        case 6: $GLOBALS['circulation']++; break;
        case 7: $GLOBALS['digest']++; break;
        case 8: $GLOBALS['immune']++; break;
        case 9: $GLOBALS['skin']++; break;
    }
}
    
function pievienothealth($veids,$attels,$h2,$p,$recomendationtext) {
    
    if($veids>$GLOBALS['good']){
        $class ="good";
        $teksts="GOOD"; 
    }else if($veids>$GLOBALS['average']){ 
        $class ="average";
        $teksts="AVERAGE";
    }else{
        $class ="poor";
        $teksts="POOR";
    }
    
    echo "<div class='kondicija'>
        <img src='images/".$attels.".svg'><h2>".$h2."</h2><p>".$p."</p><h2 class= '".$class."'> ".$teksts." </h2>
            <h1>".$veids."%</h1></div>";

    if($veids==100){
        echo "<div class='greatjob'><img src='images/apple_green.svg'><h2>Great Job!</h2><p>Keep up the good
        work!</p></div><div class='greatjobbg'></div>";
    }else{
         echo "<div class='recomendation'><img src='images/apple_light.svg'><h2>Recomendation</h2><p>".$recomendationtext."</p></div>";
    }
    
}
function pievienotprogressbar($vitamins,$h2) {
    
    if($vitamins>28){
        $sarkanums = 200-$vitamins*1.5;
    echo "<div class='progressbar sortable' style='width: ".$vitamins."% ; 
    background: rgb(255, ".$sarkanums.", 40);'>
        <h2>".$h2."</h2> <h2>".$vitamins."%</h2>
    </div>";  
    }
  
}
    
    
    
    
    
    
    
    
if (isset($_GET["submitatbildes"])){
    if(isset($_SESSION['atbildes'])){   //ja ir atbildes iesutitas
        
    $lietotajaID = mysqli_query($conn, "select id_lietotajs from lietotajs where email = '".$_GET['email']."'");
    $lietotajaID = $lietotajaID->fetch_assoc();
    if($lietotajaID['id_lietotajs']> 0){
        $sql = "delete from lietotaju_atbildes where id_lietotajs='".$lietotajaID['id_lietotajs']."' ";
        $conn->query($sql);
        $sql = "delete from lietotajs where email ='".$_GET['email']."' ";
        $conn->query($sql);
    }
    
    $sql = "INSERT INTO lietotajs (email) VALUES ('".$_GET['email']."')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $lietotajaID = mysqli_query($conn, "select id_lietotajs from lietotajs where email = '".$_GET['email']."'");
    $lietotajaID = $lietotajaID->fetch_assoc();

        foreach ($_SESSION['atbildes'] as $jautajums => $atbildes) {
            if(is_array($atbildes)){
            foreach ($atbildes as $atbilde) {
                $sql = "INSERT INTO lietotaju_atbildes (id_lietotajs,id_jautajums,atbilde) 
                VALUES (".$lietotajaID['id_lietotajs'].", ".$jautajums.", '".$atbilde."' )";
                $conn->query($sql);
            }
            }else{
                $sql = "INSERT INTO lietotaju_atbildes (id_lietotajs,id_jautajums,atbilde) 
                VALUES (".$lietotajaID['id_lietotajs'].", ".$jautajums.", '".$atbildes."' )";
                $conn->query($sql);
            }
        }
        session_destroy();
    }

    $behavior=0;$circulation=0;$digest=0;$immune=0;$skin=0;
    $Omega3=0;$VitaminB12=0;$CoQ10=0;$Bacopa_brahmi=0;$Probiotics=0;$Triphala=0;$Chitosan=0;
    $Iron=0;$Magnesium=0;$Borage_oil=0;$Bamboo_extract=0;$B_vitamins=0;$Vitamin_C=0;
    //iet cauri visam atbildem
    $atbildes = mysqli_query($conn, "select * from lietotaju_atbildes,lietotajs where lietotajs.id_lietotajs= lietotaju_atbildes.id_lietotajs and email = '".$_GET['email']."'");
    while($a = mysqli_fetch_assoc($atbildes)){
            $sql  = "select * from atbildes where atbilde = '".$a['atbilde']."' ";
            $atbilde = $conn->query($sql) or die($conn->error);
            $atbilde = $atbilde->fetch_assoc();
        if($a['id_jautajums'] == 10){
            $energy = $a['atbilde'];
        }
        ////////////////////////////////////////// ACTIVITY
        if($a['atbilde'] == "0-1 km"){
            $activity = 15;
            $ripukrasa1 = "#fa0735";
        }else if($a['atbilde'] == "1-3 km"){
            $activity = 40;
            $ripukrasa1 = "#fea33b";
        }else if($a['atbilde'] == "3-5 km"){
            $activity = 60;
            $ripukrasa1 = "#f9de3e";
        }else if($a['atbilde'] == "5-8 km"){
            $activity = 80;
            $ripukrasa1 = "#92cd4e";
        }else if($a['atbilde'] == "8 km and more"){
            $activity = 100;
            $ripukrasa1 = "#17b853";
        }
        ////////////////////////////////////////// SLEEP
        //"#17b853";"#92cd4e";"#f9de3e";"#fea33b"; "#fa0735";
        if($a['atbilde'] == "0 - 5h"){
            $sleep = 15;
            $ripukrasa = "#fa0735";
        }else if($a['atbilde'] == "5 - 7,5h"){
            $sleep = 40;
            $ripukrasa = "#f9de3e";
        }else if($a['atbilde'] == "7,5 - 9h"){
            $sleep = 70;
            $ripukrasa = "#92cd4e";
        }else if($a['atbilde'] == "9h and more"){
            $sleep = 100;
            $ripukrasa = "#17b853";
        }
        
        ////////////////////////////////////////// Vitamini
        if($atbilde['id_vitamins'] == 1){
            $Omega3++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 2){
            $VitaminB12++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 3){
            $CoQ10++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 4){
            $Bacopa_brahmi++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 5){
            $Probiotics++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 6){
            $Triphala++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 7){
            $Chitosan++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 8){
            $Iron++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 9){
            $Magnesium++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 10){
            $Borage_oil++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 11){
            $Bamboo_extract++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 12){
            $B_vitamins++;
            atbildesskaits($atbilde['id_jautajums']);
        }else if($atbilde['id_vitamins'] == 13){
            $Vitamin_C++;
            atbildesskaits($atbilde['id_jautajums']);
        }
        
        // otrie vitamini
        if($atbilde['id_extravitam'] == 1){
            $Omega3++;
        }else if($atbilde['id_extravitam'] == 2){
            $VitaminB12++;
        }else if($atbilde['id_extravitam'] == 3){
            $CoQ10++;
        }else if($atbilde['id_extravitam'] == 4){
            $Bacopa_brahmi++;
        }else if($atbilde['id_extravitam'] == 5){
            $Probiotics++;
        }else if($atbilde['id_extravitam'] == 6){
            $Triphala++;
        }else if($atbilde['id_extravitam'] == 7){
            $Chitosan++;
        }else if($atbilde['id_extravitam'] == 8){
            $Iron++;
        }else if($atbilde['id_extravitam'] == 9){
            $Magnesium++;
        }else if($atbilde['id_extravitam'] == 10){
            $Borage_oil++;
        }else if($atbilde['id_extravitam'] == 11){
            $Bamboo_extract++;
        }else if($atbilde['id_extravitam'] == 12){
            $B_vitamins++;
        }else if($atbilde['id_extravitam'] == 13){
            $Vitamin_C++;
        }
        

    }
    
    $behaviorcount = $behavior;
    $behavior = round(((6-$behavior)/6)*100);
    $circulationcount = $circulation;
    $circulation = round(((6-$circulation)/6)*100);
    $digestcount = $digest;
    $digest = round(((9-$digest)/9)*100);
    $immunecount = $immune;
    $immune = round(((6-$immune)/6)*100);
    $skincount = $skin;
    $skin = round(((9-$skin)/9)*100);
    
    $Omega3 = round((($Omega3)/9)*100);
    $VitaminB12 = round((($VitaminB12)/5)*100);
    $CoQ10 = round((($CoQ10)/4)*100);
    $Bacopa_brahmi = round((($Bacopa_brahmi)/2)*100);
    $Probiotics = round((($Probiotics)/4)*100);
    $Triphala = round((($Triphala)/2)*100);
    $Iron = $Iron*80;
    $Magnesium = $Magnesium*80;
    $Borage_oil = round((($Borage_oil)/4)*100);
    $Bamboo_extract = round((($Bamboo_extract)/3)*100);
    $B_vitamins = $B_vitamins*80;
    $Vitamin_C = $Vitamin_C*80;
    
    $energy = round($energy*10);
    
    $generalhealth = round((($behavior+$circulation+$digest+$immune+$skin)/5 + $energy)/2);
    
    $welness = round(($activity+$sleep)/2);
    if($welness<20){
            $ripukrasa2 = "#fa0735";
        }else if($welness<41){
            $ripukrasa2 = "#fea33b";
        }else if($welness<61){
            $ripukrasa2 = "#f9de3e";
        }else if($welness<81){
            $ripukrasa2 = "#92cd4e";
        }else{
            $ripukrasa2 = "#17b853";
        }
    
    $good = 74;
    $average = 49;
    $poor = 24;
    
    
    
    ?>
        <h1 class="virsraksts">Your Health Report</h1>
<div id="resultContent" class="clear">
    <div class="viens">
        <img src="images/overall_score.svg"><h2>Health score</h2><h1 class="resultscore">
        <?php echo $generalhealth ?></h1>
    </div>
    <div class="divi">
        <p>It has survived not only five centuries, but also the leap into
        electronic typesetting, remaining essentially unchanged. It
        was popularised in the 1960s with the release of Letraset
        sheets containing Lorem Ipsum passages, and more recently
        with desktop publishing software like Aldus PageMaker including
        versions of Lorem Ipsum.</p>
        <a>Subscribe monthly health plan!</a>
    </div>
    <div class="tris">
        <div class="procenti"><h2>Sleep</h2>
            <div class="procentamala" style= 
                 <?php 
                if($sleep<50){
                    $lenkis = 90+360*($sleep/100);
                    echo "'background-image:
                    linear-gradient(".$lenkis."deg, transparent 50%, #eceeef 50%),
                    linear-gradient(90deg, #eceeef 50%, transparent 50%);
                    background-color: ".$ripukrasa1.";
                    '";
                }else{
                    $lenkis = -270+360*($sleep/100);
                    echo "'background-image:
                    linear-gradient(90deg, transparent 50%, ".$ripukrasa." 50%),
                    linear-gradient(".$lenkis."deg, ".$ripukrasa." 50%, transparent 50%);
                    background-color: #eceeef;
                    '";
                }
                 ?> >
                <div class="progress">
                    <p class=<?php if($sleep>$good){echo "'good'>"; }else if($sleep>$average){ echo "'average'>";}else{echo "'poor'>"; }   if($sleep>$good){echo "GOOD"; }else if($sleep>$average){ echo "AVERAGE";}else{echo "POOR"; }  ?>
                        <br><span><?php echo $sleep ?>%</span></p>
                </div>
            
            
            
            </div>
        </div>
        <div class="procenti"><h2>Activity</h2>
            <div class="procentamala" style= 
                 <?php 
                if($activity<50){
                    $lenkis = 90+360*($activity/100);
                    echo "'background-image:
                    linear-gradient(".$lenkis."deg, transparent 50%, #eceeef 50%),
                    linear-gradient(90deg, #eceeef 50%, transparent 50%);'
                    background-color: ".$ripukrasa1.";
                    ";
                }else{
                    $lenkis = -270+360*($activity/100);
                    echo "'background-image:
                    linear-gradient(90deg, transparent 50%, ".$ripukrasa1." 50%),
                    linear-gradient(".$lenkis."deg, ".$ripukrasa1." 50%, transparent 50%);
                    background-color: #eceeef;
                    '";
                }
                 ?> >
                <div class="progress">
                    <p class=<?php if($activity>$good){echo "'good'>"; }else if($activity>$average){ echo "'average'>";}else{echo "'poor'>"; }   if($activity>$good){echo "GOOD"; }else if($activity>$average){ echo "AVERAGE";}else{echo "POOR"; }  ?>
                        <br><span><?php echo $activity ?>%</span></p>
                </div>
            
            
            
            </div>
        </div>
        <div class="procenti"><h2>Welness</h2>
            <div class="procentamala" style= 
                 <?php 
                if($welness<50){
                    $lenkis = 90+360*($welness/100);
                    echo "'background-image:
                    linear-gradient(".$lenkis."deg, transparent 50%, #eceeef 50%),
                    linear-gradient(90deg, #eceeef 50%, transparent 50%);'
                    background-color: ".$ripukrasa2."; ";
                }else{
                    $lenkis = -270+360*($welness/100);
                    echo "'background-image:
                    linear-gradient(90deg, transparent 50%, ".$ripukrasa2." 50%),
                    linear-gradient(".$lenkis."deg, ".$ripukrasa2." 50%, transparent 50%);
                    background-color: #eceeef;
                    '";
                }
                 ?>>
                <div class="progress">
                    <p class=<?php if($welness>$good){echo "'good'>"; }else if($welness>$average){ echo "'average'>";}else{echo "'poor'>"; }   if($welness>$good){echo "GOOD"; }else if($welness>$average){ echo "AVERAGE";}else{echo "POOR"; }  ?>
                        <br><span><?php echo $welness ?>%</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="sleeptext">
        <img src="images/sleep_dark.svg"><h2>Sleep</h2><p>Like good diet and exercise, sleep is a critical component to overall health. Though research cannot pinpoint an exact amount of sleep need by people at different ages, however for adults it is suggested to have 7 - 9 hour healthy sleep to feel really and truly rested among any our daily activities. Therefore, schedule Your sleep and make it a priority. <a target="_blank" href="https://sleepfoundation.org/how-sleep-works/how-much-sleep-do-we-really-need/page/0/2" class="recomenedlink">National Sleep Foundation</a></p>
    </div>
    <div class="sleeptext recomend">
        <img src="images/apple_light.svg"><h2>Recomendation</h2><p>
        <?php  
                    if($sleep<$poor){
                        $krasa = "#fa0735";
                        $recomendation = "Short sleep durations up to five hours a day have negative physiological and neurobehavioral consequences. Restful sleep is essential to physical and mental health, having lack of sleep does not allow restorative processes to take place. You should review Your daily schedule and set priorities to have enough sleep which is so much needed for Your body.
                        <a class='recomendlink' target='_blank' href='https://www.livestrong.com/article/115829-effects-sleeping-hours-night/'>Kristen Knutson, University of Chicago, 2017</a>";
                    }else if($sleep<$average){
                        $krasa = "#f9de3e";
                        $recomendation = "Sleep balances your blood sugar levels and helps consolidate new things you’ve learned, but there’s a natural variation of how much sleep humans require. You should try to add an hour or two to Your sleep to let Your body recover in healthy sleep and be productive as much as possible in Your daily activities. ";
                    }else if($sleep<90){
                        $krasa = "#92cd4e";
                        $recomendation = "You have a healthy sleep habit, which helps You to stay alert and active all day through. You can be assured, that You are much more productive and better at everyday decision making than people who don’t take sleep as a serious component of their lives and have a lack or too much of sleeping hours.";
                    }else{
                        $krasa = "#17b853";
                        $recomendation = "The more is not always the better especially when it comes to sleeping habits. Of course, Your schedule of the day directly impacts the health of Your sleep, but if You constantly oversleep, it might be a signal to pay attention to Your body health as it can cause many diseases including depression and higher rate of mortality.
                        <a class='recomendlink' target='_blank' href='https://www.amerisleep.com/blog/oversleeping-the-health-effects/'>Modern Health, 2015</a>";
                    }
    
                    echo $recomendation;
                    ?>
        
        
        </p>
    </div>
    <?php   
    $user = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
if (preg_match('~MSIE|Internet Explorer~i', $user) || (strpos($user, 'Trident/7.0') == true && strpos($user, 'rv:11.0') == true)) {
$margin = "1.5"; $margin1 = "60%"; $margin2 = "150%"; }else{ $margin = "0"; $margin1 = "40%"; $margin2 = "130%"; }  
      
    if($sleep>$average){
        $class = "mainigaatstarpe0";
    }else if($sleep>$poor){
        $class = "mainigaatstarpe1";
    }else{
        $class = "mainigaatstarpe2";
    }
  ?>


    <div class="lietotajastundas"><div class="<?php echo $class; ?>" style=
         <?php 
    if($sleep>$average){echo "'padding-top:4.2vw;margin-top: ".$margin."; background-color:#34bc52;' "; }else if($sleep>$poor){echo "' padding-top:1vw; margin-top:".$margin1.";background-color:#c9d94d;' "; }else{echo "'height:55%;margin-top: ".$margin2."; background-color:#f90336; '"; }  ?> >
        <h2 style= <?php if($sleep<$poor){echo "'margin-top:0.5rem;'"; }?> > <?php 
            if($sleep>$good){echo "9 and more"; }else if($sleep>$average){ echo "7,5 - 9h";}else if($sleep>$poor){ echo "5 - 7,5h";}else{echo "0 - 5h"; }
            ?>
            <br>HOURS</h2><br></div><img src="images/sleep_light.svg"><p>Your<br>HOURS</p></div>
<div class="recomendedstundas"><div><h2>7.5 - 9<br>HOURS</h2><br></div><img src="images/sleep_light.svg"><p>Recommended<br> HOURS</p></div>


<?php

    $recomendationtext = "";
    switch($circulationcount){
        case 1: $recomendationtext = "Your heart health is good. Continue to implement healthy lifestyle by enriching Your diet with super fruits as citrus fruits, goji berries, watermelon and others to receive nutrients and vitamins that are needed to withstand daily load. Supplement everyday with exercises and have a healthy 7-9 restorative sleeping hours."; break;
            
        case 2: $recomendationtext = "Your heart health is normal, but it still can be improved by diversifying and enriching the diet with super fruits as orange, goji berries, watermelon and others, drink a lot of water and have a healthy dose of exercises to stimulate better circulation. It is also suggested that dark chocolate and green tea are very good additions to menu, drink a lot of water."; break;
            
        case 3:  
        case 4: $recomendationtext = "Your heart health is poor, but You can improve it by implementing exercises and, more importantly, balance Your diet, reduce sugary and fast food, complement with fresh vegetables and super fruits to give Your body necessary nutrients and vitamins to withstand the daily load."; break;
            
        case 5:
        case 6: $recomendationtext = "Having uncomfortable symptoms may signal an underlying condition which can lead to serious complications. Maybe Your workload is too high which causes too much stress to feel great. You can add to Your menu super fruits such as citrus fruits, goji berries, watermelon and others, and have some healthy dose of exercises and 7-9 hour restorative sleep as well."; break;
            
    }
        $veids = $circulation;
        $attels="blood_circulation";
        $h2="Circulation";
        $p = "Your circulation health is:";
        echo "<div class='k'>";
        pievienothealth($veids,$attels,$h2,$p,$recomendationtext);
        echo "</div>";
    
    switch($digestcount){
        case 1: $recomendationtext = "Thoughtful menu and active lifestyle is a result of good health. Continue to lead a healthy lifestyle by exercising everyday at least 10 - 30 minutes and remember that a good 7 - 9 hour sleep is no less important to restore Your strength to be productive and happy."; break;
            
        case 2: $recomendationtext = "You have a normal health, but few of symptoms can mean to think about Your eating habits. Water is essential, also include food that contains fiber and vitamins, to feed Your body and brain, so it could function properly and be good at everyday decision making. Maybe You should reduce sugary or spicy and fast food."; break;
            
        case 3:  
        case 4: $recomendationtext = "As these symptoms are directly related to Your eating habits and stress level during the day, soft and bland foods are recommended, including bananas, plain rice, toast, boiled potatoes, yogurt and others. Doing exercise and having healthy 7-9 hours of sleep is no less important. Get sunshine, it delivers to Your body D vitamins."; break;
            
        case 5:
        case 6:
        case 7:
        case 8:
        case 9: $recomendationtext = "These symptoms are related to Your eating habits and high stress level. Reduce sugary products, add citrus fruits to Your menu, avoid of products who cause You to feel sick. Soft and bland foods are also recommended as bananas, plain rice, toast, boiled potatoes, yogurt and others. Doing exercise and having healthy 7-9 hours of sleep is no less important."; break;
            
    }
        $veids = $digest;
        $attels="digestion";
        $h2="Digestion";
        $p = "Your digestion health is:";
        echo "<div class='v'>";
        pievienothealth($veids,$attels,$h2,$p,$recomendationtext);
        echo "</div>";
    
    
    switch($immunecount){
        case 1: $recomendationtext = "You have a good immune system, even if You have one of symptoms, it might be temporary, if You have a healthy lifestyle in Your everyday life. Certainly eat products, which are rich in B and magnesium vitamins and balance it with exercises to stimulate a good metabolism. Massage is also very good to stimulate muscles and keep them in tone."; break;
            
        case 2: $recomendationtext = "Your immunity is within norms, but to prevent these symptoms, Your body needs vitamins B and magnesium, which are significant to help fight any diseases and be strong. Include fresh fruits and vegetables, whole grains, leafy greens in Your menu, also cacao is very rich of magnesium. Exercise and have a quality sleep. Massage can help to improve blood circulation and prevent numbness."; break;
            
        case 3:  
        case 4: $recomendationtext = "Your immune system is poor, in other words, Your body needs vitamins such as B and magnesium, which You can find in fresh fruits and vegetables, banana, whole grains, leafy greens, also cacao is rich with magnesium. Balance Your diet with exercises and quality sleep. Massage helps with numbness, improves blood circulation, reduces stress level and helps to relax."; break;
            
        case 5:
        case 6: $recomendationtext = "You have a lack of vitamins mainly  doctor."; break;
            
    }
        $veids = $immune;
        $attels="immunity";
        $h2="Immunity";
        $p = "Your immune health is:";
        echo "<div class='l'>";
        pievienothealth($veids,$attels,$h2,$p,$recomendationtext);
        echo "</div>";
    
    switch($skincount){
        case 1: $recomendationtext = "You have a healthy skin which means that Your diet is balanced and You are enough hydrated to have quality skin, however remember that also a healthy skin needs regular treatment with moisturizers and lotions to avoid any of bad symptoms."; break;
            
        case 2: $recomendationtext = "To maintain Your skin hydrated, drink water and balance Your diet with products that are rich in A, C and E vitamins as fruits, sweet potatoes, meats, broccoli, carrots, spinach and others to give Your body nutrients that it needs. Treat Your skin with appropriate moisturizers and lotions, prefer warm or cool shower instead of long hot showers."; break;
            
        case 3:  
        case 4: $recomendationtext = "You have to drink water and balance Your diet by including products rich in A, C and E vitamins as fruits, sweet potatoes, meats, broccoli, carrots, spinach and others to strengthen Your body health. Use appropriate moisturizers and lotions, avoid long hot showers or baths to restore skin hydration."; break;
            
        case 5:
        case 6:
        case 7:
        case 8:
        case 9: $recomendationtext = "Drink up to 8 glasses of water a day, balance Your diet by including products rich in A, C and E vitamins as fruits, sweet potatoes, meats, broccoli, carrots, spinach and others to strengthen hair and nails. Use appropriate moisturizers and lotions to restore skin hydration, avoid lip licking and long excessively hot showers or baths."; break;
            
    }
        $veids = $skin;
        $attels="skin";
        $h2="Skin";
        $p = "Your skin health is:";
        echo "<div class='k'>";
        pievienothealth($veids,$attels,$h2,$p,$recomendationtext);
        echo "</div>";
    
    switch($energy){
        case 1: $recomendationtext = ""; break;
            
        case 2: $recomendationtext = ""; break;
            
        case 3:  
        case 4: $recomendationtext = ""; break;
            
        case 5:
        case 6: $recomendationtext = ""; break;
        default:  $recomendationtext = ""; break;
            
    }
        $veids = $energy;
        $attels="energy";
        $h2="Energy";
        $p = "Your energy health is:";
        echo "<div class='v'>";
        pievienothealth($veids,$attels,$h2,$p,$recomendationtext);
        echo "</div>";
    
    switch($behaviorcount){
        case 1: $recomendationtext = "Your general health is excellent, even if You have one of these symptoms, they might be temporary and disappear, if You continue to develop a healthy lifestyle by balancing Your life spheres as work, sleep and a rich diet of nutrients and vitamins, to stay healthy and alert all day long."; break;
            
        case 2: $recomendationtext = "You have a normal health, but it can be improved by complementing Your menu with fresh vegetables and fruits that are rich in vitamins and nutrients Your body needs. Have 7-9 hours quality sleep - these are very important ingredients of life that impacts how You function daily - how alert and productive at work and other spheres of life You are."; break;
            
        case 3:  
        case 4: $recomendationtext = "Your symptoms might be caused by overworking, not getting enough of sleep and poor diet. Complement Your diet with vegetables and fruits, use products that are rich in vitamins and gives Your body nutrients that it needs to be strong and healthy. These are very important ingredients of Your life, which must be kept in balance to be able function properly."; break;
            
        case 5:
        case 6: $recomendationtext = "Your general health is very low, which probably is caused by high workload, lack of sleep and poor diet. Complement Your menu with vegetables and fruits, eat products that are rich in vitamins and gives Your body the nutrients that it needs. It is also very important to have enough of rest to be able to function properly.
        <a class='recomendlink' target='_blank' href='https://www.peoplespharmacy.com/2017/08/07/is-your-confusion-due-to-a-vitamin-deficiency/'>Kumar, Handbook of Clinical Neurology, 2014</a> "; break;
            
    }
        $veids = $behavior;
        $attels="behavior_brain_function";
        $h2="Behavior";
        $p = "Your behavior is:";
        echo "<div class='l'>";
        pievienothealth($veids,$attels,$h2,$p,$recomendationtext);
        echo "</div>";



    
    

if($activity<20){
    $krasa = "#fa0735";
    $activityrecomendation = "You have critically little activity on a daily basis which can cause chronic diseases such as obesity, depression, anxiety and many others. You should start taking at least 10 minute brisk walk exercise to improve Your physical fitness and reduce the chance of illness.
    <a class='recomenedlink' target='_blank' href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4241367/'>US National Library of Medicine National Institute of Health, 2012</a>";
}else if($activity<40){
    $krasa = "#fea33b";
    $activityrecomendation = "The average person takes around 3 km walk everyday, whereas to reduce risks of illness, based on studies it is suggested to have at least 8 km long walk per day. But don’t worry, You can gain Your physical form by doing 10 minute brisk walk every day and boost Your health.";
}else if($activity<60){
    $krasa = "#f9de3e";
    $activityrecomendation = "You are doing good and You can do even better. To help Yourself achieve better results it is suggested to set an aim, for example, get involved in the 10 000 step challenge which can be compared to 8 km. There are many Mobile Apps and pedometers which can be handy to help You keep up with Your progress.";
}else if($activity<80){
    $krasa = "#92cd4e";
    $activityrecomendation = "You are in a very good physical form! The average person daily walks around 3 km, although it is suggested to walk around 8 km a day to maintain a good health. But let this not stop You to gain a better physical form and health.";
}else{
    $krasa = "#17b853";
    $activityrecomendation = "You have an excellent physical form which positively influences Your health and helps to prevent any chronic diseases. Continue to develop healthy lifestyle to stay active and feel great! ";
}
    
?>
<div class="aktivitate">
        <h1>Your Activity</h1>
        <div class="aktivitatestur">
            <div class="procentamala">
                <div class="progress">
                    <div class="centrs" style="background-color:<?php echo $krasa; ?>">
                        <label><?php echo $activity  ?></label>
                    </div>
                </div>
            <div class="raditajs" style="
            <?php  
                    $lenkis = -90 + ($activity/100) * 180;
                    echo "transform:rotate(".$lenkis."deg); ";
             ?>
             "></div>
                <div class="cutoff"></div>
            </div>
            <h2>Your’s</h2><p><?php echo $activityrecomendation  ?></p>

        </div>
        <span></span>
        <div class="aktivitatestur">
            <div class="procentamala">
                <div class="progress">
                    <div class="centrs">
                        <label>86</label>
                    </div>
                </div>
            <div class="raditajs "></div>
                <div class="cutoff"></div>
            </div>
            <h2>Recommended</h2><p>Experts claim that taking a ten minute brisk stroll every day would cut chance of early death by 15 per cent. Whereas to stay healthy a person should exercise for at least 30 minutes or have 150 minute physical activities which can be compared to 5 mile long walk (8 km).</p>

        </div>
    </div>


<div class="tris">
    <h2>Food Supplement Recommendation</h2><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum.</p>
    <div id="kartotajs">
    <?php
    $vitamins = $Omega3;
    $h2 = "Vitamin D";
    pievienotprogressbar($vitamins,$h2);

    $vitamins = $VitaminB12;
    $h2 = "VitaminB12";
    pievienotprogressbar($vitamins,$h2);

    $vitamins = $CoQ10;
    $h2 = "CoQ10";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Bacopa_brahmi;
    $h2 = "Bacopa brahmi";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Probiotics;
    $h2 = "Probiotics";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Triphala;
    $h2 = "Triphala";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Chitosan;
    $h2 = "Chitosan";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Iron;
    $h2 = "Iron";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Magnesium;
    $h2 = "Magnesium";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Borage_oil;
    $h2 = "Borage oil";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Bamboo_extract;
    $h2 = "Bamboo extract";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $B_vitamins;
    $h2 = "B vitamins";
    pievienotprogressbar($vitamins,$h2);
    
    $vitamins = $Vitamin_C;
    $h2 = "Vitamin C";
    pievienotprogressbar($vitamins,$h2);
        ?>
    </div>
        
    </div>
    <div class="tris">
        <h2>Shop on Amazon</h2>
    </div>
    
    
    
    </div>
    <div class="subscribe">
        <h1>Subscribe monthly health plan!</h1><h2>Get advanced personalized monthly health plan! <a>Learn more</a></h2><h2 class="cena">$8.98 a month</h2><button class="submit" onclick="uzauksu()">SUBSCRIBE NOW</button>
    </div>


    
    <?php
    }else{
    ?>
    
        <h1 class="virsraksts">Something wen't wrong, check your link and try again</h1>
    
    <?php
}
    ?>
       
</body>
</html>











