<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Note'), array('action' => 'edit', $note['Note']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Note'), array('action' => 'delete', $note['Note']['id']), null, __('Are you sure you want to delete # %s?', $note['Note']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Note'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notecategories'), array('controller' => 'notecategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notecategory'), array('controller' => 'notecategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="notes view well well-sm">
<h2><?php echo __('Note'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($note['Note']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notecategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($note['Notecategory']['name'], array('controller' => 'notecategories', 'action' => 'view', $note['Notecategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($note['Note']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($note['Note']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Xyz'); ?></dt>
		<dd>
			<?php echo h($note['Note']['xyz']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wh'); ?></dt>
		<dd>
			<?php echo h($note['Note']['wh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($note['Note']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>