<?php
	$priority = ($record['Record']['priority']) ? ' high-priority' : '';
?>
<tr id="record-<?php echo $record['Record']['id']?>">
	<td nowrap>
		<span class="actions">
			<i class="handle glyphicon glyphicon-leaf"></i>
			<i class="remove glyphicon glyphicon-remove"></i>
			<input type="checkbox" class="checkmark" style="display:none;"/>
		</span>
	</td>
<!--	<td class="eventdate" nowrap><?php // echo $record['Record']['eventdate']; ?></td>-->
	<td class="eventdate" nowrap><input type="text" class="inputdate" size="8" readonly="readonly" value="<?php echo $record['Record']['eventdate']; ?>" /></td>
	<td contenteditable="true" class="text<?php echo $priority;?>"><?php echo $record['Record']['title']; ?></td>
</tr>
