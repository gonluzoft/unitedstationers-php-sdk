<?php


class UnitedStationers_Data_Catalog_Item{
	
	
	public $prefix;
	public $stockNumber;
	public $description;
	public $vendor;
	public $inventoryUnit;
	public $listPrice;
	public $listUnitCode;
	public $boxPackQuantity;
	public $boxPackUnitCode;
	public $cartonPackQuantity;
	public $cartonPackUnitCode;
	public $dealerUnitNetPrice;
	public $pricePlan;
	
	public $itemFacilities;
	
	public $errorCode;
	public $errorMessage;
	
	
	public function __construct(){
		$this->itemFacilities = array();
	}
	
	
	public function addItemFacility($itemFacility){
		$this->itemFacilities[] = $itemFacility;
	}
	
	
}