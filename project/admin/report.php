<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="report")
	{
		header("location:panel.php?page=home");
	}

	$view_post_on_special_time = -1;
	if(isset($_POST['post_id']) && isset($_POST['start_year']) && isset($_POST['start_month']) && isset($_POST['start_day']))
	{
		if(empty($_POST['post_id']) || empty($_POST['start_year']) || empty($_POST['start_month']) || empty($_POST['start_day']))
		{
			$error = 1;
		}
		elseif(!is_numeric($_POST['post_id']) || !is_numeric($_POST['start_year']) || !is_numeric($_POST['start_month']) || !is_numeric($_POST['start_day']))
		{
			$error = 2;
		}
		else
		{
			$post_id = ltrim(rtrim($_POST['post_id']));
			$start_year = ltrim(rtrim($_POST['start_year']));
			$start_month = ltrim(rtrim($_POST['start_month']));
			$start_day = ltrim(rtrim($_POST['start_day']));
			$start_time=$start_year . '-' . $start_month . '-' . $start_day;

			$view_post_on_special_time = view_post_on_special_time($post_id, strtotime($start_time));
		}
	}

	$count_post = count_post();
	$count_link = count_link();
	$count_comment = count_comment();
	$post_view_count = post_view_count();
	require_once("../system/view.php");
	$read_view = read_view();
	$today = $read_view['today'];
	$yesterday = $read_view['yesterday'];
	$total = $read_view['total'];
?>
<div class="panel_content_section">
	<p>گزارش های وبسایت به شرح زیر می باشد:</p>
	<table>
		<tr>
			<td>تعداد مطالب:</td>
			<td><?php echo $count_post; ?></td>
		</tr>
		<tr>
			<td>تعداد نظرات:</td>
			<td><?php echo $count_comment; ?></td>
		</tr>
		<tr>
			<td>تعداد لینک ها:</td>
			<td><?php echo $count_link; ?></td>
		</tr>
		<tr>
			<td>بازدید امروز:</td>
			<td><?php echo $today; ?></td>
		</tr>
		<tr>
			<td>بازدید دیروز:</td>
			<td><?php echo $yesterday; ?></td>
		</tr>
		<tr>
			<td>بازدید کل:</td>
			<td><?php echo $total; ?></td>
		</tr>
		<tr>
			<td>مجموع بازدید کل مطلب:</td>
			<td><?php echo $post_view_count; ?></td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<p>بازدید مطلب در بازه زمانی خاص:</p>
	<form action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="title">مطلب مورد نظر</label></td>
				<td>
					<select name="post_id">
						<?php
							$list_post = list_post();
							foreach ($list_post as $my_list_post) {
								echo '<option value="' . $my_list_post['id'] . '">' . $my_list_post['title'] . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="content">تاریخ شروع</label></td>
				<td>
					<select name="start_year">
						<?php
							for($i=2015;$i<=2017;$i++)
							{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
					</select>
					<select name="start_month">
						<?php
							for($i=1;$i<=12;$i++)
							{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
					</select>
					<select name="start_day">
						<?php
							for($i=1;$i<=30;$i++)
							{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php if($view_post_on_special_time!=-1)
			{ ?>
			<tr>
				<td colspan="2">مطلب مورد نظر شما از تاریخ <?php echo '<span dir="ltr">' . $start_time . '</span>'; ?> دارای <?php echo $view_post_on_special_time; ?> بازدید می باشد.</td>
			</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td><input type="submit" value=" جستجو " /></td>
			</tr>
		</table>
	</form>
	<p>پنج مطلب پربازدید:</p>
	<?php
		$top_view_post = top_view_post();
		$database_table = '<table class="database_table" cellpadding="0" cellspacing="0"><tr><td>عنوان مطلب</td>
		<td>تعداد بازدید</td><td>&nbsp;</td><td>&nbsp;</td></tr>';

		if($top_view_post===0)
		{
			$database_table = $database_table . '<tr><td colspan="3">هیچ مطلبی موجود نیست.</td></tr>';
		}
		else
		{
			foreach ($top_view_post as $my_top_view_post) {
				$database_table = $database_table . '<tr><td>' . $my_top_view_post['title'] . '</td><td>' . $my_top_view_post['view'] . '</td><td align="center"><a href="panel.php?page=edit_post&edit_id=' . $my_top_view_post['id'] . '" title="ویرایش">ویرایش</a></td><td align="center"><a href="panel.php?page=list_post&delte_id=' . $my_top_view_post['id'] . '" title="حذف">حذف</a></td></tr>';
			}
		}

		$database_table = $database_table . '</table>';
		echo $database_table;
	?>
	<p>&nbsp;</p>
	<p>پنج مطلب پر نظر:</p>
	<?php
		$top_comment_post = top_comment_post();
		$database_table = '<table class="database_table" cellpadding="0" cellspacing="0"><tr><td>عنوان مطلب</td>
		<td>تعداد نظرات</td><td>&nbsp;</td><td>&nbsp;</td></tr>';

		if($top_comment_post===0)
		{
			$database_table = $database_table . '<tr><td colspan="3">هیچ مطلبی موجود نیست.</td></tr>';
		}
		else
		{
			$i=0;
			foreach ($top_comment_post as $my_top_comment_post) {
				if($i<5)
				{
					$database_table = $database_table . '<tr><td>' . $my_top_comment_post['title'] . '</td><td>' . $my_top_comment_post['comment_count'] . '</td><td align="center"><a href="panel.php?page=edit_post&edit_id=' . $my_top_comment_post['id'] . '" title="ویرایش">ویرایش</a></td><td align="center"><a href="panel.php?page=list_post&delte_id=' . $my_top_comment_post['id'] . '" title="حذف">حذف</a></td></tr>';
					$i+=1;
				}
				else
				{
					break;
				}
			}
		}

		$database_table = $database_table . '</table>';
		echo $database_table;
	?>
</div>