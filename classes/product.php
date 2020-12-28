<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class product
    {
        private $db;
        private $fm;
        
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function show_product(){
            $sp_tungtrang = 5;
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $tungtrang = ($page-1) * $sp_tungtrang;
            $query="SELECT * FROM products ORDER BY id asc LIMIT $tungtrang,$sp_tungtrang"; 
            $result=$this->db->select($query);
            return $result;
        }
        public function show_all_product(){
            $query="SELECT * FROM products ORDER BY id"; 
            $result=$this->db->select($query);
            return $result;
        }
        public function getproductbyId($id)
        {
            $query="SELECT * FROM products where id='$id'   ";
            $result=$this->db->select($query);
            return $result;
        }
        public function del_product($id)
        {
            $query="DELETE FROM products where ID='$id'  ";
            $result=$this->db->delete($query);
            
            if($result)
                {
                    $alert="<span class='success'> Xoá thành công </span>";
                    return $alert;
                }
            else
                {
                    $alert="<span class='error'> Xoá thất bại  </span>";
                    return $alert;
                }
        }
        public function update_product($data,$files,$id)
        {
            $productName= mysqli_real_escape_string($this->db->link,$data['productName']);
            $product_desc= mysqli_real_escape_string($this->db->link,$data['product_desc']);
            $type= mysqli_real_escape_string($this->db->link,$data['type']);
            //check rồi laady hình ảnh
            $permited = array('jpg','jpeg','png','gif');
            $file_name =$_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_temp =$_FILES['image']['tmp_name'];
            $div=explode('.',$file_name);
            $file_ext=strtolower(end($div));
            $unique_image=substr(md5(time()),0,10).'.'.$file_ext;
            $uploaded_image="uploads/".$unique_image;

            if( $productName=="" || $product_desc=="" || $type==""){
				$alert = "<span class='error'>Ko thể để trống</span>";
				return $alert; 
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Kích thước ảnh nhỏ phải nhỏ hơn 2mb!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				    	
				    $alert = "<span class='success'>Có thể tải lên:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE products SET
					title = '$productName',
					status = '$type', 
					image = '$unique_image',
					description = '$product_desc'
					WHERE id = '$id'";
					
				}else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE products SET
					title = '$productName',
					status = '$type', 
					image = '$unique_image',
					description = '$product_desc'
					WHERE id = '$id'";
					
				}
				$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật không thành công</span>";
						return $alert;
					}
				
			}
           
        }
        
    }
?>
