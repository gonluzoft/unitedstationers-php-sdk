<?php


class UnitedStationers_Interlink_Record_Request_LineText extends UnitedStationers_Interlink_Record_Request_Abstract {
	
	const RECORD_TYPE = 'LT';
	
	const WILL_CALL = 'W';	
	const SHIP_OUT = 'S';

	
	public function recordFormat(){
		
		return array(
			array('field'=>'recordType', 'length'=>'2', 'default'=>self::RECORD_TYPE),
			
			array('field'=>'unitedOrderNumber', 'length'=>'10'),
			
			array('field'=>'accountNumber', 'length'=>'6'),
			array('field'=>'reserved1', 'length'=>'3'),
			array('field'=>'purchaseOrderNumber', 'length'=>'22'),
			array('field'=>'willCallOrShipOut', 'length'=>'1', 'default'=>self::SHIP_OUT),
			array('field'=>'facilityOverride', 'length'=>'3'),
			array('field'=>'item', 'length'=>'15'),
			array('field'=>'reserved2', 'length'=>'26'),
			array('field'=>'shippingLabelFormatOverride', 'length'=>'8'),
			array('field'=>'wrapAndLabelNumber', 'length'=>'9'),
			
			array('field'=>'line1', 'length'=>'78'),

		);
		
	}	
}