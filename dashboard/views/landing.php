<!doctype html>
<html lang="en">
<?php require_once dirname(__FILE__, 3) . '/views/universal/signedin/header.php' ?>

<body>
  <?php require_once dirname(__FILE__, 3) . '/views/universal/signedin/navigation.php' ?>

  <div class="container-fluid">
    <div class="row">

      <?php require_once dirname(__FILE__, 3) . '/views/universal/signedin/sidenav.php' ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <span class="col-12 m-5"></span>
        <span class="col-12 m-5"></span>
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

          <h1 class="h2">Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>

      </main>
    </div>
  </div>

  <?php require_once dirname(__FILE__, 3) . '/views/universal/signedin/footer.php' ?>

</body>

</html>