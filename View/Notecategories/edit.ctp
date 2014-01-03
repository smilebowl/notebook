<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Notecategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Notecategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Notecategories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Notes'), array('controller' => 'notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Note'), array('controller' => 'notes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="notecategories form">
<?php echo $this->Form->create('Notecategory', array(
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
		<legend><?php echo __('Edit Notecategory'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('position');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
