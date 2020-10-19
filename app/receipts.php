<?php
session_start();
require_once('inc/config/constants.php');
require_once('inc/config/db.php');
$id=$_GET['id'];
$myQuery="SELECT * FROM sale WHERE customerID=:customerID";
$stmt=$conn->prepare($myQuery);
$stmt->bindParam(':customerID',$id);
$stmt->execute();
$data=$stmt->fetchAll();
foreach ($data as $row) {
  // code...
  $customerName=$row['customerName'];
  $itemName=$row['itemName'];
  $saleDate=$row['saleDate'];
  $discount=$row['discount'];
  $quantity=$row['quantity'];
  $unitPrice=$row['unitPrice'];
  $total=$quantity * $unitPrice;
  if ($discount!=0) {
    // code...
    $dis=$total*($discount / 100);
    $paid=$total-$dis;
  }else {
    $paid=$total;
  }

}

 ?>
 <?php require_once('inc/header.html'); ?>
   <body>
     <div class="container">
       <div class="row">
         <div class="col-md-12" align="center">
         <h4>Mathai Warehouse Invoice</h4>
         <p>Date Issued: <?php echo date('Y/m/d') ;?></p>
         <p>Served by: <?php echo $_SESSION['fullName'] ?></p>
          </div>
       </div>
       <table class="table">
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">Customer Name</th>
       <th scope="col">Item Name</th>
       <th scope="col">Date Sold</th>
       <th scope="col">Discount</th>
       <th scope="col">Quantity</th>
       <th scope="col">Unit Price</th>
       <th scope="col">Due Total</th>
       <th scope="col">Paid</th>
     </tr>
   </thead>
   <tbody>
     <tr>
       <th scope="row"><?php echo $id; ?></th>
       <td><?php echo $customerName; ?></td>
       <td><?php echo $itemName; ?></td>
       <td><?php echo $saleDate; ?></td>
       <td><?php echo $discount; ?></td>
       <td><?php echo $quantity; ?></td>
       <td><?php echo $unitPrice; ?></td>
       <td><?php echo $total; ?></td>
       <td><?php echo $paid;; ?></td>

     </tr>
   </tbody>
 </table>
 <button  onclick="window.print();" type="button" class="btn" name="button">Print Receipt</button>
     </div>
   </body>
   <?php require_once('inc/header.html'); ?>
