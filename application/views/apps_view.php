<html>
<body>
<h1><i>Applications</i></h1>
<?php $i = 1;?>
<ul>
<?php if(!$query):?>
<i><?="No comments!"?></i>
<?php endif;?>

<?php foreach($query as $item):?>
<li>
<i>
<strong><?=anchor('one_controller/index/'.$item->eid, "App#$i")?></strong>
<?=": by "?><strong><?=$item->uname?></strong><?=" on "?>
<?=date("D jS F Y g.iA", strtotime($item->time))?>
<strong><?=anchor('app_controller/agree/'.$item->eid.'/'.$item->uname, ' [&radic;] ')?></strong>
<strong><?=anchor('app_controller/disagree/'.$item->eid.'/'.$item->uname, ' [x]')?></strong>
<p>
	<?=nl2br($item->details)?>
</p>
</i>
</li>
<?php $i++;?>
<?php endforeach;?>
</ul>
<body>
<html>
