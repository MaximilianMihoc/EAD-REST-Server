<?php
class ValidateUser extends UnitTestCase 
{
	private $validation;
	public function setUp () 
	{
		$this->validation = new Validation();
 	}

	public function testIsUserValid()
	{
		//Valid tests 
		$arr = array ( "name" => "Adam","surname" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertTrue($this->validation->isUserValid($arr));
		
		//Invalid tests
		$arr = array ( "name" => "","surname" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		$arr = array ( "name" => "Adam","surname" => "","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		$arr = array ( "name" => "Adam","surname" => "Miedodsn","email" => "","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		$arr = array ( "name" => "Adam","surname" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "" );
		$this->assertFalse($this->validation->isUserValid($arr));
		
		$arr = array ( "names" => "Adam","surname" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		$arr = array ( "name" => "Adam","surnames" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		$arr = array ( "name" => "Adam","surname" => "Miedodsn","emails" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		$arr = array ( "name" => "Adam","surname" => "Miedodsn","email" => "adamdo@jaja.clo","passwords" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		
		$arr = array ( "name" => "AdamAdamAdamAdamAdamAdamAdam","surname" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		
		$arr = array ( "name" => "Adam","surname" => "MiedodsnMiedodsnMiedodsnaa","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
		
		$arr = array ( "" );
		$this->assertFalse($this->validation->isUserValid($arr));
		
		$arr = '{ "name":"Adam", "surname":"Miedodsn", "email":"adamdo@jaja.clo", "password":"123456" }';
		$this->assertFalse($this->validation->isUserValid($arr));
		
	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>