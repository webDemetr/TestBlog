<?php require('header.php') ?>
<h1>Edit entry</h1>
<form action="?act=apply-edit-entry" method="POST" class="well">
<input type="hidden" name="id" value='<?=$id?>'>
 <label for="">Autor</label>  
<input type="text" name="autor" value='<?=$row['autor']?>'><br>
<label for="">Header</label>  
<input type="text" name="header" value='<?=$row['header']?>'><br>
<label for="">Content</label>  
<textarea name="content" id="" cols="30" rows="10"> <?=$row['content']?></textarea>
<button type="submit" class="submit" value="login">Зберегти</button>
</form>
<?php require('footer.php') ?>
  