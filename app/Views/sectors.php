<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Filières</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-column vh-100 p-3" style="width: 250px; position: fixed;">
            <a class="navbar-brand mb-4" href="#">EMS Dashboard</a>
            <ul class="navbar-nav flex-column w-100">
                <li class="nav-item">
                    <a class="nav-link" href="/">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="gestionNotesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestion des notes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="gestionNotesDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('/sectors') ?>">Saisie des notes</a></li>
                    </ul>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>

        <div class="flex-grow-1" style="margin-left: 250px;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100" style="z-index: 1050;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">EMS Dashboard</a>
                    <!--form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                    </form-->
                    <a href="#" class="nav-link">
                        <img src="<?= base_url('assets/images/profil.png') ?>" alt="Profile" style="width:30px;">
                    </a>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid p-4">
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

                <!-- Choose a sector -->
                <h2 class="text-center">Choisissez une filière</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($sectors as $sector): ?>
    <?php
    $colors = ['#ffc197'];
    $randomColor = $colors[array_rand($colors)];
    ?>
    <div class="col">
        <a href="<?= site_url('/modules/' . $sector['id']) ?>" class="text-decoration-none">
            <div class="card" style="background-color: <?= $randomColor; ?>;">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold "><?= esc($sector['nom']) ?></h5>
                    <p class="card-text"><?= esc($sector['description']) ?></p>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
