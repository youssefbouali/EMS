<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Dashboard</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }

        .main-content {
            margin-left: 250px;
            /*padding-top: 20px;*/
        }

        .navbar {
            z-index: 1050;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: bold;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-logout {
            margin-top: auto;
        }

        /* Media Query for small screens */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="navbar navbar-dark bg-dark sidebar flex-column p-3">
            <a class="navbar-brand mb-4" href="#">EMS Dashboard</a>
            <ul class="navbar-nav flex-column w-100">
                <li class="nav-item">
                    <a class="nav-link" href="/">🏠 Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="gestionNotesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        📚 Gestion des notes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="gestionNotesDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('/sectors') ?>">Saisie des notes</a></li>
                    </ul>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>
        <!-- Main Content -->
        <div class="flex-grow-1 main-content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100" style="z-index: 1050;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">EMS Dashboard</a>
                    <a href="#" class="nav-link">
                        <img src="<?= base_url('assets/images/profil.png') ?>" alt="Profile" style="width:30px;">
                    </a>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid p-4">
                <h2 class="text-center">Welcome to The dashboard Professor</h2>
                
                <!-- Success and Error Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <p><?= esc(session()->getFlashdata('success')) ?></p>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?php esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
