<?php


class UnitedStationers_Interlink_Record_Reply_OrderStart extends UnitedStationers_Interlink_Record_Reply_Abstract {
	
	const RECORD_TYPE = 'OS';
	
	
	public function recordFormat(){
		
		return array(
			array('field'=>'recordType', 'length'=>'2'),
			array('field'=>'errorCode', 'length'=>'2'),
			array('field'=>'unitedOrderNumber', 'length'=>'10'),
			array('field'=>'accountNumber', 'length'=>'6'),
			array('field'=>'reserved', 'length'=>'3'),
			array('field'=>'purchaseOrderNumber', 'length'=>'22'),
			array('field'=>'willCallOrShipOut', 'length'=>'1'),
			array('field'=>'facilityOverride', 'length'=>'3'),
			array('field'=>'orderIndicator', 'length'=>'1'),
			array('field'=>'zipCode', 'length'=>'5'),
			array('field'=>'reserved', 'length'=>'71'),
			array('field'=>'shippingLabelFormatOverride', 'length'=>'8'),
			array('field'=>'wrapAndLabelNumber', 'length'=>'9')
		);
		

	}
	
	
}