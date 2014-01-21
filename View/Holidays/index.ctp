<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Holiday'), array('action' => 'add')); ?></li>
		<li>
			<?php echo $this->Form->postLink(
				__('Update holiday from Google'),
				array('action' => 'update'),
				array('confirm' => 'Update all holidays?'));
			?>
		</li>
	</ul>
</div>
<div class="holidays index">
	<h2><?php echo __('Holidays'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('day'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
		</tr>
	<?php foreach ($holidays as $holiday): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $holiday['Holiday']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $holiday['Holiday']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $holiday['Holiday']['id']), null, __('Are you sure you want to delete # %s?', $holiday['Holiday']['id'])); ?>
		</td>
		<td class="right"><?php echo h($holiday['Holiday']['id']); ?>&nbsp;</td>
		<td><?php echo h($holiday['Holiday']['name']); ?>&nbsp;</td>
		<td><?php echo h($holiday['Holiday']['day']); ?>&nbsp;</td>
		<td><?php echo h($holiday['Holiday']['modified']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
