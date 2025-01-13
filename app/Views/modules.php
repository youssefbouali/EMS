<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Modules</title>
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
                        <li><a class="dropdown-item" href="/sectors">Saisie des notes</a></li>
                    </ul>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 250px;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100" style="z-index: 1050;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">EMS Dashboard</a>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                    </form>
                    <a href="#" class="nav-link">
                        <img src="<?= base_url('assets/images/profil.png') ?>" alt="Profile" style="width:30px;">
                    </a>
                </div>
            </nav>

            <div class="container-fluid p-4">
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

                <!-- Content -->
                <h2 class="text-center">Choisissez un module</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($modules as $module): ?>
						<div class="col">
							<a href="<?= site_url('/notes/' . $module['id']) ?>" class="text-decoration-none">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title font-weight-bold "><?= esc($module['nom']) ?></h5>
										<p class="card-text"><?= esc($module['description']) ?></p>
									</div>
								</div>
							</a>
						</div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to handle content change when a module card is clicked
        function changeContent(moduleId) {
            const contentDiv = document.getElementById('content');
            contentDiv.innerHTML = contentDiv.innerHTML = '<form action="/notes" method="post">Session: <select name="session" required><option value="normal">Normal</option><option value="rattrapage">Rattrapage</option></select> Note Normal: <input type="number" name="noteNormal" min="0" max="20" required> Note Rattrapage: <input type="number" name="noteRattrapage" min="0" max="20" required> ID Étudiant: <input type="text" name="idUserStudent" required> ID Module: <input type="text" name="idModule" required> description: <input type="text" name="description" required> <button type="submit">Ajouter les Notes</button></form>';
        }
    </script>
</body>

</html>
