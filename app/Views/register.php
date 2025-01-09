<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - Inscription</title>
    <!-- Bootstrap CSS from local directory -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
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

    <!-- Display Success Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green;">
            <p><?= esc(session()->getFlashdata('success')) ?></p>
        </div>
    <?php endif; ?>

        <!-- Affichage des erreurs -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?php echo($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulaire d'inscription -->
        <form action="/register" method="POST">
            <div class="form-group mb-3">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom"
                       value="<?= old('nom') ?>"
                       placeholder="Doe" required>
            </div>

            <div class="form-group mb-3">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom"
                       value="<?= old('prenom') ?>"
                       placeholder="John" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?= old('email') ?>"
                       placeholder="you@domain.com" required>
            </div>

            <div class="form-group mb-3">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="********" required>
            </div>

            <div class="form-group mb-3">
                <label for="confirmPassword">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                       placeholder="********" required>
            </div>

            <div class="form-group mb-3">
                <label for="role">Rôle</label><br>
                <label>
                    <input type="radio" name="role" value="student" <?php echo (old('role') == 'student') ? 'checked' : ''; ?>> Étudiant
                </label>
                <label class="ml-3">
                    <input type="radio" name="role" value="professor" <?php echo (old('role') == 'professor') ? 'checked' : ''; ?>> Professeur
                </label>
            </div>


            <div id="student-fields" class="<?php echo old('role') == 'student' ? '' : 'd-none'; ?>">
                <div class="form-group mb-3">
                    <label for="cne">CNE</label>
                    <input type="text" class="form-control" id="cne" name="cne"
                           value="<?= old('cne') ?>"
                           placeholder="CNE">
                </div>
                <div class="form-group mb-3">
                    <label for="dob">Date de naissance</label>
                    <input type="date" class="form-control" id="dob" name="dateNaissance"
                           value="<?= old('dateNaissance') ?>"
                           placeholder="01/01/2000">
                </div>
            </div>

            <div id="professor-fields" class="<?php echo old('role') == 'professor' ? '' : 'd-none'; ?>">
                <div class="form-group mb-3">
                    <label for="cin">CIN</label>
                    <input type="text" class="form-control" id="cin" name="cin"
                           value="<?= old('cin') ?>"
                           placeholder="CIN">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">S'inscrire</button>
        </form>

        <div class="footer-text">
            <p>Vous avez déjà un compte? <a href="/login">Connectez-vous ici</a></p>
        </div>
    </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('input[name="role"]').forEach(input => {
            input.addEventListener('change', () => {
                if (input.value === 'student') {
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
