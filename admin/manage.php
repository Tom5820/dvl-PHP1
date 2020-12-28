<?php include 'inc/header.php';?>
<?php include_once '../classes/product.php';?>
<?php
$pd = new product();
$fm = new Format();
?>
<?php
	
	if(isset($_GET['productId']))
    {
		$id=$_GET['productId'];
		$delpro=$pd->del_product($id);
	}
?>

<body>
<?php
			if(isset($delpro))
            {
                echo $delpro;
            }
        ?>
<input class="button" type="submit" name="submit" Value="New" /> 
<div class="center" >
    <table>
        <tr>
            <th>Id</th>
            <th>Thumb</th>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php        
            $pdlist = $pd->show_product();
            if($pdlist){
				$i=0;
                while ($result = $pdlist->fetch_assoc()){
				$i++;
                            
        ?>
        <tr>
            <td><?php echo $result['id'] ?></td>
            <td><img style=" width: 100px; " src="http://localhost/dvlexc/admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
            <td><?php echo $result['title'] ?></td>
            <td><?php if($result['status']==1)
						{
							echo'enabled';
						}
						else{
							echo'unenabled';
						}
                         ?>
            </td>
            <td><a href="show/<?php echo $result['id']?>.html">Show</a> || <a href="edit/<?php echo $result['id']?>.html">Edit</a> || <a href="?productId=<?php echo $result['id']?>">Delete</a></td>

        </tr>
        <?php 
                }
            }
        ?>
    </table>

<h5>page:</h5>
    <select style ="position: relative;  " id="select" name="type">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="full">All</option>
    </select>
<ul class="pagination" style="position: relative;
          left: 575px;">
    <?php
        
        if(isset($_GET['page']))
        {
            $current_page = $_GET['page'];
        }
        else{
            $current_page = 1;
        }
        if($current_page > 1){
    ?>
    <li class="page-item"><a class="page-link" href="manage/<?php echo $current_page-1 ?>.html"><</a></li>
    <?php
        }
    ?>
    <?php        
            $pdlist = $pd->show_all_product();
            $product_count = mysqli_num_rows($pdlist);
            $product_bt = $product_count/5;
            $i = 1;
            for($i; $i <= $product_bt; $i++)
                {
    ?>
    <li class="page-item"><a class="page-link" href="manage/<?php echo $i ?>.html"><?php echo $i;?></a></li>
    <?php
            }
    ?>
    <?php        
            $pdlist = $pd->show_all_product();
            $product_count = mysqli_num_rows($pdlist);
            $product_bt = $product_count/5;
            if(isset($_GET['page']))
            {
                $current_page = $_GET['page'];
            }
            else{
                $current_page = 1;
            }
            if($current_page+1<=$product_bt)
            {
            
    ?>
    <li class="page-item"><a class="page-link" href="manage/<?php echo $current_page+1 ?>.html">></a></li>
    <?php
            }
    ?>
  </ul>
  </div>
</body>
<?php include 'inc/footer.php';?>
