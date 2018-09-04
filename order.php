<?php
class Order
{
private $connect;
private $table_name="order_tbl";
private $created;

private $user_id;//use session to pick the id
public function __construct($db){
    $this->connect = $db;
}
public function createOrder(){

  $this->created=date('Y-m-d H:i:s');

   // query to insert cart item record
   $query = "INSERT INTO
               " . $this->table_name . "
           SET

               user_id = :user_id,
               created = :created";

               //prepare the $query
               // prepare query statement
               $stmt = $this->connect->prepare($query);

               // sanitize
               $this->user_id=htmlspecialchars(strip_tags($this->user_id));

               // bind values;
               $stmt->bindParam(":user_id", $this->user_id);
               $stmt->bindParam(":created", $this->created);

               // execute query
               if($stmt->execute()){
                   return true;
               }

               return false;


}
  public function readOrders(){
      $query = " SELECT id ,user_id,created FROM ".$this->table_name."";
       $stmt =$this->connect->prepare($query);
       $stmt->execute();
       return $stmt;
   }
   function readOne(){

       $query = "SELECT
                   id, user_id, created
               FROM
                   " . $this->table_name . "
               WHERE
                   id = ?
               LIMIT
                   0,1";

       $stmt = $this->connect->prepare( $query );
       $stmt->bindParam(1, $this->id);
       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       $this->id = $row['id'];
       $this->user_id = $row['user_id'];
       $this->created = $row['created'];
   }
   function execute(){

       $query = " DELETE  FROM " . $this->table_name . " WHERE id = ?";

       $stmt = $this->connect->prepare($query);
       $stmt->bindParam(1, $this->id);

       if($result = $stmt->execute()){
           return true;
       }else{
           return false;
       }

}




}




?>
