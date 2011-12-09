<?php


class UnitedStationers_Interlink_Record_Request_AddLineItem extends UnitedStationers_Interlink_Record_Request_Abstract {
	const RECORD_TYPE = 'IT';
	
	
	const WILL_CALL = 'W';	
	const SHIP_OUT = 'S';
	
	const BACKORDER_FILL_PARTIAL = 'FP';	
	const BACKORDER_FILL_TOTAL = 'TM';
	
	const ADOT_SPLIT = 'S';
	const ADOT_DONT_SPLIT = 'Y';
	const ADOT_PRIMARY_ONLY = 'N';
	
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
			
			array('field'=>'itemPrefix', 'length'=>'3'),
			array('field'=>'itemStockNumber', 'length'=>'12'),
			array('field'=>'orderQuantity', 'length'=>'7', 'defaultPadding'=>'0'),
			array('field'=>'orderUnit', 'length'=>'2'),
			array('field'=>'backorderDisposition', 'length'=>'2', 'default'=>self::BACKORDER_FILL_PARTIAL),
			array('field'=>'stockSearchIndicator', 'length'=>'1', 'default'=>self::ADOT_SPLIT),
			array('field'=>'lineTextId', 'length'=>'6'),
			array('field'=>'reserved1', 'length'=>'2'),
			array('field'=>'listPriceConversion', 'length'=>'9'),
			array('field'=>'listPriceTolerance', 'length'=>'3')
		);
		
	}
}