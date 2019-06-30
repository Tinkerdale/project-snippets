<?php
require_once('index.php');
//session_start();

class login
{
	//parameters to log in
	private $username;
	private $regNo;
	private $password;
	private $row;
	private $connect;
	//constructor that passes in the parameters
	  public function __construct($username,$password)
	{
		$this->username=$username;
		// $this->regNo= $regNo;
		$this->password=$password;

		require_once('dbconnection.php');
		//instaniating the db connection class
		$db=new dbConnect();
		$this->connect=$db->connect();
     }

//method that checks the user's authentication
public function validateUser(){
	//checking if  the username or regNo exist

	$query="SELECT * FROM cafe_db.users WHERE  username= ?";
	//prepare db connections
	$pre=$this->connect->prepare($query);
	//executing the querry
	$pre->execute([$this->username]);
	$row=$pre->rowCount();

	if ($row<1) {
		return true;
		//if the user  is not found in the database
		// echo"<script>alert('username or regNo don't exist')</script>";
		// echo "<script>window.open('loginpage.php)</script>";

}else{

return false;
}}
//if the user is found on the database
    public function authenticateUser(){
			$unable=new login($this->username,$this->password);
     // if($rows = $run_query->fetch(PDO::FETCH_ASSOC)) {
						//dehash the password and verify the password

				$dehash=password_verify($this->password,$this->row['password']);
				if($unable->validateUser()==false){
					echo "<script>alert('Enter correct username ')</script>";
					echo "<script>window.open('loginpage.php','_self')</script>";
				}else {



							//if it does not match
							if($dehash==false){

										//echo some error and open the login window
									echo "<script>alert('Username or Password Incorrect')</script>";
									echo "<script>window.open('loginpage.php','_self')</script>";
							}
							else if($dehash==true){

									//if passwords match

								//create sessions

							$_SESSION['username']=$row['username'];
							// $_SESSION['regNo']=$rows['regNo'];
							$_SESSION['id']=$row['id'];
							//show some success nofication and open the index window
							echo "<script>alert('Login Successful')</script>";
							header("Location: index.php?msg=logged in Successfully");

							}
					}

}
}

if(isset($_POST['Login_btn'])){

	$username=$_POST['username'];
	// $regNo=$_POST['regNo'];
	$password=$_POST['password'];

//create an object of the class with its parameters
	$userlogin = new login($username,$password);

//call method to authenticate user with its parameters
	$userlogin->authenticateUser($username,$password);

}
