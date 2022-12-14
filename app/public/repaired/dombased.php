<?php // attacks/dombased.php
ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
$page_name = basename($_SERVER['PHP_SELF']);
$page_title = 'DOM-Based XSS';
if (!isset($_SESSION)) {
	session_start();
}

$requested_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$method = "OTHER";
$data = [];
// check methods
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$method = "GET";
  $keys = array_keys($_GET);
	for ($i=0; $i<count($keys); $i++) {
		$data[$i] = [$keys[$i], htmlEntities($_GET[$keys[$i]], ENT_QUOTES)];
	}
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$method = "POST";
  $keys = array_keys($_POST);
	for ($i=0; $i<count($keys); $i++) {
		$data[$i] = [$keys[$i], htmlEntities($_POST[$keys[$i]], ENT_QUOTES)];
	}
}

$sbtype = "resultssb";
include(TEMPLATES . 'headersidebar.php');
?>
				<div class="row">
					<div class="col-6-lg mx-auto text-center">
	        	<h1 class="display-5 fw-bold">Dynamic Content Page</h1>
					</div>
				</div>
				<?= $message ?? ''; ?>
        <div class="row">
          <div class="col-lg-12">
            <h1>
							<span class="text-danger">S</span>
							<span class="text-success">A</span>
							<span class="text-danger">N</span>
							<span class="text-success">T</span>
							<span class="text-danger">A</span>
							<span class="text-success">'</span>
							<span class="text-danger">S</span>&nbsp
							<span class="text-success">L</span>
							<span class="text-danger">I</span>
							<span class="text-success">S</span>
							<span class="text-danger">T</span>&nbsp
							<span class="text-success">C</span>
							<span class="text-danger">H</span>
							<span class="text-success">E</span>
							<span class="text-danger">C</span>
							<span class="text-success">K</span>
							<span class="text-danger">E</span>
							<span class="text-success">R</span>
							<span class="text-danger">:</span>
						</h1>
          </div>
        </div>
        <div class="row mt-2 mb-4">
          <div class="col-lg-12">
            <div class="h5" id="listmessage"><span class="fw-bold text-dark border-bottom border-2 border-info" id="targetname"></span> is on the <span id="listresult"></span> list!</div>
          </div>
        </div>
				<div class="row mb-2">
					<div class="col-10-lg mx-auto">
						<div class="row">
							<div class="col-12-lg">
								<span class="text-secondary">This is the URL the server saw:</span>
							</div>
							<div class="row">
								<div class="col-12-lg">
									<span><?= $requested_url; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-10-lg mx-auto">
						<div class="row">
							<div class="col-12-lg">
								<span class="text-secondary">These are the <?= $method; ?> terms the server saw:</span>
							</div>
							<div class="row">
								<div class="col-12-lg">
								<?php if (count($data)) { ?>
									<table class="table table-bordered table-sm mx-auto">
			              <thead>
			                <tr>
			                  <th>Term</th>
			                  <th>Value</th>
			                </tr>
			              </thead>
										<tbody>
										<?php for ($i=0; $i<count($data); $i++) { ?>
											<tr>
												<td><?= $data[$i][0]; ?></td>
												<td><?= $data[$i][1]; ?></td>
											</tr>
										<?php	} ?>
			              </tbody>
			            </table>
								<?php } else { echo "None"; } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-10-lg mx-auto">
						<div class="row">
							<div class="col-12-lg">
								<span class="text-secondary">This is the URL in the web browser:</span>
							</div>
							<div class="row">
								<div class="col-12-lg">
									<span id="requestedurl"></span>
								</div>
							</div>
						</div>
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
				<script type="text/javascript">
					function check_santas_list() {
						var pos = document.URL.indexOf("name=");
						if (pos < 0) {
							$('#listmessage').html("To use Santa's list checker and see if [yourname] is on Santa's NAUGHTY or NICE lists, add<br />?name=[yourname]<br />or<br />#name=[yourname]<br />at the end of the browser address. Note the difference in the URL seen by the server vs what is entered in the browser.");
						} else {
							var n = decodeURIComponent(document.URL.substring(pos + 5));
							var r = 'NAUGHTY';
							var c = 'text-danger';
							if (n.length > 0) {
								s = n[0].charCodeAt(0) - 65;
								if (s % 2 == 0) {
									r = 'NICE';
									c = 'text-success';
								}
							}
							$('#targetname').text(n); // XSS vuln fixed, used to be .html/.innerHTML
							$('#listresult').addClass(c);
							$('#listresult').text(r);
						}
					}
					$(document).ready(function() {
						check_santas_list();
						$('#requestedurl').text(document.URL); // ok .textContent
					});
				</script>
				<script type="text/javascript" src="/js/xssdemo.js"></script>
<?php
$db = null; // kill db connection
include(TEMPLATES . 'footersidebar.php');
// Flush the buffered output.
ob_end_flush();
?>
