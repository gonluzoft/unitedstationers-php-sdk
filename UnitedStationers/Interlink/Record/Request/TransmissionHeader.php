<?php


class UnitedStationers_Interlink_Record_Request_TransmissionHeader extends UnitedStationers_Interlink_Record_Request_Abstract {
	
	
	const UNITED_TRANSACTION_ID = 'OE01';
	const TRANSACTION_TYPE = 'D';
	
	const POSITION_INDICATOR__FIRST = 'F';
	const POSITION_INDICATOR__MIDDLE = 'M';
	const POSITION_INDICATOR__LAST = 'L';
	
	const CONFIRMATION_RECORD_FORMAT = 'A';
	
	
	public function recordFormat(){
		
		return array(
			array('field'=>'unitedTransactionId', 'length'=>'4', 'default'=>self::UNITED_TRANSACTION_ID),
			array('field'=>'systemId', 'length'=>'4'),
			array('field'=>'reserved1', 'length'=>'12'),
			array('field'=>'transmissionType', 'length'=>'1', 'default'=>self::TRANSACTION_TYPE),
			array('field'=>'positionIndicator', 'length'=>'1', 'default'=>self::POSITION_INDICATOR__LAST),
			array('field'=>'sendDate', 'length'=>'10', 'default'=>date('Y-m-d')),
			array('field'=>'sendTime', 'length'=>'8', 'default'=>date('H:i:s')),
			array('field'=>'sequenceNumber', 'length'=>'4', 'default'=>'0001', 'paddingCharacter' => '0'),
			array('field'=>'dataLength', 'length'=>'5', 'paddingCharacter' => '0'),
			array('field'=>'signOnAccountNumber', 'length'=>'6', 'paddingCharacter' => '0'),
			array('field'=>'reserved2', 'length'=>'3'),
			array('field'=>'transmissionNumber', 'length'=>'5', 'paddingCharacter' => '0'),
			array('field'=>'signOnPassword', 'length'=>'8'),
			array('field'=>'requestorId', 'length'=>'8'),
			array('field'=>'confirmationRecordFormat', 'length'=>'1', 'default'=>self::CONFIRMATION_RECORD_FORMAT)
		);
		
	}
	
	
}

