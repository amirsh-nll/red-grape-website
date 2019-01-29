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
						if($list_post===0)
						{
							$list_post = list_post(1);
							echo '<div style="border:20px solid #e63856;color:#000;text-align:center;line-height:300px;font-family:tahoma;font-size:13px;">هیچ مطلبی موجود نیست.</div>';
						}
						else
						{
							foreach ($list_post as $my_list_post) {
								if(trim($my_list_post['image_file'])=="")
								{
									$my_list_post['image_file'] = 'unknown.png';
								}
								echo '<div class="post_item">';
								echo '<h2><a href="post.php?id=' . $my_list_post['id'] . '" title="' . $my_list_post['title'] . '">' . $my_list_post['title'] . '</a></h2>';
								echo '<div class="post_info"><p>دسته بندی : ' . single_category($my_list_post['category_id']) . '</p><p>تاریخ ارسال : ' . date("Y/n/j", $my_list_post['create_time']) . '</p><p>نام نویسنده : ' . author_username($my_list_post['author_id']) . '</p><p>تعداد بازدید : ' . $my_list_post['view'] . '</p><p>تعداد نظرات : ' . comment_count_post($my_list_post['id']) . '</p></div>';
								echo '<div class="content"><div class="content_image"><img src="upload/' . $my_list_post['image_file'] . '" title="' . $my_list_post['title'] . '" /></div><p>' . word_limiter($my_list_post['content'], 60) . '</p></div>';
								echo '<div class="post_more"><a href="post.php?id=' . $my_list_post['id'] . '" title="ادامه مطلب">ادامه مطلب...</a></div>';
								echo '<div class="clear"></div>';
								echo '</div>';
							}
							echo '<div class="page_number">';
							$page=1;
							for($i=0;$i<=$count_post;$i+=10)
							{
								echo '<p><a href="index.php?page=' . $page . '" title="صفحه ' . $page . '">' . $page . '</a></p>';
								$page+=1;
								if(fmod($page, 10)==0)
								{
									break;
								}
							}
							echo '</div><div class="clear"></div>';
						}
					?>
				</div>
			</div>
			<?php
				require_once("footer.php");
			?>