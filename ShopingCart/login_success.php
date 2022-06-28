<html>
<h1>
    <?PHP
    session_start();
    if($_SESSION["user"]=="admin") {
        echo "欢迎您！超级管理员！<br/>";
        echo "正在重定向...！";
        header("refresh:2;url=index.php");
    } else {
        echo "欢迎您！顾客".$_SESSION["user"]."<br/>";
        echo "正在重定向...！";
        header("refresh:2;url=index.php");
    }
    ?>
</h1>
</html>