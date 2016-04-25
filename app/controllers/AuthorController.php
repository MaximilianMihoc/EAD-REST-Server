<?php
class AuthorController {
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
			case ACTION_GET_AUTHOR :
				$this->getAuthors ( $id );
				break;
			case ACTION_GET_AUTHORS :
				$this->getAuthors ();
				break;
			case ACTION_UPDATE_AUTHOR :
				$this->updateAuthor ( $id, $this->requestBody );
				break;
			case ACTION_CREATE_AUTHOR :
				$this->createNewAuthor ( $this->requestBody );
				break;
			case ACTION_DELETE_AUTHOR :
				$this->deleteAuthor ( $id );
				break;
			case ACTION_SEARCH_AUTHORS :
				$string = $parameteres ["SearchingString"];
				$this->searchAuthors ( $string );
				break;
			case null :
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_CLIENT_ERROR);
				break;
		}
	}
	
	private function getAuthors($authorID = null) {
		if($authorID == null) {
			$answer = $this->model->getAuthors ();
		} else {
			$answer = $this->model->getAuthors ( $authorID );
		}
			
		if ($answer != null) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, $answer);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOCONTENT, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function createNewAuthor($newAuthor) {
		if ($newID = $this->model->createNewAuthor ( $newAuthor )) {
			$this->setApiResponseAndStatus(HTTPSTATUS_CREATED, $this->buildMessage(GENERAL_RESOURCE_CREATED, $newID));
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDBODY);
		}
	}
	private function deleteAuthor($authorId) {
		if ($deletedID = $this->model->deleteAuthor ( $authorId )) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, GENERAL_RESOURCE_DELETED);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOTFOUND, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function updateAuthor($authorId, $toUpdateAuthor) {
		if ($updatedRows = $this->model->updateAuthor ( $authorId, $toUpdateAuthor )) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, $this->buildMessage(GENERAL_RESOURCE_UPDATED, $authorId));
		} else {
			if($authorId == null)
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDINDEX);
			else
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDBODY);
		}
	}
	
	private function searchAuthors($string) {
		$answer = $this->model->searchAuthors($string);
		if ($answer != null) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, $answer);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOCONTENT, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function setApiResponseAndStatus($status, $response)
	{
		$this->slimApp->response ()->setStatus ( $status );
		if (!is_array($response) && !is_bool($response)) 
		{
			$Message = array ( GENERAL_MESSAGE_LABEL => $response );
			$this->model->apiResponse = $Message;
		} else {
			$this->model->apiResponse = $response;
		}
	}
	
	// this is used to show the id of the created or updated record along with the message
	private function buildMessage($response, $id)
	{
		$Message = array ( 
			GENERAL_MESSAGE_LABEL => $response,
			"id" => $id
		);
		
		return $Message;
	}
}
?>