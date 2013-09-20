<!-- File: /app/views/users/home.ctp -->
<?php if($message):?>
	<div style="background-color: #FFBBBB; border: 1px solid #880000; padding: 5px; margin-bottom: 15px;">
		<?php echo $message; ?>
	</div>
<?php endif;?>

<div id="transparency-container-right">
	<?php if(sizeOf($user['LinkedAccount'] )> 0):?>
		<div id="user-home-linked-accounts" style="margin-bottom: 15px;">
			<div style="background-color: #EEE; border: 1px solid #CCC; padding: 5px;">
				Applications
			</div>
			<?php foreach ($user['LinkedAccount'] as $linkedAccount): ?>
				<div style="border: 1px solid #CCC; border-top: 0px; color: #0000AA; font-weight: normal; padding: 5px;">
					<?php if($linkedAccount['username'] != "" OR $linkedAccount['password'] != ""):?>
					<form action="<?php echo $linkedAccount['action'];?>" method="<?php echo $linkedAccount['method'];?>" target="_blank" id="account-form-<?php echo $linkedAccount['linked_account_id'];?>">
						<input type="hidden" name="<?php echo $linkedAccount['username_form_field'];?>" value="<?php echo $linkedAccount['username'];?>" />
						<input type="hidden" name="<?php echo $linkedAccount['password_form_field'];?>" value="<?php echo $linkedAccount['password'];?>" />
						<a href="javascript:this.document.getElementById('account-form-<?php echo $linkedAccount['linked_account_id'];?>').submit()">
							<?php echo $linkedAccount['name'];?> 
						</a>
					</form>
					<?php endif;?>
					<?php if($linkedAccount['username'] == "" AND $linkedAccount['password'] == ""):?>
						<a href="<?php echo $linkedAccount['action']?>" target="_blank">
							<?php echo $linkedAccount['name'];?> 
						</a>
					<?php endif;?>
				</div>
			<?php endforeach;?>
		</div>
	<?php endif;?>
	
	<div id="user-home-linked-accounts" style="margin-bottom: 15px; font-weight: bold;">
		<div style="background-color: #EEE; border: 1px solid #CCC; padding: 5px;">
			Projects
		</div>
		<?php foreach ($projects as $project): ?>
			<div style="border: 1px solid #CCC; border-top: 0px; color: #0000AA; font-weight: normal; padding: 5px;">
				<?php echo $html->link($project['Project']['project_name'],'../projects/entries/' . $project['Project']['project_id'], array('escape'=>false) );?>
			</div>
		<?php endforeach;?>
	</div>
</div>

<div id="transparency-container-left" class="no-underline-anchors" style="width: 550px; margin-bottom: 20px; margin-left: 10px;">
	<?php if($entries):?>
		<h2 style="margin-top: 0px; margin-bottom: 0px; border-bottom: 1px solid #EEE; padding-bottom: 10px;">
			Recent entries
		</h2>
		<?php foreach($entries as $entry):?>
			<div style="border-bottom: 1px solid #EEE; padding: 20px 10px 20px 10px;"
				onmouseover="this.style.backgroundColor='#F7F7F7'" 
				onmouseout="this.style.backgroundColor='#FFF'"
			>
				<div style="float: left; width: 50px;">
					<?php if(sizeOf($entry['Upload']) > 0):?>
						<?php foreach($entry['Upload'] as $upload):?>
							<?php $extension = substr(strrchr($upload['name'],'.'),1); ?>
							<img src='<?php echo $this->base . '/img/fileico/' . $extension . '.gif'?>' />
						<?php endforeach;?>
					<?php endif;?>
					<?php if(sizeOf($entry['Upload']) == 0):?>
						<img src='<?php echo $this->base . '/img/icons/' . 'entry.png'?>' />
					<?php endif;?>
					<?php if($entry['Entry']['embed_url'] != ""):?>
						<img src='<?php echo $this->base . '/img/' . 'video_small.png'?>' />
					<?php endif;?>
				</div>
				<div style="margin-left: 65px;">
					<?php $entryTitle = "";?>
					<?php if($entry['Entry']['entry_type'] == "file"):?>
						<?php $firstFile = true;?>
						<?php foreach($entry['Upload'] as $upload):?>
							<?php if(!$firstFile):?>
								<?php $entryTitle .= ", ";?>
							<?php endif;?>
							<?php if($firstFile):?>
								<?php $firstFile = false;?>
							<?php endif;?>
							<?php $entryTitle .= $upload['display_name'];?>
						<?php endforeach;?>
					<?php endif;?>
					<?php if($entry['Entry']['entry_type'] != "file"):?>
						<?php $entryTitle = $entry['Entry']['title'];?>
					<?php endif;?>
					<span style="font-weight: bold; font-size: 1.1em;">
						<?php echo $html->link($entryTitle . ' ','../projects/entries/' . $entry['Project']['project_id'] . '/' . $entry['Entry']['entry_id'], array('escape'=>false) );?>		
					</span>
					<span style="color: #777;">
						posted in 
						<?php echo $html->link($entry['Project']['project_name'],'../projects/entries/' . $entry['Project']['project_id'], array('escape'=>false, 'style'=>'text-decoration: underline; color: #777;') );?> 
						on 
						<?php echo date('M jS, Y', strtotime($entry['Entry']['entry_date']));?>
					</span>
				</div>
			</div>
		<?php endforeach;?>
	<?php endif;?>
</div>