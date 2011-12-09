<?php



class UnitedStationers_Interlink_Transmission_Reply_MultiFacilityStockCheck extends UnitedStationers_Interlink_Transmission_Reply_Abstract {

	const TRANSMISSION_TYPE = 'MF';
	
	
	public function __construct(){
		parent::__construct();
	}
	
	
	
	public function buildReplyRecordClassNames(){
		return array(
			'TransmissionHeader',
			'MultiFacilityStockCheck'
		);
	}
	
	
}