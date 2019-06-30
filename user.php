<?php



class User{

	
	public $age = 0;
	private $regno = "";
	public function __construct($age,$regno){
		$this->age = $age ;
		$this->regno = $regno;

	}
	public function getAge(){
		return $this->age;
		
		}
	
	public function getRegno($hint){
		if($hint == "legit"){
			return $this->regno;
		}else{
			return "No permission granted";
		}
		
			
			
}

	/*public __toString(){
		echo 'oop';
	}*/
}


?>