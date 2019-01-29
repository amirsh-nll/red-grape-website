<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="link")
	{
		header("location:panel.php?page=home");
	}

	if(isset($_POST['title']) || isset($_POST['url']))
	{
		$title = ltrim(rtrim($_POST['title']));
		$url = ltrim(rtrim($_POST['url']));
		if(empty($title) || empty($url))
		{
			$error=1;
		}
		elseif (strlen($title)>100 || strlen($url)>255) {
			$error=2;
		}
		else
		{
			$new_link = new_link($title, $url);
			if($new_link!=1)
			{
				$error=3;
			}
			else
			{
				$error=4;
			}
		}
	}

	if(isset($_GET['delte_id']))
	{
		$delte_id = ltrim(rtrim($_GET['delte_id']));
		if(empty($delte_id) || !is_numeric($delte_id) || $delte_id==1)
		{
			$error=5;
		}
		else
		{
			$delete_link = delete_link($delte_id);
			if($delete_link!=1)
			{
				$error=6;
			}
			else
			{
				$error=7;
			}
		}
	}
?>
<div class="panel_content_section">
	<form action="" method="post">
		<table>
			<tr>
				<td><label for="title">عنوان لینک:</label></td>
				<td><input type="text" name="title" id="title" maxlength="100" /></td>
			</tr>
			<tr>
				<td><label for="url">آدرس لینک:</label></td>
				<td><input type="text" name="url" id="url" maxlength="255" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value=" افزودن " /></td>
			</tr>
		</table>
	</form>
	<?php
		if(isset($error))
		{
			switch ($error) {
				case '1':
					echo '<p style="color:#f00">لطفا فیلد های بالا را خالی نگذارید.</p>';
					break;
				case '2':
					echo '<p style="color:#f00">حداکثر طول عنوان 100 کاراکتر و آدرس لینک 255 کاراکتر می باشد.</p>';
					break;
				case '3':
					echo '<p style="color:#f00">مشکلی در ثبت لینک رخ داد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '4':
					echo '<p style="color:#0c0">لینک جدید با موفقیت اضافه شد.</p>';
					break;
			}
		}
	?>
	<p>لیست لینک ها:</p>
	<?php
		$list_link = list_link();
		$database_table = '<table class="database_table" cellpadding="0" cellspacing="0"><tr><td>عنوان لینک</td><td>آدرس لینک</td><td>&nbsp;</td><td>&nbsp;</td></tr>';

		if($list_link===0)
		{
			$database_table = $database_table . '<tr><td colspan="4">هیچ دسته بندی موجود نیست.</td></tr>';
		}
		else
		{
			foreach ($list_link as $my_list_link) {
				$database_table = $database_table . '<tr><td>' . $my_list_link['title'] . '</td><td>' . $my_list_link['url'] . '</td><td align="center"><a href="panel.php?page=edit_link&edit_id=' . $my_list_link['id'] . '" title="ویرایش">ویرایش</a></td><td align="center"><a href="panel.php?page=link&delte_id=' . $my_list_link['id'] . '" title="حذف">حذف</a></td></tr>';
			}
		}

		$database_table = $database_table . '</table>';
		echo $database_table;
	?>
	<?php
		if(isset($error))
		{
			switch ($error) {
				case '5':
					echo '<p style="color:#f00">عملیات حذف امکان پذیر نمی باشد.</p>';
					break;
				case '6':
					echo '<p style="color:#f00">مشکلی در حذف پیش آمد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '7':
					echo '<p style="color:#0c0">لینک مورد نظر حذف شد.</p>';
					break;
			}
		}
	?>
</div>