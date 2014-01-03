<div id="category-<?php echo $memocategory_id; ?>">

<?php foreach($memos as $memo) : ?>

	<?php
			echo $this->element('../Memos/ui_element', array('memo'=>$memo));
	?>

<?php endforeach; ?>

</div>