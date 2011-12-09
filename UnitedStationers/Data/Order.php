<?php


class UnitedStationers_Data_Order{
	
	public $id; 
	
	public $accountNumber;

	public $number;
	public $addressLine1;
	public $addressLine2;
	public $addressCity;
	public $addressState;
	public $addressPostalCode;
	
	public $lineItems;
	
	public $indicator;
	
	public $errorCode;
	public $errorMessage;
	
	
	public function __construct(){
		$this->lineItems = array();
	}
	
	
	public function addLineItem($lineItem){
		$this->lineItems[] = $lineItem;
	}
	
}

