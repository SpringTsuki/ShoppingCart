<?PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "minishop";
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) {
    echo "连接数据库失败";
}

$createusertable = 
"
create table user (
    username varchar(30) PRIMARY KEY NOT NULL,
    password varchar(30) NOT NULL
)
";
if ($conn->query($createusertable) == true) {
    echo "创建用户数据表成功<br/>";
} else {
    echo "创建用户数据表失败<br/>";
}

$createadmin =
"
insert into user (username,password) values
('admin','123456')
";
if ($conn->query($createadmin) == true ) {
    echo "创建admin用户成功，密码为123456<br/>";
    echo "请自行刷新至主页进行登入操作<br/>";
} else {
    echo "创建admin用户失败<br/>";
}

$create_itemlist_table = "
create table itemlist (
    item_id int PRIMARY KEY NOT NULL,
    item_name varchar(30) NOT NULL,
    item_price float NOT NULL
)
";
if ($conn->query($create_itemlist_table)==true) {
    echo "创建商品信息表成功<br/>";
} else {
    echo "创建商品信息表失败<br/>";
}

$create_default_item_info ="
insert into itemlist (item_id,item_name,item_price) values
('1','iPhone XS','7899')
";
if($conn->query($create_default_item_info)==true) {
	echo "创建默认商品成功<br/>";
} else {
	echo "创建默认商品失败<br/>";
}

$create_orderinfo_table =
"
create table orderinfo (
    order_id varchar(20) PRIMARY KEY,
    order_user varchar(30) NOT NULL,
    item_id int NOT NULL,
    order_count int NOT NULL,
    order_address varchar(70) NOT NULL,
    order_result int default 0,
	
	FOREIGN KEY(order_user) REFERENCES user(username),
	FOREIGN KEY(item_id) REFERENCES itemlist(item_id)
)
";
if ($conn->query($create_orderinfo_table) == true ) {
    echo "创建订单数据表成功<br/>";
} else {
    echo "创建订单数据表失败<br/>";
}

$create_default_order =
"
insert into orderinfo(order_user,item_id,order_count,order_address) values
('admin','1','1','ShangHai')
";
if($conn->query($create_default_order) == true) {
	echo "创建默认订单成功<br/>";
} else {
	echo "创建默认订单失败<br/>";
}

$conn->close();
?>


