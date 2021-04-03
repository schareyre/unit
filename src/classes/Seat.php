<?php
namespace src\classes;
class Seat {
	
	public $number;
	public $letter;
	
	public function __construct($number, $letter) {
		
		$this->number = $number;
		$this->letter = $letter;
		
	}
	
}
?>