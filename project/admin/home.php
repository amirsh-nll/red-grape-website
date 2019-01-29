<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="home")
	{
		header("location:panel.php?page=home");
	}
?>
<div class="panel_content_section">
	<p>به پنل مدیریت خوش آمدید.</p>
	<p>اینجا صفحه خانگی پنل مدیریت است. برای دسترسی به بخش های متفاوت این پنل از منوی سمت راست عملیات های خود را انجام دهید.</p>
</div>