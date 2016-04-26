<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/UsersDAO.php";
require_once "/../TDD/Validation/Validation.php";
class UserModel {
	private $UsersDAO; // list of DAOs used by this model
	private $dbmanager; // dbmanager
	public $apiResponse; // api response
	private $validationSuite; // contains functions for validating inputs
	public function __construct() {
		$this->dbmanager = new pdoDbManager ();
		$this->UsersDAO = new UsersDAO ( $this->dbmanager );
		$this->dbmanager->openConnection ();
		$this->validationSuite = new Validation ();
	}
	public function getUserByEmail ( $email ) {
		//validate username and password
		if($this->validationSuite->isValidEmail($email)) {
			return ($this->UsersDAO->getUserByEmail ( $email ));
		}
		return (false);
	}

	public function getUsers ($userID = null) {
		if($userID == null) {
			return ($this->UsersDAO->get ());
		} else if (is_numeric ( $userID )) {
			return ($this->UsersDAO->get ( $userID ));
		}
		return false;
	}
	/**
	 *
	 * @param array $UserRepresentation:
	 *        	an associative array containing the detail of the new user
	 */
	public function createNewUser($newUser) {
		// validation of the values of the new user
		// compulsory values
		if (! empty ( $newUser ["name"] ) && ! empty ( $newUser ["surname"] ) && ! empty ( $newUser ["email"] ) && ! empty ( $newUser ["password"] )) {
			/*
			 * the model knows the representation of a user in the database and this is: name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
			 */
			
			if (($this->validationSuite->isLengthStringValid ( $newUser ["name"], TABLE_USER_NAME_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newUser ["surname"], TABLE_USER_SURNAME_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newUser ["email"], TABLE_USER_EMAIL_LENGTH )) && ($this->validationSuite->isLengthStringValid ( $newUser ["password"], TABLE_USER_PASSWORD_LENGTH ))) 
			{
					return $this->UsersDAO->insert ( $newUser );
			}
		}
		
		// if validation fails or insertion fails
		return (false);
	}
	public function updateUser($userID, $userNewRepresentation) {
		if (is_numeric ( $userID ))
			if (! empty ( $userNewRepresentation ["name"] ) && ! empty ( $userNewRepresentation ["surname"] ) && ! empty ( $userNewRepresentation ["email"] ) && ! empty ( $userNewRepresentation ["password"] )) {
				
				if($updateRows = $this->UsersDAO->updateUser($userID, $userNewRepresentation))
				{
					return ($updateRows);
				}
			}
		return false;
	}
	
	public function searchUsers($string) {
		return ($this->UsersDAO->searchUsers($string));
	}
	public function deleteUser($userID) {
		if (is_numeric ( $userID ))
			return ($this->UsersDAO->deleteUser($userID));
		
		return false;
		
	}
	public function __destruct() {
		$this->UsersDAO = null;
		$this->dbmanager->closeConnection ();
	}
}
?>