<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="edit_category")
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
			$edit_category = edit_category($_SESSION['category_edit_id'], $name);
			if($edit_category!=1)
			{
				$error=3;
			}
			else
			{
				$error=4;
			}
		}
	}

	if(isset($_GET['edit_id']))
	{
		$edit_id = ltrim(rtrim($_GET['edit_id']));
		if(empty($edit_id) || !is_numeric($edit_id) || $edit_id==1)
		{
			header("location:panel.php?page=category");
		}
		else
		{
			$single_category = single_category($edit_id);
			if($single_category===0)
			{
				header("location:panel.php?page=category");
			}
			else
			{
				$_SESSION['category_edit_id']=$edit_id;
			}
		}
	}
?>
<div class="panel_content_section">
	<form action="" method="post">
		<table>
			<tr>
				<td><label for="name">عنوان دسته بندی:</label></td>
				<td><input type="text" name="name" id="name" maxlength="100" value="<?php echo $single_category; ?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value=" ویرایش " /></td>
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
					echo '<p style="color:#f00">مشکلی در ویرایش دسته بندی رخ داد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '4':
					echo '<p style="color:#0c0">دسته بندی با موفقیت ویرایش شد.</p>';
					break;
			}
		}
	?>
</div>