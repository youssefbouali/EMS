<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Dashboard Professor</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-column vh-100 p-3">
            <a class="navbar-brand mb-4" href="#">EMS Dashboard</a>
            <ul class="navbar-nav flex-column w-100">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="gestionNotesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestion des notes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="gestionNotesDropdown">
                        <li><a class="dropdown-item" href="/filiere/ingenierie">Ingenierie logiciel</a></li>
                        <li><a class="dropdown-item" href="/filiere/intelligence">Intelligence artificielle</a></li>
                        <li><a class="dropdown-item" href="/filiere/systeme">Système embarqué</a></li>
                    </ul>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h2 class="text-center">Welcome to The dashboard Professor</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <a href="/filiere/ingenierie" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ingenierie logiciel</h5>
                                <p class="card-text">Cliquez pour gérer les notes d'ingénierie logiciel.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/filiere/intelligence" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Intelligence artificielle</h5>
                                <p class="card-text">Cliquez pour gérer les notes d'intelligence artificielle.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/filiere/systeme" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Système embarqué</h5>
                                <p class="card-text">Cliquez pour gérer les notes de système embarqué.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
	
	<form action="/notes" method="post">Session: <select name="session" required><option value="normal">Normal</option><option value="rattrapage">Rattrapage</option></select> Note Normal: <input type="number" name="noteNormal" min="0" max="20" required> Note Rattrapage: <input type="number" name="noteRattrapage" min="0" max="20" required> ID Étudiant: <input type="text" name="idUserStudent" required> ID Module: <input type="text" name="idModule" required> description: <input type="text" name="description" required> <button type="submit">Ajouter les Notes</button></form>
        </div>
    </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
