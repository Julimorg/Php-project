<?php
//$_GET: Bất kể phương thức nào,PHP sẽ tự 
//động phân tích phần query string này và lưu các 
//giá trị tương ứng vào mảng siêu toàn cục $_GET

//$_POST: PHP sẽ tự động phân tích dữ liệu trong 
//phần body này và lưu trữ các giá trị tương ứng 
//vào mảng $_POST.

function consoleLog($msg) {
	echo '<script type="text/javascript">' .
	  'console.log(' . $msg . ');</script>';
}	


if(!empty($_GET["action"])) 
{
	$restaurantId = isset($_GET['res_id']) ? htmlspecialchars($_GET['res_id']) : '';
	consoleLog($restaurantId);
	// consoleLog(count($_SESSION["cart_item_$restaurantId"]));
	$productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
	$quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

switch($_GET["action"])
 {
	case "add":
		if(!empty($quantity)) { //Nếu có select thì sẽ không vào đây (0 thì vẫn sẽ vào đây những cart sẽ không được cập nhật)
								$stmt = $db->prepare("SELECT * FROM dishes where d_id= ?");
								$stmt->bind_param('i',$productId); 
								//'i': kí tự định dạng dùng để chỉ định kiểu dữ liệu của biến được truyền vào (integer)
								//'s': Cho chuỗi (string)
								//'d': Cho số thực (double)
								//'b': Cho dữ liệu dạng blob (binary data)
								$stmt->execute();
								$productDetails = $stmt->get_result()->fetch_object();
                                $itemArray = array($productDetails->d_id=>array('title'=>$productDetails->title, 'd_id'=>$productDetails->d_id, 'quantity'=>$quantity, 'price'=>$productDetails->price));
					if(!empty($_SESSION["cart_item_$restaurantId"])) //Trong cart hiện tại đang có sản phẩm
					{
						if(in_array($productDetails->d_id,array_keys($_SESSION["cart_item_$restaurantId"]))) 
						{
							foreach($_SESSION["cart_item_$restaurantId"] as $k => $v) //$k là key - $v là value
							{
								if($productDetails->d_id == $k) 
								{
									if(empty($_SESSION["cart_item_$restaurantId"][$k]["quantity"])) //Xem số lượng sản phẩm có tồn tại không
									{
									$_SESSION["cart_item_$restaurantId"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item_$restaurantId"][$k]["quantity"] += $quantity;
								}
							}
						}
						else
						{
								$_SESSION["cart_item_$restaurantId"] = $_SESSION["cart_item_$restaurantId"] + $itemArray;
						}
						// consoleLog($_SESSION["cart_item_$restaurantId"]);
					} 
					else //Trong cart hiện tại đang trống
					{
						$_SESSION["cart_item_$restaurantId"] = $itemArray;
						// consoleLog($_SESSION["cart_item_$restaurantId"]);
					}
			}
			break;
			
	case "remove":
		if(!empty($_SESSION["cart_item_$restaurantId"]))
			{
				foreach($_SESSION["cart_item_$restaurantId"] as $k => $v) 
				{
					if($productId == $v['d_id'])
						unset($_SESSION["cart_item_$restaurantId"][$k]);
				}
			}
			break;
			
	case "empty":
			unset($_SESSION["cart_item_$restaurantId"]);
			break;
			
	case "check":
			consoleLog("Check Out");
			header("location:checkout.php?res_id=$restaurantId");
			break;
	}
}



?>