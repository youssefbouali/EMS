<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Dashboard</title>
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
                        <li><a class="dropdown-item" href="#" onclick="showCards()" >Saisie des notes</a></li>
                    </ul>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h2 class="text-center">Welcome to The Dashboard</h2>
            <div id="content">
                <p>Click on the "Saisie des notes" link to see the cards.</p>
            </div>

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function showCards() {
            const contentDiv = document.getElementById('content');
            contentDiv.innerHTML = `
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card" href="" onclick="changeContent('card1')">
                            <div class="card-body">
                                <h5 class="card-title" style="cursor: pointer; ">Ingenierie logiciel</h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" onclick="changeContent('card2')">
                            <div class="card-body">
                                <h5 class="card-title" style="cursor: pointer; ">Intelligence artificiel</h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" onclick="changeContent('card3')">
                            <div class="card-body">
                                <h5 class="card-title" style="cursor: pointer; ">Systeme embarquee</h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function changeContent(card) {
            const contentDiv = document.getElementById('content');
            if (card === 'card1') {
                contentDiv.innerHTML = '<form action="/notes" method="post">Session: <select name="session" required><option value="normal">Normal</option><option value="rattrapage">Rattrapage</option></select> Note Normal: <input type="number" name="noteNormal" min="0" max="20" required> Note Rattrapage: <input type="number" name="noteRattrapage" min="0" max="20" required> ID Étudiant: <input type="text" name="idUserStudent" required> ID Module: <input type="text" name="idModule" required> description: <input type="text" name="description" required> <button type="submit">Ajouter les Notes</button></form>';
            } else if (card === 'card2') {
                contentDiv.innerHTML = '<h2>Card 2 Details</h2><p>Details for the second card.</p>';
            } else if (card === 'card3') {
                contentDiv.innerHTML = '<h2>Card 3 Details</h2><p>Details for the third card.</p>';
            }
        }
    </script>
    
</body>
