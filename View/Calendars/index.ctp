<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Calendar'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Calendarcategories'), array('controller' => 'calendarcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendarcategory'), array('controller' => 'calendarcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="calendars index">
	<h2><?php echo __('Calendars'); ?></h2>

<?php echo $this->Form->create('Calendar', array(
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
	echo $this->Form->input('calendarcategory_id', array('empty'=>'---'));
	echo $this->Form->input('start', array(
		'type'=>'text','class'=>'form-control col col-sm-1 input_date','placeholder' => 'start day'
	));
	echo $this->Form->input('keyword', array(
		'type'=>'text','class'=>'form-control','placeholder' => 'keyword'
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
			<th><?php echo $this->Paginator->sort('calendarcategory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('start'); ?></th>
			<th><?php echo $this->Paginator->sort('end'); ?></th>
			<th><?php echo $this->Paginator->sort('detail'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
<!--			<th><?php echo $this->Paginator->sort('textcolor'); ?></th>-->
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
	<?php foreach ($calendars as $calendar): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $calendar['Calendar']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $calendar['Calendar']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $calendar['Calendar']['id']), null, __('Are you sure you want to delete # %s?', $calendar['Calendar']['id'])); ?>
		</td>
		<td class="right"><?php echo h($calendar['Calendar']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($calendar['Calendarcategory']['name'], array('controller' => 'calendarcategories', 'action' => 'view', $calendar['Calendarcategory']['id'])); ?>
		</td>
		<td><?php echo String::truncate(h($calendar['Calendar']['title']), 20); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['start']); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['end']); ?>&nbsp;</td>
		<td><?php echo String::truncate(h($calendar['Calendar']['detail']), 20); ?>&nbsp;</td>
		<td><?php echo h($calendar['Calendar']['color']); ?>&nbsp;</td>
<!--		<td><?php echo h($calendar['Calendar']['textcolor']); ?>&nbsp;</td>-->
		<td><?php echo h($calendar['Calendar']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
