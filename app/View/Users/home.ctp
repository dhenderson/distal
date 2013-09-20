<!-- File: /app/View/Users/home.ctp -->

<h1>Organization</h1>
<ul>
<?php foreach($organizations as $organization):?>
	<li><?php echo $organization['Organization']['name'];?></li>
<?php endforeach;?>
</ul>