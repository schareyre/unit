<?php
namespace src\classes;
class Travel {
	
	public $from;
	public $to;
	//public $seat;
	public $transport;
	
	public function __construct(Station $from = null, Station $to = null, Transport $transport) {
		
		$this->from = $from;
		$this->to = $to;
		$this->transport = $transport;
		
	}
	
}
?>