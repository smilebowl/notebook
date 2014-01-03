<?php
echo $this->Html->css('note', null, array('inline' => false));
echo $this->Html->script('noteui', array('inline' => false));
?>

<h3>
	<?php echo __( 'Note'); ?>
</h3>

<div class="categories clearfix">
	<?php foreach($notecategories as $notecategory) : ?>
	<div class="infobox col-sm-2" id="nc-<?php echo $notecategory['Notecategory']['id']?>">
		<a href="#" class="categoryselector">
			<?php echo $notecategory['Notecategory']['name']; ?>
		</a>
	</div>
	<?php endforeach; ?>
	<div class="infobox col-sm-2">
		<a href="#" class="addnote">Add note</a>
	</div>
</div>

<div id="noteui"></div>


<!--<?php foreach($notes as $noteset) : ?>

<div class="noteui" id="category-<?php echo $noteset['Notecategory']['id'];?>">
	<?php foreach($noteset['Note'] as $note) : ?>
	<?php	echo $this->element('../Notes/ui_element', array('note'=>$note)); ?>
	<?php endforeach; ?>
</div>

<?php endforeach; ?>-->
