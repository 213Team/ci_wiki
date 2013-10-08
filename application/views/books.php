<div class="container">
<div class="row">
<div class="page-header">
  <h1>所有书籍</h1>
</div>
	<?php 
          if(!$mybooks):?>
	<div class="alert alert-info no-radius">
  			<strong>目前没有任何书籍。</strong>
	</div>
	<?php else:?>
	
	<table class="table table-striped table-hover">
	<thead>
            <tr>
              <th>#</th>
              <th>书名</th>
              <th>作者</th>
              <th>最后修改</th>
            </tr>
          </thead>
          <tbody>
          <?php 
          $i = 1;
          foreach($mybooks as $book){
          ?>	
            <tr>
              <td><?php echo $i;?></td>
              <td width="60%"><?php echo anchor("books/view/{$book->id}", $book->title);?></td>
              <td><?php echo $book->username;?> </td>
              <td><?php echo $book->lastmod;?> </td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>
	<?php endif;?>
</div>
</div>
