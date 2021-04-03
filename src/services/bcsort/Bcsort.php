<?php
namespace src\services\bcsort;
use src\classes\Flight;
use src\classes\Bus;


class Bcsort implements Sort {
	
	private $tickets = [];
	private $sortedTickets = [];
	private $originalTickets = [];	// debug purpose

	public function __construct($tickets = null) {
		
		$this->tickets = $tickets;
		$this->originalTickets = $tickets;	// debug purpose
		
	}
	

	/**
	 * 
	 * {@inheritDoc}
	 * loop on tickets
	 * searching the [travel Object]->from->name who hasn't [travel Object]->to->name => it's the one who gets added to the sorted tickets list ;
	 * finding the departure who isn't the destination of another travel
	 * @return void
	 */
	public function sort() : void {
		
		while(count($this->tickets)>0) {
			
			foreach ($this->tickets as $key => $travel) {
				
				$found = false;
				
				foreach($this->tickets as $travel2) {
					//echo 'test '.$travel->from->name.' = '.$travel2->to->name." ? \n";
					if($travel2->to->name == $travel->from->name)	{
						//echo "found, breaking... \n";
						$found = true;
						break;
					}
					
				}
				
				if($found === false){
					//echo $travel->from->name.' not found, => added to $sortedTickets '." \n";
					$this->sortedTickets[] = $this->tickets[$key];
					unset($this->tickets[$key]);
				}
				
			}
			
		}
		
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @return array
	 */
	public function render() : array {
		
		$output = [];
		
		foreach ($this->sortedTickets as $ticket) {
			
			if($ticket->transport instanceof Flight) {
				$output[] = "From {$ticket->from->name}, take flight {$ticket->transport->id} to {$ticket->to->name}. Gate {$ticket->transport->gateId}, ".
				"seat {$ticket->transport->seat->number}{$ticket->transport->seat->letter}. {$ticket->transport->baggageDetails}.";
				continue;
			}
			
			$string = "Take ";
			if($ticket->transport instanceof Bus) {
				$string .= "the {$ticket->transport->type} bus ";
			}
			else $string .= "train {$ticket->transport->id} ";
			
			$string .= "from {$ticket->from->name} to {$ticket->to->name}. ";
			
			if(is_null($ticket->transport->seat))	$string .= "No seat assignment.";
			else									$string .= "Sit in seat {$ticket->transport->seat->number}{$ticket->transport->seat->letter}.";
			
			$output[] = $string;			
		}
		
		$output[] = "You have arrived at your final destination.";
		
		return $output;
	}
	
	public function getsortedTickets():array {
		return $this->sortedTickets;
	}
	
	
}
?>