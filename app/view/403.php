<?php
http_response_code(403);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403 Forbidden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">

                        <h1 class="display-3 text-danger fw-bold">403</h1>
                        <h4 class="mt-3 fw-semibold">Access Forbidden</h4>

                        <p class="text-muted mt-2 mb-4">
                            You do not have permission to access this page.<br>
                            Please contact the administrator if you think this is an error.
                        </p>

                        <!-- Buttons -->
                        <a href="<?= BASE_URL ?>" class="btn btn-danger px-4">
                            Go to Home
                        </a>

                        <a href="javascript:history.back()" class="btn btn-outline-secondary px-4 ms-2">
                            Go Back
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>

