<?php // /templates/sidebarheader.php
include(TEMPLATES . 'header.php');
?>
      <!-- begin headersidebar.php -->
      <div class="container-fluid">
        <div class="row bg-warning text-center mb-2">
          <p class="text-dark text-center">Warning: this site tests web vulnerabilities; DO NOT enter any sensitive information</p>
        </div>
        <div class="row">
          <div class="col-lg-2" id="sidebardata">
            <?php
            if ($sbtype ?? false) {
              include(TEMPLATES . "partials/$sbtype.php");
            }
            ?>
          </div>
          <div class="col-lg-8">
          <!-- end headersidebar.php -->
