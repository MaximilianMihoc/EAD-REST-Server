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
		$arr = array (	"title" => "", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "" );
		$this->assertFalse($this->validation->isBookValid($arr));
		
		$arr = array (	"titles" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorIDs" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBNs" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pagess" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"ratings" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publishers" => "O'Reilly Media, Inc.", "publicationDate" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		$arr = array (	"title" => "Android Cookbook", "authorID" => "1", "ISBN" => "978-1-4493-8841-6", "pages" => "710",
						"rating" => "3.50", "publisher" => "O'Reilly Media, Inc.", "publicationDates" => "2012-04-20" );
		$this->assertFalse($this->validation->isBookValid($arr));
		
		$arr = array (	"" );
		$this->assertFalse($this->validation->isBookValid($arr));
		
		$arr = '{ "titles":"Android Cookbook", "authorID":"1", "ISBN":"978-1-4493-8841-6", "pages":"710",
						"rating":"3.50", "publisher":"O\'Reilly Media, Inc.", "publicationDate":"2012-04-20" }';
		$this->assertFalse($this->validation->isBookValid($arr));
	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>