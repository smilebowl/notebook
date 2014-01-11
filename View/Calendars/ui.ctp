<?php
echo $this->Html->css('calendar', null, array('inline' => false));
echo $this->Html->css('/js/vendar/fullcalendar/fullcalendar', null, array('inline' => false));
echo $this->Html->script('vendar/fullcalendar/fullcalendar.min', array('inline' => false));
echo $this->Html->script('vendar/fullcalendar/gcal', array('inline' => false));
echo $this->Html->script('calendarui', array('inline' => false));
?>

<h3><?php echo __('Calendar'); ?></h3>

<div class="categories clearfix">
	<?php foreach($calendarcategories as $calendarcategory) : ?>
	<div class="infobox col-sm-2" id="cal-<?php echo $calendarcategory['Calendarcategory']['id']?>">
		<a href="#" class="categoryselector">
			<?php echo $calendarcategory['Calendarcategory']['name']; ?>
		</a>
	</div>
	<?php endforeach; ?>
</div>


<div id="calendarui"></div>




<div id="dialog-event" title="Event" style="display: none;">
<!--	<p>イベントを追加</p>-->

	<?php
//		echo $this->Form->input('calendar_select',array(
//			'type'=>'select',
//			'label'=>__('Calendars'),
//			'options'=>$calendars,
//			'class' => 'form-control'
//		));
	?>
	<div class="titlepart">
		<label for="name">タイトル</label>
		<input type="text" size="30" name="name" id="event_title" class="form-control" placeholder="Event title" />
	</div>
	<div class="datepart form-group">
		<label for="edate" class="control-label">日付</label>
		<input type="text" name="edate" id="event_date" class="form-control input_date" value="date" />
	</div>
	<div class="detailpart form-group">
		<label for="edetail" class="control-label">詳細</label>
		<textarea name="edetail" id="event_detail" rows=3 class="form-control"></textarea>
	</div>
	<div class="clearfix">
		<label for="colorpicker" class="control-label">Color</label>
		<select name="colorpicker" id="event_color" class="form-control">
		  <option value="#7bd148">Green</option>
		  <option value="#5484ed">Bold blue</option>
		  <option value="#a4bdfc">Blue</option>
		  <option value="#46d6db">Turquoise</option>
		  <option value="#7ae7bf">Light green</option>
		  <option value="#51b749">Bold green</option>
		  <option value="#fbd75b">Yellow</option>
		  <option value="#ffb878">Orange</option>
		  <option value="#ff887c">Red</option>
		  <option value="#dc2127">Bold red</option>
		  <option value="#dbadff">Purple</option>
		  <option value="#e1e1e1">Gray</option>
		</select>
	</div>
</div>