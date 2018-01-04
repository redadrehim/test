<?php
require_once('Trip_Sorter.php');
$airportRoot=new AirportRoot('Barcelona', 'Gerona Airport');    
$flightRoot1=new FlightRoot('Stockholm', 'New York JFK', '7B', 'SK22', '22');
$trainRoot=new TrainRoot('Madrid', 'Barcelona', '45B', '78A');
$flightRoot2=new FlightRoot('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344');
$roots=array($airportRoot,$flightRoot1,$trainRoot,$flightRoot2);
$testTripRoot = new TripRoot($roots);
$testTripSorter=$testTripRoot->getSortedRoots();
?>
<h2>Your trip roots and nodes will be the below</h2>
<ol>
<?php for ($i = 0; $i < count($testTripSorter); $i++) {?>
	<li><?=$testTripSorter[$i]?></li>
 <?php } ?>
 <li>You have arrived at your final destination.</li>
</ol>


