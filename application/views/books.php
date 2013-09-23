<div class="container" style="margin-top:70px;">
<div class="row">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong>所有书籍</strong></div>
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
              <td width="60%"><?php echo anchor("usercenter/catalog/{$book->id}", $book->title);?></td>
              <td><?php echo $book->username;?> </td>
              <td><?php echo $book->lastmod;?> </td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>

</div>
</div>
</div>
