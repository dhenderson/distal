<!-- File: /app/View/Outcome/edit.ctp -->
<?php
	echo $this->form->create('Outcome');
	echo $this->form->input('name');
	echo $this->form->input('id', array('type'=>'hidden'));
	echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organization_id));
	echo $this->form->end('Save outcome');
?>
<div>
<h2>Parent outcomes</h2>
<table class="table">
	<tr>
		<th>Parent outcome</th>
		<th>Remove parent</th>
	</tr>
	<?php foreach($outcome['Parent'] as $parent):?>
		<tr>
			<td><?php echo $parent['name'];?></td>
			<td><?php echo $this->html->link('Remove parent', '/outcomes/removeparent/' . $outcome['Outcome']['id'] . '/' . $parent['id']);?></td>
		</tr>
	<?php endforeach;?>
</table>

</div>