<?PHP
session_start();
$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";

$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
$conn->set_charset("utf-8");

$list = "select * from itemlist";
$result = $conn->query($list);
$data = $result->fetch_all();
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>
    </title>
</head>

<body>
    <h2 align="center">商品管理界面</h2>
    <a href="logout.php">注销</a>
    <a href="index.php">返回主页</a>
    <div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
    <h3 align="center">添加商品</h3>
    <form action="" method="POST">
        <table width=1200 align="center">
            <tr align="center">
                <td>商品ID <input name="item_id" type="text"></td>
                <td>商品名 <input name="item_name" type="text"></td>
                <td>物品价格 <input name="item_price" type="text"></td>
                <td><input type="submit" value="添加商品"></td>
                <td><?PHP
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $item_id = $_POST['item_id'];
                        $item_name = $_POST['item_name'];
                        $item_price = $_POST['item_price'];

                        $addsql = "insert into itemlist(item_id,item_name,item_price) values
                        ('" . $item_id . "','" . $item_name . "','" . $item_price . "');";
                        if ($conn->query($addsql) == true) {
                            header("location:admin_order.php");
                            echo "添加商品成功";
                        } else {
                            echo "<font color='red'>添加商品失败，请检查商品信息</font>";
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>
    </form>
    <h3 align="center">商品列表</h3>
    <table width=1000 align="center">
        <tr align="center">
            <td>商品ID</td>
            <td>商品名</td>
            <td>商品价格</td>
<!--        <td>移除该商品</td>   --->
        </tr>
        <?PHP foreach ($data as $key) : ?>
            <tr align="center">
                <td><?PHP echo $key[0]; ?></td>
                <td><?PHP echo $key[1]; ?></td>
                <td><?PHP echo $key[2]; ?></td>
<!--            <td>
                    <a class="btn" href="remove_item.php?upd=del&id=<?PHP # echo $key[0]; ?>">+</a>
                </td>   -->
            </tr>
        <?PHP endforeach; ?>
    </table>


</body>

</html>