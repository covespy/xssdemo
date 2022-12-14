<?php // /notfound.php
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
include(TEMPLATES . 'headerstandard.php');
?>
        <div class="col-6-lg mx-auto">
          <h1 class="display-5 fw-bold text-center text-danger">Page Not Found</h1>
        </div>
        <div class="col-lg-3 text-center mx-auto">
          <a class="link-primary" href="/">Home</a>
        </div>
<?php
include(TEMPLATES . 'footerstandard.php');
?>
