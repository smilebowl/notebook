<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Timelog'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Timelogcategories'), array('controller' => 'timelogcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogcategory'), array('controller' => 'timelogcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogtasks'), array('controller' => 'timelogtasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogtask'), array('controller' => 'timelogtasks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="timelogs index">
	<h2><?php echo __('Timelogs'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('timelogcategory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('timelogtask_id'); ?></th>
			<th><?php echo $this->Paginator->sort('workdate'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('worktime'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
		</tr>
	<?php foreach ($timelogs as $timelog): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $timelog['Timelog']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $timelog['Timelog']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $timelog['Timelog']['id']), null, __('Are you sure you want to delete # %s?', $timelog['Timelog']['id'])); ?>
		</td>
		<td class="right"><?php echo h($timelog['Timelog']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($timelog['Timelogcategory']['name'], array('controller' => 'timelogcategories', 'action' => 'view', $timelog['Timelogcategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($timelog['Timelogtask']['name'], array('controller' => 'timelogtasks', 'action' => 'view', $timelog['Timelogtask']['id'])); ?>
		</td>
		<td><?php echo h($timelog['Timelog']['workdate']); ?>&nbsp;</td>
		<td><?php echo h($timelog['Timelog']['title']); ?>&nbsp;</td>
		<td class="right"><?php echo h($timelog['Timelog']['worktime']); ?>&nbsp;</td>
		<td><?php echo h($timelog['Timelog']['created']); ?>&nbsp;</td>
		<td><?php echo h($timelog['Timelog']['modified']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
