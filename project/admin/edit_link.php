<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="edit_link")
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
			$edit_link = edit_link($_SESSION['link_edit_id'], $title, $url);
			if($edit_link!=1)
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
		if(empty($edit_id) || !is_numeric($edit_id))
		{
			header("location:panel.php?page=link");
		}
		else
		{
			$single_link = single_link($edit_id);
			if($single_link===0)
			{
				header("location:panel.php?page=link");
			}
			else
			{
				$_SESSION['link_edit_id']=$edit_id;
			}
		}
	}
?>
<div class="panel_content_section">
	<form action="" method="post">
		<table>
			<tr>
				<td><label for="title">عنوان لینک:</label></td>
				<td><input type="text" name="title" id="title" maxlength="100" value="<?php echo $single_link['title']; ?>" /></td>
			</tr>
			<tr>
				<td><label for="url">آدرس لینک:</label></td>
				<td><input type="text" name="url" id="url" maxlength="255" value="<?php echo $single_link['url']; ?>" /></td>
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
					echo '<p style="color:#f00">لطفا فیلد بالا را خالی نگذارید.</p>';
					break;
				case '2':
					echo '<p style="color:#f00">حداکثر طول عنوان لینک 100 کاراکتر و آدرس آن 255 کاراکتر باشد.</p>';
					break;
				case '3':
					echo '<p style="color:#f00">مشکلی در ویرایش لینک رخ داد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '4':
					echo '<p style="color:#0c0">لینک با موفقیت ویرایش شد.</p>';
					break;
			}
		}
	?>
</div>