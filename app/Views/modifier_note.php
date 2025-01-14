<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la note</title>
    <!-- Intégration de Bootstrap depuis un CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Modifier la note de l'étudiant</h1>

        <!-- Affichage des messages d'erreur -->
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Affichage des messages de succès -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire pour modifier la note -->
        <form action="/notes/modifierNote/<?= $note['id'] ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'étudiant:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($note['nom_etudiant']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Note de l'étudiant (0-20):</label>
                <input type="number" class="form-control" id="note" name="note" value="<?= htmlspecialchars($note['note']) ?>" min="0" max="20" step="0.25" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier la note</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
