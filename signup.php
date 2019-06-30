	<?php

	class signup
	{
		//declaring parameters
		private $userName;//from form
		private $email;//from form
		private $regNo;//from form
		private $password;//from form
		private $confpass;//from form
		private $hashedpassword;
		private $hashedconfpass;
		private $time;//time that the acccount was created
		private $connect;
		private $errors;
		private $errors_init;
	     //constructor
		public function __construct( $userName,$email,$regNo,$password,$confpass,$hashedpassword,$hashedconfpass,$time)
		{
			$this->userName=$userName;
			$this->email=$email;
			$this->regNo=$regNo;
			$this->password=$password;
			$this->confpass=$confpass;
			$this->hashedpassword=$hashedpassword;
			$this->hashedconfpass=$hashedconfpass;
			$this->time=$time;

			//importing db class
			require_once('dbconnection.php');
			//signup creates extends dbconnection
			$db=new dbConnect();
			$this->connect=$db->connect();
	}
	//checking if the username is taken
	private function userNameTaken(){

		$query="SELECT * FROM cafe_db.users WHERE username= ?";
		$pre=$this->connect->prepare($query);
		$pre->execute([$this->userName]);
		$rows=$pre->rowCount();

		if ($rows>0) {
   return true;
	 }
	 else{
 	return false;
		}
	}
	//validating registration number
	private function regNoTaken(){

		$query="SELECT * FROM cafe_db.users WHERE regNo= ?";
		$pre=$this->connect->prepare($query);
		$pre->execute([$this->regNo]);
		$rows=$pre->rowCount();

		if ($rows>0) {
    	return true;
			}
			else{

			return false;
		}
	}


       //method that creates new account.
		public function createAccount(){

$unable= new signup($this->userName,$this->email,$this->regNo,$this->password,$this->confpass,$this->hashedpassword,$this->hashedconfpass,$this->time);



						 		if($this->password != $this->confpass){

          echo "<script>alert('Password Do Not Match')</script>";
					echo "<script>window.open('signupPage.php','_self')</script>";

}else
	if($unable->userNameTaken()==true){

			echo"<script>alert('user name already taken!')</script>";
			echo"<script>window.open('signuppage.php','_self')</script>";
	}else
	if($unable->regNoTaken()==true){
		echo"<script>alert('Reg Number already taken!')</script>";
		echo"<script>window.open('signuppage.php','_self')</script>";
	}

	else{

		try {
  			$insert="INSERT INTO cafe_db.users(username,regNo,email,password,day) VALUES ('".$this->userName."','".$this->regNo."','".$this->email."','".$this->hashedpassword."','".$this->time."')";

				//calls connect method in dtabbase connection class and execute the query
				$insert_results=$this->connect->exec($insert);


				//notify success in account creation...Java Script
				echo"<script>alert('Account Created Sucessfully')</script>";
				echo"<script>window.open('loginpage.php','_self')</script>;";
				header("Location: loginpage.php?account created in Successfully");

				} catch (Exception $e) {

			echo "Error ".$e->getMessage();
		}

	}
}
}
	//the action code
	//create the account
	if(isset($_POST['register_btn'])){


		$inuserName=$_POST['username'];
		$inregNo=$_POST['regNo'];
		$inemail=$_POST['email'];
		$inpassword=$_POST['password'];
		$inconfpass=$_POST['confpass'];

	    if(($inuserName=="") ||($inregNo=="")||($inemail=="")||($inpassword=="")|| ($inconfpass =="")){


	        echo "<script>alert('All fields are required')</script>";
	        echo "<script>window.open('signupPage.php','_self')</script>";
	        exit();
}else

				if (strlen(	$inpassword) < 8) {

					echo "<script>alert('Password too short!')</script>";
	        echo "<script>window.open('signupPage.php','_self')</script>";

				}else

				if (!preg_match("#[0-9]+#", $inpassword)) {

					echo "<script>alert('Password must include at least one number!!')</script>";
	        echo "<script>window.open('signupPage.php','_self')</script>";

				}else

				if (!preg_match("#[a-zA-Z]+#", $inpassword)) {

					echo "<script>alert('Password must include at least one letter!')</script>";
	        echo "<script>window.open('signupPage.php','_self')</script>";


				}else
				{
			//hash and salt the passwords
		$hashedinpassword = password_hash($inpassword,PASSWORD_DEFAULT);
		$hashedinconfpass = password_hash($inconfpass,PASSWORD_DEFAULT);

		//get the date and time the account was created
		$timeCreated=date('Y-m-d H:i:s');

	//create the class object and pass in the constructer values in their order
		//$userName,$email,$regNo,$password,$confpass,$hashedpassword,$hashedconfpass,$time
		$myAccount = new signup($inuserName,$inemail,$inregNo,$inpassword,$inconfpass,$hashedinpassword,$hashedinconfpass,$timeCreated);

	//call to the method that create user and pass in values from the html form
		$myAccount->createAccount();
}
}
