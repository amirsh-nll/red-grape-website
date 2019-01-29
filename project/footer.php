<div class="left">
				<div class="last_post">
					<h3>آخرین مطالب</h3>
					<table>
						<?php
							if($last_list_post!==0)
							{
								foreach ($last_list_post as $my_last_list_post) {
									echo '<tr><td><span class="fa fa-circle-o fa-lg"></span></td><td><a href="post.php?id=' . $my_last_list_post['id'] . '" title="' . $my_last_list_post['title'] . '">' . $my_last_list_post['title'] . '</a></td></tr>';
								}
							}
						?>
					</table>
				</div>

				<div class="status">
					<h3>آمار بازدید</h3>
					<table>
						<tr>
							<td><span class="fa fa-circle-o fa-lg"></span> تعداد مطالب:</td>
							<td><?php echo $count_post; ?></td>
						</tr>
						<tr>
							<td><span class="fa fa-circle-o fa-lg"></span> تعداد نظرات:</td>
							<td><?php echo $count_comment; ?></td>
						</tr>
						<tr>
							<td><span class="fa fa-circle-o fa-lg"></span> تعداد لینک ها:</td>
							<td><?php echo $count_link; ?></td>
						</tr>
						<tr>
							<td><span class="fa fa-circle-o fa-lg"></span> بازدید امروز:</td>
							<td><?php echo $today; ?></td>
						</tr>
						<tr>
							<td><span class="fa fa-circle-o fa-lg"></span> بازدید دیروز:</td>
							<td><?php echo $yesterday; ?></td>
						</tr>
						<tr>
							<td><span class="fa fa-circle-o fa-lg"></span> بازدید کل:</td>
							<td><?php echo $total; ?></td>
						</tr>
						<tr>
							<td><span class="fa fa-circle-o fa-lg"></span> بازدید کل مطالب:</td>
							<td><?php echo $post_view_count; ?></td>
						</tr>
					</table>
				</div>
				
				<div class="link">
					<h3>پیوندها</h3>
					<table>
						<?php
							if($list_link!==0)
							{
								foreach ($list_link as $my_list_link) {
									echo '<tr><td><span class="fa fa-circle-o fa-lg"></span></td><td><a href="' . $my_list_link['url'] . '" title="' . $my_list_link['title'] . '">' . $my_list_link['title'] . '</a></td></tr>';
								}
							}
						?>
					</table>
				</div>
			</div>

			<div class="fotter">
				<p>&copy; 1395-1396 تمامی حقوق این وبسایت محفوظ می باشد.</p>
			</div>
		</div>
	</body>
</html>