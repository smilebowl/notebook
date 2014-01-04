<?php
	$priority = ($record['Record']['priority']) ? ' high-priority' : '';
?>
<tr id="record-<?php echo $record['Record']['id']?>">
	<td nowrap>
		<span class="actions">
			<i class="handle glyphicon glyphicon-leaf" title="Highlight"></i>
			<i class="formatreset glyphicon glyphicon-repeat" title="書式クリア"></i>
			<i class="remove glyphicon glyphicon-remove" title="削除"></i>
			<input type="checkbox" class="checkmark" style="display:none;"/>
		</span>
	</td>
<!--	<td class="eventdate" nowrap><?php // echo $record['Record']['eventdate']; ?></td>-->
	<td class="eventdate" nowrap><input type="text" class="inputdate" size="10" readonly="readonly" value="<?php echo $record['Record']['eventdate']; ?>" /></td>
	<td contenteditable="true" class="text<?php echo $priority;?>"><?php echo $record['Record']['title']; ?></td>
</tr>
