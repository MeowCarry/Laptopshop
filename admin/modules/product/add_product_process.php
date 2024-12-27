<?php
   require_once "../../../config/db.php";
   $conn = initConnection();
   $prd_name = $_POST['prd_name'];
   $prd_price = $_POST['prd_price'];
   $prd_warranty = $_POST['prd_warranty'];
   $prd_accessories = $_POST['prd_accessories'];
   $prd_promotion = $_POST['prd_promotion'];
   $prd_new = $_POST['prd_new'];
   $cat_id = $_POST['cat_id'];
   $prd_status = $_POST['prd_status'];
   $prd_details = $_POST['prd_details'];
   if(isset($_POST['prd_featured'])) {
        $prd_featured = 1;
   }else{
        $prd_featured = 0;
   }

   if(isset($_FILES['prd_image']['name'])) {
       $file_name = $_FILES['prd_image']['name'];
       $file_tmp_name = $_FILES['prd_image']['tmp_name'];
       move_uploaded_file($file_tmp_name, '../../../upload/product/'.$file_name);
   }

   $sqlInsert = "INSERT INTO product(prd_name,prd_price,prd_warranty,prd_accessories,prd_promotion,prd_new,cat_id,prd_status,prd_details,prd_featured,prd_image)
                VALUES('$prd_name','$prd_price','$prd_warranty','$prd_accessories','$prd_promotion','$prd_new','$cat_id','$prd_status','$prd_details','$prd_featured','$file_name')";
   $queryInsert = mysqli_query($conn, $sqlInsert);
   header("location:../../index.php?page=product");
?>