<?php



class UnitedStationers_Interlink {
	
	
	private $systemId;
	private $signOnAccountNumber;
	private $signOnPassword;
	private $requestorId;
	private $orderTakerId;
	
	private $interlinkClient;
	
	
	public function __construct($options){
		
	    if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        if (is_array($options)) {
            $this->setOptions($options);
        }
	}
	
	
	public function isServiceAvailable(){
		try{
			$transmission = new UnitedStationers_Interlink_Transmission_Request_ServiceAvailableTest();
			$transmission->addRequestRecord($this->generateTransmissionHeader());
		
			$this->getInterlinkClient()->setTransmission($transmission);
		
			$transmissionReply = $this->getInterlinkClient()->request();
			
			return true;
			
		}catch(UnitedStationers_Interlink_Transmission_Reply_Exception_ServiceUnavailable $ex){
			return false;
			
		}catch(Exception $ex){
			return true;
		}
	}
	
	
	public function transmitOrder($order){
		//build and populate each record for the transmission
		$orderStart = UnitedStationers_Interlink_Record_Request::factoryByType('OrderStart');
		$orderStart->accountNumber = $order->accountNumber;
		$orderStart->purchaseOrderNumber = $order->number;
		$orderStart->orderTakerId = $this->getOrderTakerId();
		$orderStart->zipCode = $order->addressPostalCode;
		$orderStart->orderIndicator = $order->indicator;
		
		$addressInfo = UnitedStationers_Interlink_Record_Request::factoryByType('AddressInfo');
		$addressInfo->accountNumber = $order->accountNumber;
		$addressInfo->purchaseOrderNumber = $order->number;
		$addressInfo->shipToAddressLine1 = $order->addressLine1;
		$addressInfo->shipToAddressLine2 = $order->addressLine2;
		$addressInfo->shipToCity = $order->addressCity;
		$addressInfo->shipToState = $order->addressState;
		$addressInfo->shipToPostalCode = $order->addressPostalCode;
		$addressInfo->orderIndicator = $order->indicator;
		

		$addLineItems = array();
		foreach($order->lineItems as $lineItem){
			$addLineItem = UnitedStationers_Interlink_Record_Request::factoryByType('AddLineItem');
			
			$addLineItem->accountNumber = $order->accountNumber;
			$addLineItem->purchaseOrderNumber = $order->number;
			$addLineItem->itemPrefix = $lineItem->prefix;
			$addLineItem->itemStockNumber = $lineItem->stockNumber;
			$addLineItem->orderQuantity = $lineItem->quantity;
			$addLineItem->orderUnit = $lineItem->unit;
			
			$addLineItems[] = $addLineItem;
		}
		
		$orderStatus = UnitedStationers_Interlink_Record_Request::factoryByType('OrderStatus');
		$orderStatus->accountNumber = $order->accountNumber;
		$orderStatus->purchaseOrderNumber = $order->number;
		$orderStatus->orderStatus = UnitedStationers_Interlink_Record_Request_OrderStatus::STATUS_HOLD;
		
		
		
		//build the request transmission and add request records
		$transmission = new UnitedStationers_Interlink_Transmission_Request_SimpleOrder();
		$transmission->addRequestRecord($this->generateTransmissionHeader());
		$transmission->addRequestRecord($orderStart);
		$transmission->addRequestRecord($addressInfo);
		
		foreach($addLineItems as $addLineItem){
			$transmission->addRequestRecord($addLineItem);
		}
		
		$transmission->addRequestRecord($orderStatus);
		
		
		
		//transmit data and get corresponding reply records
		//@todo - add error checking (look at error codes for each set of records)
		$this->getInterlinkClient()->setTransmission($transmission);

		$transmissionReply = $this->getInterlinkClient()->request();
		$orderStartReply= $transmissionReply->getOrderStartRecord();
		$addressInfoReply= $transmissionReply->getAddressInfoRecord();
		$addLineItemReplies = $transmissionReply->getAddLineItemRecords();
		$orderStatusReply = $transmissionReply->getOrderStatusRecord();
		
		foreach($addLineItemReplies as $key=>$addLineItemReply){
			$lineItems = $order->lineItems;
			$lineItem = $lineItems[$key];
			
			$lineItem->shippedQuantity = $addLineItemReply->shippedQuantity;
			$lineItem->adotShipQuantity1 = $addLineItemReply->adotShipQuantity1;
			$lineItem->adotShipQuantity2 = $addLineItemReply->adotShipQuantity2;
		}	
		
		return $order;
		//print_r($transmissionReply);
		//print_r($order->lineItems);
	}
	
	

	
	public function multiFacilityStockCheck($item){
		
		$multiFacilityStockCheck = UnitedStationers_Interlink_Record_Request::factoryByType('MultiFacilityStockCheck');
		$multiFacilityStockCheck->accountNumber = $this->getSignOnAccountNumber();
		$multiFacilityStockCheck->itemPrefix = $item->prefix;
		$multiFacilityStockCheck->itemStockNumber = $item->stockNumber;
		
		$transmission = new UnitedStationers_Interlink_Transmission_Request_MultiFacilityStockCheck();
		$transmission->addRequestRecord($this->generateTransmissionHeader());
		$transmission->addRequestRecord($multiFacilityStockCheck);
		
		$this->getInterlinkClient()->setTransmission($transmission);
		
		$transmissionReply = $this->getInterlinkClient()->request();
		$multiFacilityStockCheckReply = $transmissionReply->getMultiFacilityStockCheckRecord();
		
		//map the inerlink record to the standard united stationers item data objecct
		$newItem = new UnitedStationers_Data_Catalog_Item();
		$newItem->prefix = $multiFacilityStockCheckReply->itemPrefix;
		$newItem->stockNumber = $multiFacilityStockCheckReply->itemStockNumber;
		$newItem->description = $multiFacilityStockCheckReply->itemDescription;
		$newItem->vendor = $multiFacilityStockCheckReply->itemVendor;
		$newItem->inventoryUnit = $multiFacilityStockCheckReply->inventoryUnit;
		$newItem->listPrice = number_format(substr_replace($multiFacilityStockCheckReply->listPrice, '.', -2, 0), 2);
		$newItem->listUnitCode = $multiFacilityStockCheckReply->listUnitCode;
		$newItem->boxPackQuantity = number_format(substr_replace($multiFacilityStockCheckReply->boxPackQuantity, '.', -2, 0), 2);
		$newItem->boxPackUnitCode = $multiFacilityStockCheckReply->boxPackUnitCode;
		$newItem->cartonPackQuantity = number_format(substr_replace($multiFacilityStockCheckReply->cartonPackQuantity, '.', -2, 0), 2);
		$newItem->cartonPackUnitCode = $multiFacilityStockCheckReply->cartonPackUnitCode;
		$newItem->dealerUnitNetPrice = number_format(substr_replace($multiFacilityStockCheckReply->dealerUnitNetPrice, '.', -2, 0), 2);
		$newItem->pricePlan = $multiFacilityStockCheckReply->pricePlan;
		
		//map any facilities that have the item to a standard united stationers item facility data object
		for($i=1; $i<=100; $i++){
			
			$facilityActionCode = "facilityActionCode$i";
			$facilityQuantityOnHand = "totalQuantityOnHand$i";
			$facilityEtaDate = "etaDate$i";
			
			if(isset($multiFacilityStockCheckReply->$facilityActionCode) && !empty($multiFacilityStockCheckReply->$facilityActionCode)){
				$newItemFacility = new UnitedStationers_Data_Catalog_ItemFacility();
				$newItemFacility->code = $multiFacilityStockCheckReply->$facilityActionCode;
				$newItemFacility->quantityOnHand = number_format(substr_replace($multiFacilityStockCheckReply->$facilityQuantityOnHand, '.', -2, 0), 2);
				$newItemFacility->etaDate = $multiFacilityStockCheckReply->$facilityEtaDate;
				
				$newItem->addItemFacility($newItemFacility);
			}
			
		}
		
		return $newItem;
		
		
	}
	
	
	protected function generateTransmissionHeader(){
		$transmissionHeader = UnitedStationers_Interlink_Record_Request::factoryByType('TransmissionHeader');
		$transmissionHeader->systemId = $this->getSystemId();
		$transmissionHeader->signOnAccountNumber = $this->getSignOnAccountNumber();
		$transmissionHeader->transmissionNumber = $this->getNextTransmissionNumber();
		$transmissionHeader->signOnPassword = $this->getSignOnPassword();
		$transmissionHeader->requestorId = $this->getRequestorId();
		
		return $transmissionHeader;
	}
	
	
	
