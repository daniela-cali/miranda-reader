<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard Template · Bootstrap v5.0</title>
	
	<!-- Bootstrap core CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Bootstrap Icons 1.13.1 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
	<link rel="icon" href="<?= base_url('favicon.ico') ?>" sizes="any">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicon-32.png') ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicon-16.png') ?>">
	<link rel="apple-touch-icon" href="<?= base_url('images/apple-touch-icon.png') ?>">
	<!-- Google font monospace -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">




	<!-- Foglio di stile unico -->
	<link href="<?= base_url('css/app.css') ?>" rel="stylesheet">
	<?= $this->renderSection('css') ?>
</head>

<body>
	<div class = 'app-wrapper'>
		<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 d-flex align-items-center gap-2" href="<?= route_to('dashboard') ?>">
    		<img src="<?= base_url('images/logo-mark-80.webp') ?>" alt="" width="61" height="30">
    		Miranda Reader
		</a>

			<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<input class="form-control form-control-dark w-100" type="text" placeholder="Cerca" aria-label="Cerca">
			<div class="navbar-nav">
				<div class="nav-item text-nowrap">
					<?php if (auth()->loggedIn()): ?>
						<a class="nav-link px-3" href="<?= site_url('logout') ?>">Logout</a>
					<?php else: ?>
						<a class="nav-link px-3" href="<?= site_url('login') ?>">Login</a>
					<?php endif ?>
				</div>
			</div>
		</header>

		<div class="container-fluid">
			<div class="row">
				<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
					<div class="position-sticky pt-3">
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link active" data-nav="Dashboard" aria-current="page" href="<?= route_to('dashboard') ?>">
									<i class="bi bi-house"></i>
									Dashboard
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									<i class="bi bi-chat"></i>
									Chat Viewer
								</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="<?= route_to('users_index') ?>">
									<i class="bi bi-people"></i>
									Users
								</a>
							</li>

						</ul>

						<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
							<span>Saved reports</span>
							<a class="link-secondary" href="#" aria-label="Nuovo Report">
							<i class="bi bi-plus-circle"></i>
							</a>
						</h6>
					</div>
				</nav>

				<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><?= $title ?></h1>

						<?php 
						//Aggiungo la toolbar solo nelle pagine che ne fanno richiesta dal controller
						if ($needsToolbar ?? false): ?>
							<?= $this->include('layouts/partials/toolbar.php'); ?>
						<?php endif ?>
					</div>
					<!-- Visualizzazione errori centralizzata per tutte le pagine -->

					<!-- Array di errori -->
					<?php if (session('errors')): ?>
						<div class="alert alert-danger">
							<ul class="mb-0">
								<?php foreach (session('errors') as $error): ?>
									<li><?= esc($error) ?></li>
								<?php endforeach ?>
							</ul>
						</div>
					<?php endif ?>
					
					<!-- Singolo errore -->
					<?php if (session('error')): ?>
						<div class="alert alert-danger"><?= esc(session('error')) ?></div>
					<?php endif ?>

					<!-- Successo -->
					<?php if (session('success')): ?>
						<div class="alert alert-success"><?= esc(session('success')) ?></div>
					<?php endif ?>


					<?= $this->renderSection('content') ?>
					<?= $this->renderSection('charts') ?>
					
					<?= $this->renderSection('tables') ?>
					

					</div>
				</main>
			</div>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
	<!-- Feather Icons 
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> -->
	<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('input[type="password"]').forEach((input) => {
            const floating = input.closest('.form-floating');

            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'btn toggle-password';
            toggleBtn.innerHTML = '<i class="bi bi-eye"></i>';

            if (floating) {
                // LOGIN: bottone assoluto dentro il wrapper con etichetta flottante
                floating.classList.add('has-toggle');
                floating.appendChild(toggleBtn);
            } else {
                // CREATE: input-group classico (funziona benissimo in 5.0.2)
                const group = document.createElement('div');
                group.className = 'input-group';
                input.parentNode.insertBefore(group, input);
                group.appendChild(input);
                toggleBtn.classList.add('btn-outline-secondary');
                group.appendChild(toggleBtn);
            }

            toggleBtn.addEventListener('click', () => {
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                const icon = toggleBtn.querySelector('i');
                icon.classList.toggle('bi-eye', !isPassword);
                icon.classList.toggle('bi-eye-slash', isPassword);
            });
        });

		document.querySelectorAll('a.nav-link').forEach((navLink)=>{
			//Rimuovo la classe active da tutti i link
			navLink.classList.remove('active');
			//Recupero l'href del link e l'url attuale
			hrefNavLink = navLink.href;
			urlPosition = window.location.href;
			//Li confronto, se sono uguali allora assegno active
			if(urlPosition == hrefNavLink) {
				navLink.classList.add('active');
			}
		});
    });
</script>
	<?= $this->renderSection('scripts') ?>
	
</body>

</html>