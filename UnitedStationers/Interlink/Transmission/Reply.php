<?php


class UnitedStationers_Interlink_Transmission_Reply {
	
	
	
	public static function factoryByReplyString($replyString, $attributes=array()){
	
		$replyParser = new UnitedStationers_Interlink_Transmission_Reply_Parser($replyString);
		$transmissionType = $replyParser->parseFirstReplyRecordTypeCode();
		
		$transmissionReply = null;
		
		switch ($transmissionType) {
			
		    case UnitedStationers_Interlink_Transmission_Reply_MultiFacilityStockCheck::TRANSMISSION_TYPE:
		        $transmissionReply = new UnitedStationers_Interlink_Transmission_Reply_MultiFacilityStockCheck();
		        break;
		    case UnitedStationers_Interlink_Transmission_Reply_SimpleOrder::TRANSMISSION_TYPE:
		        $transmissionReply = new UnitedStationers_Interlink_Transmission_Reply_SimpleOrder();
		        break;
		    default:
				throw new Exception("Interlink transmission reply class with type code of, '$transmissionType', not found!");
				break;
		}
		
		 
		$transmissionReply->addReplyRecords($replyParser->parseReplyRecords());
		return $transmissionReply;
		
	}

}