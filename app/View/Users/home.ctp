<!-- File: /app/View/Users/home.ctp -->

<table class="table">
	<tr>
		<th>Organization</th>
	</tr>
	<?php foreach($organizations as $organization):?>
		<tr>
			<td>
				<?php echo $this->html->link($organization['Organization']['name'], '/organizations/about/' . $organization['Organization']['id']);?></li>
			</td>
		</tr>
	<?php endforeach;?>
</table>