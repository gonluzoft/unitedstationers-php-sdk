<?php



class UnitedStationers_Interlink_Client {
	
	
	const MODE_TEST = 'test';
	const MODE_PRODUCTION = 'production';
	
	const URL_TEST = 'https://stage-elink2.unitedstationers.com/interlink/interlinkdirect.asp';
	const URL_PRODUCTION = 'https://elink2.unitedstationers.com/interlink/interlinkdirect.asp';
	
	const REQUEST_TYPE_SEND = '1';
	const REQUEST_TYPE_SEND_RECEIVE = '3';
	
	
	private $mode;
	private $url;
	
	private $requestType;
	
	private $transmission;
	
	
	
	
	
	public function __construct(){
		$this->mode = null;
		$this->url = null;
		$this->requestType=null;
		$this->transmission = null;	
	}
	
	
	
	
	public function setMode($mode){
		if($mode == self::MODE_TEST){
			
			$this->mode = self::MODE_TEST;
			$this->url = self::URL_TEST;
			
		} else if($mode == self::MODE_PRODUCTION){
			
			$this->mode = self::MODE_PRODUCTION;
			$this->url = self::URL_PRODUCTION;	
		
		} else{
			throw new Exception("Unknown mode attempted to be set");
		} 

	}
	
	
	public function getMode(){
		return $this->mode;
	}
	
	
	
	
	public function getUrl(){
		return $this->url;
	}
	
	
	
	
	public function setRequestType($requestType){
		if($requestType == self::REQUEST_TYPE_SEND){
			 $this->requestType = self::REQUEST_TYPE_SEND;
		
		}else if($requestType == self::REQUEST_TYPE_SEND_RECEIVE){
			$this->requestType = self::REQUEST_TYPE_SEND_RECEIVE;
		
		}else{
			throw new Exception('Unknown request type specified.');
		}
		
	}
	
	
	public function getRequestType(){
		return $this->requestType;
	}
	
	
	
	
	public function setTransmission($transmission){
		if(!is_a($transmission, 'UnitedStationers_Interlink_Transmission_Request_Abstract'))
			throw new Exception("Object is not of type 'UnitedStationers_Interlink_Transmission'");
		
		$this->transmission = $transmission;
	}
	
	
	public function getTransmission(){
		return $this->transmission;
	}
	

	
	public function request(){
		if($this->mode == null) throw new Exception("Cannot send until mode has been set properly");
		if($this->transmission == null) throw new Exception("Cannot send until transmission has been set properly");
		
		$client = new Zend_Http_Client($this->url);

		//echo $this->transmission."\n\n\n\n";
		$client->setParameterGet(array(
		    'RequestType'  => $this->requestType,
		    'RequestTransmission' => "{$this->transmission}"
		));
		
		$clientResponse = $client->request();
		//echo $clientResponse."\n\n\n\n\n";
		
		return UnitedStationers_Interlink_Transmission_Reply::factoryByReplyString($clientResponse);
		
	}
}