<?php
declare(strict_types=1);
require __DIR__ . "/../src/Email.php";


use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase {
	
	public function testCanBeCreatedFromValidEmailaddress():void {
		
		$this->assertInstanceOf(Email::class, Email::fromString('user@exemple.com'));
		
	}
	
	public function testNotCanBeCreatedFromValidEmailaddress():void {
		
		$this->expectException(InvalidArgumentException::class);
		Email::fromString('invalid');
		
	}
	
	public function testCanBeUsedAsString():void {
		
		$this->assertEquals('user@exemple.com', Email::fromString('user@exemple.com'));
		
	}
	
}
?>