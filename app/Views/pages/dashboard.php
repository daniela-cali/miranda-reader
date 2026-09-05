<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
	CONTENUTO DELLA HOME DI PROVA
<?= $this->endSection() ?>

<?= $this->section('charts') ?>
	<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
<?= $this->endSection() ?>

<?= $this->section('tables') ?>
	<h2>Ultima Chat</h2>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Header</th>
					<th scope="col">Header</th>
					<th scope="col">Header</th>
					<th scope="col">Header</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1,001</td>
					<td>random</td>
					<td>data</td>
					<td>placeholder</td>
					<td>text</td>
				</tr>
				<tr>
					<td>1,002</td>
					<td>placeholder</td>
					<td>irrelevant</td>
					<td>visual</td>
					<td>layout</td>
				</tr>
			</tbody>
		</table>
	</div>
<?= $this->endSection() ?>
<?php $this->section('scripts') ?>
<?php if (!auth()->loggedIn()): ?>
    <!-- Modal di login: si sovrappone al contenuto sfocato, non chiudibile dall'utente -->
    <div class="modal fade" id="loginModal" tabindex="-1"
        data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="loginModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">

                <!-- Header scuro con logo e nome dell'applicazione -->
                <div class="modal-header">
                    <img src="<?= setting('SiteConfig.logoPath') ?>"
                        alt="<?= esc(setting('SiteConfig.siteName')) ?>"
                        class="me-3">
                    <h5 class="modal-title mb-0" id="loginModalLabel">
                        <?= esc(setting('SiteConfig.siteName')) ?> — Accesso
                    </h5>
                </div>

                <!-- Form di login riusato dal partial Shield/_login_form -->
                <div class="modal-body px-4 pb-4">
                    <?= view('Shield/_login_form') ?>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!auth()->loggedIn()): ?>
    <script>
        // Modalità ospite: attiva blur sull'app e mostra il modal di login
        document.addEventListener('DOMContentLoaded', function() {
            // Sposta il modal come figlio diretto di <body> (era dentro .app-wrapper)
            // così non viene colpito dal filter:blur applicato all'app-wrapper
            document.body.appendChild(document.getElementById('loginModal'));

            // Aggiunge la classe che applica il filtro blur all'app-wrapper via custom.css
            document.body.classList.add('guest-mode');
            console.log('aggiunto classe al body');

            // Mostra il modal in modo non chiudibile (backdrop=static, keyboard=false)
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'), {
                backdrop: 'static',
                keyboard: false,
            });
            loginModal.show();
            console.log('appare il modal');
        });
    </script>
<?php endif; ?>
<?php $this->endSection() ?>