<?php include 'inc/header.php';?>

<body>
<div class="center" >
    <table>
        <tr>
            <th>Id</th>
            <th>Thumb</th>
            <th>Title</th>
        </tr>
        <?php        
            $pdlist = $product->show_product();
            if($pdlist){
				$i=0;
                while ($result = $pdlist->fetch_assoc()){
				$i++;
                            
        ?>
        <tr>
            <td><a href="showpost.php?productId=<?php echo $result['id']?>"><?php echo $result['id'] ?></a></td>
            <td><a href="showpost.php?productId=<?php echo $result['id']?>"><img style=" width: 100px; " src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a></td>
            <td><a href="showpost.php?productId=<?php echo $result['id']?>"><?php echo $result['title'] ?></a></td>

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
    <ul class="pagination">
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
    <li class="page-item"><a class="page-link" href="listpost.php?page=<?php echo $current_page-1 ?>"><</a></li>
    <?php
        }
    ?>
    <?php        
            $pdlist = $product->show_all_product();
            $product_count = mysqli_num_rows($pdlist);
            $product_bt = $product_count/5;
            $i = 1;
            for($i; $i <= $product_bt; $i++)
                {
    ?>
    <li class="page-item"><a class="page-link" href="/<?php echo $i ?>.html"><?php echo $i;?></a></li>
    <?php
            }
    ?>
    <?php        
            $pdlist = $product->show_all_product();
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
    <li class="page-item"><a class="page-link" href="listpost.php?page=<?php echo $current_page+1 ?>">></a></li>
    <?php
            }
    ?>
  </ul>
</div>
</body>                 


