<div class="topbar">
	<div class="topbar__main">
		
		<nav class="nav nav--main">
			<ul class="nav-list">
				<li><a href="#" data-nav="parfums">Parfums</a></li>
				<li><a href="#" data-nav="l-univers-blone">L'univers Blone</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</nav>
		<div class="topbar__logo-container">
			<a href="<?php echo get_home_url(); ?>" class="topbar__logo"><img src="<?php echo get_template_directory_uri()?>/assets/media/img/blone-logo.svg" alt=""></a>
		</div>
		
		<nav class="nav nav--utils">
			<?php wp_nav_menu( array('theme_location' => 'tools', 'container' => false, 'menu_class' => 'nav-list') ); ?>
		</nav>
	</div>
	
	<div class="topbar__sub" data-parent-nav="parfums">
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
	</div>
</div>