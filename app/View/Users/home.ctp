<!-- File: /app/View/Users/home.ctp -->

<?php foreach($advisoryGroups as $advisoryGroup):?>
	<h1><?php echo $advisoryGroup['AdvisoryGroup']['name']?></h1>
	<div>
		<?php echo $this->html->link('Add an organization for ' . $advisoryGroup['AdvisoryGroup']['name'], '/organizations/add/' . $advisoryGroup['AdvisoryGroup']['id']);?>
	</div>
	<h2>Organizations in this group</h2>
	<ul>
	<?php foreach($organizations as $organization):?>
		<li><?php echo $this->html->link($organization['Organization']['name'], '/organizations/about/' . $organization['Organization']['id']);?></li>
	<?php endforeach;?>
	</ul>
<?php endforeach;?>