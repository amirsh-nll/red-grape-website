<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="comment")
	{
		header("location:panel.php?page=home");
	}

	if(isset($_GET['accept_id']))
	{
		$accept_id = ltrim(rtrim($_GET['accept_id']));
		if(empty($accept_id) || !is_numeric($accept_id))
		{
			$error=1;
		}
		else
		{
			$accept_comment = accept_comment($accept_id);
			if($accept_comment!=1)
			{
				$error=2;
			}
			else
			{
				$error=3;
			}
		}
	}

	if(isset($_GET['unaccept_id']))
	{
		$unaccept_id = ltrim(rtrim($_GET['unaccept_id']));
		if(empty($unaccept_id) || !is_numeric($unaccept_id))
		{
			$error=4;
		}
		else
		{
			$unaccept_comment = unaccept_comment($unaccept_id);
			if($unaccept_comment!=1)
			{
				$error=5;
			}
			else
			{
				$error=6;
			}
		}
	}

	if(isset($_GET['delte_id']))
	{
		$delte_id = ltrim(rtrim($_GET['delte_id']));
		if(empty($delte_id) || !is_numeric($delte_id))
		{
			$error=7;
		}
		else
		{
			$delete_comment = delete_comment($delte_id);
			if($delete_comment!=1)
			{
				$error=8;
			}
			else
			{
				$error=9;
			}
		}
	}
?>
<div class="panel_content_section">
	<p>لیست نظرات:</p>
	<?php
		$list_comment = list_comment();
		$database_table = '<table class="database_table" cellpadding="0" cellspacing="0"><tr><td>نام ارسال کننده</td><td>ایمیل</td><td>نظر</td><td>&nbsp;</td><td>&nbsp;</td></tr>';

		if($list_comment===0)
		{
			$database_table = $database_table . '<tr><td colspan="3">هیچ نظری موجود نیست.</td></tr>';
		}
		else
		{
			foreach ($list_comment as $my_list_comment) {
				if($my_list_comment['view']==1)
				{
					$database_table = $database_table . '<tr><td>' . $my_list_comment['name'] . '</td><td>' . $my_list_comment['email'] . '</td><td>' . $my_list_comment['content'] . '</td><td align="center"><a href="panel.php?page=comment&unaccept_id=' . $my_list_comment['id'] . '" title="حذف تایید">حذف تایید</a></td><td align="center"><a href="panel.php?page=comment&delte_id=' . $my_list_comment['id'] . '" title="حذف">حذف</a></td></tr>';
				}
				else
				{
					$database_table = $database_table . '<tr><td>' . $my_list_comment['name'] . '</td><td>' . $my_list_comment['email'] . '</td><td>' . $my_list_comment['content'] . '</td><td align="center"><a href="panel.php?page=comment&accept_id=' . $my_list_comment['id'] . '" title="تایید">تایید</a></td><td align="center"><a href="panel.php?page=comment&delte_id=' . $my_list_comment['id'] . '" title="حذف">حذف</a></td></tr>';
				}
			}
		}

		$database_table = $database_table . '</table>';
		echo $database_table;
	?>
	<?php
		if(isset($error))
		{
			switch ($error) {
				case '1':
					echo '<p style="color:#f00">عملیات تایید امکان پذیر نمی باشد.</p>';
					break;
				case '2':
					echo '<p style="color:#f00">مشکلی در تایید نظر پیش آمد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '3':
					echo '<p style="color:#0c0">نظر مورد نظر تایید شد.</p>';
					break;
				case '4':
					echo '<p style="color:#f00">عملیات حذف تایید امکان پذیر نمی باشد.</p>';
					break;
				case '5':
					echo '<p style="color:#f00">مشکلی در حذف تایید نظر پیش آمد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '6':
					echo '<p style="color:#0c0">نظر مورد نظر حذف تایید شد.</p>';
					break;
				case '7':
					echo '<p style="color:#f00">عملیات حذف امکان پذیر نمی باشد.</p>';
					break;
				case '8':
					echo '<p style="color:#f00">مشکلی در حذف پیش آمد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '9':
					echo '<p style="color:#0c0">مطلب مورد نظر حذف شد.</p>';
					break;
			}
		}
	?>
</div>