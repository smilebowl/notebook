<?php
$id = $timelog['Timelog']['id'];

//debug($timelog, true);

?>
<tr id="timelog-<?php echo $id?>">
	<td nowrap>
		<span class="actions">
			<i class="remove glyphicon glyphicon-remove" title="削除"></i>
			<input type="checkbox" class="checkmark" style="display:none;"/>
		</span>
	</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id ?>" />
		<?php echo $this->Form->input('timelogcategory_id', array('name'=>'timelogcategory_id','class'=>'form-control input-sm','label'=>false, 'value'=>$timelog['Timelog']['timelogcategory_id'])); ?>
	</td>
	<td>
		<?php echo $this->Form->input('timelogtask_id', array('name'=>'timelogtask_id','class'=>'form-control input-sm','label'=>false,'empty'=>'---','value'=>$timelog['Timelog']['timelogtask_id'])); ?>
	</td>
	<td><input name="worktime" name="worktime" value="<?php echo number_format($timelog['Timelog']['worktime'], 2); ?>" class="form-control input-sm timelog_worktime" placeholder="worktime" type="number" /></td>
	<td><input name="title" name="title" value="<?php echo $timelog['Timelog']['title']?>" class="form-control input-sm timelog_title" placeholder="(title)" type="text"></td>
</tr>
