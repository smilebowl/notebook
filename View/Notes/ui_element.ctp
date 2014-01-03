<?php
	$xyz = explode('.',$note['Note']['xyz']);
	$wh = explode('.',$note['Note']['wh']);
	$style = "left:{$xyz[0]}px; top:{$xyz[1]}px; z-index:{$xyz[2]}; width:{$wh[0]}px; height:{$wh[1]}px; ";
?>
<div class="norwwrapper">
	<div class="widget" id="note-<?php echo $note['Note']['id'] ?>" style="<?php echo $style; ?>">
		<div class="widget-header">
			<i class="icon glyphicon glyphicon-th"></i>
			<span class="title" contenteditable=true>
				<?php echo $note['Note']['name']; ?>
			</span>
			<span class="actions">
				<i class="formatreset glyphicon glyphicon-repeat" title="書式クリア"></i>
				<i class="remove glyphicon glyphicon-remove" title="削除"></i>
			</span>
		</div>
		<div class="widget-content nopadding">
			<div contenteditable="true" class="text">
				<?php echo $note['Note']['text']; ?>
			</div>
		</div>
	</div>
</div>