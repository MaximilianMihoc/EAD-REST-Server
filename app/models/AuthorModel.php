<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/AuthorsDAO.php";
require_once "/../TDD/Validation/Validation.php";
class AuthorModel {
	private $AuthorsDAO; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->AuthorsDAO = new AuthorsDAO ( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	
	public function getAuthors ($authorID = null) {
		if($authorID == null){
			return ($this->AuthorsDAO->get ());
		} else if (is_numeric ( $authorID )) {
			return ($this->AuthorsDAO->get ( $authorID ));
		}
		return false;
	}
	
	public function getAuthorsByBookId ($bookID) {
		if($bookID != null && is_numeric ( $bookID )) {
			return ($this->AuthorsDAO->getAuthorsByBookId ( $bookID ));
		}
		return false;
	}
	
	/**
	 *
	 * @param array $AuthorRepresentation:
	 *        an associative array containing the detail of the new Author
	 */
	public function createNewAuthor($newAuthor) {
		// validation of the values of the new Author
		if ($this->validationSuite->isAuthorValid($newAuthor)) {
				return $this->AuthorsDAO->insert ( $newAuthor );
		}
		
		return (false);
	}
	public function updateAuthor($authorID, $authorNewRepresentation) {
		if ( is_numeric ( $authorID ))
			if ($this->validationSuite->isAuthorValid($authorNewRepresentation)) {
				if($updateRows = $this->AuthorsDAO->updateAuthor($authorID, $authorNewRepresentation))
				{
					return ($updateRows);
				}
			}
		return false;
	}
	// validation needed
	public function searchAuthors($string) {
		return ($this->AuthorsDAO->searchAuthors($string));
	}
	
	public function deleteAuthor($authorID) {
		if ( is_numeric ( $authorID ))
			return ($this->AuthorsDAO->deleteAuthor($authorID));
		return false;
		
	}
	public function __destruct() {
		$this->AuthorsDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>