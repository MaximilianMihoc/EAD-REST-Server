<?php
require_once "/../TDD/Validation/Validation.php";
class UserController {
	private $slimApp;
	private $model;
	private $requestBody;
	private $validationSuite;
	public function __construct($model, $action = null, $slimApp, $parameters = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode ( $this->slimApp->request->getBody (), true ); 
		$this->validationSuite = new Validation ();
		
		if (! empty ( $parameters ["id"] ))
			$id = $parameters ["id"];
		else 
			$id = null;
		
		switch ($action) {
			case ACTION_AUTHENTICATE_USER:
				$this->validateCredentials($parameters);
				break;
			case ACTION_GET_USER :
				$this->getUsers ( $id );
				break;
			case ACTION_GET_USERS :
				$this->getUsers ();
				break;
			case ACTION_UPDATE_USER :
				$this->updateUser ( $id, $this->requestBody );
				break;
			case ACTION_CREATE_USER :
				$this->createNewUser ( $this->requestBody );
				break;
			case ACTION_DELETE_USER :
				$this->deleteUser ( $id );
				break;
			case ACTION_SEARCH_USERS :
				$string = $parameteres ["SearchingString"];
				$this->searchUsers ( $string );
				break;
			case null :
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_CLIENT_ERROR);
				break;
		}
	}
	private function validateCredentials($parameters) {
		$email = $parameters ["email"];
		$password = sha1($parameters ["password"]);
		
		if(!empty($email) && !empty($password)){
			$user = $this->model->getUserByEmail ( $email );
			if($user != false){
				if ($password == $user[0]['password']) {
					$this->setApiResponseAndStatus(HTTPSTATUS_OK, true);
				} else {
					$this->setApiResponseAndStatus(HTTPSTATUS_UNAUTHORIZED, false);
				}
			} else {
				$this->setApiResponseAndStatus(HTTPSTATUS_UNAUTHORIZED, false);
			}
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, false);
		}
	} 
	
	private function getUsers ($userID = null) {
		if($userID == null) {
			$answer = $this->model->getUsers ();
		} else {
			$answer = $this->model->getUsers ( $userID );
		}
		
		if ($answer != null) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, $answer);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOCONTENT, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function createNewUser($newUser) {
		//check if user email already exists
		if($this->validationSuite->isUserValid($newUser)) {
			$user = $this->model->getUserByEmail ( $newUser['email'] );
			if($user == null) {
				$passHash = sha1($newUser['password']);
				$newUser['password'] = $passHash;
				if ($newID = $this->model->createNewUser ( $newUser )) {
					$this->setApiResponseAndStatus(HTTPSTATUS_CREATED, GENERAL_RESOURCE_CREATED, $newID);
				} else {
					$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDBODY);
				}
			} else {
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, USER_EXISTS);
			}
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDBODY);
		}
	}
	private function deleteUser($userId) {
		if ($this->model->deleteUser ( $userId )) {
			$this->setApiResponseAndStatus(HTTPSTATUS_OK, GENERAL_RESOURCE_DELETED);
		} else {
			$this->setApiResponseAndStatus(HTTPSTATUS_NOTFOUND, GENERAL_NOCONTENT_MESSAGE);
		}
	}
	
	private function updateUser($userId, $toUpdateUser) {
		if($this->validationSuite->isUserValid($toUpdateUser)) {
			$user = $this->model->getUserByEmail ( $toUpdateUser['email'] );
			if($user != null) {
				$passHash = sha1($toUpdateUser['password']);
				$toUpdateUser['password'] = $passHash;
				if ($this->model->updateUser ( $userId, $toUpdateUser )) {
					$this->setApiResponseAndStatus(HTTPSTATUS_OK, GENERAL_RESOURCE_UPDATED, $userId);
				} else {
					$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, GENERAL_INVALIDBODY);
				}
			} else {
				$this->setApiResponseAndStatus(HTTPSTATUS_BADREQUEST, USER_DOES_NOT_EXIST);
			}
		}
	}
	
	private function searchUsers($string) {
		$answer = $this->model->searchUsers($string);
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