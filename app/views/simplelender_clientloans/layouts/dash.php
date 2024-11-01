<div class="client_dash">
	
	<div id="simplelender_dash_content">
			<div class="logout_link_wrapper">

					<div id="simplelender_dash_menu">
						<nav id="site-navigation" class="simplelender_dash_menu" role="navigation" aria-label="Top Menu">
							<?php wp_nav_menu( array( 'theme_location' => 'simplelender_client_admin_menu' ) ); ?>
						</nav>
					</div>
				
				<span class="logout_link"><?php
				$user = wp_get_current_user();
				echo "<a href='". mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => 'index',))."'> <b>Loan Applications</b> </a> | ";
				echo "<a href='". mvc_public_url(array('controller' => 'simplelender_messages', 'action' => 'index',))."'> <b>Open Tickets</b> </a> | <b>".$user->data->user_nicename." </b> - ";
				
				?>
				<a href="<?php echo  get_site_url(); ?>/wp-login.php?action=logout"><button>Logout</button></a></span>
			</div>
			<br><br><div >

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>

</div>