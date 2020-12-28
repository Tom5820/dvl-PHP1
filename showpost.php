<?php include 'inc/header.php';?>
<?php 
	if(!isset($_GET['productId']) || $_GET['productId'] == NULL){
        echo "<script> window.location = '404.php' </script>";
        
    }else {
        $id = $_GET['productId']; // Lấy productid trên host
    }
?>
<body>
<div class="center" >
<?php        
            $get_pd = $product->getproductbyId($id);
            if($get_pd){
                while ($result = $get_pd->fetch_assoc()){
        ?>
    <h1><?php echo $result['title'] ?></h1>
    <?php
                }
            }
    ?>
    <table>
        <tr>
            <th>Thumb</th>
            <th>Description</th>
        </tr>
        <?php        
            $get_pd = $product->getproductbyId($id);
            if($get_pd){
                while ($result = $get_pd->fetch_assoc()){
                            
        ?>
        <tr>
            <td><img style=" width: 100px; " src="http://localhost/dvlexc/admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
            <td><?php echo $result['description'] ?></td>
        </tr>
        <?php 
                }
            }
        ?>
    </table>
</div>
</body>