<?php



abstract class UnitedStationers_Interlink_Transmission_Request_Abstract {

	
	
	
	protected $lineDelimter = '';
	protected $dataLengthOffset = 49;
	
	
	private $requestRecords;

	
	
	
	
	
	public function __construct(){
		$this->requestRecords = array();
	}
	
	
	abstract public function buildRequestRecordClassNames();






	public function calculateDataLength(){
		
		$fullRequestRecordClassNames = $this->buildFullRequestRecordClassNames();
		$requestRecords = $this->getRequestRecordsByClassNames($fullRequestRecordClassNames);
		
		$dataLength = 0;
		
		foreach($requestRecords as $requestRecord){
			$dataLength += ($requestRecord->getDataLength()+strlen($this->lineDelimter));
		}
		
		return ($dataLength - $this->dataLengthOffset);
	}


	
	


	public function buildFullRequestRecordClassNames(){
		$requestRecordClassNames = $this->buildRequestRecordClassNames();
		foreach($requestRecordClassNames as $key => $requestRecordClassName){
			$requestRecordClassNames[$key] = "UnitedStationers_Interlink_Record_Request_$requestRecordClassName";
		}
		
		return $requestRecordClassNames;
	}
	
	
	
		
		
	
	public function addRequestRecord($request){
		
		if(!is_subclass_of($request, 'UnitedStationers_Interlink_Record_Request_Abstract')) throw new Exception('Request doe not inherit from UnitedStationers_Interlink_Record_Request_Abstract');
		
		$this->requestRecords[get_class($request)][] = $request;
		
	}
	
	
	public function getRequestRecords(){
		return $this->requestRecords;
		
	}
	
	
	
	
	
	
	public function getRequestRecordsByClassNames($classNames){
		$requestRecords = array();
		
		foreach($classNames as $className){
			
			try{
				$requestRecords = array_merge($requestRecords, $this->getRequestRecordsByClassName($className));
			
			}catch(Exception $ex){ 
				//dont need to do anything. no records exists, so they wont be added to request records array 
			}
		}
		
		return $requestRecords;
		
	}
	
	public function getRequestRecordsByClassName($className, $isOnlyOne = false){

		$requestRecords = @$this->requestRecords[$className];

		$nonEmptyRequestRecords = array();
		
		if(is_array($requestRecords)){
			
			foreach($requestRecords as $requestRecord){
				if(!empty($requestRecord)){
					$nonEmptyRequestRecords[] = $requestRecord;
				}
			}
			
		}
		
		if(empty($nonEmptyRequestRecords)) 
			throw new Exception("Could not get UnitedStationers_Interlink_Record_Request record(s) of class, '$className' - none set");
		
		if($isOnlyOne === true) 
			return $requestRecords[0];
		
		return $requestRecords;
	}
	
	
	

	
	/**
	*    Method convention signatures supported by the call method:
	*		getXXXRecords() - translates to getRequestRecordsByClassName(UnitedStationers_Interlink_Record_Request_XXX, false)
	*		getXXXRecord() - translates to getRequestRecordsByClassName(UnitedStationers_Interlink_Record_Request_XXX, true)
	*/
	public function __call($methodName, $args){
		
		//calls getRequestRecordsByClassName(class, false) with the appropriate class formulatd through the conventions of a method signature
		$matches = array();
		if(preg_match('/^get(.*)Records$/', $methodName, $matches)){
			return $this->getRequestRecordsByClassName('UnitedStationers_Interlink_Record_Request_'.$matches[1], false);
		}
		
		//calls getRequestRecordsByClassName(class, true) with the appropriate class formulatd through the conventions of a method signature
		$matches = array();
		if(preg_match('/^get(.*)Record$/', $methodName, $matches)){
			return $this->getRequestRecordsByClassName('UnitedStationers_Interlink_Record_Request_'.$matches[1], true);
		}
	}
	
	
	
	/**
	*	Takes all the records specified by a build request 
	*/
	public function __toString(){
		
		try{
			$fullRequestRecordClassNames = $this->buildFullRequestRecordClassNames();
			$requestRecords = $this->getRequestRecordsByClassNames($fullRequestRecordClassNames);
		
		
		
			$request = '';
			foreach($requestRecords as $requestRecord){
			
				//before we send, we need to update the transmission header with the full lenght of the transmission, now that all the records are in place
				if(get_class($requestRecord) == 'UnitedStationers_Interlink_Record_Request_TransmissionHeader') 
					$requestRecord->dataLength = $this->calculateDataLength();
				
				$request .= "$requestRecord{$this->lineDelimter}";
			}
		
			return $request;
		
		}catch(Exception $ex){
			echo($ex->getMessage());
			exit();
		}
	}
	
}