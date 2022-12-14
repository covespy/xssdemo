<?php // attacks/refected.php
ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
require(MYSQL);
$db = new DB();
$page_name = basename($_SERVER['PHP_SELF']);
$page_title = 'Reflected XSS';
if (!isset($_SESSION)) {
	session_start();
}

// handle form
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])) {
  $search = $_GET['search']; // XSS vulnerability here
	$c = $db->run("SELECT `tstamp`, `name`, `comment` FROM `comments` WHERE `comment` LIKE ?
                ORDER BY `tstamp` ASC", ["%$search%"])->fetchAll(PDO::FETCH_ASSOC);
  $alerttype = count($c) > 0 ? 'success' : 'warning';
  $alertmessage = 'Your search returned <span class="fw-semibold">' . count($c) .
    '</span> results.';
	$message = '<div class="row"><div class="col-12-lg">' . "\n" .
		'<div class="alert alert-' . $alerttype . ' alert-dismissible fade show" role="alert">' . "\n" .
		$alertmessage . "\n" .
		'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . "\n" .
		'</div>' . "\n" . '</div></div>';
}

$r = $db->run("SELECT COUNT(*) FROM `results`")->fetch(PDO::FETCH_NUM);

$sbtype = "resultssb";
include(TEMPLATES . 'headersidebar.php');
?>
				<div class="row">
					<div class="col-6-lg mx-auto text-center">
	        	<h1 class="display-5 fw-bold">Reflected/Displayed Input</h1>
					</div>
				</div>
				<?= $message ?? ''; ?>
        <div class="row">
          <div class="col-lg-12">
            <h1>Search Comments</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="text-secondary">Use the search bar below to search the comments found on the <a class="link-primary" href="./stored.php">message board page</a>.</div>
          </div>
        </div>
				<div class="row mt-4 mb-2">
					<div class="col-12-lg">
						<form action="<?= htmlEntities($_SERVER['PHP_SELF']); ?>" method="get">
							<div class="row">
								<div class="col-lg-8 offset-lg-2 form-group">
									<div class="input-group">
										<span class="input-group-text" id="search-term-addon">Search</span>
										<input type="text" class="form-control" name="search" aria-label="Search Term" aria-describedby="search-term-addon" required>
                    <button type="submit" class="btn btn-success btn-block" id="submitbtn">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
        <?php if (isset($c)) { ?>
        <div class="row">
          <div class="col-lg-10">
            <h1>Results</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
          <?php if (count($c)) { ?>
            <table class="table table-bordered table-sm mx-auto">
              <thead>
                <tr>
                  <th>Timestamp</th>
                  <th>Name</th>
                  <th>Comment</th>
                </tr>
              </thead>
							<tbody>
							<?php for ($i=0; $i<count($c); $i++) { ?>
								<tr>
									<td><?= $c[$i]['tstamp']; ?></td>
									<td><?= $c[$i]['name']; ?></td>
									<td><?= $c[$i]['comment']; ?></td>
								</tr>
							<?php	} ?>
              </tbody>
            </table>
          <?php } else {
            echo 'Your search returned no resuts for the term <span class="fst-italic fw-semibold">' .
              $search . '</span>'; // $search here is unsanitized and will be reflected in page html
          } ?>
          </div>
        </div>
      	<?php } ?>
				<div class="row justify-content-center">
					<div class="col-lg-auto text-center">
						<a class="btn btn-primary" href="./" role="button"><i class="bi bi-arrow-left-circle-fill"></i> Attacks</a>
					</div>
					<div class="col-lg-auto text-center">
						<a class="btn btn-primary" href="/repaired/<?= $page_name; ?>" role="button">Repaired <i class="bi bi-tools"></i></a>
					</div>
				</div>
				<script type="text/javascript" src="/js/xssdemo.js"></script>
<?php
$db = null; // kill db connection
include(TEMPLATES . 'footersidebar.php');
// Flush the buffered output.
ob_end_flush();
?>
