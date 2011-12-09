<?php



class UnitedStationers_Interlink_Transmission_Request_SimpleOrder extends UnitedStationers_Interlink_Transmission_Request_Abstract {


	
	public function __construct(){
		parent::__construct();
	}
	
	
	
	public function buildRequestRecordClassNames(){
		return array(
			'TransmissionHeader',
			'OrderStart',
			'AddressInfo',
			'SpecialInstruct',
			'DealerInstruct',
			'ShippingInfo',
			'RouteInfo',
			'ReferenceInfo',
			'EndConsumerPo',
			'BarCode',
			'UsageReporting',
			'AddLineItem',
			'LineText',
			'OrderStatus'
		);
	}
	
	
}