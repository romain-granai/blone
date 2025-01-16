<div class="topbar">
	<div class="topbar__main">
		<?php
			$menuName = 'main';
			$menu = wp_get_nav_menu_object($menuName);
			$menuID = $menu->term_id;
			$menuItems = wp_get_nav_menu_items($menuID);
			$menuStructure = array();
			foreach ($menuItems as $menuItem) {
				$menuStructure[$menuItem->menu_item_parent][] = $menuItem;
			}
		?>
		<nav class="nav nav--main">
			<?php if($menu): ?>
			<ul class="nav-list">
				<?php foreach($menuStructure[0] as $firstLevelItem): 
					$target = $firstLevelItem->target == '_blank' ? ' target="_blank"' : '';
					$titleDataNav = strtolower($firstLevelItem->title);
					$titleDataNav = preg_replace('/[^a-z0-9]+/', '-', $titleDataNav);
					$titleDataNav = trim($titleDataNav, '-');

					$hasSubItems = isset($menuStructure[$firstLevelItem->ID]);
				?>

					<li>
						<a href="<?php echo esc_url($firstLevelItem->url); ?>" <?php echo $hasSubItems ? 'data-nav="' . $titleDataNav . '"' : ''; ?> title="<?php echo esc_html($firstLevelItem->title); ?>" <?php echo $target ?>> <?php echo esc_html($firstLevelItem->title); ?> </a>
					</li>

				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</nav>
		<div class="topbar__logo-container">
			<a href="<?php echo get_home_url(); ?>" class="topbar__logo">
				<svg viewBox="0 0 390 149" xmlns="http://www.w3.org/2000/svg">
				<path d="M195.295 4.68946C231.908 4.68946 261.698 35.7948 261.698 74.0351C261.698 111.739 231.29 143.591 195.295 143.591C159.303 143.591 128.896 111.739 128.896 74.0351C128.896 35.7948 158.682 4.68946 195.295 4.68946ZM195.295 0.157463C151.018 0.157463 117.631 31.9175 117.631 74.0351C117.631 116.271 151.018 148.123 195.295 148.123C239.571 148.123 272.959 116.271 272.959 74.0351C272.959 31.9175 239.571 0.157463 195.295 0.157463Z"></path>
				<path d="M312.808 117.414L262.963 37.0909L262.767 36.7696L246.984 28.9576L309.79 130.307L310.175 130.934H317.06V18.1176H312.808V117.414Z"></path>
				<path d="M389.866 22.3696V18.1176H324.977V130.934H389.866V126.681H334.382V72.532H389.866V68.4404H334.382V22.3696H389.866Z"></path>
				<path d="M103.883 126.681V18.1176H94.4766V130.934H150.593V126.681H103.883Z"></path>
				<path d="M4.2892 72.6235H50.5303C65.436 72.6235 77.5589 84.8235 77.5589 99.8167C77.5589 114.718 65.436 126.842 50.5303 126.842H4.2892V72.6235ZM45.3761 68.3751H4.2892V22.5299H45.3761C57.9684 22.5299 68.2147 32.7766 68.2147 45.3726C68.2147 58.0568 57.9684 68.3751 45.3761 68.3751ZM63.7043 69.3099C72.3689 64.5964 77.9449 55.4511 77.9449 45.3726C77.9449 30.4339 65.7887 18.2779 50.8501 18.2779H0.0371094V131.094H56.0043C73.3397 131.094 87.4455 117.06 87.4455 99.8167C87.4455 85.1833 77.5043 72.7579 63.7043 69.3099Z"></path>
				<path d="M195.295 4.68946C231.908 4.68946 261.698 35.7948 261.698 74.0351C261.698 111.739 231.29 143.591 195.295 143.591C159.303 143.591 128.896 111.739 128.896 74.0351C128.896 35.7948 158.682 4.68946 195.295 4.68946ZM195.295 0.157463C151.018 0.157463 117.631 31.9175 117.631 74.0351C117.631 116.271 151.018 148.123 195.295 148.123C239.571 148.123 272.959 116.271 272.959 74.0351C272.959 31.9175 239.571 0.157463 195.295 0.157463Z"></path>
				<path d="M312.808 117.414L262.963 37.0909L262.767 36.7696L246.984 28.9576L309.79 130.307L310.175 130.934H317.06V18.1176H312.808V117.414Z"></path>
				<path d="M389.866 22.3696V18.1176H324.977V130.934H389.866V126.681H334.382V72.532H389.866V68.4404H334.382V22.3696H389.866Z"></path>
				<path d="M103.883 126.681V18.1176H94.4766V130.934H150.593V126.681H103.883Z"></path>
				<path d="M4.2892 72.6235H50.5303C65.436 72.6235 77.5589 84.8235 77.5589 99.8167C77.5589 114.718 65.436 126.842 50.5303 126.842H4.2892V72.6235ZM45.3761 68.3751H4.2892V22.5299H45.3761C57.9684 22.5299 68.2147 32.7766 68.2147 45.3726C68.2147 58.0568 57.9684 68.3751 45.3761 68.3751ZM63.7043 69.3099C72.3689 64.5964 77.9449 55.4511 77.9449 45.3726C77.9449 30.4339 65.7887 18.2779 50.8501 18.2779H0.0371094V131.094H56.0043C73.3397 131.094 87.4455 117.06 87.4455 99.8167C87.4455 85.1833 77.5043 72.7579 63.7043 69.3099Z"></path>
				</svg>
			</a>
		</div>
		
		<nav class="nav nav--utils" data-barba-prevent="all">
			<?php wp_nav_menu( array('theme_location' => 'tools', 'container' => false, 'menu_class' => 'nav-list') ); ?>
		</nav>
		<button class="burger">
			<span class="burger__bar burger__bar--top"></span>
			<span class="burger__bar burger__bar--middle"></span>
			<span class="burger__bar burger__bar--bottom"></span>
		</button>
	</div>
	<div class="mobile-nav">
	<?php

		wp_nav_menu(array(
			'theme_location' => 'main',
			'container' => 'nav',
			'container_class' => 'mobile-nav__main',
			'menu_class' => 'menu',
		));

		wp_nav_menu(array(
			'theme_location' => 'tools',
			'container' => 'nav',
			'container_class' => 'mobile-nav__tools',
			'menu_class' => 'menu',
		));

		?>
	</div>
	<?php if(isset($menuStructure[0]) && is_array($menuStructure[0])) :
		foreach($menuStructure[0] as $firstLevelItem): 

		?>
			<?php if(isset($menuStructure[$firstLevelItem->ID]) && is_array($menuStructure[$firstLevelItem->ID])): 
				$titleDataNav = strtolower($firstLevelItem->title);
				$titleDataNav = preg_replace('/[^a-z0-9]+/', '-', $titleDataNav);
				$titleDataNav = trim($titleDataNav, '-');
			?>
				<div class="topbar__sub" data-parent-nav="<?php echo $titleDataNav; ?>">
					<div class="topbar__sub__inner">
						<div class="topbar__sub__nav">

						<?php if(isset($menuStructure[$firstLevelItem->ID])):
						foreach($menuStructure[$firstLevelItem->ID] as $secondLevelItem):
							$target = $secondLevelItem->target == '_blank' ? ' target="_blank"' : '';
						?>

							<nav class="nav nav--sub">
								<ul class="nav-list">
									<li>
										<a href="<?php echo esc_url($secondLevelItem->url); ?>" title="<?php echo esc_html($secondLevelItem->title); ?>" <?php echo $target ?>> <?php echo esc_html($secondLevelItem->title); ?> </a>
									</li>

									<?php if(isset($menuStructure[$secondLevelItem->ID])): ?>
										<?php foreach ($menuStructure[$secondLevelItem->ID] as $thirdLevelItem): 
											$target = $thirdLevelItem->target == '_blank' ? ' target="_blank"' : '';?>
											<li>
												<a href="<?php echo esc_url($thirdLevelItem->url); ?>" title="<?php echo esc_html($thirdLevelItem->title); ?>" <?php echo $target ?>> <?php echo esc_html($thirdLevelItem->title); ?> </a>
											</li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</nav>

							<?php endforeach; ?>
						<?php endif; ?>

						</div>

						<div class="nav-media">
							<img src="https://assets.codepen.io/225413/blone-lemon.png" alt="">
						</div>
					</div>	
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

</div>