	public function setSystemId($systemId){
		$this->systemId = $systemId;
	}
	
	
	public function setSignOnAccountNumber($signOnAccountNumber){
		$this->signOnAccountNumber = $signOnAccountNumber;
	}
	
	
	public function setSignOnPassword($signOnPassword){
		$this->signOnPassword = $signOnPassword;
	}
	
	
	public function setRequestorId($requestorId){
		$this->requestorId = $requestorId;
	}
	
	public function setOrderTakerId($orderTakerId){
		$this->orderTakerId = $orderTakerId;
	}
	
	
	
	public function setInterlinkClient($interlinkClient){
		$this->interlinkClient = $interlinkClient;
	}
	
	
	
	
	public function getSystemId(){
		return $this->systemId;
	}
	
	
	public function getSignOnAccountNumber(){
		return $this->signOnAccountNumber;
	}
	
	
	public function getSignOnPassword(){
		return $this->signOnPassword;
	}
	
	
	public function getRequestorId(){
		return $this->requestorId;
	}
	
	public function getOrderTakerId(){
		return $this->orderTakerId;
	}
	
	public function getInterlinkClient(){
		
		if($this->interlinkClient === null){
			$this->interlinkClient = new UnitedStationers_Interlink_Client();
			
			$this->interlinkClient->setMode(UnitedStationers_Interlink_Client::MODE_TEST);
			$this->interlinkClient->setRequestType(UnitedStationers_Interlink_Client::REQUEST_TYPE_SEND_RECEIVE);
		}
		
		return $this->interlinkClient;
	}
	
	

	public function getNextTransmissionNumber(){
		$number = @file_get_contents($this->getTransmissionNumberFile());
		
		//if we didnt get a number or the number is larger then the maximum allowable size by united (5 digits), then reset the current number to 1
		if($number === false || empty($number) || $number > 99999) $number = 1;
	
		//increment the number we have on file and return the current number
		$this->incrementTransmissionNumber($number);
		return $number;
	}
	
	public function incrementTransmissionNumber($currentNumber){
		file_put_contents($this->getTransmissionNumberFile(), ($currentNumber+1));
	}
	
	
	protected function getTransmissionNumberFile(){
		return sys_get_temp_dir().'/unitedstationers__next_transmission_number';
	}
	



	/**
     * Set options
     * One or more of salesforceWsdl, salesforceUsername, salesforcePassword
     *
     * @param  array $options
     * @return UnitedStationers_Interlinks
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }


	
}