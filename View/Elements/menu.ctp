<?php
$act_todo=''; $act_memo=''; $act_calendar=''; $act_record=''; $act_timelog='';
switch ($this->name) {
	case "Todos":
	case "Todocategories":
	case "Todohistories":
		$act_todo = "active";
		break;
	case "Memos":
	case "Memocategories":
		$act_memo = "active";
		break;
	case "Calendars":
	case "Calendarcategories":
		$act_calendar = "active";
		break;
	case "Records":
	case "Recordcategories":
		$act_record = "active";
		break;
	case "Timelogs":
	case "Timelogcategories":
	case "Timelogtasks":
		$act_timelog = "active";
		break;
};
?>

<div id="sidebar-wrapper">
	<ul class="sidebar-nav">
		<li class="sidebar-brand">
			<a href="#">NOTEBOOK</a>
		</li>

		<!-- Dashboard -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller'=>'todos', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-home"></i>Dashboard</a>
		</li>

		<!-- Todo -->
		<li class="<?php echo $act_todo; ?>">
			<a href="<?php echo $this->Html->url(array('controller' => 'todos', 'action' => 'ui')); ?>">
				<i class="glyphicon glyphicon-tasks"></i><?php echo __('Todo') ?>
			</a>
<!--
		</li>
		<li>
-->
			<ul>
				<li>
					<?php echo $this->Html->link(__('Todocategories'), array('controller' => 'todocategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'todos', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Todohistories'), array('controller' => 'todohistories', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

		<!-- Record -->
		<li class="<?php echo $act_record; ?>">
			<a href="<?php echo $this->Html->url(array('controller'=>'records', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-play"></i><?php echo __('Record');?></a>
<!--
		</li>
		<li>
-->
			<ul>
				<li>
					<?php echo $this->Html->link(__('Recordcategories'), array('controller' => 'recordcategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'records', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

		<!-- Timelog -->
		<li class="<?php echo $act_timelog; ?>">
			<a href="<?php echo $this->Html->url(array('controller'=>'timelogs', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-time"></i><?php echo __('Timelog');?></a>
<!--
		</li>
		<li>
-->
			<ul>
				<li>
					<?php echo $this->Html->link(__('Timelogcategories'), array('controller' => 'timelogcategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'timelogs', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

		<!-- Memo -->
		<li class="<?php echo $act_memo; ?>">
			<a href="<?php echo $this->Html->url(array('controller'=>'memos', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-book"></i>Memo</a>
<!--
		</li>
		<li>
-->
			<ul>
				<li>
					<?php echo $this->Html->link(__('Memocategories'), array('controller' => 'memocategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'memos', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

		<!-- Calendar -->
		<li class="<?php echo $act_calendar; ?>">
			<a href="<?php echo $this->Html->url(array('controller'=>'calendars', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-calendar"></i><?php echo __('Calendar');?></a>
<!--
		</li>
		<li>
-->
			<ul>
				<li>
					<?php echo $this->Html->link(__('Calendarcategories'), array('controller' => 'calendarcategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'calendars', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

	</ul>
</div>