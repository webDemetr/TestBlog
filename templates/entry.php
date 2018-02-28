<?php require('header.php') ?>

<style>
    .comments{
		font-size: 0.8em;
		margin-bottom: 20px;
	}
</style>

<h4> <?=$ENTRY['header'] ?></h4>
<p class="justify"><?=$ENTRY['content'] ?></p>

<div class="comments">
 <p> <span class="date"> <?=$ENTRY['date'] ?></span>
  <span class="autor"><?=$ENTRY['autor'] ?></span></p>
</div>



<h2>Comments:</h2>

<?php foreach ($comments as $row): ?>
<div class="entry">
<div class="comment-header">
  <span class="date"> <?=$row['date'] ?></span>
  <span class="autor"><b><?=$row['autor'] ?>
    <?php if (IS_ADMIN) : ?>
    <a href="?act=delete-comment&entry_id=<?=$ENTRY['id']?>&id=<?=$row['id']  ?>"> <i class="fa fa-trash-o" aria-hidden="true"></i></i></a></h3> 
<?php endif ?>
  </b></span>
</div>
  <div class="comments"><p> <?=$row['content'] ?> </p>
</div>

</div>
<?php endforeach ?>


<h1>Add new comment</h1>
 <form action="?act=do-new-comment" method="POST">
 	 <input type="hidden" name="entry_id" value="<?=$id?>">
	<label for="">Autor</label>  
	<input type="text"  name="autor"><br>
	<label for="">Content</label>  
	<textarea type="text" name="content"></textarea><br>
	<input type="submit"class="button special" class="btn" value="Відправити "></button>
</form>
<?php require('footer.php') ?>
