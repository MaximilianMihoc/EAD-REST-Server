<?php
/**
 * @author Luca
 * definition of the author DAO (database access object)
 */
class AuthorsDAO {
	private $dbManager;
	function AuthorsDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	public function get($id = null) {
		$sql = "SELECT * ";
		$sql .= "FROM authors ";
		if ($id != null)
			$sql .= "WHERE authors.id=? ";
		$sql .= "ORDER BY authors.name ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $id, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$rows = $this->dbManager->fetchResults ( $stmt );
		
		return ($rows);
	}
	public function insert($parametersArray) {
		// insertion assumes that all the required parameters are defined and set
		$sql = "INSERT INTO authors (name, surname, email, phone) ";
		$sql .= "VALUES (?,?,?,?) ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $parametersArray ["name"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $parametersArray ["surname"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $parametersArray ["email"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $parametersArray ["phone"], $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		return ($this->dbManager->getLastInsertedID ());
	}
	public function updateAuthor($authorID, $parametersArray) {
		//TODO
		$sqlIns = "UPDATE `authors` SET `name` = ?, `surname` = ?,  `email` = ?, `phone` = ? WHERE `id` = ? ";
		
		//(`name`, `surname`, `email`, `password`)
		
		//execute the query
		$sqlStmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue($sqlStmt, 1, $parametersArray['name'], $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 2, $parametersArray['surname'], $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 3, $parametersArray['email'], $this->dbManager->STRING_TYPE);
		$this->dbManager->bindValue($sqlStmt, 4, $parametersArray['phone'], $this->dbManager->INT_TYPE);
		$this->dbManager->bindValue($sqlStmt, 5, $authorID, $this->dbManager->INT_TYPE);
		$this->dbManager->executeQuery ( $sqlStmt );
		
		return ($this->dbManager->getNumberOfAffectedRows ($sqlStmt));
	}
	public function deleteAuthor($authorID) {
		//TODO
		$sqlIns = "DELETE FROM `authors` WHERE `id` = ? ";
		
		//execute the query
		$sqlStmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue($sqlStmt, 1, $authorID, $this->dbManager->INT_TYPE);
		$this->dbManager->executeQuery ( $sqlStmt );
		
		return ($this->dbManager->getNumberOfAffectedRows ($sqlStmt));
	}
	public function searchAuthors($searchString) {
		//TODO
		$searchString = '%' . $searchString . '%';
		
		$sqlIns = "Select * FROM `authors` WHERE `name` LIKE ? OR `surname` LIKE ? ";
		
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
