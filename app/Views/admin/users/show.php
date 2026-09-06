<?= $this->extend('layouts/main') ?>

<?= $this->section('css') ?>
<link href="<?= base_url('css/form.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-wrap">

	<!-- Page header -->
	<div class="page-header">
		<div class="badge-pill">Settings</div>
		<h1>Account &amp; Profilo</h1>
		<p>Dettagli utente, gruppi e collegamento all'utente di Miranda.</p>
	</div>

	<div class="form-card">

		<!-- ─── Section 1: Account ─── -->
		<div class="section-head">
			<div class="dot"></div>
			<span>Account</span>
		</div>

		<form id="mainForm" novalidate>
			<div class="form-body">

				<!-- Username -->
				<div class="row hf-row align-items-center">
					<label for="username" class="col-sm-3 col-form-label">
						Username
					</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="username" value="<?= $user->username ?>" readonly />
					</div>
				</div>

				<!-- Email -->
				<div class="row hf-row align-items-center">
					<label for="emailAddr" class="col-sm-3 col-form-label">
						Email
					</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="emailAddr" value="<?= $user->email ?>" readonly>
						<div class="invalid-feedback">Please enter a valid email address.</div>
					</div>
				</div>

				<!-- Miranda Username -->
				<div class="row hf-row align-items-center">
					<label for="miranda" class="col-sm-3 col-form-label">
						Miranda Username
					</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control" id="miranda" value="<?= $user->ejabberd_nick ?? 'Nessun nickname associato' ?>" readonly />
						</div>
					</div>
				</div>

			</div><!-- /form-body -->

			<hr class="card-divider" />

			<!-- ─── Section 2: Gruppi ─── -->
			<div class="section-head">
				<div class="dot"></div>
				<span>Gruppi</span>
			</div>

			<div class="form-body">

				<!-- Gruppi -->
				<div class="row hf-row align-items-start">
					<div class="list-group">
						<?php foreach ($allGroups as $group =>$groupDetails): ?>

							<label class="list-group-item">
								<input class="form-check-input me-1"
									type="checkbox"
									disabled
									<?= $user->inGroup($group) ? 'checked' : '' ?> />
								<?= esc($groupDetails["title"])  ?> 
							</label>
						<?php endforeach ?>
						
					</div>


				</div>


			</div><!-- /form-body -->

			<hr class="card-divider" />

			<!-- ─── Section 3: Permessi ─── -->
			<div class="section-head">
				<div class="dot"></div>
				<span>Permessi</span>
			</div>

			<div class="form-body">

			<div class="row hf-row align-items-start">
				<div class="list-group">
					<?php foreach ($allPermissions as $permission =>$permissionDescription): ?>

						<label class="list-group-item">
							<input class="form-check-input me-1"
								type="checkbox"
								disabled
								<?= $user->hasPermission($permission) ? 'checked' : '' ?> />
							<?= $permission.': '.esc($permissionDescription)  ?> 
						</label>
					<?php endforeach ?>
					
				</div>


			</div>

			</div><!-- /form-body -->

			<!-- ─── Footer ─── -->
			<div class="form-footer">
				<span class="footer-note">Changes are saved to your workspace instantly.</span>
				<div class="footer-actions">
					<button type="button" class="btn-ghost" id="btnReset">Discard</button>
					<button type="submit" class="btn-primary-custom" id="btnSave">
						<svg viewBox="0 0 24 24">
							<polyline points="20 6 9 17 4 12" />
						</svg>
						Save changes
					</button>
				</div>
			</div>

		</form>
	</div><!-- /form-card -->
</div>

<!-- Toast -->
<div class="toast-wrap">
	<div class="toast-msg" id="toast">
		<span class="check">✓</span> Profile updated successfully
	</div>
</div>
<?php $this->endSection() ?>