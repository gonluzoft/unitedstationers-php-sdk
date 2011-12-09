<?php


class UnitedStationers_Interlink_Record_Request_OrderStart extends UnitedStationers_Interlink_Record_Request_Abstract {
	
	
	const RECORD_TYPE = 'OS';

	const WILL_CALL = 'W';	
	const SHIP_OUT = 'S';
	
	const REJECT_DUPLICATE_PO__YES = 'Y';
	const REJECT_DUPLICATE_PO__NO = 'N';
	
	const ORDER_INDICATOR__REGULAR = ' ';
	const ORDER_INDICATOR__DROP_SHIP = 'D';
	const ORDER_INDICATOR__SINGLE_WRAP_AND_LABEL = 'W';
	const ORDER_INDICATOR__MUTLTI_WRAP_AND_LABEL = 'M';
	const ORDER_INDICATOR__FURNITURE_ORDER_WITH_SETUP = 'F';
	
	
	
	public function recordFormat(){
		
		return array(
			array('field'=>'recordType', 'length'=>'2', 'default'=>self::RECORD_TYPE),
			
			array('field'=>'accountNumber', 'length'=>'6'),
			array('field'=>'reserved1', 'length'=>'3'),
			array('field'=>'purchaseOrderNumber', 'length'=>'22'),
			array('field'=>'willCallOrShipOut', 'length'=>'1', 'default'=>self::SHIP_OUT),
			array('field'=>'facilityOverride', 'length'=>'3'),
			array('field'=>'reserved2', 'length'=>'22'),
			array('field'=>'orderTakerId', 'length'=>'3'),
			array('field'=>'reserved3', 'length'=>'5'),
			array('field'=>'regectDuplicatePo', 'length'=>'1', 'default'=>self::REJECT_DUPLICATE_PO__NO),
			array('field'=>'orderIndicator', 'length'=>'1', 'default'=>self::ORDER_INDICATOR__DROP_SHIP),
			array('field'=>'zipCode', 'length'=>'5', 'paddingCharacter' => '0'),
			array('field'=>'reserved4', 'length'=>'66'),
			array('field'=>'shippingLabelFormatOverride', 'length'=>'8'),
			array('field'=>'wrapAndLabelNumber', 'length'=>'9')

		);
		
	}
	
}