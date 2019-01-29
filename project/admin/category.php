<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="category")
	{
		header("location:panel.php?page=home");
	}

	if(isset($_POST['name']))
	{
		$name = ltrim(rtrim($_POST['name']));
		if(empty($name))
		{
			$error=1;
		}
		elseif (strlen($name)>100) {
			$error=2;
		}
		else
		{
			$new_category = new_category($name);
			if($new_category!=1)
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
			$delete_category = delete_category($delte_id);
			if($delete_category!=1)
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
				<td><label for="name">عنوان دسته بندی:</label></td>
				<td><input type="text" name="name" id="name" maxlength="100" /></td>
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
					echo '<p style="color:#f00">لطفا فیلد عنوان دسته بندی را خالی نگذارید.</p>';
					break;
				case '2':
					echo '<p style="color:#f00">حداکثر طول عنوان دسته بندی نباید بیش از 100 کاراکتر باشد.</p>';
					break;
				case '3':
					echo '<p style="color:#f00">مشکلی در ثبت دسته بندی رخ داد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '4':
					echo '<p style="color:#0c0">دسته بندی جدید با موفقیت اضافه شد.</p>';
					break;
			}
		}
	?>
	<p>لیست دسته بندی ها:</p>
	<?php
		$list_category = list_category();
		$database_table = '<table class="database_table" cellpadding="0" cellspacing="0"><tr><td>عنوان دسته بندی</td><td>&nbsp;</td><td>&nbsp;</td></tr>';

		if($list_category===0)
		{
			$database_table = $database_table . '<tr><td colspan="3">هیچ دسته بندی موجود نیست.</td></tr>';
		}
		else
		{
			foreach ($list_category as $my_list_category) {
				$database_table = $database_table . '<tr><td>' . $my_list_category['name'] . '</td><td align="center"><a href="panel.php?page=edit_category&edit_id=' . $my_list_category['id'] . '" title="ویرایش">ویرایش</a></td><td align="center"><a href="panel.php?page=category&delte_id=' . $my_list_category['id'] . '" title="حذف">حذف</a></td></tr>';
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
					echo '<p style="color:#0c0">دسته بندی مورد نظر حذف شد.</p>';
					break;
			}
		}
	?>
</div>