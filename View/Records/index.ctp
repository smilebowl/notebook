<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Record'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Recordcategories'), array('controller' => 'recordcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recordcategory'), array('controller' => 'recordcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="records index">
	<h2><?php echo __('Records'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('recordcategory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('eventdate'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
	<?php foreach ($records as $record): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $record['Record']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $record['Record']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $record['Record']['id']), null, __('Are you sure you want to delete # %s?', $record['Record']['id'])); ?>
		</td>
		<td class="right"><?php echo h($record['Record']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($record['Recordcategory']['name'], array('controller' => 'recordcategories', 'action' => 'view', $record['Recordcategory']['id'])); ?>
		</td>
		<td><?php echo h($record['Record']['eventdate']); ?>&nbsp;</td>
		<td><?php echo String::truncate(h($record['Record']['title']),20); ?>&nbsp;</td>
		<td><?php echo h($record['Record']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
