<?php

class UnitedStationers_Interlink_Record_Reply {
	
	public static function factoryByRecordCode($recordCode, $attributes=array()){
		
		
		$replyRecord = null;
		
		switch ($recordCode) {
		    case UnitedStationers_Interlink_Record_Reply_TransmissionHeader::UNITED_TRANSACTION_ID:
		        $replyRecord = new UnitedStationers_Interlink_Record_Reply_TransmissionHeader($attributes);
		        break;
		
		
		    case UnitedStationers_Interlink_Record_Reply_OrderStart::RECORD_TYPE:
		        $replyRecord = new UnitedStationers_Interlink_Record_Reply_OrderStart($attributes);
		        break;
		    case UnitedStationers_Interlink_Record_Reply_AddressInfo::RECORD_TYPE:
		        $replyRecord = new UnitedStationers_Interlink_Record_Reply_AddressInfo($attributes);
		        break;
		    case UnitedStationers_Interlink_Record_Reply_AddLineItem::RECORD_TYPE:
		        $replyRecord = new UnitedStationers_Interlink_Record_Reply_AddLineItem($attributes);
		        break;
		    case UnitedStationers_Interlink_Record_Reply_OrderStatus::RECORD_TYPE:
		        $replyRecord = new UnitedStationers_Interlink_Record_Reply_OrderStatus($attributes);
		        break;
		
			
		    case UnitedStationers_Interlink_Record_Reply_MultiFacilityStockCheck::RECORD_TYPE:
		        $replyRecord = new UnitedStationers_Interlink_Record_Reply_MultiFacilityStockCheck($attributes);
		        break;
		
		
		    default:
				throw new Exception("Interlink reply class with record type code of, '$recordCode', not found!");
				break;
		}
		
		
		return $replyRecord;
		
	}
	

}