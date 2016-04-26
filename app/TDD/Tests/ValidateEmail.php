<?php
/**
* @author Max
* Test isValidEmail Method
*/
class ValidateEmail extends UnitTestCase 
{
	private $validation;
	public function setUp () 
	{
		$this->validation = new Validation();
 	}

	public function testIsEmailValid()
	{
		// Valid Emails
		$validateEmail = $this->validation->isValidEmail("email@domain.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("firstname.lastname@domain.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@subdomain.domain.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("firstname+lastname@domain.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@[123.123.123.123]");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("\"email\"@domain.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("1234567890@domain.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@domain-one.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("_______@domain.com");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@domain.name");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@domain.co.jp");
		$this->assertTrue($validateEmail);
		$validateEmail = $this->validation->isValidEmail("firstname-lastname@domain.com");
		$this->assertTrue($validateEmail);

		// Invalid Emails
		$validateEmail = $this->validation->isValidEmail("");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail(NULL);
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("plainaddress");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("#@%^%#$@#$@#.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("@domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("Joe Smith <email@domain.com>");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email.domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@domain@domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail(".email@domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email.@domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email..email@domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("あいうえお@domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@domain.com (Joe Smith)");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@domain");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@-domain.com");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@111.222.333.44444");
		$this->assertFalse($validateEmail);
		$validateEmail = $this->validation->isValidEmail("email@domain..com");
		$this->assertFalse($validateEmail);

		$arr = array (
				"" 
		);
		$validateEmail = $this->validation->isValidEmail($arr);
		$this->assertFalse($validateEmail);

		$v = new Validation();
		$validateEmail = $this->validation->isValidEmail($v);
		$this->assertFalse($validateEmail);

	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>