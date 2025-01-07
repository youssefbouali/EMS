<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Inscription</title>
    <!-- Bootstrap CSS from local directory -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .footer-text {
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2 class="text-center">Welcome to The dashboard</h2>

    <!-- Display Success Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green;">
            <p><?= esc(session()->getFlashdata('success')) ?></p>
        </div>
    <?php endif; ?>

        <!-- Affichage des erreurs -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?php esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div>
			<a href="/logout">Logout</a>
		</div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('input[name="role"]').forEach(input => {
            input.addEventListener('change', () => {
                if (input.value === '0') {
                    document.getElementById('student-fields').classList.remove('d-none');
                    document.getElementById('professor-fields').classList.add('d-none');
                } else {
                    document.getElementById('professor-fields').classList.remove('d-none');
                    document.getElementById('student-fields').classList.add('d-none');
                }
            });
        });
    </script>

</body>
</html>
