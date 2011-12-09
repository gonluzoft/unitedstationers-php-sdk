<?php



class UnitedStationers_Interlink_Transmission_Reply_SimpleOrder extends UnitedStationers_Interlink_Transmission_Reply_Abstract {

	const TRANSMISSION_TYPE = 'OS';
	
	
	public function __construct(){
		parent::__construct();
	}
	
	
	
	public function buildReplyRecordClassNames(){
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