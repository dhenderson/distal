<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('style');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/libs/jquery/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/libs/springy/springy.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/libs/springy/springyui.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/libs/canvas2image/canvas2image.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/libs/canvas2image/base64.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot;?>js/libs/bootstrap/bootstrap.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
		
</head>
<body>
	<div id="container">
		<header>
			<span id="app-name">
				<?php echo $this->html->link('Distal', '/users/home'); ?>
			</span> 
			<?php echo $title_for_layout; ?>
		</header>
		<?php if(isset($navOptions)):?>
			<nav>
				<ul>
					<?php foreach($navOptions as $displayValue => $linkValue):?>
						<li>
							<?php echo $this->html->link($displayValue, $linkValue);?>
						</li>
					<?php endforeach;?>
				</ul>
			</nav>
		<?php endif;?>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
