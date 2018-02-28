<?php require('header.php') ?>
 <style type"text/css" >
  .coments{margin-bottom: 20px;}
    .date, .autor{
      font-size: 0.8em;
      margin-right: 10px;
    }

    .content{
      padding-left: 20px;
      padding-top: 5px;
    }
    .entry{
      padding-left:20px;
    }  
</style>
<?php foreach ($records as $row): ?>

<div class="entry">
<h3> <a href="?act=view-entry&id=<?=$row['id']?>"> <?=$row['header']  ?></a>
  <?php if (IS_ADMIN) : ?>
     <a href="?act=edit-entry&id=<?=$row['id']  ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
    <a href="?act=delete-entry&id=<?=$row['id']  ?>"> <i class="fa fa-trash-o" aria-hidden="true"></i></i></a></h3> 
<?php endif ?>
  <div class="content">
  <p><?=$row['content'] ?></p>
</div>

<div class="comments">
  <p><span class="date"> <?=$row['date'] ?></span>
  <span class="autor"><?=$row['autor'] ?></span>
  <a href="?act=view-entry&id=<?=$row['id'] ?>"> <?=$row['comments'] ?>  comments</a><hr></p>
</div>
</div>
<?php endforeach ?>

<div>
 <strong>Pages:</strong>  
<?php for ($i=1; $i <= $pages; $i++): ?>
 <?php if ($i == $page):?><br><b><?=$i ?></b>
 <?php else: ?> <a href=?page=<?=$i ?> ><?=$i ?></a>

 <?php endif ?>

<?php endfor ?>
</div>

<?php if (IS_ADMIN): ?>
  <form action="?act=do-new-entry" method="POST">
<h1>Add new entry</h1>
<label for="">Autor</label>  
<input type="text" name="autor"><br>
<label for="">Header</label>  
<input type="text" name="header"><br>
<label for="">Content</label>  
<textarea name="content" id="" cols="30" rows="10"></textarea>
<button type="submit" class="submit" value="login">Зберегти</button>

</form>
<?php endif ?>
<?php require('footer.php') ?>
