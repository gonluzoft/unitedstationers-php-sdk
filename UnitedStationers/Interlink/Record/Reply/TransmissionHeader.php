<?php


class UnitedStationers_Interlink_Record_Reply_TransmissionHeader extends UnitedStationers_Interlink_Record_Reply_Abstract {
	
	
	const UNITED_TRANSACTION_ID = 'OE01';

		
	public function recordFormat(){
		
		return array(
			array('field'=>'unitedTransactionId', 'length'=>'4'),
			array('field'=>'systemId', 'length'=>'4'),
			array('field'=>'reserved1', 'length'=>'12'),
			array('field'=>'transmissionType', 'length'=>'1',),
			array('field'=>'positionIndicator', 'length'=>'1', ),
			array('field'=>'sendDate', 'length'=>'10', ),
			array('field'=>'sendTime', 'length'=>'8', ),
			array('field'=>'sequenceNumber', 'length'=>'4'),
			array('field'=>'dataLength', 'length'=>'5'),
			array('field'=>'signOnAccountNumber', 'length'=>'6'),
			array('field'=>'reserved2', 'length'=>'3'),
			array('field'=>'transmissionNumber', 'length'=>'5'),
			array('field'=>'requestorId', 'length'=>'8')
		);
		
	}
	
	
}

