<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Note'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Notecategories'), array('controller' => 'notecategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notecategory'), array('controller' => 'notecategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="notes index">
	<h2><?php echo __('Notes'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('notecategory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('text'); ?></th>
			<th><?php echo $this->Paginator->sort('xyz'); ?></th>
			<th><?php echo $this->Paginator->sort('wh'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
	<?php foreach ($notes as $note): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $note['Note']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $note['Note']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $note['Note']['id']), null, __('Are you sure you want to delete # %s?', $note['Note']['id'])); ?>
		</td>
		<td><?php echo h($note['Note']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($note['Notecategory']['name'], array('controller' => 'notecategories', 'action' => 'view', $note['Notecategory']['id'])); ?>
		</td>
		<td><?php echo h($note['Note']['name']); ?>&nbsp;</td>
		<td><?php echo String::truncate(h($note['Note']['text']), 20); ?>&nbsp;</td>
		<td><?php echo h($note['Note']['xyz']); ?>&nbsp;</td>
		<td><?php echo h($note['Note']['wh']); ?>&nbsp;</td>
		<td><?php echo h($note['Note']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
