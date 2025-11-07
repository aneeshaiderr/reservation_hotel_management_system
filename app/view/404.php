<?php
http_response_code(404);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <!-- <title>404 — Page Not Found</title> -->
  <!-- Bootstrap CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="container text-center">
    <div class="card shadow-lg border-0 p-5">
      <h1 class="display-1 text-danger fw-bold">404</h1>
      <h3 class="mb-3">Page Not Found</h3>
      <p class="text-muted mb-4">
        Sorry, we can't find the page you're looking for.<br>
        The link may be broken or the page may have been removed.
      </p>

      <div class="d-flex justify-content-center gap-2 flex-wrap mb-3">
        <a href="<?= BASE_URL ?>" class="btn btn-danger px-4">
          Back to Home
        </a>
        <a href="javascript:history.back()" class="btn btn-outline-secondary px-4">
          Go Back
        </a>
      </div>



      <div class="text-muted small mt-3">
        If you think this is an error, please <a href="mailto:postmaster@localhost" class="link-danger">contact support</a>.
      </div>
    </div>
  </div>

</body>
</html>
