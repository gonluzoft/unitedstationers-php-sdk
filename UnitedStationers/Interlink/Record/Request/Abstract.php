<?php


abstract class UnitedStationers_Interlink_Record_Request_Abstract {
	
	private $attributes;

	
	
	public function __construct($attributes = array()){
		$this->attributes = $attributes;
	}
	


	//method to be implemented by all subclasses. It supplies a specific array data formatted to allow output of the data in interlink friendly format
	abstract public function recordFormat();



	
	public function getAttributes(){
		return $this->attributes;
	}
	
	
	public function getDataLength(){
		return strlen("{$this}");
	}
	
	
	
	
	public function __set($name, $value){
		$this->attributes[$name] = $value;
	}
	
	
	public function __get($name){
		
		if(isset($this->attributes[$name])){
			return $this->attributes[$name];
		}
		
		return null;
	}
	
	
	
	
	public function __isset($name){
		return isset($this->attributes[$name]);
	}
	
	
	public function __unset($name){
		
		if(isset($this->attributes[$name])){
			unset($this->attributes[$name]);
		}

	}
	
	
	
	
	public function __toString(){
		
		try{
			
			$recordFormat = $this->recordFormat();
		
			$vsprintfFormatString = '';
			$vsprintfValues = array();
		
			foreach($recordFormat as $recordFormatItem){
				$paddingCharacter = isset($recordFormatItem['paddingCharacter']) ? $recordFormatItem['paddingCharacter'] : ' ';
			
				$vsprintfFormatString .= "%'{$paddingCharacter}{$recordFormatItem['length']}s";
				$vsprintfValues[] = ($this->__get($recordFormatItem['field']) === null) ? @$recordFormatItem['default'] : $this->__get($recordFormatItem['field']);
			}
		
			$output = vsprintf($vsprintfFormatString, $vsprintfValues);
		
			return $output;
		
		}catch(Exception $ex){
			return '';
		}
	}


}

