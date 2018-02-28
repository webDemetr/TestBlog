<?php

$mysqli = new MYSQLI('127.0.0.1','root','') or die ('Cannot connect to database');
$mysqli -> select_db('blog') or die('Cannot select databese');
$mysqli -> set_charset('UTF8');



const  INSERT_INTO_ENTRY ='
INSERT INTO 
  entry(
       autor,
       date,
       header,
       content) 

VALUES
 (?,?,?,? )';

const INSERT_INTO_COMMENTS ='
INSERT INTO
       comments(
       entry_id,
       autor,
       date,
       content)
VALUES (?,?,?,?)';

const UPDATE_EDIT_ENTRY = '
      UPDATE entry SET(
      autor,
      header,
      content)
      VALUES(
      :autor,
      :header,
      :content)';



 ?>
