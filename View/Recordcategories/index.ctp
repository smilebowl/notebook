<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Recordcategory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Records'), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Record'), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="recordcategories index">
	<h2><?php echo __('Recordcategories'); ?></h2>
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
	<?php foreach ($recordcategories as $recordcategory): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $recordcategory['Recordcategory']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $recordcategory['Recordcategory']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $recordcategory['Recordcategory']['id']), null, __('Are you sure you want to delete # %s?', $recordcategory['Recordcategory']['id'])); ?>
		</td>
		<td><?php echo h($recordcategory['Recordcategory']['id']); ?>&nbsp;</td>
		<td><?php echo h($recordcategory['Recordcategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($recordcategory['Recordcategory']['position']); ?>&nbsp;</td>
		<td><?php echo h($recordcategory['Recordcategory']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
