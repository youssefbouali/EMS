<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie des notes</title>
    <!-- Intégration de Bootstrap depuis un CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Saisir les notes des étudiants</h1>

        <!-- Affichage des messages d'erreur -->
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Affichage des messages de succès -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire pour saisir les informations -->
        <form action="/notes/saisirNote" method="POST" class="mb-5">
            <?= csrf_field() ?> <!-- Protection CSRF -->

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'étudiant:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Note de l'étudiant (0-20):</label>
                <input type="number" class="form-control" id="note" name="note" min="0" max="20" required>
            </div>

            <button type="submit" class="btn btn-primary">Saisir la note</button>
        </form>

        <hr>

        <h2 class="text-center mb-4">Liste des étudiants et de leurs notes</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom de l'étudiant</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note) : ?>
                    <tr>
                        <td><?= htmlspecialchars($note['nom_etudiant']) ?></td>
                        <td><?= htmlspecialchars($note['note']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Intégration de Bootstrap JS depuis un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
