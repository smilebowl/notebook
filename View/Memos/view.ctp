<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Memo'), array('action' => 'edit', $memo['Memo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Memo'), array('action' => 'delete', $memo['Memo']['id']), null, __('Are you sure you want to delete # %s?', $memo['Memo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Memos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Memo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Memocategories'), array('controller' => 'memocategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Memocategory'), array('controller' => 'memocategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="memos view well well-sm">
<h2><?php echo __('Memo'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($memo['Memo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Memocategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($memo['Memocategory']['name'], array('controller' => 'memocategories', 'action' => 'view', $memo['Memocategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($memo['Memo']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($memo['Memo']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Xyz'); ?></dt>
		<dd>
			<?php echo h($memo['Memo']['xyz']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wh'); ?></dt>
		<dd>
			<?php echo h($memo['Memo']['wh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($memo['Memo']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>