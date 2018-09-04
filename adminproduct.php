<?php
class Products{

    // database connection and table name
    private $connect;
    private $table_name = "products";

    // object properties
    public $id;
    public $name;
    public $price;
    public $quantity;
    public $description;
    public $category_id;
    public $timestamp;
    public $image;

    public function __construct($db){
        $this->connect = $db;
    }

    // create product
    function create(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, price=:price,quantity=:quantity,
                     description=:description, category_id=:category_id, created=:created";

        $stmt = $this->connect->prepare($query);

        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
      //  $this->image=htmlspecialchars(strip_tags($this->image));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));

        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
      //  $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":created", $this->timestamp);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
    //create  read all code
   public function readAll($from_record_num,$records_per_page){
       $query = " SELECT id ,name,description,price,quantity,category_id FROM ".$this->table_name."
        ORDER BY id ASC LIMIT {$from_record_num},{$records_per_page}";
        $stmt =$this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // used for paging products
public function countAll(){

    $query = "SELECT id FROM " . $this->table_name . "";

    $stmt = $this->connect->prepare( $query );
    $stmt->execute();

    $num = $stmt->rowCount();

    return $num;
}
//reading products
function readOne(){

    $query = "SELECT
                name, price, description, category_id,quantity
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

    $this->name = $row['name'];
    $this->price = $row['price'];
    $this->quantity = $row['quantity'];
    //$this->image = $row['image'];
    $this->description = $row['description'];
    $this->category_id = $row['category_id'];
}
function update(){

    $query = "UPDATE
                ". $this->table_name ."
            SET
                name = :name,
                price = :price,
                quantity=:quantity,
                description = :description,
                category_id  = :category_id
            WHERE
                id = :id ";

    $stmt = $this->connect->prepare($query);

    // posted values
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->quantity=htmlspecialchars(strip_tags($this->quantity));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind parameters
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':quantity', $this->price);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':category_id', $this->category_id);
    $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }

    return false;

}
// delete the product
function delete(){

    $query = " DELETE  FROM " . $this->table_name . " WHERE id = ?";

    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
//create image
// will upload image file to server
function uploadPhoto(){

    $result_message="";

    // now, if image is not empty, try to upload the image
    if($this->image){

        // sha1_file() function is used to make a unique file name
        $target_directory = "uploads/";
        $target_file = $target_directory . $this->image;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

        // error message is empty
        $file_upload_error_messages="";
        // make sure that file is a real image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check!==false){
    // submitted file is an image
}else{
    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
}

// make sure certain file types are allowed
$allowed_file_types=array("jpg", "jpeg", "png", "gif");
if(!in_array($file_type, $allowed_file_types)){
    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
}

// make sure file does not exist
if(file_exists($target_file)){
    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
}

// make sure submitted file is not too large, can't be larger than 1 MB
if($_FILES['image']['size'] > (1024)){
    $file_upload_error_messages.="<div>Image must be less than 5 MB in size.</div>";
}

// make sure the 'uploads' folder exists
// if not, create it
if(!is_dir($target_directory)){
    mkdir($target_directory, 0777, true);
}

    }

    return $result_message;
    // if $file_upload_error_messages is still empty
if(empty($file_upload_error_messages)){
    // it means there are no errors, so try to upload the file
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        // it means photo was uploaded
    }else{
        $result_message.="<div class='alert alert-danger'>";
            $result_message.="<div>Unable to upload photo.</div>";
            $result_message.="<div>Update the record to upload photo.</div>";
        $result_message.="</div>";
    }
}

// if $file_upload_error_messages is NOT empty
else{
    // it means there are some errors, so show them to user
    $result_message.="<div class='alert alert-danger'>";
        $result_message.="{$file_upload_error_messages}";
        $result_message.="<div>Update the record to upload photo.</div>";
    $result_message.="</div>";
}
}

}
?>
