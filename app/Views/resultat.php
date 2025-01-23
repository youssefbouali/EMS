<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Gestion des Examens - notes</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-column vh-100 p-3" style="width: 250px; position: fixed;">
            <a class="navbar-brand mb-4" href="#">EMS Dashboard</a>
            <ul class="navbar-nav flex-column w-100">
                <li class="nav-item">
                    <a class="nav-link" href="/"> 🏠 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/"> les notes</a>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 250px;">
            <!-- Navbar -->
           <nav class="navbar navbar-expand-lg navbar-light bg-light w-100" style="z-index: 1050;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Buletin</a>
        <!-- Profil utilisateur -->
        <a href="#" class="nav-link">
            <img src="<?= base_url('assets/images/profil.png') ?>" alt="Profile" style="width:30px;">
        </a>
    </div>
</nav>


            <div class="container-fluid p-4">
                <!-- Success and Error Flash Messages -->
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

                <!-- Content -->
                <div class="container-fluid p-4">
    <h2 class="text-center">Les notes : </h2>


    <div class="container mt-4">
    <div class="semester-header">S1</div>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th>ID-MODULE</th>
      <th class="module-column">MODULE</th>
      <th>N.N</th>
      <th>N.R</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td class="module-column">GENIE LOGICIEL</td>
      <td>10</td>
      <td>-</td>
    </tr>
    <tr>
      <td>21</td>
      <td class="module-column">LANGUE ET COMMUNICATION 1</td>
      <td>15</td>
      <td>-</td>
    </tr>
    <tr>
      <td>12</td>
      <td class="module-column">DESIGN THINKING</td>
      <td>9</td>
      <td>12</td>
    </tr>
    <tr>
      <td>23</td>
      <td class="module-column">JAVA</td>
      <td>17</td>
      <td>-</td>
    </tr>
    <tr>
      <td>121</td>
      <td class="module-column">RECHERCHE OPERATIONNEL</td>
      <td>10</td>
      <td>-</td>
    </tr>
    <tr>
      <td>27</td>
      <td class="module-column">MATHS APPLIQUEE</td>
      <td>16</td>
      <td>-</td>
    </tr>
  </tbody>
</table>

    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success mt-3">
            <p><?= esc(session()->getFlashdata('success')) ?></p>
        </div>
    <?php endif; ?>
</div>

		
		
            </div>
        </div>
    </div>

    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/assets/js/xlsx.full.min.js"></script>
</body>

</html>
