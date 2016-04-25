<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/AuthorsDAO.php";
require_once "Validation.php";
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
	/**
	 *
	 * @param array $AuthorRepresentation:
	 *        	an associative array containing the detail of the new Author
	 */
	public function createNewAuthor($newAuthor) {
		// validation of the values of the new Author
		// compulsory values
		if (! empty ( $newAuthor ["name"] ) && ! empty ( $newAuthor ["surname"] ) 
			&& ! empty ( $newAuthor ["email"] ) && ! empty ( $newAuthor ["phone"] )) {
			/*
			 * the model knows the representation of a Author in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
			
			if (($this->validationSuite->isLengthStringValid ( $newAuthor ["name"], TABLE_AUTHOR_NAME_LENGTH )) 
				&& ($this->validationSuite->isLengthStringValid ( $newAuthor ["surname"], TABLE_AUTHOR_SURNAME_LENGTH )) 
				&& ($this->validationSuite->isLengthStringValid ( $newAuthor ["email"], TABLE_AUTHOR_EMAIL_LENGTH )) 
				&& ($this->validationSuite->isLengthStringValid ( $newAuthor ["phone"], TABLE_AUTHOR_PHONE_LENGTH ))) {
					return $this->AuthorsDAO->insert ( $newAuthor );
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}
	public function updateAuthor($authorID, $authorNewRepresentation) {
		if (is_numeric ( $authorID ))
			if (! empty ( $authorNewRepresentation ["name"] ) && ! empty ( $authorNewRepresentation ["surname"] ) 
				&& ! empty ( $authorNewRepresentation ["email"] ) && ! empty ( $authorNewRepresentation ["phone"] )) {
				
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
		if (is_numeric ( $authorID ))
			return ($this->AuthorsDAO->deleteAuthor($authorID));
		
		return false;
		
	}
	public function __destruct() {
		$this->AuthorsDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>