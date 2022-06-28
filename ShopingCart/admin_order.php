<?PHP
session_start();
$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";
$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
if (!$conn) {
    echo "连接数据库失败";
} 

?>


<html>

<head>
    <title>处理订单</title>
</head>

<body>
    <div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
    <a href="logout.php">注销</a>
    <a href="index.php">返回主页</a>
    <h1 align="center">处理订单：</h1>
    <table width=1000 align='center' border='1'>
            <tr align='center'>
                <td>订单号</td>
                <td>下单人</td>
                <td>商品号</td>
                <td>商品名</td>
                <td>数量</td>
                <td>地址</td>
                <td>处理情况</td>
            </tr>
        <?PHP
        $sql =
        "
        select * from orderinfo;
        ";
        $result = $conn->query($sql);
        $data = $result->fetch_all();
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
	        orderinfo INNER JOIN itemlist ON orderinfo.item_id = itemlist.item_id INNER JOIN user ON orderinfo.order_user = user.username;";
        $result = $conn->query($sql);
        $data = $result->fetch_all();
        foreach ($data as $key):
            echo  "<tr align='center'>
            <td>" . $key[0] . "</td>
            <td>" . $key[1] . "</td>
            <td>" . $key[2] . "</td>
            <td>" . $key[3] . "</td>
            <td>" . $key[4] . "</td>
            <td>" . $key[5] . "</td>";
            
?>
        <td>
        <?PHP
        if ($key[6] == 0) {
            echo "<a href='admin_handle.php?hand=yes&id=".$key[0]."'>处理订单</a>";
        } else {
            echo "订单已完成";
        }
        endforeach;
        ?>
        </td>
    </table>
</body>
</html>