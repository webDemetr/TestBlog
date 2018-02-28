<?php
session_start(); 
header('Content-type: text/html; charset=UTF-8 ');
require"queries.php";
$act = isset ($_GET['act']) ? $_GET['act'] : 'list';

define('IS_ADMIN', isset($_SESSION['IS_ADMIN']));

       switch ($act) {
              case 'list':
               $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
               $limit  = 2;
               $offset = ($page - 1) * $limit;
               $records = array(); 
               $pages_result= $mysqli -> query("SELECT COUNT(id) AS number_page FROM entry ")->fetch_assoc();
               $pages = $pages_result['number_page']/$limit;
               $sel = $mysqli -> query("SELECT entry.*, COUNT(comments.id) AS comments FROM entry LEFT JOIN comments ON entry.id = comments.entry_id GROUP BY entry.id ORDER BY date DESC LIMIT $offset, $limit");
                 while ($row = $sel-> fetch_assoc()) {
                  $row['date'] = date('Y-m-d H:i:s', $row['date'] );
                  if (mb_strlen($row['content'])>100) {
                    $row['content'] = mb_substr(strip_tags($row['content']), 0,97) . '...';
                  }
                  $row['content'] = nl2br($row['content']);
                  $records[] = $row;
                    }
                 require 'templates/list.php';
              break;

              case 'view-entry':
                 if (!isset($_GET['id'])) die ("Missing id parametr");
                 $id = intval($_GET['id']);
              
                 $ENTRY = $mysqli -> query('SELECT * FROM entry WHERE id= '. $id .' ')->fetch_assoc() ;
                 if (!$ENTRY) die ("No such entry");

                 $ENTRY['date']    = date('Y-m-d H:i:s', $ENTRY['date'] );
                 $ENTRY['content'] = nl2br(htmlspecialchars($ENTRY['content']));
                 $ENTRY['header']  = htmlspecialchars($ENTRY['header']);


                 $comments = array();
                 $sel = $mysqli -> query('SELECT * FROM comments WHERE entry_id= '.$id.' ORDER BY date');
                 while ($row = $sel  -> fetch_assoc()) {
                    $row['date']    = date('Y-m-d H:i:s', $row['date'] );
                    $row['content'] = nl2br(htmlspecialchars($row['content']));
                    $row['header']  = htmlspecialchars($row['header']);
                    $row['autor']   = htmlspecialchars($row['autor']);
                    $comments[]     = $row;
                  }  
                  require 'templates/entry.php';
                  break;

              case 'do-new-entry':
                if (!IS_ADMIN) die('You may by admin to add entry');
                $sel = $mysqli -> prepare(INSERT_INTO_ENTRY);
                $time = time();
                $sel -> bind_param('siss',$_POST['autor'], $time, $_POST['header'], $_POST['content']);
                if ($sel -> execute()) {
                   header('Location: .');
                 } else {
                  die("Cannot insert entry");
                 }
                break;

              case 'delete-entry':
                if (!IS_ADMIN) die('You may by admin to add entry');
                $id = intval($_GET['id']);
                $mysqli -> query('DELETE  FROM entry WHERE id='.$id.'');
                $mysqli -> query('DELETE  FROM comments WHERE entry_id='.$id.'');
                break;

              case 'edit-entry':
                if (!IS_ADMIN) die('You may by admin to add entry');
                $id  = intval($_GET['id']);
                $row =  $mysqli -> query('SELECT * FROM entry WHERE id='.$id.'') -> fetch_assoc();
                require 'templates/edit-entry.php';
                break; 

              case 'apply-edit-entry':
                if (!IS_ADMIN) die('You may by admin to add entry');
                $sel = $mysqli -> prepare('UPDATE entry SET autor = ?, header = ?, content = ? WHERE id = ?');
                $id = intval($_POST['id']);
                $sel -> bind_param('siss',$_POST['autor'],$_POST['header'], $_POST['content'], $id);
                if ($sel -> execute()) {
                   header('Location: .');
                 } else {
                  die("Cannot insert entry");
                 }
                break;    

              case 'do-new-comment':
                $sel = $mysqli -> prepare(INSERT_INTO_COMMENTS);
                $time = time();
                $sel -> bind_param('sssi',$_POST['entry_id'],$_POST['autor'], $time, $_POST['content']);
               if ($sel -> execute()) {
                   header('Location: ?act=view-entry&id='.intval($_POST['entry_id']));
                   } else {
                   die("Cannot insert entry");
                   }
                 break;
              case 'delete-comment':
                if (!IS_ADMIN) die('You may by admin to add entry');
                $id = intval($_GET['id']);
                $mysqli -> query('DELETE  FROM comments WHERE id='.$id.'');
                header('Location: ?act=view-entry&id='. intval($_GET['entry_id']));
                break;
              case 'login':
                    require 'templates/login.php';
                    break;

              case 'do-login':
                      if ($_POST['login'] == 'login' && $_POST['pass']=='pass'){
                      $_SESSION['IS_ADMIN'] = true; 
                     header('Location:.');
                     }
                     else{
                     header('location: ?act=login');
                     }
                     break;

              case 'logout':
                     unset($_SESSION['IS_ADMIN']); 
                     header('Location:.');
                     break;
              default:
              die("No such action");
      }
 ?>
