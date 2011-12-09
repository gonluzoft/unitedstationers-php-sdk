<?php



class UnitedStationers_Interlink_Transmission_Request_Reconfirmation extends UnitedStationers_Interlink_Transmission_Request_Abstract {


	
	public function __construct(){
		parent::__construct();
	}
	
	
	
	public function buildRequestRecordClassNames(){
		return array(
			'Reconfirm'
		);
	}
	
	
}