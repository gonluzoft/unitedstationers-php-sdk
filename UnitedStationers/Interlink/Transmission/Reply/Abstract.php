<?php



abstract class UnitedStationers_Interlink_Transmission_Reply_Abstract {

	
	
	
	protected $lineDelimter = '';
	protected $dataLengthOffset = 49;
	
	
	private $replyRecords;

	
	
	
	
	
	public function __construct(){
		$this->replyRecords = array();
	}
	
	
	abstract public function buildReplyRecordClassNames();


	public function buildFullReplyRecordClassNames(){
		$replyRecordClassNames = $this->buildReplyRecordClassNames();
		foreach($replyRecordClassNames as $key => $replyRecordClassName){
			$replyRecordClassNames[$key] = "UnitedStationers_Interlink_Record_Reply_$replyRecordClassName";
		}
		
		return $replyRecordClassNames;
	}
	



	public function calculateDataLength(){
		
		$fullReplyRecordClassNames = $this->buildFullReplyRecordClassNames();
		$replyRecords = $this->getReplyRecordsByClassNames($fullReplyRecordClassNames);
		
		$dataLength = 0;
		
		foreach($replyRecords as $replyRecord){
			$dataLength += ($replyRecord->getDataLength()+strlen($this->lineDelimter));
		}
		
		return ($dataLength - $this->dataLengthOffset);
	}




	public function addReplyRecord($reply){
		
		if(!is_subclass_of($reply, 'UnitedStationers_Interlink_Record_Reply_Abstract')) throw new Exception('Reply doe not inherit from UnitedStationers_Interlink_Record_Reply_Abstract');
		
		$this->replyRecords[get_class($reply)][] = $reply;
		
	}
	
	
	public function addReplyRecords($replyRecords){
		foreach($replyRecords as $replyRecord){
			$this->addReplyRecord($replyRecord);
		}
	}
	
	
	
	
	public function getReplyRecords(){
		return $this->replyRecords;
		
	}
	
	
	
	
	
	
	public function getReplyRecordsByClassNames($classNames){
		$replyRecords = array();
		
		foreach($classNames as $className){
			
			try{
				$replyRecords = array_merge($replyRecords, $this->getReplyRecordsByClassName($className));
			}catch(Exception $ex){
				//dont do anything. data will just not be added to reply records array
			}
		}
		
		return $replyRecords;
		
	}
	
	public function getReplyRecordsByClassName($className, $isOnlyOne = false){

		$replyRecords = @$this->replyRecords[$className];

		$nonEmptyReplyRecords = array();
		
		if(is_array($replyRecords)){
			
			foreach($replyRecords as $replyRecord){
				if(!empty($replyRecord)){
					$nonEmptyReplyRecords[] = $replyRecord;
				}
			}
			
		}
		
		if(empty($nonEmptyReplyRecords)) 
			throw new Exception("Could not get UnitedStationers_Interlink_Record_Reply record(s) of class, '$className' - none set");
		
		if($isOnlyOne === true) 
			return $replyRecords[0];
		
		return $replyRecords;
	}
	
	
	

	
	/**
	*    Method convention signatures supported by the call method:
	*		getXXXRecords() - translates to getReplyRecordsByClassName(UnitedStationers_Interlink_Record_Reply_XXX, false)
	*		getXXXRecord() - translates to getReplyRecordsByClassName(UnitedStationers_Interlink_Record_Reply_XXX, true)
	*/
	public function __call($methodName, $args){
		
		//calls getReplyRecordsByClassName(class, false) with the appropriate class formulatd through the conventions of a method signature
		$matches = array();
		if(preg_match('/^get(.*)Records$/', $methodName, $matches)){
			return $this->getReplyRecordsByClassName('UnitedStationers_Interlink_Record_Reply_'.$matches[1], false);
		}
		
		//calls getReplyRecordsByClassName(class, true) with the appropriate class formulatd through the conventions of a method signature
		$matches = array();
		if(preg_match('/^get(.*)Record$/', $methodName, $matches)){
			return $this->getReplyRecordsByClassName('UnitedStationers_Interlink_Record_Reply_'.$matches[1], true);
		}
	}
	
	

	
}