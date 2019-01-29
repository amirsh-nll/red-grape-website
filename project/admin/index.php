<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"> 
		<title>پنل مدیریت-مجله تفریحی انگور قرمز</title>
		<link rel="stylesheet" href="../raw/css/admin.css" />
		<link rel="stylesheet" href="../raw/css/font-awesome.css">
		<link rel="stylesheet" href="../raw/css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/ico" href="../raw/image/favicon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<?php
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			$username = ltrim(rtrim($_POST['username']));
			$password = ltrim(rtrim($_POST['password']));
			if(empty($username) || empty($password))
			{
				$error=1;
			}
			elseif (strlen($username) > 100 || strlen($password) > 100) {
				$error=2;
			}
			else
			{
				require_once('../system/login.php');
				$login = login($username, $password);
				if($login==1)
				{
					@session_start();
					$_SESSION['login']=1;
					$_SESSION['username']=$username;
					header("location:panel.php?page=home");
				}
				else
				{
					$error=3;
				}
			}
		}
	?>
	<body>
		<div class="login_form">
			<div class="logo"></div>
			<form action="" method="post">
				<table>
					<tr>
						<td><label for="username">نام کاربری:</label></td>
						<td><input maxlength="100" type="text" name="username" id="username" /></td>
					</tr>
					<tr>
						<td><label for="password">رمز عبور:</label></td>
						<td><input maxlength="100" type="password" name="password" id="password" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value=" ورود " /></td>
					</tr>
				</table>
				<?php
					if(isset($error))
					{
						switch ($error) {
							case '1':
								echo '<p style="color:#f00">لطفا فیلد نام کاربری و رمز عبور را کامل پر کنید.</p>';
								break;
							case '2':
								echo '<p style="color:#f00">حداکثر اندازه فیلد نام کاربری و رمز عبور 100 کاراکتر می باشد.</p>';
								break;
							case '3':
								echo '<p style="color:#f00">نام کاربری یا رمزعبور وارد شده اشتباه است.</p>';
								break;
						}
					}
				?>
			</form>
		</div>
	</body>
</html>