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
            background-color: white;
            max-width: 1000px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #333;
            border: 1px solid #ddd;
            margin-bottom: 8px;
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
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #333;
            border: 1px solid #ddd;
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
        }
        .table-success {
            background-color: #d4edda;
            color: #155724;
        }
        .table-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        /* Impression */
       @media print {
           body {
               visibility: hidden;
           }
           .container, .container * {
               visibility: visible;
           }
           .container {
               position: relative;
               margin: 0 auto;
               width: 80%; /* Ajustez la largeur selon vos besoins */
           }
           #btn {
               display: none; /* Cachez les boutons lors de l'impression */
           }
           .table-success, .table-danger {
               background-color: none; /* Supprimer les couleurs des lignes lors de l'impression */
           }
       }

    </style>
</head>
<body>
    <!-- En-tête avec logo et bouton de déconnexion -->
    <div class="header">
        <img src="/assets/images/uiz.png"
            alt="Université Ibno Zohr"
            class="header-logo"
            width="150" height="auto">
        <a href="/logout" class="btn btn-danger">Logout</a>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <div class="card">
            <h4 class="modern-title mb-4">Informations Étudiant</h4>
            <div class="row">
                <div class="col-md-6">
                    <p class="field-label">Nom :</p>
                    <div class="info-background">
                        <p id="student-nom"><?= htmlspecialchars($user['nom']) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="field-label">CNE :</p>
                    <div class="info-background">
                        <p id="student-cne"><?= htmlspecialchars($user['cne']) ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="field-label">Prénom :</p>
                    <div class="info-background">
                        <p id="student-prenom"><?= htmlspecialchars($user['prenom']) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="field-label">Filière :</p>
                    <div class="info-background">
                        <p id="student-filiere"><?= htmlspecialchars($sector['nom']) ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="field-label">Date de Naissance :</p>
                    <div class="info-background">
                        <p id="student-dob"><?= htmlspecialchars($user['dateNaissance']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table des notes -->
        <div class="card mt-4">
            <h4 class="modern-title mb-4">Modules et Notes</h4>
            <div class="table-responsive">
                <?php if (!empty($grades)) : ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nom du Module</th>
                                <th>Note Normale</th>
                                <th>Note de Rattrapage</th>
                                <th>Valide</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grades as $grade) : ?>
                               <tr>
                                   <td><?= htmlspecialchars($grade['nom']) ?></td>
                                   <td><?= htmlspecialchars($grade['noteNormal']) ?></td>
                                   <td><?= htmlspecialchars($grade['noteRattrapage']) ?></td>
                                   <td class="<?= $grade['valide'] ? 'table-success' : 'table-danger' ?>">
                                       <?= $grade['valide'] ? 'Oui' : 'Non' ?>
                                   </td>
                               </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>Aucune note trouvée.</p>
                <?php endif; ?>
            </div>
        </div>
      <div class="card text-center mt-4">
                           <h5 class="modern-title">Moyenne des notes</h5>
                           <div class="info-background p-3">
                               <span class="fs-4 fw-bold text-success">
                                   <?= htmlspecialchars(number_format($general_grade, 2)) ?> <!-- Affiche la moyenne avec 2 décimales -->
                               </span>
                           </div>
                           <!-- Ajout du statut de validation -->
                           <div class="mt-2">
                               <span class="fw-bold text-<?= $general_grade >= 10 ? 'success' : 'danger' ?>">
                                   <?= $general_grade >= 10 ? 'Validé' : 'Non Validé' ?>
                               </span>
                           </div>
                                   <!-- Bouton Print -->
                                   <div class="text-center mt-3">
                                       <button class="btn btn-primary" id="btn" onclick="window.print()">Imprimer les résultats</button>
                                   </div>
                       </div>
    </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
