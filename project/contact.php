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
					<div class="post_item">
						<h2>تماس با ما</h2>
						<div class="post_info"><p>نویسنده:<?php echo author_username(1); ?></p></div>
						<div class="content">
						<p>موبای: 09120000000 </p>
						<p>ایمیل : email@email.com </p>
						<p>برای تماس با بنده فقط بین ساعت های کاری اقدام نمایید.</p>
						</div>
					</div>
				</div>
			</div>
			<?php
				require_once("footer.php");
			?>