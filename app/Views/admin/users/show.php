<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-wrap">

	<!-- Page header -->
	<div class="page-header">
	<div class="badge-pill">Account &amp; Profilo</div>
		<p>Dettagli utente, gruppi e collegamento all'utente di Miranda.</p>
	</div>

	<div class="form-card">

		<!-- ─── Section 1: Account ─── -->
		<div class="section-head">
			<div class="dot"></div>
			<span>Account</span>
		</div>


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



			
	</div><!-- /form-card -->
</div>

<!-- Toast -->
<div class="toast-wrap">
	<div class="toast-msg" id="toast">
		<span class="check">✓</span> Profile updated successfully
	</div>
</div>
<?php $this->endSection() ?>