<?php
	@session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login']!=1)
	{
		header("location:index.php");
	}
	elseif(!isset($_SESSION['page']) || $_SESSION['page']!="password")
	{
		header("location:panel.php?page=home");
	}

	if(isset($_POST['old_password']) || isset($_POST['new_password']) || isset($_POST['new_repassword']))
	{
		$old_password = ltrim(rtrim($_POST['old_password']));
		$new_password = ltrim(rtrim($_POST['new_password']));
		$new_repassword = ltrim(rtrim($_POST['new_repassword']));
		if(empty($old_password) || empty($new_password) || empty($new_repassword))
		{
			$error=1;
		}
		elseif (strlen($old_password)>100 || strlen($new_password)>100 || strlen($new_repassword)>100) {
			$error=2;
		}
		elseif($new_password!==$new_repassword)
		{
			$error=6;
		}
		elseif(strlen($new_password)<4)
		{
			$error=7;
		}
		else
		{
			$change_password = change_password($old_password, $new_password, $new_repassword);
			if($change_password==1)
			{
				$error=4;
			}
			elseif ($change_password==-1) {
				$error=5;
			}
			else
			{
				$error=3;
			}
		}
	}
?>
<div class="panel_content_section">
	<form action="" method="post">
		<table>
			<tr>
				<td><label for="old_password">رمز عبور فعلی:</label></td>
				<td><input type="password" name="old_password" id="old_password" maxlength="100" /></td>
			</tr>
			<tr>
				<td><label for="new_password">رمز عبور جدید:</label></td>
				<td><input type="password" name="new_password" id="new_password" maxlength="100" /></td>
			</tr>
			<tr>
				<td><label for="new_repassword">تکرار رمز عبور جدید:</label></td>
				<td><input type="password" name="new_repassword" id="new_repassword" maxlength="100" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value=" تغییر رمز عبور " /></td>
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
					echo '<p style="color:#f00">حداکثر فیلد رمزعبور 100 کاراکتر می تواند باشد.</p>';
					break;
				case '3':
					echo '<p style="color:#f00">مشکلی در تغییر رمز عبور رخ داد، لطفا دوباره امتحان کنید.</p>';
					break;
				case '4':
					echo '<p style="color:#0c0">رمز عبور با موفقیت تغییر یافت.</p>';
					break;
				case '5':
					echo '<p style="color:#f00">رمز عبور فعلی شما صحیح نمی باشد.</p>';
					break;
				case '6':
					echo '<p style="color:#f00">رمز عبور و تکرارا آن مطابق نمی باشند.</p>';
					break;
				case '7':
					echo '<p style="color:#f00">رمز عبور جدید نباید کمتر از 4 کاراکتر باشد.</p>';
					break;
			}
		}
	?>
</div>