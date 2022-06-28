<?PHP 
header("Content-type:text/html;charset=utf-8");


$sername = "localhost";
$serusername = "root";
$serpassword = "";
$serdb = "minishop";

$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
$conn->set_charset("utf-8");
if (!$conn) {
    echo "连接数据库失败";
} else {
    $list = "select * from itemlist where item_id = '1'";
    $result = $conn->query($list);
    $data = $result->fetch_all();
    foreach($data as $v) {
        echo $v[0]."-".$v[1]."-".$v[2];
    }
}

?>