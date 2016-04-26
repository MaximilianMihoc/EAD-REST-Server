<?php

class ValidateDateFormat extends UnitTestCase 
{
	private $validation;
	public function setUp () 
	{
		$this->validation = new Validation();
 	}

	public function testIsDateFormatValid()
	{
		//Valid tests
		$this->assertTrue($this->validation->isDateFormatValid("2012-04-20"));
		$this->assertTrue($this->validation->isDateFormatValid("2010-07-31"));
		$this->assertTrue($this->validation->isDateFormatValid("2000-01-01"));
		$this->assertTrue($this->validation->isDateFormatValid("2000-12-31"));
		
		// Invalid tests
		$this->assertFalse($this->validation->isDateFormatValid(null));
		$this->assertFalse($this->validation->isDateFormatValid("0000-00-00"));
		$this->assertFalse($this->validation->isDateFormatValid("2012-20-01"));
		$this->assertFalse($this->validation->isDateFormatValid("2012-13-01"));
		$this->assertFalse($this->validation->isDateFormatValid("2012-12-32"));
		$this->assertFalse($this->validation->isDateFormatValid("31-07-2012"));
		$this->assertFalse($this->validation->isDateFormatValid("26 Apr 2016"));
		$this->assertFalse($this->validation->isDateFormatValid("2016-04-26T19:08:09UTC"));
		$this->assertFalse($this->validation->isDateFormatValid("yyyy-MM-dd"));
		$this->assertFalse($this->validation->isDateFormatValid("20132-13-01"));
		$this->assertFalse($this->validation->isDateFormatValid("201-13-01"));
	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>