<?php
	$completed = ($todo['completed']) ? 'completed' : '';
	$priority = ($todo['priority']) ? ' high-priority' : '';
?>
<tr id="todo-<?php echo $todo['id']?>" class="<?php echo $completed; ?>">
	<td nowrap>
		<span class="actions">
			<i class="handle glyphicon glyphicon-tasks"></i>
			<i class="done glyphicon glyphicon-ok"></i>
			<i class="remove glyphicon glyphicon-remove"></i>
			<input type="checkbox" class="checkmark" style="display:none;"/>
		</span>
	</td>
	<td contenteditable="true" class="text<?php echo $priority;?>"><?php echo $todo['title']; ?></td>
</tr>