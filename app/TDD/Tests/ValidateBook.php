<?php

class ValidateBook extends UnitTestCase 
{
	private $validation;
	public function setUp () 
	{
		$this->validation = new Validation();
 	}

	public function testIsBookValid()
	{
		//Valid tests 
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertTrue($this->validation->isBookValid($arr));
		
		//Invalid tests
		$arr = array (	"titles" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>