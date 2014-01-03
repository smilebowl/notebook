<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Html->link(__('List Notes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Notecategories'), array('controller' => 'notecategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notecategory'), array('controller' => 'notecategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="notes form">
<?php echo $this->Form->create('Note', array(
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
		<legend><?php echo __('Add Note'); ?></legend>
	<?php
		echo $this->Form->input('notecategory_id');
		echo $this->Form->input('name');
		echo $this->Form->input('text');
		echo $this->Form->input('xyz');
		echo $this->Form->input('wh');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
