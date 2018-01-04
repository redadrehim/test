<?php
/**
	 *This Lib is deveoped  By Reda Mohammed on 4th of JAN 2018
	 *due for this file is to set the logic for Trip with Sorting 
	 *Root Class Used Bstract Class
	 * @param string $departure Departure point
	 * @param string $arrival Arrival Point
	 * @param string $seat Seat Number
*/
class Root
{
	private $departure = '';
	private $arrival = '';
	private $seat = '';

	function __construct($departure, $arrival, $seat)
	{
		$this->departure = $departure;
		$this->arrival = $arrival;
		$this->seat = $seat;
	}

	public function getDeparture($obj)
	{
		return $obj->departure;
	}

	public function getArrival($obj)
	{
		return $obj->arrival;
	}

	public function getSeat($obj)
	{
		return $obj->seat;
	}
}
/**
	 * TrainRoot Class Used for Set Trains Statments Parts
	 * @param string $train Train Name
*/
class TrainRoot extends Root
{
	private $train;
	function __construct($departure, $arrival, $seat, $train)
	{
		parent::__construct($departure, $arrival, $seat);

		$this->train = $train;
	}
/**
	* This method is to convert train Roots to printed statment Parts
*/
	public function printStatment()
	{
		return 'Take train ' . $this->train . ' from ' . Root::getDeparture($this) . ' to ' . Root::getarrival($this) . '. Sit in seat ' . Root::getSeat($this) . '.';
	}
}
/**
	 * AirportRoot Class Used for Set Airports Statments Parts
*/
class AirportRoot extends Root
{
	function __construct($departure, $arrival, $seat = null)
	{
		parent::__construct($departure, $arrival, $seat);
	}
/**
	* This method is to convert Airports Roots to printed statment
*/
	public function printStatment()
	{
		return 'Take the airport bus from ' . Root::getDeparture($this) . ' to ' . Root::getarrival($this) . '. ' . (Root::getSeat($this) ? 'Sit in seat ' . Root::getSeat($this) . '.' : 'No seat assignment.');
	}
}
/**
	 * FlightRoot Class Used for Set Flights Statments Parts
	 * @param string $flight Flight Number
	 * @param string $gate Gate Name or Number
	 * @param string $index Used as Counter
*/
class FlightRoot extends Root
{
	private $flight, $gate, $index;

	function __construct($departure, $arrival, $seat, $flight, $gate, $index = null)
	{
		parent::__construct($departure, $arrival, $seat);
		$this->flight = $flight;
		$this->gate = $gate;
		$this->index = $index;
	}
/**
	* This method is to convert Flights Roots to printed statment
*/	
	public function printStatment()
	{
		return 'From ' . Root::getDeparture($this) . ', take flight ' . $this->flight . ' to ' . Root::getarrival($this) . '. Gate ' . $this->gate . ', seat ' . Root::getSeat($this) . '. ' . ($this->index ? 'Baggage drop at ticket counter ' . $this->index . '.' : 'Baggage will be automatically transferred from your last leg.');
	}
}

/**
 * A TripRoot "class" to collect the whole Basses
 * Used in Calling all Other Classes from Frontend View 
 * @param the Roots Nodes 
 */
class TripRoot
{
	private $arrivalNodes = array();
	private $departureNodes = array();

	public function __construct($Roots)
	{
		$this->Roots = $Roots;
	}
/**
	* This method is to Get The Finnial Sorted Roots Objects
*/		
	public function getSortedRoots()
	{
		$sortedRoots = array();

/**
	* For Loop for Getting Roots
*/
		for ($i = 0; $i < count($this->Roots); $i++) {
			$Root = $this->Roots[$i];
			$this->departureNodes[Root::getDeparture($Root)] = $Root;
			$this->arrivalNodes[Root::getArrival($Root)] = $Root;
			$departure = Root::getDeparture($this->Roots[$i]);
			if (!array_key_exists($departure, $this->arrivalNodes)) {
				$current=$departure;
			}
		}
/**
	* For Loop for Sorting Roots
*/		
		for ($i = 0; $i < count($this->Roots); $i++) {
			if(array_key_exists($current, $this->departureNodes)){
				$currentRoot=$this->departureNodes[$current];
			}
			$sortedRoots[$i]= $currentRoot->printStatment();
			$current = Root::getArrival($currentRoot);
		}
		return $sortedRoots;
	}
}

?>