<?php


class UnitedStationers_Interlink_Record_Request_AddressInfo extends UnitedStationers_Interlink_Record_Request_Abstract {
	
	const RECORD_TYPE = 'A1';
	
	const WILL_CALL = 'W';	
	const SHIP_OUT = 'S';
	
	const ORDER_INDICATOR__REGULAR = ' ';
	const ORDER_INDICATOR__DROP_SHIP = 'D';
	const ORDER_INDICATOR__SINGLE_WRAP_AND_LABEL = 'W';
	const ORDER_INDICATOR__MUTLTI_WRAP_AND_LABEL = 'M';
	const ORDER_INDICATOR__FURNITURE_ORDER_WITH_SETUP = 'F';
	
	public function recordFormat(){
		
		return array(
			array('field'=>'recordType', 'length'=>'2', 'default'=>self::RECORD_TYPE),
			
			array('field'=>'unitedOrderNumber', 'length'=>'10'),
			
			array('field'=>'accountNumber', 'length'=>'6'),
			array('field'=>'reserved1', 'length'=>'3'),
			array('field'=>'purchaseOrderNumber', 'length'=>'22'),
			array('field'=>'willCallOrShipOut', 'length'=>'1', 'default'=>self::SHIP_OUT),
			array('field'=>'facilityOverride', 'length'=>'3'),
			array('field'=>'reserved2', 'length'=>'41'),
			array('field'=>'shippingLabelFormatOverride', 'length'=>'8'),
			array('field'=>'wrapAndLabelNumber', 'length'=>'9'),
			
			array('field'=>'orderIndicator', 'length'=>'1', 'default'=>self::ORDER_INDICATOR__DROP_SHIP),
			array('field'=>'shipToAddressLine1', 'length'=>'35'),
			array('field'=>'shipToAddressLine2', 'length'=>'35'),
			array('field'=>'shipToAddressLine3', 'length'=>'35'),
			array('field'=>'shipToAddressLine4', 'length'=>'35'),
			array('field'=>'shipToCity', 'length'=>'30'),
			array('field'=>'shipToFiller1', 'length'=>'1'),
			array('field'=>'shipToState', 'length'=>'2'),
			array('field'=>'shipToFiller2', 'length'=>'2'),
			array('field'=>'shipToPostalCode', 'length'=>'15', 'paddingCharacter' => '0'),
			array('field'=>'shipToFiller3', 'length'=>'20')
		);
		
	}	
}