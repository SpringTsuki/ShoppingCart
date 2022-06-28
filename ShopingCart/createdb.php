<?PHP
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    echo "连接失败";
}

$sql = "create database minishop";
if ($conn->query($sql) == true) {
    echo "数据库创建成功";
} else {
    echo "数据库创建失败";
}
$conn->close();
?>