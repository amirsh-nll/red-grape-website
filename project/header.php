<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>مجله تفریحی انگور قرمز</title>
		<link rel="stylesheet" href="raw/css/layout.css" />
		<link rel="stylesheet" href="raw/css/font-awesome.css">
		<link rel="stylesheet" href="raw/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/ico" href="raw/image/favicon.png">
		<script type="text/javascript" src="raw/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="raw/js/doc.js"></script>
	</head>
	<?php
		require_once("system/view.php");
		view_up();
		$read_view = read_view();
		if($read_view===0)
		{
			$today = 0;
			$yesterday = 0;
			$total = 0;
		}
		else
		{
			$today = $read_view['today'];
			$yesterday = $read_view['yesterday'];
			$total = $read_view['total'];
		}

		if(isset($_GET['page']) && is_numeric($_GET['page']))
		{
			$page=$_GET['page'];
		}
		else
		{
			$page=1;
		}

		require_once("system/web.php");
		$list_category = list_category();
		$list_link = list_link();
		$last_list_post = last_list_post();
		$count_post = count_post();
		$count_link = count_link();
		$count_comment = count_comment();
		$list_post = list_post($page);
		$post_view_count = post_view_count();
	?>
	<body>
		<div class="main">
			<div class="menu">
				<ul>
					<li><a href="index.php" title="خانه">خانه</a></li>
					<li><a href="ads.php" title="تبلیغات">تبلیغات</a></li>
					<li><a href="about.php" title="درباره ما">درباره ما</a></li>
					<li><a href="contact.php" title="تماس با ما">تماس با ما</a></li>
				</ul>
			</div>
			
			<div class="right">
				<div class="logo">
					<img src="raw/image/logo.png" title="مجله تفریحی انگور قرمز" alt="مجله تفریحی انگور قرمز" />
				</div>
				
				<div class="category">
					<h3>موضوعات</h3>
					<table>
						<?php
							if($list_category!==0)
							{
								foreach ($list_category as $my_list_category) {
									echo '<tr><td><span class="fa fa-circle-o fa-lg"></span></td><td><a href="category.php?id=' . $my_list_category['id'] . '" title="' . $my_list_category['name'] . '">' . $my_list_category['name'] . '</a></td></tr>';
								}
							}
						?>
					</table>
				</div>
			</div>