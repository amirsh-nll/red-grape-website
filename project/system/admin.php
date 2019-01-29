<?php
	function author_id($username)
	{
		if(empty($username))
		{
			header("location:../admin/panel.php?page=home");
		}
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_user` WHERE `username`='" . $username . "'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$id = $my_result['id'];
			}

			$result = $id;
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function new_post($title, $content, $create_time, $image_file, $category_id, $refrence_title, $refrence_url, $author_id)
	{
		if(empty($title) || empty($content) || empty($create_time) || empty($category_id) || empty($author_id))
		{
			header("location:../admin/panel.php?page=new_post");
		}
		require_once('database.php');
		$connection = connect();
		$title = mysql_real_escape_string($title);
		$content = mysql_real_escape_string($content);
		$create_time = mysql_real_escape_string($create_time);
		$image_file = mysql_real_escape_string($image_file);
		$category_id = mysql_real_escape_string($category_id);
		$refrence_title = mysql_real_escape_string($refrence_title);
		$refrence_url = mysql_real_escape_string($refrence_url);
		$author_id = mysql_real_escape_string($author_id);

		$query = "INSERT INTO `tbl_post`(`title`, `content`, `create_time`, `image_file`, `category_id`, `refrence_title`, `refrence_url`, `author_id`) VALUES ('" . $title . "', '" . $content . "', '" . $create_time . "', '" . $image_file . "', '" . $category_id . "', '" . $refrence_title . "', '" . $refrence_url . "', '" . $author_id . "')";
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
	function single_post($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=list_post");
		}
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post` WHERE `id`='" . $id . "'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$data['title'] = $my_result['title'];
				$data['content'] = $my_result['content'];
				$data['category_id'] = $my_result['category_id'];
				$data['image_file'] = $my_result['image_file'];
				$data['refrence_title'] = $my_result['refrence_title'];
				$data['refrence_url'] = $my_result['refrence_url'];
			}

			$result = $data;
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function list_post()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post`";
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
	function edit_post($id, $title, $content, $category_id, $refrence_title, $refrence_url, $image_file)
	{
		if(empty($title) || empty($content) || empty($category_id))
		{
			header("location:../admin/panel.php?page=list_post");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);
		$title = mysql_real_escape_string($title);
		$content = mysql_real_escape_string($content);
		$category_id = mysql_real_escape_string($category_id);
		$refrence_title = mysql_real_escape_string($refrence_title);
		$refrence_url = mysql_real_escape_string($refrence_url);
		$image_file = mysql_real_escape_string($image_file);
		if($image_file=="unknown.png" || $image_file==" ")
		{
			$query = "UPDATE `tbl_post` SET `title`='" . $title . "',`content`='" . $content . "', `category_id`='" . $category_id . "', `refrence_title`='" . $refrence_title . "', `refrence_url`='" . $refrence_url . "' WHERE `id`='" . $id . "'";
		}
		else
		{
			$query = "UPDATE `tbl_post` SET `title`='" . $title . "',`content`='" . $content . "', `image_file`='" . $image_file . "',`category_id`='" . $category_id . "', `refrence_title`='" . $refrence_title . "', `refrence_url`='" . $refrence_url . "' WHERE `id`='" . $id . "'";
		}
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
	function delete_post($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=list_post");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);

		$query = "DELETE FROM `tbl_post` WHERE `id`='" . $id . "'";
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
	function new_category($name)
	{
		if(empty($name))
		{
			header("location:../admin/panel.php?page=category");
		}
		require_once('database.php');
		$connection = connect();
		$name = mysql_real_escape_string($name);

		$query = "INSERT INTO `tbl_category`(`name`) VALUES ('" . $name . "')";
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
	function single_category($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=category");
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
	function edit_category($id, $name)
	{
		if(empty($name))
		{
			header("location:../admin/panel.php?page=category");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);
		$name = mysql_real_escape_string($name);

		$query = "UPDATE `tbl_category` SET `name`='" . $name . "' WHERE `id`='" . $id . "'";
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
	function delete_category($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=category");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);

		$query = "DELETE FROM `tbl_category` WHERE `id`='" . $id . "'";
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
	function new_link($title, $url)
	{
		if(empty($title) || empty($url))
		{
			header("location:../admin/panel.php?page=link");
		}
		require_once('database.php');
		$connection = connect();
		$title = mysql_real_escape_string($title);
		$url = mysql_real_escape_string($url);

		$query = "INSERT INTO `tbl_link`(`title`, `url`) VALUES ('" . $title . "', '" . $url . "')";
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
	function single_link($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=link");
		}
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_link` WHERE `id`='" . $id . "'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$data['title'] = $my_result['title'];
				$data['url'] = $my_result['url'];
			}

			$result = $data;
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
	function edit_link($id, $title, $url)
	{
		if(empty($title) || empty($url))
		{
			header("location:../admin/panel.php?page=link");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);
		$title = mysql_real_escape_string($title);
		$url = mysql_real_escape_string($url);

		$query = "UPDATE `tbl_link` SET `title`='" . $title . "', `url`='" . $url . "' WHERE `id`='" . $id . "'";
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
	function delete_link($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=link");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);

		$query = "DELETE FROM `tbl_link` WHERE `id`='" . $id . "'";
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
	function list_comment()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_comment`";
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
	function accept_comment($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=comment");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);

		$query = "UPDATE `tbl_comment` SET `view`='1' WHERE `id`='" . $id . "'";
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
	function unaccept_comment($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=comment");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);

		$query = "UPDATE `tbl_comment` SET `view`='0' WHERE `id`='" . $id . "'";
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
	function delete_comment($id)
	{
		if(empty($id))
		{
			header("location:../admin/panel.php?page=comment");
		}
		require_once('database.php');
		$connection = connect();
		$id = mysql_real_escape_string($id);

		$query = "DELETE FROM `tbl_comment` WHERE `id`='" . $id . "'";
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
	function top_view_post()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post` ORDER BY `view` DESC LIMIT 5";
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
	function top_comment_post()
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post`";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			$i=0;
			foreach ($result as $my_result) {
				$data[$i] = $my_result;
				$data[$i]['comment_count'] = single_post_count($my_result['id']);
				$i+=1;
			}
			$data = array_sort($data, 'comment_count', SORT_DESC);
			$result = $data;
			return $result;
		}
		else
		{
			return 0;
		}
	}
	function single_post_count($post_id)
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_comment` WHERE `post_id`='" . $post_id . "'";
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
	function array_sort($array, $on, $order = SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();
	    if (count($array) > 0)
	    {
	        foreach ($array as $k => $v)
	        {
	            if (is_array($v))
	            {
	                foreach ($v as $k2 => $v2)
	                {
	                    if ($k2 == $on)
	                    {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else
	            {
	                $sortable_array[$k] = $v;
	            }
	        }
	        switch ($order)
	        {
	            case SORT_ASC:
	                asort($sortable_array);
	                break;
	            case SORT_DESC:
	                arsort($sortable_array);
	                break;
	        }
	        foreach ($sortable_array as $k => $v)
	        {
	            $new_array[$k] = $array[$k];
	        }
	    }
	    return $new_array;
	}

	function change_password($old_password, $new_password, $new_repassword)
	{
		if(empty($old_password) || empty($new_password) || empty($new_repassword))
		{
			header("location:../admin/index.php");
		}
		require_once('database.php');
		$connection = connect();
		$old_password =  md5(mysql_real_escape_string($old_password));
		$new_password = md5(mysql_real_escape_string($new_password));
		$new_repassword = md5(mysql_real_escape_string($new_repassword));

		$query = "SELECT * FROM `tbl_user`";
		$result = mysqli_query($connection, $query);
		foreach ($result as $my_result) {
			if($my_result['password']==$old_password)
			{
				$query = "UPDATE `tbl_user` SET `password`='" . $new_password ."' WHERE `id`='1'";
				$result = mysqli_query($connection, $query);
				if($result==1)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return -1;
			}
		}
	}

	function view_post_on_special_time($id, $start)
	{
		require_once('database.php');
		$connection = connect();

		$query = "SELECT * FROM `tbl_post_view` WHERE `post_id`=$id AND `time`>$start";
		$result = mysqli_query($connection, $query);
		
		if(mysqli_num_rows($result)>0)
		{
			$i=0;
			foreach ($result as $my_result) {
				$i+=1;
			}
			return $i;
		}
		else
		{
			return 0;
		}
	}
?>