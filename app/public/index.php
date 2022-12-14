<?php // /index.php - site start page
require($_SERVER['DOCUMENT_ROOT'] . '/../config/config.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>App Index</title>
    <!--based on https://getbootstrap.com/docs/5.2/examples/heroes/ -->
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      @media (min-width: 992px) {
        .rounded-lg-3 { border-radius: .3rem; }
      }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="icon" href="/media/favicon.ico">
  </head>
  <body>
    <main>
      <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="media/xss_logo.png" alt="Logo Here" width="72" height="57">
        <h1 class="display-5 fw-bold">Cross Site Scripting (XSS) Demonstration and Detection</h1>
        <div class="col-lg-6 mx-auto">
          <p class="lead mb-4">XSS is an attack vector that uses injected code to cause otherwise legitimate web servers to do malicious things. This site has <a class="link-primary" href="attacks">several examples of web pages</a> that are vulnerable to XSS. An instructions page explains how to trigger each of the vulnerabilities, and XSS scanning tools may be deployed against these pages to detect any XSS vulnerabilities.</p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <p class="lead mb-4"><?php echo 'This app is running PHP version: ' . phpversion(); ?></p>
            <!--<button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
            <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
          </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </main>
  </body>
</html>
