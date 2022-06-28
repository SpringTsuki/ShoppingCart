<?PHP
session_start();
?>
<html>
<h1 align="center">管理员页面</h1>
<a href="logout.php">注销</a><br />
<div>欢迎您：<?PHP echo $_SESSION['user'] ?></div>
<table align="center" width=1000 border=1 >
    <tr>
        <td>商品管理界面</td>
        <td><a href="admin_item.php">商品管理界面</a></td>
    </tr>
    <tr>
        <td>订单处理界面</td>
        <td><a href="admin_order.php">订单处理页面</a></td>
    </tr>
</table>

</html>