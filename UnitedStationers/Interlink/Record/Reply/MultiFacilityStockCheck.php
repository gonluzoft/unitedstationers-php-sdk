<?php


class UnitedStationers_Interlink_Record_Reply_MultiFacilityStockCheck extends UnitedStationers_Interlink_Record_Reply_Abstract {
	
	const RECORD_TYPE = 'MF';
	
	
	public function recordFormat(){
		
		$recordFormat = array(
			array('field'=>'recordType', 'length'=>'2'),
			array('field'=>'errorCode', 'length'=>'2'),
			array('field'=>'accountNumber', 'length'=>'6'),
			array('field'=>'reserved1', 'length'=>'3'),
			array('field'=>'itemPrefix', 'length'=>'3'),
			array('field'=>'itemStockNumber', 'length'=>'12'),
			array('field'=>'changedPrefix', 'length'=>'3'),
			array('field'=>'changedStockNo', 'length'=>'12'),
			array('field'=>'changedReasonCode', 'length'=>'2'),
			array('field'=>'changedSecondItem', 'length'=>'15'),
			array('field'=>'itemDescription', 'length'=>'25'),
			array('field'=>'itemVendor', 'length'=>'10'),
			array('field'=>'promotionId', 'length'=>'3'),
			array('field'=>'inventoryUnit', 'length'=>'2'),
			array('field'=>'listPrice', 'length'=>'9'),
			array('field'=>'listUnitCode', 'length'=>'2'),
			array('field'=>'boxPackQuantity', 'length'=>'7'),
			array('field'=>'boxPackUnitCode', 'length'=>'2'),
			array('field'=>'cartonPackQuantity', 'length'=>'7'),
			array('field'=>'cartonPackUnitCode', 'length'=>'2'),
			array('field'=>'reserved2', 'length'=>'1'),
			array('field'=>'dealerUnitNetPrice', 'length'=>'9'),
			array('field'=>'pricePlan', 'length'=>'1'),
			array('field'=>'startingPriceColumn', 'length'=>'1'),
			array('field'=>'adotListIndicator', 'length'=>'1'),
			array('field'=>'zipCodeOverride', 'length'=>'5'),
		);
		
		
		for($i=1; $i<=100; $i++){
			$recordFormat[] = array('field'=>"facilityActionCode$i", 'length'=>'3');
			$recordFormat[] = array('field'=>"facilityErrorCode$i", 'length'=>'2');
			$recordFormat[] = array('field'=>"totalQuantityOnHand$i", 'length'=>'9');
			$recordFormat[] = array('field'=>"etaDate$i", 'length'=>'7');
		}
		
		return $recordFormat;
	}
	
	
}