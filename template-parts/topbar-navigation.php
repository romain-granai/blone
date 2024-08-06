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
			<a href="<?php echo get_home_url(); ?>" class="topbar__logo"><img src="<?php echo get_template_directory_uri()?>/assets/media/img/blone-logo.svg" alt=""></a>
		</div>
		
		<nav class="nav nav--utils">

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