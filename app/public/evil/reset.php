<?php // /evil/reset.php
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && !empty($_POST['reset'])) {
  require(MYSQL);
  $db = new DB();
  $db->run("DROP TABLE `dbapp`.`results`");
  $db->run("CREATE TABLE IF NOT EXISTS `dbapp`.`results` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `data` TEXT NOT NULL,
              `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB");
  $db = null; // kill db connection
  $text = "Results table successfully reset.";
  // handle ajax requests
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
      && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo json_encode(array("text" => $text));
    exit;
  }
}

ob_start();
$page_name = basename($_SERVER['PHP_SELF']);
$page_title = 'Results Reset';
if (!isset($_SESSION)) {
	session_start();
}
include(TEMPLATES . 'headerstandard.php');
?>
        <div class="row">
          <div class="col-6-lg mx-auto text-center">
            <h1 class="display-5 fw-bold">Results Reset Page</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <?= isset($text) ? '<div class="alert alert-success alert-dismissible fade show" role="alert">' . "\n" . $text . "\n" .
          		'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . "\n" .
          		'</div>' : ''; ?></h1>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-2 text-center">
            <a class="btn btn-primary" href="/evil/" role="button"><i class="bi bi-arrow-left-circle-fill"></i> Results</a>
          </div>
          <div class="col-lg-2 text-center">
            <form action="<?= htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
              <button type="submit" class="btn btn-danger btn-block" name="reset" id="resetbtn" value="1"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
            </form>
          </div>
        </div>
<?php
$db = null; // kill db connection
include(TEMPLATES . 'footerstandard.php');
// Flush the buffered output.
ob_end_flush();
