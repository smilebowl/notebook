<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('New Memo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Memocategories'), array('controller' => 'memocategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Memocategory'), array('controller' => 'memocategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="memos index">
	<h2><?php echo __('Memos'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('memocategory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('text'); ?></th>
			<th><?php echo $this->Paginator->sort('xyz'); ?></th>
			<th><?php echo $this->Paginator->sort('wh'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
	<?php foreach ($memos as $memo): ?>
	<tr style="white-space: nowrap;">
		<td class="actions">
			<?php echo $this->Icon->link(__('View'), array('action' => 'view', $memo['Memo']['id'])); ?>
			<?php echo $this->Icon->link(__('Edit'), array('action' => 'edit', $memo['Memo']['id'])); ?>
			<?php echo $this->Icon->postLink(__('Delete'), array('action' => 'delete', $memo['Memo']['id']), null, __('Are you sure you want to delete # %s?', $memo['Memo']['id'])); ?>
		</td>
		<td class="right"><?php echo h($memo['Memo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($memo['Memocategory']['name'], array('controller' => 'memocategories', 'action' => 'view', $memo['Memocategory']['id'])); ?>
		</td>
		<td><?php echo h($memo['Memo']['name']); ?>&nbsp;</td>
		<td><?php echo String::truncate(h($memo['Memo']['text']), 20); ?>&nbsp;</td>
		<td><?php echo h($memo['Memo']['xyz']); ?>&nbsp;</td>
		<td><?php echo h($memo['Memo']['wh']); ?>&nbsp;</td>
		<td><?php echo h($memo['Memo']['created']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sx', 'modulus' => 9));
	?>
	</div>
</div>
