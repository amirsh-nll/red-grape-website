<?php
	function login($username, $password)
	{
		if(empty($username) || empty($password))
		{
			header("location:../admin/index.php");
		}
		require_once('database.php');
		$connection = connect();
		$username = mysql_real_escape_string($username);
		$password = md5(mysql_real_escape_string($password));

		$query = "SELECT * FROM `tbl_user`";
		$result = mysqli_query($connection, $query);
		foreach ($result as $my_result) {
			if($my_result['username']==$username && $my_result['password']==$password)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}
?>