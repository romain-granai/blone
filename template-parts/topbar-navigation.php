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
				<!-- <li><a href="#" data-nav="parfums" title="Parfums">Parfums</a></li>
				<li><a href="#" data-nav="l-univers-blone" title="L'univers Blone">L'univers Blone</a></li>
				<li><a href="#" title="Contact">Contact</a></li> -->
				<?php foreach($menuStructure[0] as $firstLevelItem): 
					$target = $firstLevelItem->target == '_blank' ? ' target="_blank"' : '';
					$titleDataNav = strtolower($firstLevelItem->title);
					$titleDataNav = preg_replace('/[^a-z0-9]+/', '-', $titleDataNav);
					$titleDataNav = trim($titleDataNav, '-');
				?>

					<li>
						<a href="<?php echo esc_url($firstLevelItem->url); ?>" data-nav="<?php echo $titleDataNav; ?>" title="<?php echo esc_html($firstLevelItem->title); ?>" <?php echo $target ?>> <?php echo esc_html($firstLevelItem->title); ?> </a>
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
	</div>
	
	<!-- <div class="topbar__sub" data-parent-nav="parfums">
		<div class="topbar__sub__inner">
			
			<div class="topbar__sub__nav">
				<nav class="nav nav--sub">
					<ul class="nav-list">
						<li class="nav-list__title"><span>Découvrir</span></li>
						<li><a href="#" title="Familles Olfactives">Familles Olfactives</a></li>
						<li><a href="#" title="Identité Blone">Identité Blone</a></li>
					</ul>
				</nav>
				
				<nav class="nav nav--sub">
					<ul class="nav-list">
						<li class="nav-list__title"><span>Collection</span></li>
						<li><a href="#" title="963">963</a></li>
						<li><a href="#" title="852">852</a></li>
						<li><a href="#" title="741">741</a></li>
						<li><a href="#" title="639">639</a></li>
						<li><a href="#" title="528">528</a></li>
						<li><a href="#" title="417">417</a></li>
						<li><a href="#" title="396">396</a></li>
					</ul>
				</nav>
			</div>
			
			<div class="nav-media">
				<img src="https://assets.codepen.io/225413/blone-lemon.png" alt="">
			</div>
			
		</div>
	</div>
	<div class="topbar__sub" data-parent-nav="l-univers-blone">
	<div class="topbar__sub__inner">
			
			<div class="topbar__sub__nav">
				<nav class="nav nav--sub">
					<ul class="nav-list">
						<li class="nav-list__title"><span>About Us</span></li>
						<li><a href="#" title="Notre philosophie">Notre philosophie</a></li>
						<li><a href="#" title="Notre Savoir Faire">Notre Savoir Faire</a></li>
					</ul>
				</nav>
				
				<nav class="nav nav--sub">
					<ul class="nav-list">
						<li class="nav-list__title"><span>Project Blone</span></li>
						<li><a href="#" title="Philantropie">Philantropie</a></li>
						<li><a href="#" title="Tribu Blone">Tribu Blone</a></li>
					</ul>
				</nav>
			</div>
			
			<div class="nav-media">
				<img src="https://assets.codepen.io/225413/blone-forest.png" alt="">
			</div>
			
		</div>
	</div> -->

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