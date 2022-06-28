<?PHP
session_start();
$order = $_SESSION['cart'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (array_sum(array_column($order, 'num')) == 0) {
        header("location:warning.php");
    }
}
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
    <title>结算</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <a href="cart.php">返回购物车</a>
    <div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
    <h1 align="center">确认订单</h1>
    <table width=1000 align="center">
        <tr align="center">
            <th>商品ID</th>
            <th>商品名</th>
            <th>商品单价</th>
            <th>商品数量</th>
            <th>商品总价</th>
        </tr>
        <?PHP foreach ($order as $key) : ?>
            <tr align="center">
                <td>
                    <?PHP echo $key['id']; ?></td>
                <?PHP
                $sql = "select * from itemlist where item_id = " . $key['id'] . ";";
                $result = $conn->query($sql);
                if ($result == NULL) {
                    continue;
                } else {
                    $data = $result->fetch_all();
                    foreach ($data as $v) : {
                            echo "<td>" . $v[1] . "</td>";
                            echo "<td>" . $v[2] . "</td>";
                        }
                    endforeach;
                    echo "<td>" . $key['num'] . "</td>";
                    echo "<td>" . $key['num'] * $v[2];
                }
                ?>
            </tr>
        <?PHP endforeach; ?>
    </table>
    <form action="upload.php" method="POST">
    <table width=1200 align="center">
        <tr align="center">
            <td>请填写地址:<input type="text" name="address" id="address"><br/>确认下单后即订单已确认，请慎重填写地址！</td>
        </tr>
        <tr align="center">
            <td><input type="submit" value="确认下单"></td>
    </table>
    </form>
</body>

</html>