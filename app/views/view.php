<?php
class view
{
	private $model, $controller, $slimApp, $headers, $resourceName;

	public function __construct($controller, $model, $slimApp, $headers, $resourceName) {
		$this->controller = $controller;
		$this->model = $model;
		$this->slimApp = $slimApp;		
		$this->headers = $headers;
		$this->resourceName = $resourceName;
	}

	public function output(){
		//prepare json response
		$contentType = $this->headers['Content-Type'];
		$arrayData = $this->model->apiResponse;
	
		switch ($contentType) {
			case "application/json":
				$response = json_encode($arrayData);
				break;
			case "application/xml":				
				require_once('XML/Serializer.php');
				
				$serializer_options = array ( 
				    'addDecl' => TRUE, 
				    'encoding' => 'ISO-8859-1', 
				    'rootName' => $this->resourceName . 's', 
				    'defaultTagName' => $this->resourceName 
				);
				
				$serializer = new XML_Serializer($serializer_options);
				if ($serializer->serialize($arrayData)) {
			        $response = $serializer->getSerializedData();
			    }
			    else {
			        $response = "";
			    }
				break;
			case "text/csv":
				$response = $this->array_2_csv($arrayData);
				break;
			default:
				$response = json_encode($this->model->apiResponse);
				break;
		}
			
		$this->slimApp->response->write($response);
	}
	
	private function array_2_csv($array) {
	    $csv = array();
	    foreach ($array as $item) {
	        if (is_array($item)) {
	            $csv[] = "\n" . $this->array_2_csv($item);
	        } else {
	            $csv[] = $item;
	        }
	    }
	    return implode(',', $csv);
	}
}
?>