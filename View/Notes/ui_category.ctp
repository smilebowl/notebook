<div id="category-<?php echo $notecategory_id; ?>">

<?php foreach($notes as $note) : ?>

	<?php
			echo $this->element('../Notes/ui_element', array('note'=>$note));
	?>

<?php endforeach; ?>

</div>