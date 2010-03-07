<?php $this->load->view('sw/global_header'); ?>
				<?php echo build_tabs($tabs, $page_title); ?>
				<div class="content" id="editor">
					<div class="protection protection_img top_bar">
						This page is currently protected from being editing by non-logged in users.
					</div>
					<form action="#" method="post">
						<textarea name="editbox" id="editbox" cols="30" rows="20" tabindex="1">== Welcome to Syncwiki ==
SyncWiki is a new form of wiki software. It's lightweight, fast, and can be mirrored across several servers without the need for MySQL replication.

* Bullet 1
* Bullet 2
* Bullet 3

# Bullet 1
# Bullet 2
# Bullet 3

== Header 1 ==
=== Header 2 ===
==== Header 3 ====
Normal
[[Link]]

=== Testing ===
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu libero quis eros aliquam condimentum. Etiam in turpis vitae neque volutpat eleifend. In ac elit metus. Donec lectus est, mattis at mattis id, dictum ac mi. Aliquam erat volutpat. Donec bibendum auctor lorem, quis bibendum metus dapibus et. Sed congue tempus cursus. Sed id purus at ante dignissim ultricies. Nulla iaculis aliquam venenatis. Nunc sodales ultricies felis at blandit. Nam non purus risus. Aenean nec turpis libero. Aliquam a convallis massa. Sed vulputate orci nec velit fermentum suscipit. Sed lobortis dapibus molestie. Maecenas ligula odio, accumsan vitae scelerisque quis, auctor in turpis. Phasellus tincidunt, velit sit amet hendrerit placerat, leo leo semper ipsum, ut vehicula turpis tortor nec elit. Sed est nunc, ornare eu dignissim vitae, semper eu libero. Duis sit amet ante justo, ut rutrum enim. Cras et nulla eros, vitae adipiscing mauris.
Phasellus vitae ultrices est. Maecenas egestas facilisis lacus sit amet pretium. Curabitur volutpat dolor ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In varius, dolor et aliquet blandit, massa sem blandit mi, vel cursus sapien neque dignissim augue. Mauris ac dolor a libero ullamcorper porttitor vel id neque. Fusce gravida porttitor tortor, eget hendrerit ante iaculis rutrum. Nullam eu ligula at orci vehicula scelerisque. Nunc tincidunt orci sit amet felis euismod et ultrices diam malesuada. Proin est urna, faucibus vel vulputate sit amet, condimentum et est. Integer commodo massa id metus rhoncus tincidunt. Mauris pulvinar adipiscing sapien eu tristique. Vestibulum dictum gravida augue et iaculis. Donec quis velit vitae ipsum egestas malesuada. Etiam fringilla justo ut felis vestibulum blandit. Etiam aliquam, quam eget semper luctus, dui purus eleifend dui, non elementum velit nisl a dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam consequat velit neque. Duis mollis imperdiet vestibulum. Donec commodo dui aliquet velit pharetra egestas molestie vitae nisi.

== Nested Lists ==
* Bullet 1
** Bullet 1a
** Bullet 1b
** Bullet 1c
* Bullet 2
* Bullet 3</textarea>
						<br />
						
						<div id="afterArea">
							<div id="reason">
								<label for="reason" style="margin-right: 6px;">Reason:
								<input name="reason" type="text" maxlength="200" size="55" tabindex="2"/>
								</label>
							</div>
							<div id="buttons">
								<input type="submit" title="Save" value="Save" tabindex="3"/>
								<input type="submit" title="Preview" value="Preview" tabindex="4"/>
							</div>
						</div>
					</form>
					<hr />
					<div id="editorTools">
						<ul>
							<li><a href="layoutHistory.html"><img src="<?php echo base_url(); ?>img/history.png" alt="History" />History</a></li>
							<li><a href="#report"><img src="<?php echo base_url(); ?>img/report.png" alt="Report" />Report</a></li>
							<li><a href="#protect"><img src="<?php echo base_url(); ?>img/protection.png" alt="Protection" />Protection</a></li>
							<li><a href="#delete"><img src="<?php echo base_url(); ?>img/delete.png" alt="Delete" />Delete</a></li>
						</ul>
					</div>
					<div class="panels">
						<div id="protect" class="protection panel">
							<h2>Protection Options</h2>
							<form action="#">
								<p>Protection level</p>
								<div id="options">
									<label for="level"><input type="radio" name="level" value="none" /> None</label>
									<label for="level"><input type="radio" name="level" value="user" checked="checked" /> Logged in users only</label>
									<label for="level"><input type="radio" name="level" value="admin" /> Admins only</label>
								</div>
								<input type="submit" value="Save" />
							</form>
						</div>
						<div id="report" class="report panel">
							<h2>Report this page</h2>
							<p>If you feel that this page is in vilation of the rules, you should report it.</p>
							<br />
							<form action="#" id="report_form">
								<p>I feel that this page is:</p>
								<div id="options">
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="1" /> Spam/Advertising</label>
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="2" /> Hateful</label>
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="3" /> Vandalism</label>
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="9999" /> Other:</label>
									<input type="text" id="other_box" name="other" size="30" style="margin-left: 15px;" />
								</div>
								<input type="submit" value="Report" />
							</form>
						</div>
						<div id="delete" class="delete panel">
							<h2>Delete this page</h2>
							<p>If this page is breaking rules, remove it!</p>
							<br />
							<form action="#" id="delete_form">
								<div id="options">
									<label for="delete_reason"><strong>Reason:</strong> <br />
										<input type="text" name="reason" id="delete_reason" size="30" /></label>
								</div><br /><br />
								<input type="submit" value="Delete" />
							</form>
						</div>
					</div>
				</div>
<?php $this->load->view('sw/global_footer'); ?>