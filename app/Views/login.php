<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EMS Gestion des examens - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <!-- Bootstrap CSS from local directory -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">

    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css">

    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="bg-gradient-to-r dark:from-gray-700 dark:via-gray-900 dark:to-black">
        <div class="h-screen w-screen flex justify-center items-center">
            <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
                <div class="card overflow-hidden sm:rounded-md rounded-none">
                    <div class="p-6">
                        <h2 class="text-center text-primary mb-4">Login</h2>

					<!-- Display Success Messages -->
					<?php if (session()->getFlashdata('success')): ?>
						<div style="color: green; text-align: center;">
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
                        <form method="post" action="/login">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="LoggingEmailAddress">Email Address</label>
                                <input id="LoggingEmailAddress" name="email" class="form-input" type="email" placeholder="you@gmail.com" value="<?= old('email') ?>" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="loggingPassword">Password</label>
                                <input id="loggingPassword" name="password" class="form-input" type="password" placeholder="********" required>
                            </div>
                            <div class="flex justify-center mb-6">
                                <button type="submit" class="btn w-full text-white bg-primary">Log In</button>
                            </div>
                            <div class="flex items-center my-6">
                                <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                                <div class="mx-4 text-secondary">Or</div>
                                <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                            </div>
                        </form>
                        <p class="text-gray-500 dark:text-gray-400 text-center">Don't have an account?
                            <a href="/register" class="text-primary ms-1"><b>Register</b></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
