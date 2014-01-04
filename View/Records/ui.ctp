<?php
echo $this->Html->css('record', null, array('inline' => false));
echo $this->Html->script('recordui', array('inline' => false));
?>

<h3>
	<?php echo __( 'Record'); ?>
</h3>

<div class="categories clearfix">
	<?php foreach($recordcategories as $recordcategory) : ?>
	<div class="infobox col-sm-2" id="nc-<?php echo $recordcategory['Recordcategory']['id']?>">
		<a href="#" class="categoryselector"><?php echo $recordcategory['Recordcategory']['name']; ?></a>
	</div>
	<?php endforeach; ?>
</div>

<div id="recordui"></div>
