<?php

class ValidateAuthor extends UnitTestCase 
{
	private $validation;
	public function setUp () 
	{
		$this->validation = new Validation();
 	}

	public function testIsAuthorValid()
	{
		//Valid tests 
		$arr = array (	"name" => "Adam", "surname" => "Tacy", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertTrue($this->validation->isAuthorValid($arr));
		
		//Invalid tests
		$arr = array (	"names" => "Adam", "surname" => "Tacy", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>