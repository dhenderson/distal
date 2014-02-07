<?php foreach($targets as $target):?>
	<?php echo $this->html->link('Link ' . $target['Target']['name'] . ' to this program','/targets/linkProgramToTarget/' . $programId . '/' . $target['Target']['id']);?>
<?php endforeach;?>