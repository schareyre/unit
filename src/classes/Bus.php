<?php
namespace src\classes;

class Bus extends Transport {
	
	public $type = 'airport';
	
	public function __construct(Seat $seat = null, $type = null) {
		
		parent::__construct($seat);
		if($type !== null)	$this->type = $type;
		
	}
	
}
?>