<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="edit_post")
	{
		header("location:panel.php?page=home");
	}

	if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['category']) && isset($_POST['refrence_title']) && isset($_POST['refrence_url']))
	{
		$title = ltrim(rtrim($_POST['title']));
		$content = ltrim(rtrim($_POST['content']));
		$category = ltrim(rtrim($_POST['category']));
		$refrence_title = ltrim(rtrim($_POST['refrence_title']));
		$refrence_url = ltrim(rtrim($_POST['refrence_url']));
		$image_file=' ';
		if(empty($title) || empty($content) || empty($category) || !is_numeric($category))
		{
			$error=1;
		}
		elseif (strlen($title)>100 || strlen($content)>10000 || strlen($refrence_title)>100 || strlen($refrence_url)>255) {
			$error=2;
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$type = $_FILES["file"]["type"];
				if (!($type=="image/gif" || $type=="image/jpeg" || $type=="image/jpg" || $type=="image/pjpeg" || $type=="image/x-png" || $type=="image/png"))
				{
					$error=3;
				}
				elseif ($_FILES["file"]["size"] > 10485760)
				{
					$error=3;
				}
				elseif ($_FILES["file"]["error"] > 0)
				{
					$error=3;
				}
				else
				{
					$filename="file_" . rand(1,99999) . $_FILES["file"]["name"];
					move_uploaded_file($_FILES["file"]["tmp_name"],"../upload/" . $filename);
					$image_file = $filename;
				}
			}
			else
			{
				$image_file='unknown.png';
			}
			echo $image_file;

			$edit_post = edit_post($_SESSION['post_edit_id'], $title, $content, $category, $refrence_title, $refrence_url, $image_file);
			if($edit_post!=1)
			{
				$error=4;
			}
			else
			{
				$error=5;
			}
		}
	}

	if(isset($_GET['edit_id']))
	{
		$edit_id = ltrim(rtrim($_GET['edit_id']));
		if(empty($edit_id) || !is_numeric($edit_id) || $edit_id==1)
		{
			header("location:panel.php?page=list_post");
		}
		else
		{
			$single_post = single_post($edit_id);
			if($single_post===0)
			{
				header("location:panel.php?page=list_post");
			}
			else
			{
				$_SESSION['post_edit_id']=$edit_id;
			}
		}
	}
?>
<div class="panel_content_section">
	<form action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="title">عنوان مطلب:</label></td>
				<td><input type="text" name="title" id="title" maxlength="100" value="<?php echo $single_post['title']; ?>" /></td>
			</tr>
			<tr>
				<td><label for="content">متن مطلب</label></td>
				<td><textarea name="content" id="content" maxlength="5000"><?php echo $single_post['content']; ?></textarea></td>
			</tr>
			<tr>
				<td><label>دسته بندی:</label></td>
				<td>
					<?php
						$list_category = list_category();
						$list_category_combo = '<select name="category">';

						if($list_category===0)
						{
							$list_category_combo = $list_category_combo . '<option value="1">نامشخص</option>';
						}
						else
						{
							foreach ($list_category as $my_list_category) {
								if($single_post['category_id']==$my_list_category['id'])
								{
									$list_category_combo = $list_category_combo . '<option selected="select" value="' . $my_list_category['id'] . '">' . $my_list_category['name'] . '</option>';
								}
								else
								{
									$list_category_combo = $list_category_combo . '<option value="' . $my_list_category['id'] . '">' . $my_list_category['name'] . '</option>';
								}
							}
						}
						$list_category_combo = $list_category_combo . '</select>';
						echo $list_category_combo;
					?>
				</td>
			</tr>
			<tr>
				<td><label>تصویر فعلی:</label></td>
				<td><img width="300" height="200" src="../upload/<?php echo $single_post['image_file']; ?>" title="تصویر مطلب <?php echo $single_post['title']; ?>" alt="تصویر مطلب <?php echo $single_post['title']; ?>" /></td>
			</tr>
			<tr>
				<td><label for="file">تصویر نوشته:</label></td>
				<td><input type="file" name="file" id="file" /></td>
			</tr>
			<tr>
				<td><label for="refrence_title">عنوان منبع:</label></td>
				<td><input type="text" name="refrence_title" id="refrence_title" maxlength="100" value="<?php echo $single_post['refrence_title']; ?>" /></td>
			</tr>
			<tr>
				<td><label for="refrence_url">لینک منبع:</label></td>
				<td><input type="text" name="refrence_url" id="refrence_url" maxlength="255" style="text-align:left;" value="<?php echo $single_post['refrence_url']; ?>" /></td>
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
					echo '<p style="color:#f00">لطفا فیلد های مطلب را خالی نگذارید.</p>';
					break;
				case '2':
					echo '<p style="color:#f00">حداکثر طول فیلد عنوان مطلب 100 و محتوای مطلب 10000 کاراکتر می باشد. ضمنا تعداد کارارکترهای فیلد منبع 100 و لینک آن 255 کاراکتر می باشد.</p>';
					break;
				case '3':
					echo '<p style="color:#f00">فایل انتخاب شده دارای شرایط آپلود نمی باشد.</p>';
					break;
				case '4':
					echo '<p style="color:#f00">مشکلی در ویرایش مطلب رخ داد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '5':
					echo '<p style="color:#0c0">مطلب با موفقیت ویرایش شد.</p>';
					break;
			}
		}
	?>
</div>