<?php
echo $this->Html->css('memo', null, array('inline' => false));
echo $this->Html->script('memoui', array('inline' => false));
?>

<h3>
	<?php echo __( 'Memo'); ?>
</h3>

<div class="categories clearfix">
	<?php foreach($memocategories as $memocategory) : ?>
	<div class="infobox col-sm-2" id="nc-<?php echo $memocategory['Memocategory']['id']?>">
		<a href="#" class="categoryselector">
			<?php echo $memocategory['Memocategory']['name']; ?>
		</a>
	</div>
	<?php endforeach; ?>
	<div class="infobox col-sm-2">
		<a href="#" class="addmemo">Add memo</a>
	</div>
</div>

<div id="memoui"></div>
