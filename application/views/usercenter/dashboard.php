<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-offset-1 col-md-11">

<div class="panel panel-default no-radius boxshadow">
<div class="panel-heading"><strong>Profile</strong></div>
<?php if(!isset($user) || $user->profile == ""){?>
	<div class="alert alert-info no-radius">
  			<strong>还没有任何个人介绍！<?php echo anchor('usercenter/account', '现在去修改>>', 'class="alert-link"');?></strong>
	</div>
<?php }else{?>
<div class="panel-body">
<h4>
<?php echo $user->profile;?></h4>
<?php }?>
</div>
</div>

</div>

<div class="row" name="sdfsdf">

<div class="col-md-11 col-md-offset-1">
<div class="col-md-6">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong>我创作的书籍</strong></div>
    <?php 
          if(!$mybooks):?>
	<div class="alert alert-info no-radius">
  			<strong>您还没有任何书籍。</strong>
	</div>
	<?php else:?>
	<table class="table table-striped table-hover">
	<thead>
            <tr>
              <th>#</th>
              <th>书名</th>
              <th>最后修改</th>
            </tr>
          </thead>
          <tbody>
          
          <?php $i = 1;
          foreach($mybooks as $book){
          ?>	
            <tr>
              <td><?php echo $i;?></td>
              <td><?php echo anchor("usercenter/catalog/{$book->id}", $book->title);?></td>
              <td><?php echo $book->lastmod;?> </td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>
	<?php endif;?>
</div>
</div>

<div class="col-md-6">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong>我参与贡献的书籍</strong></div>
	
	<?php if(!$mycontrib || count($mycontrib) == 0){?>
    	<div class="alert alert-info no-radius">
  			<strong>暂时没有贡献任何意见。</strong>
		</div>
	<?php }else{?>
	<table class="table table-hover table-striped">
    	<thead>
            <tr>
              <th>#</th>
              <th>书籍：章节</th>
              <th>创作用户</th>
            </tr>
        </thead>
        <?php $i = 1;
          foreach($mycontrib as $row){
          ?>	
            <tr>
              <td><?php echo $i;?></td>
              <td><?php echo anchor("books/view/{$row->bid}/{$row->cid}", $row->btitle." : ".$row->ctitle);?></td>
              <td><?php echo $row->username?></td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>
	<?php }?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
