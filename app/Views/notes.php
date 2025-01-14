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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="gestionNotesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    📚 Gestion des notes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="gestionNotesDropdown">
                        <li><a class="dropdown-item" href="/sectors">Les filières</a></li>
                    </ul>
                </li>
            </ul>
            <a href="/logout" class="btn btn-danger mt-auto">Logout</a>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 250px;">
            <!-- Navbar -->
           <nav class="navbar navbar-expand-lg navbar-light bg-light w-100" style="z-index: 1050;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Saisie des notes</a>
        <!-- Formulaire de recherche -->
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
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
    <h2 class="text-center">Les notes : <?= esc($nom) ?></h2>

    <!-- Table -->
    <form action="/notes/1" method="post" id="notesForm">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Identifiant</th>
                        <th>CNE</th>
                        <th>Nom de l'Étudiant</th>
                        <th>Note Normal</th>
                        <th>Note Rattrapage</th>
                        <th>Valide</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td><?= esc($note['idUserStudent']) ?></td>
                            <td><?= esc($note['cne']) ?></td>
                            <td><?= esc($note['prenom']) ?> <?= esc($note['nom']) ?></td>
                            <td>
                                <input type="number" name="note_[<?= esc($note['idModule']) ?>,<?= esc($note['idUserStudent']) ?>,normal]" class="form-control" min="0" max="20" value="<?= esc($note['noteNormal']) ?>" required>
                            </td>
                            <td>
                                <input type="number" name="note_[<?= esc($note['idModule']) ?>,<?= esc($note['idUserStudent']) ?>,rattrapage]" class="form-control" min="0" max="20" value="<?= esc($note['noteRattrapage']) ?>" required>
                            </td>
                            <td><?= esc($note['valide']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if (session()->get('role')=="professor"): ?>
            <div class="d-flex justify-content-end align-items-center mt-3">
    <!-- Confirm button aligned to the right -->
    <button type="submit" class="btn btn-dark">Confirmer la saisie</button>
</div>

    <div class="mt-4">
        <!-- Title for file import option -->
        <h5 class="text-center mb-3">Importer des notes au format XLSX</h5>
        
        <!-- Import file button -->
        <div class="d-flex justify-content-center align-items-center">
            <label for="my_file_input" class="btn btn-secondary">Importer un fichier</label>
            <input type="file" id="my_file_input" style="display: none;" />
        </div>
        
        <!-- File download button -->
        <div class="text-center mt-3">
            <a href="/assets/notes.xlsx" class="btn btn-success">Télécharger le fichier XLSX</a>
        </div>
    </div>
<?php endif; ?>

    </form>

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


    <script>
        // Function to handle content change when a note card is clicked
        /*function changeContent(noteId) {
            const contentDiv = document.getElementById('content');
            contentDiv.innerHTML = contentDiv.innerHTML = '<form action="/notes" method="post">Session: <select name="session" required><option value="normal">Normal</option><option value="rattrapage">Rattrapage</option></select> Note Normal: <input type="number" name="noteNormal" min="0" max="20" required> Note Rattrapage: <input type="number" name="noteRattrapage" min="0" max="20" required> ID Étudiant: <input type="text" name="idUserStudent" required> ID note: <input type="text" name="idnote" required> description: <input type="text" name="description" required> <button type="submit">Ajouter les Notes</button></form>';
        }*/
		
		
		var oFileIn;

	document.addEventListener('DOMContentLoaded', function() {
		oFileIn = document.getElementById('my_file_input');
		if (oFileIn.addEventListener) {
			oFileIn.addEventListener('change', filePicked, false);
		}
	});

	function filePicked(oEvent) {
		// Get The File From The Input
		var oFile = oEvent.target.files[0];
		var sFilename = oFile.name;

		// Create A File Reader HTML5
		var reader = new FileReader();

		// Ready The Event For When A File Gets Selected
		reader.onload = function(e) {
			var data = e.target.result;

			// Use XLSX.read instead of XLS.parse_xlscfb
			var wb = XLSX.read(data, { type: 'binary' });

			// Loop Over Each Sheet
			wb.SheetNames.forEach(function(sheetName) {
				// Obtain The Current Row As CSV
				var sCSV = XLSX.utils.make_csv(wb.Sheets[sheetName]);   
				var oJS = XLSX.utils.sheet_to_row_object_array(wb.Sheets[sheetName]);   

				// Display CSV data
				
				//document.getElementById("my_file_output").innerHTML = sCSV;
				oJS.forEach(row => {
					// Find the corresponding input fields based on idModule and idUserStudent
					const inputNormal = document.querySelector(`input[name="note_[${row.idModule},${row.idUserStudent},normal]"]`);
					const inputRattrapage = document.querySelector(`input[name="note_[${row.idModule},${row.idUserStudent},rattrapage]"]`);

					// If inputs exist, update their values
					if (inputNormal) {
						inputNormal.value = row.noteNormal;
					}
					if (inputRattrapage) {
						inputRattrapage.value = row.noteRattrapage;
					}
				});
				console.log(oJS);
			});
		};

		// Tell JS To Start Reading The File
		reader.readAsBinaryString(oFile);
	}





    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('notesForm');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(event.target);
            const notes = {};

            // Process each input to build the structured JSON
            for (const [key, value] of formData.entries()) {
                const match = key.match(/^note_\[(\d+),(\d+),(\w+)\]$/);
                if (match) {
                    const id_module = match[1];
                    const id_student = match[2];
                    const type_note = match[3];

                    // Create a unique key for each student/module combination
                    const uniqueKey = `${id_module}_${id_student}`;

                    if (!notes[uniqueKey]) {
                        notes[uniqueKey] = {
                            idModule: id_module,
                            idUserStudent: id_student,
                            noteNormal: null,
                            noteRattrapage: null
                        };
                    }

                    // Assign the value to the correct note type
                    if (type_note === 'normal') {
                        notes[uniqueKey].noteNormal = value;
                    } else if (type_note === 'rattrapage') {
                        notes[uniqueKey].noteRattrapage = value;
                    }
                }
            }

            // Convert the notes object to an array of values
            const notesArray = Object.values(notes);

            // Send the JSON to the server
            fetch('/notes/<?= esc($id) ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ notes: notesArray }),
            })
                //.then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    alert('Notes submitted successfully!');
					window.location.reload();  // Reload the page to reflect changes
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting the notes.');
                });
        });
    }
});

</script>
</body>

</html>
