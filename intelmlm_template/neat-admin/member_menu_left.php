<div class="navi">
		<ul class='main-nav'>
			<li class='active'>
				<a href="index.php" class='light'>
					<div class="ico"><i class="icon-home icon-white"></i></div>
					Dashboard
					<span class="label label-warning">10</span>
				</a>
			</li>
            <li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-th-large icon-white"></i></div>
					Profile
					<img src="<?php echo THEME_LOC; ?>/img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav closed'>
					<li>
						<a href="index.php?modules=Users&amp;op=editprofile">
							Edit Profile
						</a>
					</li>
					
				</ul>
			</li>
			<li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-th-large icon-white"></i></div>
					User Manager
					<img src="<?php echo THEME_LOC; ?>/img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav closed'>
					<li>
						<a href="index.php?modules=Users&amp;op=search&amp;query_style=alluser">
							All User
						</a>
					</li>
					<li>
						<a href="index.php?modules=Users&amp;op=role">
							User Role
						</a>
					</li>
				</ul>
			</li>
            
            <?php if($session->userinfo['fb_role'] == 'seller'){ ?>
            <li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-th-large icon-white"></i></div>
					Product Manager
					<img src="<?php echo THEME_LOC; ?>/img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav closed'>
					<li>
						<a href="index.php?modules=Product&amp;op=allproduct">
							All product
						</a>
					</li>
					<li>
						<a href="index.php?modules=Users&amp;op=role">
							All Purchases
						</a>
					</li>
				</ul>
			</li>
            <?php } ?>
			<li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-tasks icon-white"></i></div>
					Interface Elements
					<img src="<?php echo THEME_LOC; ?>/img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav closed'>
					<li>
						<a href="buttons.html">
							Buttons & Icons
						</a>
					</li>
					<li>
						<a href="sliders.html">
							Sliders & Progress-Bars
						</a>
					</li>
					<li>
						<a href="tooltips.html">
							Tooltips, Alerts & Notification
						</a>
					</li>
					<li>
						<a href="tabs.html">
							Tabs, Pills & Accordion
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="statistics.html" class='light'>
					<div class="ico"><i class="icon-signal icon-white"></i></div>
					Statistics
					<span class="label label-important">3</span>
				</a>
			</li>
			<li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-exclamation-sign icon-white"></i></div>
					Error Pages
					<img src="img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav closed'>
					<li>
						<a href="403.html">
							403
						</a>
					</li>
					<li>
						<a href="404.html">
							404
						</a>
					</li>
					<li>
						<a href="500.html">
							500
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-book icon-white"></i></div>
					Sample Pages
					<img src="img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav closed'>
					<li>
						<a href="gallery.html">
							Gallery
						</a>
					</li>
					<li>
						<a href="messages.html">
							Messages
						</a>
					</li>
					<li>
						<a href="userprofile.html">
							User Profile
						</a>
					</li>
					<li>
						<a href="index.html">
							Login
						</a>
					</li>
					<li>
						<a href="results.html">
							Search results
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>