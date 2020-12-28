<?php include 'inc/header.php';?>
<?php include_once '../classes/product.php';?>
<?php
$pd = new product();
?>
<?php
    if(isset($_GET['productId'])||$_GET['productId']!=NULL)
    {
        $id=$_GET['productId'];
    }
	$pd=new product();
	if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['submit']))
	{
		$updateProduct  =$pd->update_product($_POST,$_FILES,$id);
	}
?>
<div class="center" >

        <h2>Sửa sản phẩm </h2>   
        <?php
			if(isset($updateProduct))
                {
                    echo $updateProduct;
                }
		?> 
        <?php
            $get_product_by_id=$pd->getproductbyId($id);
            if($get_product_by_id)
			{
                while($result_product=$get_product_by_id->fetch_assoc())
                {
			
        ?>
        <form action="" method="post" enctype="multipart/form-data">  
        <table>
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_product['title'] ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Miêu tả</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce" style="width: 583px; height: 116px;"> <?php echo $result_product['description'] ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tải ảnh</label>
                    </td>
                    <td>
                        <image src="http://localhost/dvlexc/admin/uploads/<?php echo $result_product['image'] ?>" width="120" >
                        <input type="file" name ="image"  />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Chọn loại</option>
                            <?php
                                if($result_product['status'] == 1)
                                {
                            ?>
                                    <option selected value="1">enabled</option>
                                    <option value="0">unenabled</option>
                            <?php
                                }
                                else
                                {
                            ?>   
                            <option value="1">enabled</option>
                            <option selected value="0">unenabled</option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                </table>
                <input class="button" style = " position: relative;left:700px;" type="submit" name="submit" Value="Submit" />    
            </form>
            <?php
                }
            }
            ?>


</div>