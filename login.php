<?php
session_start();

require_once "config/dbconnection.php";

class login extends dbConnect
{
	//parameters to log in
	private $username;
	private $regNo;
	private $password;
	private $row;
	private $rights;
	//constructor that passes in the parameters
	  public function __construct($username,$password)
	{
		$this->username=$username;
		// $this->regNo= $regNo;
		$this->password=$password;

		//instaniating the db connection class


     }

//method that checks the user's authentication
public function validateUser(){
	//checking if  the username or regNo exist

	$query="SELECT * FROM cafe_db.users WHERE  username= ?";
	//prepare db connections
	$pre=$this->connect()->prepare($query);
	//executing the querry
	$pre->execute([$this->username]);
	$row=$pre->rowCount();

	if ($row<1) {
		return false;
		//if the user  is not found in the database
		// echo"<script>alert('username or regNo don't exist')</script>";
		// echo "<script>window.open('loginpage.php)</script>";

}else{

return true;
}}
//if1 the user is found on the database
    public function authenticateUser(){
			$unable=new login($this->username,$this->password);
     // if($rows = $run_query->fetch(PDO::FETCH_ASSOC)) {
						//dehash the password and verify the password

				$dehash=password_verify($this->password,$this->row['password']);
				if($unable->validateUser()==false){
					echo "<script>alert('Enter correct username ')</script>";
					echo "<script>window.open('loginpage.php','_self')</script>";
				}else {

                    $getpassword = "SELECT *FROM  cafe_db.users WHERE username = ?";
                    $rungetpassword = $this->connect()->prepare($getpassword);
                    $rungetpassword->execute([$this->username]);

                    if ($row = $rungetpassword->fetch(PDO::FETCH_ASSOC)) {

                        $getpass = $row['password'];

                        $dehash= password_verify($this->password,$getpass);


                    //if it does not match
                    if ($dehash == false) {

                        //echo some error and open the login window
                        echo "<script>alert('Username or Password Incorrect')</script>";
                        echo "<script>window.open('loginpage.php','_self')</script>";
                    } else if ($dehash == true) {

                        //if passwords match

                        //create sessions

                        $_SESSION['username'] = $row['username'];
                        // $_SESSION['regNo']=$rows['regNo'];
                        $_SESSION['rights'] = $row['rights'];

												if($_SESSION['rights']=='user' ){

													echo "<script> alert('Login Successful session')</script>";
										//	header("url= products.php?msg=logged in Successfully");
											    header('Location:Products.php');
												}
												if($_SESSION['rights']=='admin' ){

													echo "<script> alert('Login Successful session')</script>";
										//	header("url= products.php?msg=logged in Successfully");
											    header('Location:Admin\Allproducts.php');
												}

												if($_SESSION['rights']=='cashier' ){

													echo "<script> alert('Login Successful session')</script>";
										//	header("url= products.php?msg=logged in Successfully");
											    header('Location:Cashier\cashier.php')


												// if(isset($_SESSION['rights'])== 'cashier'){
												//
												// 		echo "<script> alert('Login Successful session')</script>";
												// 	  header("Location:Cashier\cashier.php?msg=logged in Successfully");
												// }
												// if(isset($_SESSION['rights'])== 'user'){
												//
												// 		echo "<script> alert('Login Successful session')</script>";
												// 	  //header("url=products.php?msg=logged in Successfully");
												// 		header('Location: products.php');
												// }









if(isset($_POST['login'])){

	$username=$_POST['uname1'];
	// $regNo=$_POST['regNo'];
	$password=$_POST['password'];

//create an object of the class with its parameters
	$userlogin = new login($username,$password);

//call method to authenticate user with its parameters
	$userlogin->authenticateUser();

}
