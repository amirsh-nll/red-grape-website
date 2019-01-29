<?php
	function view_up()
	{
		require_once('database.php');
		$connection = connect();
		$query = "SELECT * FROM `tbl_view` WHERE 1";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$today = $my_result['today'];
				$yesterday = $my_result['yesterday'];
				$total = $my_result['total'];
				$last = $my_result['last'];
			}

			$now = date('y') . date('n') . date('j');
			if($last==$now)
			{
				$today = $today+1;
				$total = $total+1;
				$query = "UPDATE `tbl_view` SET `today`='" . $today . "', `total`='" . $total . "' WHERE 1";
			}
			else
			{
				$yesterday = $today;
				$today = 1;
				$total = $total+1;
				$last =  date('y') . date('n') . date('j');
				$query = "UPDATE `tbl_view` SET `today`='" . $today . "',`yesterday`='" . $yesterday . "',`total`='" . $total . "',`last`='" . $last . "' WHERE 1";
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
	}
	function read_view()
	{
		require_once('database.php');
		$connection = connect();
		$query = "SELECT * FROM `tbl_view` WHERE 1";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$data['today'] = $my_result['today'];
				$data['yesterday'] = $my_result['yesterday'];
				$data['total'] = $my_result['total'];
				$data['last'] = $my_result['last'];
			}
			$result = $data;
			return $result;
		}
		else
		{
			return 0;
		}
	}
?>