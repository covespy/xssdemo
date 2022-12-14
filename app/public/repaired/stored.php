<?php // attacks/stored.php
ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
require(MYSQL);
$db = new DB();
$page_name = basename($_SERVER['PHP_SELF']);
$page_title = 'Stored XSS';
if (!isset($_SESSION)) {
	session_start();
}

// handle form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['submit'])) {
	if ($_POST['submit'] == 'reset') {
		$db->run("DELETE FROM `comments` WHERE `id` > 4");
		$alerttype = 'warning';
		$alertmessage = '<strong>Reset!</strong> Comments table has been reset.';
	} else {
		$name = htmlEntities($_POST['name'], ENT_QUOTES); // effective to prevent XSS
		$comment = htmlEntities($_POST['comment'], ENT_QUOTES); // XSS vulnerability eliminated with htmlEntities()
		$db->run("INSERT INTO `comments` (`name`, `comment`) VALUES (?, ?)", [$name, $comment]);
		if ($id = $db->pdo->lastInsertId()) {
			$alerttype = 'success';
			$alertmessage = "<strong>Success!</strong> Comment with ID $id has been added.";
			unset($comment);
		} else {
			$alerttype = 'danger';
			$alertmessage = "<strong>Unsuccessful!</strong> There was a problem adding the last comment.";
		}
	}
	$message = '<div class="row"><div class="col-12-lg">' . "\n" .
		'<div class="alert alert-' . $alerttype . ' alert-dismissible fade show" role="alert">' . "\n" .
		$alertmessage . "\n" .
		'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . "\n" .
		'</div>' . "\n" . '</div></div>';
}

$c = $db->run("SELECT `tstamp`, `name`, `comment` FROM `comments`
              ORDER BY `tstamp` ASC")->fetchAll(PDO::FETCH_ASSOC);
$r = $db->run("SELECT COUNT(*) FROM `results`")->fetch(PDO::FETCH_NUM);

$sbtype = "resultssb";
include(TEMPLATES . 'headersidebar.php');
?>
				<div class="row">
					<div class="col-6-lg mx-auto text-center">
	        	<h1 class="display-5 fw-bold">Stored Data</h1>
					</div>
				</div>
				<?= $message ?? ''; ?>
        <div class="row">
          <div class="col-lg-10">
            <h1>Comments</h1>
          </div>
					<div class="col-lg-2">
						<form action="<?= $page_name; ?>" method="post">
							<div class="d-grid gap-2 d-md-flex justify-content-md-end">
								<button type="submit" class="btn btn-danger btn-block" name="submit" id="resetbtn" value="reset"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
							</div>
						</form>
					</div>
        </div>
				<div class="row mb-3">
					<div class="col-12-lg">
						<form action="<?= htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
							<div class="row">
								<div class="col-lg-4 form-group">
									<div class="row">
										<div class="col-lg-12">
											<div class="input-group">
												<span class="input-group-text" id="name-addon">Name</span>
												<input type="text" class="form-control" name="name" maxlength="40" aria-label="Name" aria-describedby="name-addon" maxlength="40" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<p class="text-secondary">Current results on page load: <span class="fw-bold"><?= $r[0]; ?></span></p>
										</div>
									</div>
								</div>
								<div class="col-lg-8 form-group">
									<div class="input-group">
										<span class="input-group-text" id="comment-addon">Comment</span>
										<textarea class="form-control" aria-label="Comment" name="comment" maxlength="5000" rows="2" wrap="soft" required><?= $comment ?? ''; ?></textarea>
										<button type="submit" class="btn btn-success btn-block" name="submit" id="submitbtn" value="submit">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
        <div class="row">
          <div class="col-lg-12">
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
									<td><?= htmlEntities($c[$i]['comment'], ENT_QUOTES); // htmlEntities used here to neutralize past exploits  ?></td>
								</tr>
							<?php	} ?>
              </tbody>
            </table>
          </div>
        </div>
				<div class="row justify-content-center">
	        <div class="col-lg-auto text-center">
						<a class="btn btn-primary" href="./" role="button"><i class="bi bi-arrow-left-circle-fill"></i> Repaired</a>
	        </div>
					<div class="col-lg-auto text-center">
						<a class="btn btn-primary" href="/attacks/<?= $page_name; ?>" role="button">Attack <i class="bi bi-fire"></i></a>
					</div>
				</div>
				<script type="text/javascript" src="/js/xssdemo.js"></script>
<?php
$db = null; // kill db connection
include(TEMPLATES . 'footersidebar.php');
// Flush the buffered output.
ob_end_flush();
?>
