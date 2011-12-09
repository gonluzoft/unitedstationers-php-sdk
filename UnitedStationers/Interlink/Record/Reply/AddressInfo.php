<?php


class UnitedStationers_Interlink_Record_Reply_AddressInfo extends UnitedStationers_Interlink_Record_Reply_Abstract {
	
	const RECORD_TYPE = 'A1';
	
	
	public function recordFormat(){
		
		return array(
			array('field'=>'recordType', 'length'=>'2'),
			array('field'=>'errorCode', 'length'=>'2'),
			
			array('field'=>'unitedOrderNumber', 'length'=>'10'),
			
			array('field'=>'accountNumber', 'length'=>'6'),
			array('field'=>'reserved1', 'length'=>'3'),
			array('field'=>'purchaseOrderNumber', 'length'=>'22'),
			array('field'=>'willCallOrShipOut', 'length'=>'1'),
			array('field'=>'facilityOverride', 'length'=>'3'),
			array('field'=>'reserved2', 'length'=>'41'),
			array('field'=>'shippingLabelFormatOverride', 'length'=>'8'),
			array('field'=>'wrapAndLabelNumber', 'length'=>'9')
	
		);
		
	}	
}