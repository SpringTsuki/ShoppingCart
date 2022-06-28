<?PHP

function generate_code($length = 4)
{
    return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
}

session_start();
$order = $_SESSION['cart'];
$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";
$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
$conn->set_charset("utf-8");

$order_info = array();

$order_user = $_SESSION['user'];
$order_address = $_POST['address'];

foreach ($order as $key) {
    $item_id = $key['id'];
    $order_count = $key['num'];
    $order_id = generate_code();
    $sql =
        "
    insert into orderinfo(order_id,order_user,item_id,order_count,order_address) value
    ('" . $order_id . "','" . $order_user . "','" . $item_id . "','" . $order_count . "','" . $order_address . "');
    ";
    $conn->query($sql);
    array_push($order_info, $order_id);
}
?>

<html>

<head>
    <title>完成订单!</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <a href="index.php">返回主页</a>
    <div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
    <h1 align="center">订单已完成</h1>
    <table width=1000 align="center">
        <tr align="center">
            <th>商品ID</th>
            <th>商品名</th>
            <th>商品单价</th>
            <th>商品数量</th>
            <th>商品总价</th>
        </tr>
        <?PHP foreach ($order as $key) : ?>
            <?PHP foreach ($order_info as $yek) ?>
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
                <td></td>
            </tr>
        <?PHP endforeach; ?>
    </table>
    <div align="center">您的订单号分别为：<?PHP foreach ($order_info as $yek) { echo $yek.";";} ?>请妥善保管.
    </div>
    <div align="center">收货地址：<?PHP echo $order_address ?></div>
</body>

</html>