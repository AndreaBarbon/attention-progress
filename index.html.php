<html>
 

<style>
  body {
    background-color: white;
    padding:10%;
    padding-top:150px;
    margin:0px;
  }

  div {
    font-size: -webkit-xxx-large;
  }

  h1 {
    position: fixed;
    top: 0px;
    padding-top: 15px;
    padding-bottom: 0px;
    background-color: white;
    width: 80%;
    text-align: center;
  }

  h2 {
    position: fixed;
    top: 60px;
    padding-top: 15px;
    padding-bottom: 0px;
    background-color: white;
    width: 80%;
    text-align: center;
  }

  div.perc {
    margin-left:10px;
    position: relative;
    top: 0px;
    min-width: 500px;
  }
  
  div.current{
    position: fixed;
    top: 150px;
    width:80%;
  }

  .progress-bar {
    border: solid 1px white;
    min-height:15px;
    padding:0px;
    background-color: lightgrey;
  }

  .progress-green {
    background-color: limegreen;
  }

  .progress-black {
    min-width:150px;
    background-color: darkgrey;
  }

  .progress-blue {
    min-width:150px;
    background-color: #2196f3;
  }

  div.white-top {
    position:fixed;
    top:0px;
    width:100%;
    background-color: white;
  }

</style>

<body>

<div>

<div class='white-top'></div>
<?php
ini_set('display_errors', 'On');
chdir("attention-HFTs");
$total = 0;
$completed = 0;
$total_events = 0;
$completed_events = 0;

foreach (glob("progress*.txt") as $filename) {
$total += 1;
$stock = substr($filename, strpos($filename, "_") + 1);
$stock = strtok($stock, '.');
$pro   = explode("\n", file_get_contents($filename))[0];
$a     = (float) strtok($pro, '/');
$b     = (float) substr($pro, strpos($pro, "/") + 1);
$perc  = round($a / $b * 100, 1);

$completed_events += $a;
$total_events += $b;

if     ($a==0    ) { 
  $color="black";
  echo "<div id='".$stock."' class='progress-bar'><div style='width:".$perc."%;' class='progress-".$color."'><div class='perc'>".$stock."</div></div></div>";
}

elseif ($perc<100) { 
  $color="blue"; 
  echo "<div id='".$stock."' class='current progress-bar'><div style='width:".$perc."%;' class='progress-".$color."'><div class='perc'>".$stock.": ".$perc."% (".$a."/".$b.")"."</div></div></div>";
}
else               { 
  $color="green"; $completed+=1;
  echo "<div id='".$stock."' class='progress-bar'><div style='width:".$perc."%;' class='progress-".$color."'><div class='perc'>".$stock.": ".$perc."% (".$a."/".$b.")"."</div></div></div>";
}


}
?>
</div>

<h1><?php echo $completed."/".$total." (".$completed_events."/".$total_events.")" ?></h1>
<h2><?php echo "About ".round(($total_events-$completed_events)*1.3,0)." minutes left (".round(($total_events-$completed_events)*1.3/60, 1)." hours)" ?></h2>

</body>
</html>




