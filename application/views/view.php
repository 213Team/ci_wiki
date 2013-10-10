<?php 
include_once 'markdown/Michelf/Markdown.php';
include_once 'markdown/Michelf/MarkdownExtra.php';
use \Michelf\MarkdownExtra;
?>

<div class="container" style="margin-top:30px;">
<div class="row">
<div class="col-md-8">
<?php
if($body)
	echo MarkdownExtra::defaultTransform($body->body);
?>
</div>
</div>
</div>





