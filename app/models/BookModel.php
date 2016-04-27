<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/BooksDAO.php";
require_once "/../TDD/Validation/Validation.php";
class BookModel {
	private $BooksDAO; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->BooksDAO = new BooksDAO ( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	
	public function getBooks ($bookID = null) {
		if($bookID == null){
			return ($this->BooksDAO->get ());
		} else if (is_numeric ( $bookID )) {
			return ($this->BooksDAO->get ( $bookID ));
		}
		return false;
	}
	
	public function getBooksByAuthorId ( $authorID ) {
		if($authorID != null){
			return ($this->BooksDAO->getBooksByAuthorId ( $authorID ));
		} 
		return false;
	}

	public function createNewBook($newBook) {
		// validation of the values of the new Book	
		if ($this->validationSuite->isBookValid($newBook)) {
			return $this->BooksDAO->insert ( $newBook );
		}
		return (false);
	}
	
	public function updateBook($bookID, $bookNewRepresentation) {
		if (is_numeric ( $bookID ))
			if ($this->validationSuite->isBookValid($newBook)) {
				return ($updateRows);
			}
		return false;
	}
	
	// validation needed
	public function searchBooks($string) {
		return ($this->BooksDAO->searchBooks($string));
	}
	
	public function deleteBook($bookID) {
		if (is_numeric ( $bookID ))
			return ($this->BooksDAO->deleteBook($bookID));
		
		return false;
		
	}
	public function __destruct() {
		$this->BooksDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>