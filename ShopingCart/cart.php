<?PHP
session_start();
error_reporting(0);
$order = $_SESSION['cart'];

$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";

$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
$conn->set_charset("utf-8");
$sum = array_sum(array_column($order, 'num'));
?>
<html>

<head>
    <title>购物车</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
    <a href="index.php">返回购物列表</a>
    <table width=1000 align="center">
        <tr align="center">
            <th>商品ID</th>
            <th>商品名</th>
            <th>商品单价</th>
            <th>商品数量</th>
            <th>商品总价</th>
            <th>数量调整</th>
        </tr>
        <?PHP foreach ($order as $key) : ?>
            <tr align="center">
                <td>
                <?PHP echo $key['id'];?></td>
                <?PHP
                $sql = "select * from itemlist where item_id = " . $key['id'] . ";";
                $result = $conn->query($sql);
                if ($result == NULL) {
                    continue;
                } else {
                    $data = $result->fetch_all();
                    foreach ($data as $v): {
                        echo "<td>" . $v[1] . "</td>";
                        echo "<td>" . $v[2] . "</td>";
                    }
                    endforeach;
                    echo "<td>" . $key['num'] . "</td>";
                    echo "<td>" . $key['num'] * $v[2];
                }
                ?>
                <td>
                    <a class="btn" href="addcart.php?upd=down&id=<?PHP echo $key['id']; ?>">-</a>
                    <a class="btn" href="addcart.php?upd=up&id=<?PHP echo $key['id']; ?>">+</a>
                </td>
            </tr>
        <?PHP endforeach; ?>
        <tr>
            <td colspan="4" align="right">
                <form action="checkcart.php" method="get">
                    <input type="submit" name="submit" value="购物车结算">
                </form>
            </td>
        </tr>
    </table>
<?PHP
if ($sum == 0) {
    echo "<div>购物车还没有商品!</div>";
} else {
    echo "<div>购物车已有:" . $sum . "件商品</div>";
}
?>
</body>

</html>