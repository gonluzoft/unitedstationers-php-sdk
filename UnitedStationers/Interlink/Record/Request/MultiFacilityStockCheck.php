<?php


class UnitedStationers_Interlink_Record_Request_MultiFacilityStockCheck extends UnitedStationers_Interlink_Record_Request_Abstract {
	const RECORD_TYPE = 'MF';
	
	const ADOT_TYPE__YES = 'Y';
	const ADOT_TYPE__NO = 'N';
	
	public function recordFormat(){
		
		$recordFormat = array(
			array('field'=>'recordType', 'length'=>'2', 'default'=>self::RECORD_TYPE),

			array('field'=>'accountNumber', 'length'=>'6', 'paddingCharacter' => '0'),
			array('field'=>'reserved1', 'length'=>'3'),
			array('field'=>'itemPrefix', 'length'=>'3'),
			array('field'=>'itemStockNumber', 'length'=>'12'),
			array('field'=>'adotType', 'length'=>'1', 'default'=>self::ADOT_TYPE__YES),
			array('field'=>'zipCode', 'length'=>'5'),			
		);
		
		
		for($i=1; $i<=100; $i++){
			$recordFormat[] = array('field'=>"facilityActionCode$i", 'length'=>'3');
		}
		
		return $recordFormat;
	}
}