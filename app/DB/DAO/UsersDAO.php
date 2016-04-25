<?php
/**
 * @author Luca
 * definition of the User DAO (database access object)
 */
class UsersDAO {
	private $dbManager;
	function UsersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	public function getUserByEmail ( $email ){
		$sql = "Select name, password FROM users WHERE users.email = ?";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		
		$this->dbManager->bindValue ( $stmt, 1, $email, $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$row = $this->dbManager->fetchResults ( $stmt );
		
		return ($row);
	}
	public function get($id = null) {
		$sql = "SELECT * ";
		$sql .= "FROM users ";
		if ($id != null)
			$sql .= "WHERE users.id=? ";
		$sql .= "ORDER BY users.name ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $id, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$rows = $this->dbManager->fetchResults ( $stmt );
		
		return ($rows);
	}
	public function insert($parametersArray) {
		// insertion assumes that all the required parameters are defined and set
		$sql = "INSERT INTO users (name, surname, email, password) ";
		$sql .= "VALUES (?,?,?,?) ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $parametersArray ["name"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $parametersArray ["surname"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $parametersArray ["email"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $parametersArray ["password"], $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		return ($this->dbManager->getLastInsertedID ());
	}
	public function updateUser($userID, $parametersArray) {
		//TODO
		$sqlIns = "UPDATE `users` SET `name` = ?, `surname` = ?,  `email` = ?, `password` = ? WHERE `id` = ? ";
		
		//(`name`, `surname`, `email`, `password`)
		
		//execute the query
		$sqlStmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue($sqlStmt, 1, $parametersArray['name'], $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 2, $parametersArray['surname'], $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 3, $parametersArray['email'], $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 4, $parametersArray['password'], $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 5, $userID, $this->dbManager->INT_TYPE);
		$this->dbManager->executeQuery ( $sqlStmt );
		
		return ($this->dbManager->getNumberOfAffectedRows ($sqlStmt));
	}
	public function deleteUser($userID) {
		//TODO
		$sqlIns = "DELETE FROM `users` WHERE `id` = ? ";
		
		//execute the query
		$sqlStmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue($sqlStmt, 1, $userID, $this->dbManager->INT_TYPE);
		$this->dbManager->executeQuery ( $sqlStmt );
		
		return ($this->dbManager->getNumberOfAffectedRows ($sqlStmt));
	}
	public function searchUsers($searchString) {
		//TODO
		$searchString = '%' . $searchString . '%';
		
		$sqlIns = "Select * FROM `users` WHERE `name` LIKE ? OR `surname` LIKE ? ";
		
		//execute the query
		$sqlStmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue($sqlStmt, 1, $searchString, $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 2, $searchString, $this->dbManager->STRING_TYPE);
		$this->dbManager->executeQuery ( $sqlStmt );
		
		$arrayOfResults = $this->dbManager->fetchResults( $sqlStmt );
		return $arrayOfResults;
	}
}
?>
