<?PHP 
session_start();
$upd = $_GET['upd'];
$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";
$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
$conn->set_charset("utf-8");
if($upd == 'del') {
    $del_id = $_GET['id'];
    $delsql = 
    "
    delete from itemlist where item_id = '".$del_id."';
    ";
    if ($conn->query($delsql) == true) {
        header("location:admin_order.php");
    } else {
        echo "<font color='red' align='center'>删除商品失败，原因可能是在订单系统中依旧存在关于该商品的订单.</font></br>";
        echo "<font color='red' align='center'>请处理完所有关于此件商品的订单后，在订单系统内把关于该商品的订单删除后再试.</font></br>";
        echo "<font color='red' align='center'>五秒后跳转回物品界面</font></br>";
        header("refresh:5;location:admin_item.php");  
    }

}
