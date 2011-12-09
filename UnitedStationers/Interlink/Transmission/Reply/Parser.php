<?php


class UnitedStationers_Interlink_Transmission_Reply_Parser {

	const RETURN_CODE_LENGTH = 3;
	const RETURN_CODE_DELIMITER = '&||&';
	const RETURN_CODE_SUCCESS = '000';
	const RETURN_CODE_UNAVAILABLE = '800';
	
	const HEADER_REPLY_RECORD_TYPE_LENGTH = 4;
	const REPLY_RECORD_TYPE_LENGTH = 2;
	
	public $requestString;
	

	
	public function __construct($requestString){
		$this->requestString = $requestString;
	}
	

	public function parse(){
		return $this->parseReplyRecords();
		
	}
	
	
	public function parseReturnCode(){
		//get the first three character after the http headers are terminated by two newlines. That is essentially the return code
		$returnStartPosition = strpos($this->requestString, "\n\n") === false ? 0 : strpos($this->requestString, "\n\n")+2;
		$returnCode = substr($this->requestString, $returnStartPosition, self::RETURN_CODE_LENGTH);
		
		return $returnCode;
		
	}
	
	
	public function parseRawRequestRecordsData(){
		$splitRequestString = explode(self::RETURN_CODE_DELIMITER, $this->requestString);
		return $splitRequestString[1];
	}
	
	
	public function parseHeaderRecordCode(){
		return substr($this->parseRawRequestRecordsData(), 0, self::HEADER_REPLY_RECORD_TYPE_LENGTH);
	}
	
	
	public function parseHeaderRecord(){
		$headerRecord = UnitedStationers_Interlink_Record_Reply::factoryByRecordCode($this->parseHeaderRecordCode());
		$headerRecord->loadFromString(substr($this->parseRawRequestRecordsData(), 0, $headerRecord->getDataLength()));
		
		return $headerRecord;
	}
	
	
	
	public function parseReplyRecords(){
		
		if($this->parseReturnCode() == self::RETURN_CODE_SUCCESS) {
			$replyRecords = array();
		
			$replyRecords[] = $this->parseHeaderRecord();
		
		
			$position = $replyRecords[0]->getDataLength();
			$rawRequestRecordsData = $this->parseRawRequestRecordsData();

			while($position < strlen($rawRequestRecordsData)){
			
				$currentRawRequestData = substr($rawRequestRecordsData, $position);
				$replyRecord = UnitedStationers_Interlink_Record_Reply::factoryByRecordCode(substr($currentRawRequestData, 0, 2));
				$replyRecord->loadFromString(substr($currentRawRequestData, 0, $replyRecord->getDataLength()));

				$replyRecords[] = $replyRecord;
				$position += $replyRecord->getDataLength();

			}
		
			return $replyRecords;
		
		}else{
			throw new UnitedStationers_Interlink_Transmission_Reply_Exception_ServiceUnavailable('Return code does not signify success: '.$this->parseReturnCode());
		}
	}



	public function parseFirstReplyRecordTypeCode(){
		$replyRecords = $this->parseReplyRecords();
		
		if(isset($replyRecords[1]) && isset($replyRecords[1]->recordType))
			return $replyRecords[1]->recordType;
			
	}


	

}

