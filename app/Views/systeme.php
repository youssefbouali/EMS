<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des examens - Filière Systeme Embarqué</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-column vh-100 p-3">
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
                        <li><a class="dropdown-item" href="/ingenierie">Ingenierie Logiciel</a></li>
                        <li><a class="dropdown-item" href="/intelligence">Intelligence Artificielle</a></li>
                        <li><a class="dropdown-item" href="/systeme">Système Embarqué</a></li>
                    </ul>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h2 class="text-center">Systeme Embarqué</h2>

            <!-- Table -->
            <form action="/submit-notes" method="post">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CNE</th>
                            <th>Nom de l'Étudiant</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>Étudiant <?= $i ?></td>
                                <td>
                                    <input type="number" name="notes[<?= $i ?>]" class="form-control" min="0" max="20" value="0" required>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Confirmer la saisie</button>
            </form>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success mt-3">
                    <p><?= esc(session()->getFlashdata('success')) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
