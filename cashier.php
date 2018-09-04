<?php
require_once 'C:\xampp\htdocs\GROUP4\config\dbconnection.php';
require_once 'C:\xampp\htdocs\GROUP4\object\order.php';
require_once 'C:\xampp\htdocs\GROUP4\Cashier\cashlay.php';
$db = new dbConnect();
$database = $db->connect();
$orders = new Order($database);
//fetch all Products
$statement =$orders->readOrders();
$numrow =$statement->rowCount();
 ?>
 <html>

 <script src='https://ajax.googleapis.com/ajax/libs/jquery/jquery/2.2.0/jquery.min.js'>
 </script>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" />






<head>
  <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  </head>

</head>
<body>
<br/><br/>
<div class="container">
  <h3>Search Order</h3>
</br>
<div class="table-responsive">
  <table id="order_table" class="table table-striped table-bordered">
    <thead>
      <tr>
      <td>ID</td>
      <td>User Name</td>
      <td>Created</td>
      <td>Action</td>
    </tr>
    </thead>
    <?php
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
  extract($row);
  echo"<tbody>";

  echo "<tr>";
      echo "<td>{$id}</td>";
      echo "<td>{$user_id}</td>";
      echo "<td>{$created}</td>";
      echo "<td>";
        // read product button

// edit product button
echo "<a href='execute.php?id={$id}' class='btn btn-info left-margin'>";
echo "<span class='glyphicon glyphicon-edit'></span> Exeecute";
echo "</a>";
echo "</td>";

echo "</tr>";
  // code...
}

    ?>
  </table>
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
 $(document).ready(function(){
   $('#order_table').DataTable();
 });


  </script>

</body>
 </html>
 <!--activate data dataTables-->
