<?php
namespace src\classes;

abstract class Transport {
	
	//public $type;
	//public $name;
	public $id;
	public $seat;
	
	//public $baggage;
	
	public function __construct($id = null, Seat $seat = null) {
		
		$this->id = $id;
		$this->seat = $seat;
		
	}
	
}
?>