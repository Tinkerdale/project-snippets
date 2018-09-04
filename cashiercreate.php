<?php
 class Cashier{

    private $connect;
    private $table_name = "users";

    // object properties
    public $username;
    public $rights;
    public $email;
    public $password;
    public $created;
    public $id;
    public $user="cashier";


    public function __construct($db){
        $this->connect = $db;
    }

    // create product
    function createCashier(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    username=:name, email=:email,password=:password,rights=:rights,created=:created";

        $stmt = $this->connect->prepare($query);

        // posted values
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->rights=htmlspecialchars(strip_tags($this->rights));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->rights=$this->user;
        $this->password=password_hash($this->password,PASSWORD_DEFAULT);;
        // to get time-stamp for 'created' field
        $this->created = date('Y-m-d H:i:s');

        // bind values
        $stmt->bindParam(":name", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
         $stmt->bindParam(":rights", $this->rights);
          $stmt->bindParam(":created", $this->created);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }





}





































?>
