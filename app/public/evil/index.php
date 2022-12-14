<?php // /evil/index.php
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
require(MYSQL);
$db = new DB();
$r = $db->run("SELECT `tstamp`, `data` FROM `results`
              ORDER BY `tstamp` ASC")->fetchAll(PDO::FETCH_ASSOC);
// handle ajax requests
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $db = null; // kill db connection
  echo json_encode($r);
  exit;
}

ob_start();
$page_name = basename($_SERVER['PHP_SELF']);
$page_title = 'Evil Results';
if (!isset($_SESSION)) {
	session_start();
}

include(TEMPLATES . 'headerstandard.php');
?>
        <div class="row">
          <div class="col-6-lg mx-auto text-center">
            <h1 class="display-5 fw-bold">Evil Website Repository</h1>
          </div>
        </div>
        <?= $message ?? ''; ?>
        <div class="row">
          <div class="col-lg-12">
            <h1>Results from XSS Attacks</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-sm mx-auto" id="contentPreview">
              <thead>
                <tr>
                  <th>Timestamp</th>
                  <th>Data</th>
                </tr>
              </thead>
							<tbody>
							<?php for ($i=0; $i<count($r); $i++) { ?>
								<tr>
									<td><?= $r[$i]['tstamp']; ?></td>
									<td><?= $r[$i]['data']; ?></td>
								</tr>
							<?php	} ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 text-center mx-auto">
            <a class="btn btn-primary" href="/attacks/" role="button"><i class="bi bi-arrow-left-circle-fill"></i> Attacks</a>
          </div>
        </div>
<?php
$db = null; // kill db connection
include(TEMPLATES . 'footerstandard.php');
// Flush the buffered output.
ob_end_flush();
?>
