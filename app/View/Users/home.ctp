<!-- File: /app/View/Users/home.ctp -->

<h1>Organization</h1>
<div>
	<?php echo $this->html->link('Add an organization', '/organizations/add/' . $user['UserGroup']['id']);?>
</div>
<ul>
<?php foreach($organizations as $organization):?>
	<li><?php echo $this->html->link($organization['Organization']['name'], '/organizations/about/' . $organization['Organization']['id']);?></li>
<?php endforeach;?>
</ul>