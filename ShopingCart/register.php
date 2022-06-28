<html>
<title>注册</title>
<meta charset="utf-8">
<form action="register.php" method="post" onsubmit="return checkall()">
	<h1>用户注册</h1>
	<table width="900">
		<tr>
			<td width="600">用户名：<input type="text" id="username" name="username" onblur="checkuser()"></td>
		</tr>
		<tr>
			<td id="usernametip">用户名应为英文字母，数字或者下划线，长度为4-16个字符</td>
		</tr>
		<tr>
			<td>密码：<input type="password" id="password" name="password" onblur="checkpwd()"></td>
		</tr>
		<tr>
			<td id="passwordtip">密码由6-16个字母或数字组成</td>
		</tr>
		<tr>
			<td><input type="submit" value="注册"></td>
			<td>
			<?PHP
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$username = $_POST["username"];
				$password = $_POST["password"];

				$sername = "localhost";
				$serusername = "root";
				$serpassword = "";
				$serdb = "minishop";

				$conn = new mysqli($sername, $serusername, $serpassword, $serdb);
				if (!$conn) {
					echo "连接数据库失败";
				} else {
					$insert = "insert into user (username,password) values
					('$username','$password')";

					if ($conn->query($insert) == true) {
						header("refresh:0;url=register_success.php");
					} else {
						echo "<font color=red>该用户名已被注册</font>";
					}
				}
			}
			?>
			</td>
			<td><input type="reset" value="重新填写"></td>
		</tr>
	</table>
</form>

</html>

<script type="text/javascript">
	function $(elementID) {
		return document.getElementById(elementID);
	}

	function checkuser() {
		var userdata = $("username").value;
		var reg = /^\w{4,15}$/;
		var usertip = $("usernametip");
		usertip.innerHTML = "";

		if (reg.test(userdata) == false) {
			usertip.innerHTML = ("<font color=red>用户名非法，用户名应为英文字母，数字或者下划线组成，长度为4-16个字符</font>");
			return false;
		} else {
			usertip.innerHTML = ("用户名填写正确")
			return true;
		}
	}

	function checkpwd() {
		var pwd = $("password").value;
		var pwdtip = $("passwordtip");
		pwdtip.innerHTML = "";
		var reg = /[a-zA-Z0-9]{6,16}$/

		if (reg.test(pwd) == false) {
			pwdtip.innerHTML = "<font color=red>密码格式非法,密码应由6-16个字母与数字组成</font>";
			return false;
		}
		pwdtip.innerHTML = "密码填写正确";
		return true;
	}

	function checkall() {
		if (checkuser() && checkpwd() == true) {
			return true;
		} else {
			checkuser();
			checkpwd();
			return false;
		}
	}
</script>