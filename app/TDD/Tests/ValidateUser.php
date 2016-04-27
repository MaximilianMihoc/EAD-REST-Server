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
		$arr = array ( "id" => "15","name" => "Adam","surname" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertTrue($this->validation->isUserValid($arr));
		
		//Invalid tests
		$arr = array (	"names" => "Adam","surname" => "Miedodsn","email" => "adamdo@jaja.clo","password" => "123456" );
		$this->assertFalse($this->validation->isUserValid($arr));
	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>