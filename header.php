<!DOCTYPE html>
<html lang="en"> 
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php
    wp_head();
    ?>

</head> 

<body>
    
    <header>
		<div class="container">
		<?php
			wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_class' => 'primary'
				)
			);
		?>
		</div>
    </header>
