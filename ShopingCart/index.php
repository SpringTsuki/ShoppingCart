<?PHP
session_start();
if (!$_SESSION["user"]) {
    header("location:login.php");
    exit;
}
if ($_SESSION["user"] == "admin") {
    header("location:admin.php");
}

if (empty($_SESSION['cart'])) {
    $order = array();
    $_SESSION['cart'] = $order;
    $sum = 0;
}

if (!empty($_SESSION['cart'])) {
    $order = $_SESSION['cart'];
    $sum = array_sum(array_column($order, 'num'));
}

$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";

$conn = mysqli_connect($sername, $serusername, $serpassword, $serdb);
if (!$conn) {
    echo "连接数据库失败";
}
$conn->set_charset("utf-8");
$list = "select * from itemlist";
$result = $conn->query($list);
$data = $result->fetch_all();

?>
<html>

<head>
    <title>主页</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<table width="900">
    <tr>
        <td width="7%">
            <a href="logout.php">注销</a>
        </td>
        <td width="20%">
            <div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
        </td>
        <td>
            <a href="search.php">查询订单</a>
        </td>
    </tr>
</table>
<table width="900" align="center" border="1">
    <tr>
        <th>商品ID</th>
        <th>商品名</th>
        <th colspan="2">商品单价</th>
    </tr>
    <?PHP foreach ($data as $key) : ?>
        <tr align="center">
            <form action=addcart.php method="POST">
                <td id="item_id_<?PHP echo $i;?>" name="item_id_<?PHP echo $i?>"><?PHP echo $key[0]; ?></td>
                <!--商品ID-->
                <td><?PHP echo $key[1]; ?></td>
                <!--商品名-->
                <td><?PHP echo $key[2]; ?></td>
                <!--商品售价-->
                <td>
                    <a class="btn" href="addcart.php?upd=add&id=<?PHP echo $key[0];?>">+</a>
                </td>
            </form>
        </tr>
    <?PHP endforeach; ?>
</table>
<?PHP
if ($sum == 0) {
    echo "<div>购物车还没有商品!</div>";
} else {
    echo "<div>购物车已有:" . $sum . "件商品</div>";
}
?>
<div><a href="addcart.php?upd=cart">点我去购物车</a></div>

</html>