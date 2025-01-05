<?php
// Initialisation des erreurs
$errors = [];
$role = ''; // Définir la variable $role par défaut
$dob = '';  // Date de naissance pour les étudiants

// Vérification si le formulaire a été soumis via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $role = $_POST['role'] ?? ''; // Vérifier la valeur du rôle
    $cne = $_POST['cne'] ?? '';
    $cin = $_POST['cin'] ?? '';
    $dob = $_POST['dob'] ?? ''; // Récupérer la date de naissance pour les étudiants

    // Validation des champs
    if (empty($nom)) {
        $errors[] = "Le nom est requis.";
    }
    if (empty($prenom)) {
        $errors[] = "Le prénom est requis.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email est invalide.";
    } elseif (!str_contains($email, '@gmail.com')) {
        $errors[] = "L'email doit contenir '@gmail.com'.";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    } elseif (strlen($password) < 8 || !preg_match('/[0-9]/', $password) || !preg_match('/[a-zA-Z]/', $password)) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une lettre et un chiffre.";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }
    if (empty($role)) {
        $errors[] = "Le rôle est requis.";
    }

    // Si le rôle est étudiant, vérifier la date de naissance
    if ($role == '0' && empty($dob)) {
        $errors[] = "La date de naissance est requise pour un étudiant.";
    }

    // Si pas d'erreurs, traiter l'enregistrement
    if (empty($errors)) {
        // Exemple d'enregistrement dans la base de données (à ajouter ici)
        echo '<div style="color: green;">Inscription réussie !</div>';
        // Ajouter ici le code pour enregistrer dans la base de données.
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <h2 class="text-center">Inscription</h2>

        <!-- Affichage des erreurs -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulaire d'inscription -->
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($nom ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($prenom ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>

            <div class="form-group">
                <label for="role">Rôle</label><br>
                <label>
                    <input type="radio" name="role" value="0" <?php echo ($role == '0') ? 'checked' : ''; ?>> Étudiant
                </label>
                <label class="ml-3">
                    <input type="radio" name="role" value="1" <?php echo ($role == '1') ? 'checked' : ''; ?>> Professeur
                </label>
            </div>

            <!-- Champs spécifiques aux étudiants -->
            <div id="student-fields" class="<?php echo $role == '0' ? '' : 'd-none'; ?>">
                <div class="form-group">
                    <label for="cne">CNE</label>
                    <input type="text" class="form-control" id="cne" name="cne" value="<?php echo htmlspecialchars($cne ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="dob">Date de naissance</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($dob ?? ''); ?>">
                </div>
            </div>

            <!-- Champs spécifiques aux professeurs -->
            <div id="professor-fields" class="<?php echo $role == '1' ? '' : 'd-none'; ?>">
                <div class="form-group">
                    <label for="cin">CIN</label>
                    <input type="text" class="form-control" id="cin" name="cin" value="<?php echo htmlspecialchars($cin ?? ''); ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
        </form>

        <div class="footer-text">
            <p>Vous avez déjà un compte? <a href="login.php">Connectez-vous ici</a></p>
        </div>
    </div>

    <script>
        // Script pour afficher les champs spécifiques selon le rôle
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
