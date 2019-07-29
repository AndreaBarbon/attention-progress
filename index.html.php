<html>
 <meta http-equiv="refresh" content="4"; URL="http://34.77.9.197/index.html.php">


<style>
body {
  background-color: white;
  padding:10%;
  padding-top:150px;
  margin:0px;
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
}
.progress-bar {
  border: solid 1px black;
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

</style>

<body>

<div>
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

if     ($a==0    ) { $color="black";}
elseif ($perc<100) { $color="blue"; }
else               { $color="green"; $completed+=1;}

echo "<div id='".$stock."' class='progress-bar'><div style='width:".$perc."%;' class='progress-".$color."'><div class='perc'>".$stock.": ".$perc."% (".$a."/".$b.")"."</div></div></div>";
echo "</br>";
}
?>
</div>

<h1><?php echo $completed."/".$total." (".$completed_events."/".$total_events.")" ?></h1>
<h2><?php echo "About ".round(($total_events-$completed_events)*1.3,0)." minutes left (".round(($total_events-$completed_events)*1.3/60, 1)." hours)" ?></h2>

</body>
</html>




