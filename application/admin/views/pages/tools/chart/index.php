<?php if ((int)$apply > 0):?>
<script type='text/javascript'>

google.load('visualization', '1', {packages:['table', 'corechart', 'annotatedtimeline', 'geochart']});
google.setOnLoadCallback(drawChartWrapper);

// chart options
var timeline_option = {
	fill: 20
};
var table_option = {
	showRowNumber: true,
	width: '175'
};
var pie_option = {
	is3D: true,
	chartArea: {
		left: 20,
		top: 20,
		width: '100%',
		height: '85%'
	},
	height: '500',
	legend: {position: 'bottom'}
};
var bar_option = {}
var geo_option = {
	region: 'JP',
	displayMode: 'regions',
	resolution: 'provinces',
	height: '500'
}

// sum data table
var sum = {
	<?php $targets = array_keys($sum);?>
	<?php foreach ($targets as $target):?>
	<?php echo $target;?>: [['<?php echo $target;?>','count'],<?php echo $sum[$target];?>],
	<?php endforeach;?>
}

// draw chart wrapper
function drawChartWrapper(){
	drawChart();
}

// draw table and chart
function drawChart(target){
	if (target == undefined) target = 'sex';
	var data = google.visualization.arrayToDataTable(sum[target]);
	var table = new google.visualization.Table(document.getElementById('table'));
	table.draw(data, table_option);
	switch (target){
		case 'sex':
			var pie = new google.visualization.PieChart(document.getElementById('chart'));
			pie.draw(data, pie_option);
			break;
		case 'pref':
			var geo = new google.visualization.GeoChart(document.getElementById('chart'));
			geo.draw(data, geo_option);
			break;
		default:
			var bar = new google.visualization.BarChart(document.getElementById('chart'));
			bar.draw(data, bar_option);
			break;
	} 
	<?php if ($day === ''):?>
	var timeline_data = new google.visualization.DataTable();
	timeline_data.addColumn('date', 'date');
	timeline_data.addColumn('number', 'apply');
	timeline_data.addColumn('string', 'title1');
	timeline_data.addColumn('string', 'text1');
	timeline_data.addColumn('number', 'paid');
	timeline_data.addColumn('string', 'title2');
	timeline_data.addColumn('string', 'text2');
	timeline_data.addRows([<?php echo $timeline;?>]);
	var timeline_chart = new google.visualization.AnnotatedTimeLine(document.getElementById('timeline'));
	timeline_chart.draw(timeline_data, timeline_option);
	<?php endif;?>
}

// change pulldown menu handler
function selectTarget(e){
	var target = e.options[e.selectedIndex].value;
	drawChart(target);
}

</script>
<?php endif;?>


<!--target date-->
<h2>Chart<?php
if ($year !== '')  echo ' - ' . $year;
if ($month !== '') echo ' / '  . $month;
if ($day !== '')   echo ' / '  . $day;
echo ' - '.$ad;
?></h2>


<!--selecting ad area-->
<div id="ad_bg">
<ul id="ad">
<?php
$ad_groups = array(
	'all',
	'google',
	'yahoo',
	'other',
);
$segments = $this->uri->rsegment_array();
foreach ($ad_groups as $ad_group)
{
	$segments[3] = $ad_group;
	$url = base_url(implode('/', $segments));
	$selected = ($ad_group === $ad) ? 'class="selected"' : '';
	echo '<li><a '.$selected.' href="'.$url.'">'.$ad_group.'</a></li>';
}
?>
</ul>
</div>
<div class="clear"></div>


<!--calendar and general counts area-->
<div class="box_solid">
<div class="box_solid" id="calendar"><?php echo $calendar;?></div>
<div class="box">
<ul>
<?php if ((int)$apply > 0):?>
<li>申請: <?php echo $apply;?></li>
<li>決済: <?php echo $paid;?></li>
<?php else:?>
<li>application data is not found.</li>
<?php endif;?>
</ul>
</div>
</div>
<div class="clear"></div>


<?php if ((int)$apply > 0):?>


<!--timeline chart-->
<?php if ($day === ''):?>
<div class="box_solid">
<div id="timeline"></div>
</div>
<?php endif;?>


<!--select chart-->
<span class="menu">表示対象チャート：</span>
<select onchange="selectTarget(this)">
<?php foreach ($targets as $target):?>
<option value="<?php echo $target;?>"><?php echo $target;?></option>
<?php endforeach;?>
</select>


<!--table and chart area-->
<div class="box_solid">
<div id="table_wrapper"><div id="table"></div></div>
<div id="chart_wrapper"><div id="chart"></div></div>
<div class="clear"></div>
</div>


<?php endif;?>
