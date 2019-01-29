			<?php
				require_once("header.php");
			?>
			<div class="center">
				<div class="slideshow">
					<ul>
						<li><img src="raw/image/slide_1.jpg" title="اسلایدشو اول" alt="اسلایدشو اول" /></li>
						<li><img src="raw/image/slide_2.jpg" title="اسلایدشو دوم" alt="اسلایدشو دوم" /></li>
					</ul>
				</div>

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
							$category_post = category_post($post_id);
							if($category_post===0)
							{
								echo '<div style="border:20px solid #e63856;color:#000;text-align:center;line-height:300px;font-family:tahoma;font-size:13px;">هیچ مطلبی در این دسته بندی موجود نیست.</div>';
							}
							else
							{
								foreach ($category_post as $my_category_post) {
									if(trim($my_category_post['image_file'])=="")
									{
										$my_category_post['image_file'] = 'unknown.png';
									}
									echo '<div class="post_item">';
									echo '<h2><a href="post.php?id=' . $my_category_post['id'] . '" title="' . $my_category_post['title'] . '">' . $my_category_post['title'] . '</a></h2>';
									echo '<div class="post_info"><p>دسته بندی : ' . single_category($my_category_post['category_id']) . '</p><p>تاریخ ارسال : ' . date("Y/n/j", $my_category_post['create_time']) . '</p><p>نام نویسنده : ' . author_username($my_category_post['author_id']) . '</p><p>تعداد بازدید : ' . $my_category_post['view'] . '</p><p>تعداد نظرات : ' . comment_count_post($my_category_post['id']) . '</p></div>';
									echo '<div class="content"><div class="content_image"><img src="upload/' . $my_category_post['image_file'] . '" title="' . $my_category_post['title'] . '" /></div><p>' . word_limiter($my_category_post['content'], 60) . '</p></div>';
									echo '<div class="post_more"><a href="post.php?id=' . $my_category_post['id'] . '" title="ادامه مطلب">ادامه نوشته...</a></div>';
									echo '<div class="clear"></div>';
									echo '</div>';
								}
							}
						}
					?>
				</div>
			</div>
			<?php
				require_once("footer.php");
			?>