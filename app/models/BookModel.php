<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/BooksDAO.php";
require_once "Validation.php";
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
	/**
	 *
	 * @param array $BookRepresentation:
	 *        	an associative array containing the detail of the new Book
	 */
	public function createNewBook($newBook) {
		// validation of the values of the new Book
		// compulsory values		
		if (!empty ( $newBook ["title"] ) && !empty ( $newBook ["authorID"] ) 
			&& !empty ( $newBook ["ISBN"] ) && !empty ( $newBook ["pages"] )
			&& !empty ( $newBook ["rating"] ) && !empty ( $newBook ["publisher"] )
			&& !empty ( $newBook ["publicationDate"] )) {
				
			// check if author exists in DB
			// also check publication date format - maybe add tests in validationSuite
			if (($this->validationSuite->isLengthStringValid ( $newBook ["title"], TABLE_BOOK_TITLE_LENGTH )) 
				&& ($this->validationSuite->isLengthStringValid ( $newBook ["ISBN"], TABLE_BOOK_ISBN_LENGTH ))
				&& ($this->validationSuite->isLengthStringValid ( $newBook ["publisher"], TABLE_BOOK_PUBLISHER_LENGTH ))) {
					return $this->BooksDAO->insert ( $newBook );
			}
		}
		// if validation fails or insertion fails
		return (false);
	}
	public function updateBook($bookID, $bookNewRepresentation) {
		
		if (is_numeric ( $bookID ))
			if (!empty ( $bookNewRepresentation ["title"] ) && !empty ( $bookNewRepresentation ["authorID"] ) 
				&& !empty ( $bookNewRepresentation ["ISBN"] ) && !empty ( $bookNewRepresentation ["pages"] )
				&& !empty ( $bookNewRepresentation ["rating"] ) && !empty ( $bookNewRepresentation ["publisher"] )
				&& !empty ( $bookNewRepresentation ["publicationDate"] ))  {
				
					
				if($updateRows = $this->BooksDAO->updateBook($bookID, $bookNewRepresentation))
				{
					return ($updateRows);
				}
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