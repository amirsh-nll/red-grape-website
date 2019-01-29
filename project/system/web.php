<?php
	function author_username($id)
	{
		if(empty($id))
		{
			header("location:../index.php");
		}
		else
		{
			$id = mysql_real_escape_string($id);
		}
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_user` WHERE `id`='" . $id . "'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$username = $my_result['username'];
			}

			$result = $username;
			return $result;
		}
		else
		{
			return 0;
		}
	}

	function list_post($page=1)
	{
		require_once('database.php');
		$connection = connect();

		if(empty($page) || !is_numeric($page))
		{
			$page=1;
		}
		else
		{
			$page = mysql_real_escape_string($page);
		}

		if($page==1)
		{
			$start = 1;
			$count = 10;
			$query = "SELECT * FROM `tbl_post` ORDER BY id DESC LIMIT 10";
		}
		else
		{
			$start = (($page-1)*10)+1;
			$count = 10;
			$query = "SELECT * FROM `tbl_post` ORDER BY id DESC LIMIT $start, $count";
		}

		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function last_list_post()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post` LIMIT 5";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function count_post()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post`";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			$count = 0;
			foreach ($result as $my_result) {
				$count+=1;
			}

			$result = $count;
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function single_post($id)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("location:../index.php");
		}
		else
		{
			$id = mysql_real_escape_string($id);
		}
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post` WHERE `id`='" . $id . "'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$data['id'] = $my_result['id'];
				$data['title'] = $my_result['title'];
				$data['content'] = $my_result['content'];
				$data['create_time'] = $my_result['create_time'];
				$data['image_file'] = $my_result['image_file'];
				$data['category_id'] = $my_result['category_id'];
				$data['author_id'] = $my_result['author_id'];
				$data['refrence_title'] = $my_result['refrence_title'];
				$data['refrence_url'] = $my_result['refrence_url'];
				$data['view'] = $my_result['view'] + 1;
			}

			$query = "UPDATE `tbl_post` SET `view`='" . $data['view'] . "' WHERE `id`='" . $id . "'";
			$result = mysqli_query($connection, $query);

			$result = $data;
			add_view_post($id);
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function category_post($id)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("location:../index.php");
		}
		else
		{
			$id = mysql_real_escape_string($id);
		}
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post` WHERE `category_id`='" . $id . "' ORDER BY id DESC LIMIT 10";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function list_category()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_category` WHERE `id`>'1'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function single_category($id)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("location:index.php");
		}
		else
		{
			$id = mysql_real_escape_string($id);
		}
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_category` WHERE `id`='" . $id . "'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$name = $my_result['name'];
			}

			$result = $name;
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function list_link()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_link`";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function count_link()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_link`";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			$count = 0;
			foreach ($result as $my_result) {
				$count+=1;
			}
			
			$result = $count;
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function count_comment()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_comment`";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			$count = 0;
			foreach ($result as $my_result) {
				$count+=1;
			}
			
			$result = $count;
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function word_limiter($str, $limit = 100, $end_char = '&#8230;')
	{
		if (trim($str) === '')
		{
			return $str;
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

		if (strlen($str) === strlen($matches[0]))
		{
			$end_char = '';
		}

		return rtrim($matches[0]).$end_char;
	}
	function new_comment($post_id, $name, $email, $content)
	{
		if(empty($name) || empty($email) || empty($content))
		{
			header("location:../index.php");
		}
		require_once('database.php');
		$connection = connect();
		$name = mysql_real_escape_string($name);
		$email = mysql_real_escape_string($email);
		$content = mysql_real_escape_string($content);

		$query = "INSERT INTO `tbl_comment`(`post_id`, `view`, `name`, `email`, `content`) VALUES ('" . $post_id . "', '0', '" . $name . "', '" . $email . "', '" . $content . "')";
		$result = mysqli_query($connection, $query);
		if($result)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function list_comment($post_id)
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_comment` WHERE `post_id`='" . $post_id . "' AND `view`='1'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function comment_count_post($post_id)
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_comment` WHERE `post_id`='" . $post_id . "'";
		$result = mysqli_query($connection, $query);
		
		return mysqli_num_rows($result);
	}
	function post_view_count()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post`";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			$data = 0;
			foreach ($result as $my_result) {
				$data+=$my_result['view'];
			}
			
			$result = $data;
			return $result;
		}
		else
		{
			return 0;
		}
	}

	function add_view_post($id)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("location:index.php");
		}
		else
		{
			$id = mysql_real_escape_string($id);
		}
		require_once('database.php');
		$connection = connect();

		$query = "INSERT INTO `tbl_post_view`(`post_id`, `time`) VALUES ('" . $id . "', '" . time() . "')";
		$result = mysqli_query($connection, $query);
	}
?>