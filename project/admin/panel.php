<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"> 
		<title>پنل مدیریت-مجله تفریحی انگور قرمز</title>
		<link rel="stylesheet" href="../raw/css/admin.css" />
		<link rel="stylesheet" href="../raw/css/font-awesome.css">
		<link rel="stylesheet" href="../raw/css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/ico" href="../raw/image/favicon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<?php
		@session_start();
		if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
		{
			header("location:index.php");
		}
		else
		{
			require_once("../system/admin.php");
		}
	?>
	<body>
		<div class="panel">
			<div class="panel_menu">
				<div class="menu_logo"><img src="../raw/image/logo.png" width="140" height="90" title="مجله تفریحی انگور قرمز" alt="مجله تفریحی انگور قرمز" /></div>
				<table>
					<tr>
						<td><span class="fa fa-lg fa-home"></span></td>
						<td><a href="panel.php?page=home" title="خانه">خانه</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-edit"></span></td>
						<td><a href="panel.php?page=new_post" title="ارسال مطلب">ارسال مطلب</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-database"></span></td>
						<td><a href="panel.php?page=list_post" title="لیست مطالب">لیست مطالب</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-list"></span></td>
						<td><a href="panel.php?page=category" title="دسته بندی ها">دسته بندی ها</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-link"></span></td>
						<td><a href="panel.php?page=link" title="پیوندها">پیوندها</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-comment"></td>
						<td></span><a href="panel.php?page=comment" title="نظرات">نظرات</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-bar-chart"></span></td>
						<td><a href="panel.php?page=report" title="گزارش ها">گزارش ها</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-user"></span></td>
						<td><a href="panel.php?page=password" title="تغییر رمز عبور">تغییر رمز عبور</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-globe"></span></td>
						<td><a target="_blank" href="../index.php" title="مشاهده وبسایت">مشاهده وبسایت</a></td>
					</tr>
					<tr>
						<td><span class="fa fa-lg fa-sign-out"></span></td>
						<td><a href="panel.php?page=logout" title="خروج">خروج</a></td>
					</tr>
				</table>
			</div>
			<div class="panel_content">
				<?php
					$page = ltrim(rtrim($_GET['page']));
					switch ($page) {
						case 'home':
							{
								echo '<h2>خانه</h2>';
								$_SESSION['page']="home";
								require_once('home.php');
							}
							break;
						case 'new_post':
							{
								echo '<h2>ارسال مطلب جدید</h2>';
								$_SESSION['page']="new_post";
								require_once('new_post.php');
							}
							break;
						case 'list_post':
							{
								echo '<h2>لیست مطالب</h2>';
								$_SESSION['page']="list_post";
								require_once('list_post.php');
							}
							break;
						case 'edit_post':
							{
								echo '<h2>ویرایش مطالب</h2>';
								$_SESSION['page']="edit_post";
								require_once('edit_post.php');
							}
							break;
						case 'category':
							{
								echo '<h2>دسته بندی ها</h2>';
								$_SESSION['page']="category";
								require_once('category.php');
							}
							break;
						case 'edit_category':
							{
								echo '<h2>ویرایش دسته بندی ها</h2>';
								$_SESSION['page']="edit_category";
								require_once('edit_category.php');
							}
							break;
						case 'link':
							{
								echo '<h2>پیوندها</h2>';
								$_SESSION['page']="link";
								require_once('link.php');
							}
							break;
						case 'edit_link':
							{
								echo '<h2>پیوندها</h2>';
								$_SESSION['page']="edit_link";
								require_once('edit_link.php');
							}
							break;
						case 'comment':
							{
								echo '<h2>نظرات</h2>';
								$_SESSION['page']="comment";
								require_once('comment.php');
							}
							break;
						case 'report':
							{
								echo '<h2>گزارش ها</h2>';
								$_SESSION['page']="report";
								require_once('report.php');
							}
							break;
						case 'password':
							{
								echo '<h2>تغییر رمز عبور</h2>';
								$_SESSION['page']="password";
								require_once('password.php');
							}
							break;
						case 'logout':
							{
								unset($_SESSION['login']);
								unset($_SESSION['username']);
								session_destroy();
								header("location:index.php");
							}
							break;
						default:
							{
								header("location:panel.php?page=home");
							}
							break;
					}
				?>
			</div>
			<div class="clear"></div>
		</div>
	</body>
</html>