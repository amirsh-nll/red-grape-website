<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="list_post")
	{
		header("location:panel.php?page=home");
	}

	if(isset($_GET['delte_id']))
	{
		$delte_id = ltrim(rtrim($_GET['delte_id']));
		if(empty($delte_id) || !is_numeric($delte_id))
		{
			$error=1;
		}
		else
		{
			$delete_post = delete_post($delte_id);
			if($delete_post!=1)
			{
				$error=2;
			}
			else
			{
				$error=3;
			}
		}
	}
?>
<div class="panel_content_section">
<p>لیست مطالب:</p>
	<?php
		$list_post = list_post();
		$database_table = '<table class="database_table" cellpadding="0" cellspacing="0"><tr><td>عنوان مطلب</td><td>&nbsp;</td><td>&nbsp;</td></tr>';

		if($list_post===0)
		{
			$database_table = $database_table . '<tr><td colspan="3">هیچ مطلبی موجود نیست.</td></tr>';
		}
		else
		{
			foreach ($list_post as $my_list_post) {
				$database_table = $database_table . '<tr><td>' . $my_list_post['title'] . '</td><td align="center"><a href="panel.php?page=edit_post&edit_id=' . $my_list_post['id'] . '" title="ویرایش">ویرایش</a></td><td align="center"><a href="panel.php?page=list_post&delte_id=' . $my_list_post['id'] . '" title="حذف">حذف</a></td></tr>';
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
					echo '<p style="color:#f00">عملیات حذف امکان پذیر نمی باشد.</p>';
					break;
				case '2':
					echo '<p style="color:#f00">مشکلی در حذف پیش آمد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '3':
					echo '<p style="color:#0c0">مطلب مورد نظر حذف شد.</p>';
					break;
			}
		}
	?>
</div>