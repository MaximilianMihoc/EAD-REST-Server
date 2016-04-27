<?php
require_once "../Slim/Slim.php";
Slim\Slim::registerAutoloader ();

$app = new \Slim\Slim (); // slim run-time object
require_once "conf/config.inc.php";

function authenticate(\Slim\Route $route)
{
	$app = \Slim\Slim::getInstance();
	
	$headers = $app->request->headers;
	$parameters['email'] = $headers['email'];
	$parameters['password'] = $headers['password'];
	
	$action = ACTION_AUTHENTICATE_USER;
	
	$mvc = new loadRunMVCComponents ( "UserModel", "UserController", "view", $action, $app, $parameters );
	
	if($mvc->model->apiResponse)
		return true;
	else
		$app->halt(HTTPSTATUS_UNAUTHORIZED);
}

/* Maps entry point for CRUD operations on authors table */
$app->map ( "/authors(/:id)", "authenticate", function ($authorID = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["id"] = $authorID; // prepare parameters to be passed to the controller (example: ID)
	
	if (($authorID == null) or is_numeric ( $authorID )) {
		switch ($httpMethod) {
			case "GET" :
				if ($authorID != null)
					$action = ACTION_GET_AUTHOR;
				else
					$action = ACTION_GET_AUTHORS;
				break;
			case "POST" :
				$action = ACTION_CREATE_AUTHOR;
				break;
			case "PUT" :
				$action = ACTION_UPDATE_AUTHOR;
				break;
			case "DELETE" :
				$action = ACTION_DELETE_AUTHOR;
				break;
			default :
		}
	}
	return new loadRunMVCComponents ( "AuthorModel", "AuthorController", "view", $action, $app, $parameters );
} )->via ( "GET", "POST", "PUT", "DELETE" );

/* Maps entry point for CRUD operations on books table */
$app->map ( "/books(/:id)", "authenticate", function ($bookID = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["id"] = $bookID; // prepare parameters to be passed to the controller (example: ID)
	
	if (($bookID == null) or is_numeric ( $bookID )) {
		switch ($httpMethod) {
			case "GET" :
				if ($bookID != null)
					$action = ACTION_GET_BOOK;
				else
					$action = ACTION_GET_BOOKS;
				break;
			case "POST" :
				$action = ACTION_CREATE_BOOK;
				break;
			case "PUT" :
				$action = ACTION_UPDATE_BOOK;
				break;
			case "DELETE" :
				$action = ACTION_DELETE_BOOK;
				break;
			default :
		}
	}
	return new loadRunMVCComponents ( "BookModel", "BookController", "view", $action, $app, $parameters );
} )->via ( "GET", "POST", "PUT", "DELETE" );

/* Maps entry point to get books for particular author */
$app->map ( "/author/:id/books", "authenticate", function ($authorID = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["id"] = $authorID;
	
	if (!empty($authorID) and is_numeric ( $authorID )) {
		$action = ACTION_GET_AUTHOR_BOOKS;
	}
	return new loadRunMVCComponents ( "BookModel", "BookController", "view", $action, $app, $parameters );
} )->via ( "GET" );

/* Maps entry point to get authors for particular book */
$app->map ( "/book/:id/authors", "authenticate", function ($bookID = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["id"] = $bookID; 
	
	if (!empty($bookID) and is_numeric ( $bookID )) {
		$action = ACTION_GET_BOOK_AUTHORS;
	}
	return new loadRunMVCComponents ( "AuthorModel", "AuthorController", "view", $action, $app, $parameters );
} )->via ( "GET" );

/* Maps entry point to search for author */
$app->map ( "/books/search(/:searchingString)", "authenticate", function ($searchingString = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["SearchingString"] = $searchingString;

	if ($searchingString != null)
		$action = ACTION_SEARCH_BOOKS;
	else
		$action = ACTION_GET_BOOKS;

	return new loadRunMVCComponents ( "BookModel", "BookController", "view", $action, $app, $parameters );
} )->via ( "GET" );

/* Maps entry point to search for author */
$app->map ( "/authors/search(/:searchingString)", "authenticate", function ($searchingString = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["SearchingString"] = $searchingString;

	if ($searchingString != null)
		$action = ACTION_SEARCH_AUTHORS;
	else
		$action = ACTION_GET_AUTHORS;

	return new loadRunMVCComponents ( "AuthorModel", "AuthorController", "view", $action, $app, $parameters );
} )->via ( "GET" );

/* Maps entry point for CRUD operations on users table */
$app->map ( "/users(/:id)", "authenticate", function ($userID = null) use($app) {
	
	$httpMethod = $app->request->getMethod ();
	$action = null;
	$parameters ["id"] = $userID;
	
	if (($userID == null) or is_numeric ( $userID )) {
		switch ($httpMethod) {
			case "GET" :
				if ($userID != null)
					$action = ACTION_GET_USER;
				else
					$action = ACTION_GET_USERS;
				break;
			case "POST" :
				$action = ACTION_CREATE_USER;
				break;
			case "PUT" :
				$action = ACTION_UPDATE_USER;
				break;
			case "DELETE" :
				$action = ACTION_DELETE_USER;
				break;
			default :
		}
	}
	return new loadRunMVCComponents ( "UserModel", "UserController", "view", $action, $app, $parameters );
} )->via ( "GET", "POST", "PUT", "DELETE" );

$app->run ();
class loadRunMVCComponents {
	public $model, $controller, $view;
	public function __construct($modelName, $controllerName, $viewName, $action, $app, $parameters = null) {
		include_once "models/" . $modelName . ".php";
		include_once "controllers/" . $controllerName . ".php";
		include_once "views/" . $viewName . ".php";
		
		$this->model = new $modelName (); // common model
		$this->controller = new $controllerName ( $this->model, $action, $app, $parameters );
		$this->view = new $viewName ( $this->controller, $this->model, $app, $app->request->headers, strtolower(chop($modelName, "Model")) ); // common view
		
		if($action != ACTION_AUTHENTICATE_USER) $this->view->output (); // this returns the response to the requesting client
	}
}
?>