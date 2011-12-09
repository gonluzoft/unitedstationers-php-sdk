<?php

class UnitedStationers_Interlink_Record_Request {
	
	public static function factoryByType($type, $attributes=array()){
		
		$className = "UnitedStationers_Interlink_Record_Request_$type";
		try{
			return new $className($attributes);
		}catch(Exception $ex){
			throw new Exception("Class of, 'UnitedStationers_Interlink_Record_Request_$type', not found!");
		}
	}
}