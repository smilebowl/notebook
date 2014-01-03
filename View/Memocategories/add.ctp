<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Html->link(__('List Memocategories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Memos'), array('controller' => 'memos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Memo'), array('controller' => 'memos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="memocategories form">
<?php echo $this->Form->create('Memocategory', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array('class' => 'col col-sm-3 control-label'),
		'wrapInput' => 'col col-sm-9',
		'class' => 'form-control',
	),
	'class' => 'well form-horizontal',
	'novalidate' => true,
)); ?>
	<fieldset>
		<legend><?php echo __('Add Memocategory'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('position');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
