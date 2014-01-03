<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Memo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Memo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Memos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Memocategories'), array('controller' => 'memocategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Memocategory'), array('controller' => 'memocategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="memos form">
<?php echo $this->Form->create('Memo', array(
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
		<legend><?php echo __('Edit Memo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('memocategory_id');
		echo $this->Form->input('name');
		echo $this->Form->input('text');
		echo $this->Form->input('xyz');
		echo $this->Form->input('wh');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
