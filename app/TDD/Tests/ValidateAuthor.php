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
		$arr = array (	"name" => "", "surname" => "Tacy", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		$arr = array (	"name" => "Adam", "surname" => "", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		$arr = array (	"name" => "Adam", "surname" => "Tacy", "email" => "", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		$arr = array (	"name" => "Adam", "surname" => "Tacy", "email" => "adamt@manning.com", "phone" => "" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		
		$arr = array (	"names" => "Adam", "surname" => "Tacy", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		$arr = array (	"name" => "Adam", "surnames" => "Tacy", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		$arr = array (	"name" => "Adam", "surname" => "Tacy", "emails" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		$arr = array (	"name" => "Adam", "surname" => "Tacy", "email" => "adamt@manning.com", "phones" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		
		
		$arr = array (	"name" => "AdamAdamAdamAdamAdamAdamAdam", "surname" => "Tacy", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		$arr = array (	"name" => "Adam", "surname" => "TacyTacyTacyTacyTacyTacyTacy", "email" => "adamt@manning.com", "phone" => "0862347143" );
		$this->assertFalse($this->validation->isAuthorValid($arr));
		
		$arr = array ("");
		$this->assertFalse($this->validation->isAuthorValid($arr));
		
		$arr = '{"name":"Adam", "surname":"Tacy", "email":"adamt@manning.com", "phone":"0862347143"}';
		$this->assertFalse($this->validation->isAuthorValid($arr));
	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>