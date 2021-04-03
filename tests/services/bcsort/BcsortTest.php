<?php
declare(strict_types=1);
/*
require __DIR__ . "/../src/classes/Travel.php";
require __DIR__ . "/../src/classes/Station.php";
require __DIR__ . "/../src/classes/Bus.php";
require __DIR__ . "/../src/classes/Flight.php";
require __DIR__ . "/../src/classes/Seat.php";
require __DIR__ . "/../src/classes/Train.php";
require __DIR__ . "/../src/services/bcsort/Bcsort.php";
*/
use PHPUnit\Framework\TestCase;
use src\classes\Travel;
use src\classes\Station;
use src\classes\Bus;
use src\classes\Flight;
use src\classes\Seat;
use src\classes\Train;
use src\services\bcsort\Bcsort;

final class BcsortTest extends TestCase {
	
	//private $sort;
	
	public function testSort() : Bcsort {
		
		/*$this->assertSame(3,3);
		$this->assertEquals('3', 3);*/
		
		$tickets = [
			new Travel(new Station('Barcelona'), new Station('Genova Airport'), new Bus()),
			new Travel(new Station('Stockholm'), new Station('New York JFK'), new Flight('SK22', new Seat(7, 'B'), '22', ' Baggage will be automatically transferred from your last leg')),
			new Travel(new Station('Genova Airport'), new Station('Stockholm'), new Flight('SK455', new Seat(3, 'A'), '45B', ' Baggage drop at ticket counter 344')),
			new Travel(new Station('Madrid'), new Station('Barcelona'), new Train('78A', new Seat(45, 'B')))
		];
		
		shuffle($tickets);
		
		$sort = new Bcsort($tickets);
		$sort->sort();
		
		$this->assertEquals([
			new Travel(new Station('Madrid'), new Station('Barcelona'), new Train('78A', new Seat(45, 'B'))),
			new Travel(new Station('Barcelona'), new Station('Genova Airport'), new Bus()),
			new Travel(new Station('Genova Airport'), new Station('Stockholm'), new Flight('SK455', new Seat(3, 'A'), '45B', ' Baggage drop at ticket counter 344')),
			new Travel(new Station('Stockholm'), new Station('New York JFK'), new Flight('SK22', new Seat(7, 'B'), '22', ' Baggage will be automatically transferred from your last leg'))
		], $sort->getsortedTickets());
		
		return $sort;
		
	}
	
	/**
	 * @depends testSort
	 */
	public function testRender(Bcsort $sort) : void {
		$expected = [
			'Take train 78A from Madrid to Barcelona. Sit in seat 45B.',
			'Take the airport bus from Barcelona to Genova Airport. No seat assignment.',
			'From Genova Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.  Baggage drop at ticket counter 344.',
			'From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.  Baggage will be automatically transferred from your last leg.',
			'You have arrived at your final destination.'
		];
		
		/*$tickets = [
			new Travel(new Station('Barcelona'), new Station('Genova Airport'), new Bus()),
			new Travel(new Station('Stockholm'), new Station('New York JFK'), new Flight('SK22', new Seat(7, 'B'), '22', ' Baggage will be automatically transferred from your last leg')),
			new Travel(new Station('Genova Airport'), new Station('Stockholm'), new Flight('SK455', new Seat(3, 'A'), '45B', ' Baggage drop at ticket counter 344')),
			new Travel(new Station('Madrid'), new Station('Barcelona'), new Train('78A', new Seat(45, 'B')))
		];
		
		shuffle($tickets);
		
		$this->sort = new Bcsort($tickets);
		$this->sort->sort();*/
		
		
		$this->assertSame($expected, $sort->render());
		
	}
	
}

?>