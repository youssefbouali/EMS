<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: hsla(214, 12.70%, 89.20%, 0.87);
            color: white;
        }
        .logo {
            width: 50px;
            height: 50px;
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 50%;
        }
        .card {
            margin-top: 20px;
            max-width: 1000px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
        }
        .field-label {
            font-weight: bold;
            font-size: 0.85rem;
            margin-bottom: 0.05rem;
        }
        .info-background {
            padding: 3px;
            border-radius: 5px;
            font-size: 0.85rem;
        }
        .row {
            margin-bottom: 0rem;
        }
        .modern-title {
            font-family: 'Arial', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }
        .modern-title::before {
            content: "";
            position: absolute;
            width: 50%;
            height: 3px;
            background-color: #007bff;
            bottom: 0;
            left: 25%;
            transition: all 0.3s ease;
        }
        .modern-title:hover::before {
            width: 100%;
            left: 0;
        }
    </style>
</head>
<body>
    <!-- En-tête avec logo et bouton de déconnexion -->
    <div class="header">
        <div class="logo">EMS</div>
        <a href="/logout" class="btn btn-danger">Logout</a>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <div class="card">
            <h4 class="modern-title">Informations Étudiant</h4>
            <div class="row">
                <div class="col-md-6">
                    <p class="field-label">Nom :</p>
                    <div class="info-background">
                        <p id="student-nom"><?= esc($user['nom']) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="field-label">CNE :</p>
                    <div class="info-background">
                        <p id="student-cne"><?= esc($user['cne']) ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="field-label">Prénom :</p>
                    <div class="info-background">
                        <p id="student-prenom"><?= esc($user['prenom']) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="field-label">Filière :</p>
                    <div class="info-background">
                        <p id="student-filiere"><?= esc($sector['nom']) ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="field-label">Date de Naissance :</p>
                    <div class="info-background">
                        <p id="student-dob"><?= esc($user['dateNaissance']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
