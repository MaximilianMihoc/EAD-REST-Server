<?php
class BookController {
	private $slimApp;
	private $model;
	private $requestBody;
	public function __construct($model, $action = null, $slimApp, $parameteres = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode ( $this->slimApp->request->getBody (), true ); 
		
		if (! empty ( $parameteres ["id"] ))
			$id = $parameteres ["id"];
		else 
			$id = null;
		
		switch ($action) {
			case ACTION_GET_BOOK :
				$this->getBooks ( $id );
				break;
			case ACTION_GET_BOOKS :
				$this->getBooks ();
				break;
			case ACTION_UPDATE_BOOK :
				$this->updateBook ( $id, $this->requestBody );
				break;
			case ACTION_CREATE_BOOK :
				$this->createNewBook ( $this->requestBody );
				break;
			case ACTION_DELETE_BOOK :
				$this->deleteBook ( $id );
				break;
			case ACTION_SEARCH_BOOKS :
				$string = $parameteres ["SearchingString"];
				$this->searchBooks ( $string );
				break;
			case null :
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_CLIENT_ERROR);
				break;
		}
	}
	
	private function getBooks($bookID = null) {
		if($bookID == null) {
			$answer = $this->model->getBooks ();
		} else {
			$answer = $this->model->getBooks ( $bookID );
		}
			
		if ($answer != null) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, $answer);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOCONTENT, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function createNewBook($newBook) {
		if ($newID = $this->model->createNewBook ( $newBook )) {
			$this->setApiResponseAndStatus(HTTPSTATUS_CREATED, GENERAL_RESOURCE_CREATED, $newID);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDBODY);
		}
	}
	private function deleteBook($bookId) {
		if ($deletedID = $this->model->deleteBook ( $bookId )) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, GENERAL_RESOURCE_DELETED);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOTFOUND, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function updateBook($bookId, $toUpdateBook) {
		if ($updatedRows = $this->model->updateBook ( $bookId, $toUpdateBook )) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, GENERAL_RESOURCE_UPDATED, $bookId);
		} else {
			if($bookId == null)
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDINDEX);
			else
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDBODY);
		}
	}
	
	private function searchBooks($string) {
		$answer = $this->model->searchBooks($string);
		if ($answer != null) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, $answer);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOCONTENT, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function setApiResponseAndStatus($status, $response, $id = null)
	{
		$this->slimApp->response ()->setStatus ( $status );
		if (!is_array($response) && !is_bool($response)) 
		{
			if ($id == null) {
				$Message = array ( GENERAL_MESSAGE_LABEL => $response );
			} else {
				$Message = array ( 
					GENERAL_MESSAGE_LABEL => $response,
					"id" => $id
				);
			}
			
			$this->model->apiResponse = $Message;
		} else {
			$this->model->apiResponse = $response;
		}
	}
}
?>