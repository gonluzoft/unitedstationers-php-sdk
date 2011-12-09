<?php


class UnitedStationers_Interlink_Record_Reply_AddLineItem extends UnitedStationers_Interlink_Record_Reply_Abstract {
	const RECORD_TYPE = 'IT';
	
	
	public function recordFormat(){
		
		return array(
			array('field'=>'recordType', 'length'=>'2'),
			array('field'=>'errorCode', 'length'=>'2'),
			
			array('field'=>'unitedOrderNumber', 'length'=>'10'),
			
			array('field'=>'accountNumber', 'length'=>'6'),
			array('field'=>'reserved1', 'length'=>'3'),
			array('field'=>'purchaseOrderNumber', 'length'=>'22'),
			array('field'=>'reserved2', 'length'=>'41'),
			array('field'=>'shippingLabelFormatOverride', 'length'=>'8'),
			array('field'=>'wrapAndLabelNumber', 'length'=>'9'),
			
			array('field'=>'itemPrefix', 'length'=>'3'),
			array('field'=>'itemStockNumber', 'length'=>'12'),
			
			array('field'=>'backorderDisposition', 'length'=>'2'),
			
			array('field'=>'changedItemPrefix', 'length'=>'3'),
			array('field'=>'changedItemStockNumber', 'length'=>'12'),
			array('field'=>'changedItemReasonCode', 'length'=>'2'),
			array('field'=>'changedItemDetails', 'length'=>'15'),
			
			
			array('field'=>'shippedQuantity', 'length'=>'9'),
			array('field'=>'shippedUnit', 'length'=>'2'),


			array('field'=>'changedUnitCode', 'length'=>'2'),
			array('field'=>'changedUnitReasonCode', 'length'=>'2'),
			
			array('field'=>'contractId', 'length'=>'3'),
			array('field'=>'fillFacilityName', 'length'=>'3'),
			array('field'=>'listPrice', 'length'=>'9'),
			array('field'=>'listUnitCode', 'length'=>'2'),
			array('field'=>'boxPackQuantity', 'length'=>'7'),
			array('field'=>'boxPackUnitCode', 'length'=>'2'),
			array('field'=>'cartonPackQuantity', 'length'=>'7'),
			array('field'=>'cartonPackUnitCode', 'length'=>'2'),
			array('field'=>'reserved3', 'length'=>'1'),
			array('field'=>'dealerUnitNetPrice', 'length'=>'9'),
			array('field'=>'pricePlan', 'length'=>'1'),
			array('field'=>'columnNumber', 'length'=>'1'),
			
			array('field'=>'filler1', 'length'=>'3'),
			array('field'=>'adotOrderNumber1', 'length'=>'7'),
			array('field'=>'adotFillFacility1', 'length'=>'3'),
			array('field'=>'adotShipQuantity1', 'length'=>'9'),
			array('field'=>'filler2', 'length'=>'3'),
			array('field'=>'adotOrderNumber2', 'length'=>'7'),
			array('field'=>'adotFillFacility2', 'length'=>'3'),
			array('field'=>'adotShipQuantity2', 'length'=>'9'),
			array('field'=>'adotIndicator', 'length'=>'1'),
			
			array('field'=>'reserved4', 'length'=>'9'),
			array('field'=>'etaDate', 'length'=>'7')
		);
		
	}
}