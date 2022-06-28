<?PHP
session_start()
?>

<html>

<head>
    <title>查询订单</title>
</head>

<body>
    <div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
    <a href="logout.php">注销</a>
    <a href="index.php">返回主页</a>
    <h1 align="center">查询订单：</h1>
    <form atcion="" method="POST">
        <div align="center">请输入订单号：<input type="text" name="search"><input type="submit" value="查询订单"></div>
    </form>
</body>

</html>

<?PHP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['search'];
    $sername = "localhost";
    $serusername = "root";
    $serpassword = "";
    $serdb = "minishop";
    $conn = new mysqli($sername, $serusername, $serpassword, $serdb);
    if (!$conn) {
        echo "连接数据库失败";
    } else {
        $sql =
            "
            select * from orderinfo where order_id = '" . $order_id . "';
        ";
        $result = $conn->query($sql);
        $data = $result->fetch_all();
        if ($data == NULL) {
            echo "<div align='center'>您查询的订单不存在!</div>";
        } else {
            $sql =
                "
            SELECT
	        orderinfo.order_id, 
	        orderinfo.order_user, 
	        orderinfo.item_id, 
	        itemlist.item_name, 
	        orderinfo.order_count, 
	        orderinfo.order_address, 
	        orderinfo.order_result
            FROM
	        orderinfo INNER JOIN itemlist ON orderinfo.item_id = itemlist.item_id INNER JOIN user ON orderinfo.order_user = user.username
            WHERE
	        orderinfo.order_id = '" . $order_id . "';";

            $result = $conn->query($sql);
            $data = $result->fetch_all();
            echo
            "<table width=1000 align='center' border='1'>
            <tr align='center'>
                <td>订单号</td>
                <td>下单人</td>
                <td>商品号</td>
                <td>商品名</td>
                <td>数量</td>
                <td>地址</td>
                <td>处理情况</td>
            </tr>";
            foreach ($data as $key) {
                echo  "<tr align='center'>
                <td>" . $key[0] . "</td>
                <td>" . $key[1] . "</td>
                <td>" . $key[2] . "</td>
                <td>" . $key[3] . "</td>
                <td>" . $key[4] . "</td>
                <td>" . $key[5] . "</td>";

                if ($key[6] == 0) {
                    echo "<td>订单处理中</td></tr>";
                } else {
                    echo "<td>订单已完成</td></tr></table>";
                }
            }
        }
    }
}
?>