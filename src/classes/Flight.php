<?php
namespace src\classes;
class Flight extends Transport {
	
	public $gateId;
	public $baggageDetails;
	
	public function __construct($id = null, Seat $seat, string $gateId, $baggageDetails = null) {
		
		parent::__construct($id, $seat);
		$this->gateId = $gateId;
		$this->baggageDetails = $baggageDetails;
		
	}
	
	
}