				<div id="footer">
					<a href="<?php echo base_url(); ?>CHANGELOG.md">Version <?php echo syncwiki_version(); ?></a><?php if(syncwiki_with_ci2()): ?> using CodeIgniter 2.0<?php endif; ?><br />
					&copy; 2010 compwhizii
				</div>
			</div>
		</div>
		<?php if(isset($bottom_script)) { echo $bottom_script; } ?>
	</body>
</html>