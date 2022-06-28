<?PHP
$order_id = $_GET['id'];
$hand = $_GET['hand'];
$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";
$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
$conn->set_charset("utf-8");

if($hand == 'yes') {
    $upd = "
    update orderinfo set order_result=1 where order_id = '".$order_id."';
    ";
    if($conn->query($upd) == true) {
        echo "订单已成功完成！";
        header("refresh:3.5;location:admin_handle.php");
    } else {
        echo "订单状态修改失败！";
    }
}
?>