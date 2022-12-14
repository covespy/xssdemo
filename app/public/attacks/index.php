<?php // attacks/index.php
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
include(TEMPLATES . 'headerstandard.php');
?>
        <div class="px-4 py-5 my-5 text-center">
          <div class="row justify-content-center">
            <h1 class="display-5 fw-bold">XSS Attacks</h1>
            <div class="col-lg-3 mx-auto">
              <div class="list-group">
                <a href="./reflected.php" class="list-group-item list-group-item-action">Reflected</a>
                <a href="./stored.php" class="list-group-item list-group-item-action">Stored</a>
                <a href="./dombased.php" class="list-group-item list-group-item-action">DOM-Based</a>
              </div>
            </div>
          </div>
          <div class="row justify-content-center my-2">
            <div class="col-lg-auto text-center">
              <a class="btn btn-primary" href="/" role="button"><i class="bi bi-arrow-left-circle-fill"></i> Home</a>
            </div>
            <div class="col-lg-auto text-center">
              <a class="btn btn-primary" href="/instructions/" role="button">Instructions <i class="bi bi-lightbulb"></i></a>
            </div>
            <div class="col-lg-auto text-center">
              <a class="btn btn-primary" href="/repaired/" role="button">Repaired <i class="bi bi-tools"></i></a>
            </div>
            <div class="col-lg-auto text-center">
              <a class="btn btn-primary" href="/evil/" role="button">Results <i class="bi bi-arrow-right-circle-fill"></i></a>
            </div>
          </div>
        </div>
<?php
include(TEMPLATES . 'footerstandard.php');
?>
