<!-- File: /app/View/Users/home.ctp -->

<?php foreach($userGroups as $userGroup):?>
	<h1><?php echo $userGroup['UserGroup']['name']?></h1>
	<div>
		<?php echo $this->html->link('Add an organization for ' . $userGroup['UserGroup']['name'], '/organizations/add/' . $userGroup['UserGroup']['id']);?>
	</div>
	<h2>Organizations in this group</h2>
	<ul>
	<?php foreach($organizations as $organization):?>
		<li><?php echo $this->html->link($organization['Organization']['name'], '/organizations/about/' . $organization['Organization']['id']);?></li>
	<?php endforeach;?>
	</ul>
<?php endforeach;?>