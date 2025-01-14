<!-- home.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenue sur notre projet de gestion des examens !</h1>

        <div class="text-center">
            <p>Veuillez choisir l'option que vous souhaitez :</p>
            
            <!-- Lien pour se connecter -->
            <a href="/login" class="btn btn-primary">Se connecter</a>

            <!-- Lien pour s'inscrire -->
            <a href="/register" class="btn btn-secondary">S'inscrire</a>

            <!-- Lien vers la gestion des notes accessible à tous -->
            <a href="/notes" class="btn btn-success">Gestion des notes</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
