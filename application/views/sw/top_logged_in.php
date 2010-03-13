			<div class="container" id="top">
				Hello, <?php echo $username; ?> (<a href="<?php echo site_url('auth/logout'); ?>">Logout</a>)
				<?php if(isset($home_link) && $home_link === TRUE): ?>
				<span style="float: left;">
					<a href="<?php echo base_url(); ?>">&laquo; Go home</a>
				</span>
				<?php endif; ?>
			</div>