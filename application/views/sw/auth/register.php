<?php $this->load->view('sw/header'); ?>
				<?php echo build_tabs($tabs, 'Register'); ?>
				<div class="content">
					<div id="login_box">
						<div id="login_box_form">
							<?php if($error != ''): ?>
							<div class="delete delete_img"><?php echo $error; ?></div>
							<?php endif; ?>
							<?php echo form_open(site_url('auth/register')); ?>
								<table>
									<tr>
										<td style="width: 55px;">Username</td>
										<td style="width: 210px;"><?php 
											$data = array(
												'name' => 'username',
												'id' => 'username',
												'tabindex' => '1',
												'value' => set_value('username')
											);
											echo form_input($data);
										 ?></td>
									</tr>
									<tr>
										<td>Password</td>
										<td><?php 
											$data = array(
												'name' => 'password',
												'id' => 'password',
												'tabindex' => '2'
											);
											echo form_password($data);
										 ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td><?php 
											$data = array(
												'name' => 'email',
												'id' => 'email',
												'tabindex' => '3',
												'value' => set_value('email')
											);
											echo form_input($data);
										 ?></td>
									</tr>
								</table>
								<div style="float: right; padding-top: 10px;">
									<?php echo form_submit('register', 'Register', 'tabindex="4"'); ?>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
<?php $this->load->view('sw/footer'); ?>