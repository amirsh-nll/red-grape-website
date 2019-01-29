			<?php
				require_once("header.php");
				@session_start();
			?>
			<div class="center">
				<div class="slideshow">
					<ul>
						<li><img src="raw/image/slide_1.jpg" title="اسلایدشو اول" alt="اسلایدشو اول" /></li>
						<li><img src="raw/image/slide_2.jpg" title="اسلایدشو دوم" alt="اسلایدشو دوم" /></li>
					</ul>
				</div>
				<?php
					if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['content']) && isset($_SESSION['post_id']))
					{
						$post_id = $_SESSION['post_id'];
						$name = ltrim(rtrim($_POST['name']));
						$email = ltrim(rtrim($_POST['email']));
						$content = ltrim(rtrim($_POST['content']));
						if(empty($name) || empty($email) || empty($content))
						{
							$error = 1;
						}
						elseif(strlen($name)>100 || strlen($email)>100 || strlen($content)>10000)
						{
								$error = 2;
						}
						else
						{
							$new_comment = new_comment($post_id, $name, $email, $content);
							if($new_comment!=1)
							{
								$error = 3;
							}
							else
							{
								$error = 4;
							}
						}
					}
				?>
				<div class="post">
					<?php
						if(!isset($_GET['id']))
						{
							header("location:index.php");
						}
						elseif(empty($_GET['id']))
						{
							header("location:index.php");
						}
						elseif(!is_numeric($_GET['id']))
						{
							header("location:index.php");
						}
						else
						{
							$post_id = ltrim(rtrim($_GET['id']));
							$_SESSION['post_id'] = $post_id;
							$single_post = single_post($post_id);
							$list_comment = list_comment($post_id);
							if($single_post===0)
							{
								header("location:index.php");
							}
							else
							{
								if(trim($single_post['image_file'])=="")
								{
									$single_post['image_file'] = 'unknown.png';
								}
								echo '<div class="post_item">';
								echo '<h2><a href="post.php?id=' . $single_post['id'] . '" title="' . $single_post['title'] . '">' . $single_post['title'] . '</a></h2>';
								echo '<div class="post_info"><p>دسته بندی : ' . single_category($single_post['category_id']) . '</p><p>تاریخ ارسال : ' . date("Y/n/j", $single_post['create_time']) . '</p><p>نام نویسنده : ' . author_username($single_post['author_id']) . '</p><p>تعداد بازدید : ' . $single_post['view'] . '</p><p>تعداد نظرات : ' . comment_count_post($single_post['id']) . '</p></div>';
								echo '<div class="content"><div class="content_image"><img src="upload/' . $single_post['image_file'] . '" title="' . $single_post['title'] . '" /></div><p>' . $single_post['content'] . '<br /><br />منبع خبر : <a href="' . $single_post['refrence_url'] . '" title="منبع خبر">' . $single_post['refrence_title'] . '</a></p></div>';
								echo '<div class="clear"></div>';
								echo '<form action="" method="post" class="post_comment">';
								echo '<h3>ثبت نظرات</h3>';
								echo '<table><tr><td><label for="">نام شما : </label></td><td><input type="text" name="name" id="name" maxlength="100" /></td></tr><tr><td><label for="">آدرس ایمیل : </label></td><td><input type="text" name="email" id="email" maxlength="100" /></td></tr><tr><td><label for="">نظر شما : </label></td><td><textarea name="content" id="content" maxlength="5000"></textarea></td></tr><tr><td></td><td><input type="submit" value=" ثبت نظر "></td></tr></table>';
								if(isset($error))
								{
									switch ($error) {
										case '1':
											echo '<p style="margin:20px; display:block; color:#f00">لطفا فیلد های ارسال نظرات را خالی نگذارید.</p>';
											break;
										case '2':
											echo '<p style="margin:20px; display:block; color:#f00">حداکثر طول فیلد نام 100 کاراکتر، ایمیل 100 کاراکتر و نظر شما 5000 کاراکتر می باشد.</p>';
											break;
										case '3':
											echo '<p style="margin:20px; display:block; color:#f00">مشکلی در ارسال نظر شما رخ داده است، لطفا بعدا با ایشون تماس بگیرید.</p>';
											break;
										case '4':
											echo '<p style="margin:20px; display:block; color:#0c0">نظر شما با موفقیت ثبت شد.</p>';
											break;
									}
								}
								echo '<h3>نظرات شما</h3>';
								if($list_comment===0)
								{
									echo '<div style="border:20px solid #e63856;color:#000;text-align:center;line-height:100px;font-family:tahoma;font-size:13px;">هیچ نظری موجود نیست.</div>';
								}
								else
								{
									foreach ($list_comment as $my_list_comment) {
										echo '<div class="comment_item">';
										echo '<h4>' . $my_list_comment['name'] . ' گفته : </h4><p>' . $my_list_comment['content'] . '</p>';
										echo '</div>';
									}
								}
								echo '</form>';
								echo '</div>';
							}
						}
					?>
				</div>
			</div>
			<?php
				require_once("footer.php");
			?>