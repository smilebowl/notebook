<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Notecategory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Notes'), array('controller' => 'notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Note'), array('controller' => 'notes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="notecategories index">
	<h2><?php echo __('Notecategories'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('position'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
	<?php foreach ($notecategories as $notecategory): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $notecategory['Notecategory']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $notecategory['Notecategory']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $notecategory['Notecategory']['id']), null, __('Are you sure you want to delete # %s?', $notecategory['Notecategory']['id'])); ?>
		</td>
		<td><?php echo h($notecategory['Notecategory']['id']); ?>&nbsp;</td>
		<td><?php echo h($notecategory['Notecategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($notecategory['Notecategory']['position']); ?>&nbsp;</td>
		<td><?php echo h($notecategory['Notecategory']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
