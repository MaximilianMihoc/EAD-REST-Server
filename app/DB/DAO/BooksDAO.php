<?php
/**
 * @author Admins team
 * definition of the book DAO (database access object)
 */
class BooksDAO {
	private $dbManager;
	function BooksDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	public function get($id = null) {
		$sql = "SELECT * ";
		$sql .= "FROM books ";
		if ($id != null)
			$sql .= "WHERE books.id=? ";
		$sql .= "GROUP BY books.ISBN ";
		$sql .= "ORDER BY books.title ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $id, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$rows = $this->dbManager->fetchResults ( $stmt );
		
		return ($rows);
	}
	public function insert($parametersArray) {
		// insertion assumes that all the required parameters are defined and set
		$sql = "INSERT INTO books ( title, authorID, ISBN, pages, rating, publisher, publicationDate) ";
		$sql .= "VALUES (?,?,?,?,?,?,?) ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $parametersArray ["title"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $parametersArray ["authorID"], $this->dbManager->INT_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $parametersArray ["ISBN"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $parametersArray ["pages"], $this->dbManager->INT_TYPE );
		$this->dbManager->bindValue ( $stmt, 5, $parametersArray ["rating"], $this->dbManager->INT_TYPE );
		$this->dbManager->bindValue ( $stmt, 6, $parametersArray ["publisher"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 7, $parametersArray ["publicationDate"], $this->dbManager->STRING_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		
		return ($this->dbManager->getLastInsertedID ());
	}
	public function updateBook($bookID, $parametersArray) {
		$sqlIns = "UPDATE `books` SET `title`=?,`authorID`=?,`ISBN`=?,`pages`=?,`rating`=?,`publisher`=?,`publicationDate`=? WHERE `id` = ?";
		
		//execute the query
		$stmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue ( $stmt, 1, $parametersArray ["title"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 2, $parametersArray ["authorID"], $this->dbManager->INT_TYPE );
		$this->dbManager->bindValue ( $stmt, 3, $parametersArray ["ISBN"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 4, $parametersArray ["pages"], $this->dbManager->INT_TYPE );
		$this->dbManager->bindValue ( $stmt, 5, $parametersArray ["rating"], $this->dbManager->INT_TYPE );
		$this->dbManager->bindValue ( $stmt, 6, $parametersArray ["publisher"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue ( $stmt, 7, $parametersArray ["publicationDate"], $this->dbManager->STRING_TYPE );
		$this->dbManager->bindValue($stmt, 8, $bookID, $this->dbManager->INT_TYPE);
		$this->dbManager->executeQuery ( $stmt );
		
		return ($this->dbManager->getNumberOfAffectedRows ($stmt));
	}
	public function deleteBook($bookID) {
		$sqlIns = "DELETE FROM `books` WHERE `id` = ? ";
		
		//execute the query
		$sqlStmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue($sqlStmt, 1, $bookID, $this->dbManager->INT_TYPE);
		$this->dbManager->executeQuery ( $sqlStmt );
		
		return ($this->dbManager->getNumberOfAffectedRows ($sqlStmt));
	}
	public function searchBooks($searchString) {
		$searchString = '%' . $searchString . '%';
		
		$sqlIns = "Select * FROM `books` WHERE `title` LIKE ? ";
		
		//execute the query
		$sqlStmt = $this->dbManager->prepareQuery($sqlIns);
		$this->dbManager->bindValue($sqlStmt, 1, $searchString, $this->dbManager->STRING_TYPE);
		$this->dbManager->executeQuery ( $sqlStmt );
		
		$arrayOfResults = $this->dbManager->fetchResults( $sqlStmt );
		return $arrayOfResults;
	}
	
	public function getBooksByAuthorId ( $authorID ) {
		$sql = "SELECT * ";
		$sql .= "FROM books ";
		$sql .= "WHERE books.authorID=? ";
		$sql .= "ORDER BY books.title ";
		
		$stmt = $this->dbManager->prepareQuery ( $sql );
		$this->dbManager->bindValue ( $stmt, 1, $authorID, $this->dbManager->INT_TYPE );
		$this->dbManager->executeQuery ( $stmt );
		$rows = $this->dbManager->fetchResults ( $stmt );
		
		return ($rows);
	}
}
?>
