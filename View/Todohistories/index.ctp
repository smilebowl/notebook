<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Todohistory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Todocategories'), array('controller' => 'todocategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Todocategory'), array('controller' => 'todocategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="todohistories index">
	<h2><?php echo __('Todohistories'); ?></h2>

<?php echo $this->Form->create('Todohistory', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'form-inline well well-sm',
	'novalidate' => true
	));
	echo $this->Form->submit('Search', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->input('todocategory_id', array('empty'=>'---'));
	echo $this->Form->input('title', array(
		'type'=>'text','class'=>'form-control','placeholder' => 'Title'
	));
	echo $this->Form->input('start', array(
		'type'=>'text','class'=>'form-control col col-xs-1 input_date','placeholder' => 'completed from'
	));
	echo $this->Form->input('end', array(
		'type'=>'text','class'=>'form-control col col-xs-1 input_date','placeholder' => 'completed to'
	));
	echo $this->Form->end();
?>

<div class="clearfix"></div>

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<table class="table table-striped table-hover table-condensed">
	<tr>
		<th class="actions"><?php echo __('Actions'); ?></th>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('todocategory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('completed'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
	<?php foreach ($todohistories as $todohistory): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $todohistory['Todohistory']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $todohistory['Todohistory']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $todohistory['Todohistory']['id']), null, __('Are you sure you want to delete # %s?', $todohistory['Todohistory']['id'])); ?>
		</td>
		<td class="right"><?php echo h($todohistory['Todohistory']['id']); ?>&nbsp;</td>
		<td><?php echo String::truncate(h($todohistory['Todohistory']['title']), 20); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($todohistory['Todocategory']['name'], array('controller' => 'todocategories', 'action' => 'view', $todohistory['Todocategory']['id'])); ?>
		</td>
		<td><?php echo h($todohistory['Todohistory']['completed']); ?>&nbsp;</td>
		<td><?php echo h($todohistory['Todohistory']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
