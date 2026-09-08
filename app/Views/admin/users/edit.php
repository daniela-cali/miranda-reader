<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-wrap">
 
  <!-- Page header -->
  <div class="page-header">
    <div class="badge-pill">Settings</div>
    <h1>Account &amp; Profilo</h1>
		<p>Dettagli utente, gruppi e collegamento all'utente di Miranda.</p>
  </div>
 
  <div class="form-card">
 
    <!-- ─── Section 1: Personal info ─── -->
    <div class="section-head">
      <div class="dot"></div>
      <span>Account</span>
    </div>
 
    <form id="mainForm" novalidate>
      <div class="form-body">
 
        <!-- Full name -->
        <div class="row hf-row align-items-center">
          <label for="username" class="col-sm-3 col-form-label">
          Username
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="username"
              placeholder="e.g. Nhildra" required />
            <div class="invalid-feedback">Inserisci il tuo nome utente</div>
          </div>
        </div>
 
        <!-- Email -->
        <div class="row hf-row align-items-center">
          <label for="emailAddr" class="col-sm-3 col-form-label">
            Email
          </label>
          <div class="col-sm-9">
            <input 
				type="email" 
				class="form-control" 
				id="emailAddr"
              	placeholder="nhildra.morwen@gmail.com" required />
            <div class="invalid-feedback">Inserisci un indirizzo email valido.</div>
          </div>
        </div>
 
        <!-- Miranda Username -->
        <div class="row hf-row align-items-center">
          <label for="ejabberd_nick" class="col-sm-3 col-form-label">
            Miranda Username
            <span class="label-hint"></span>
          </label>
          <div class="col-sm-9">
            <div class="input-group">
              <span class="input-group-text">@</span>
              <input  
                type="text" 
                      class="form-control" id="ejabberd_nick"
                placeholder="Nhildra" />
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
								type="checkbox" />
							<?= esc($groupDetails["title"])  ?> 
						</label>
					<?php endforeach ?>
					
				</div>


			</div>

		</div><!-- /form-body -->

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
								type="checkbox"/>
							<?= $permission.': '.esc($permissionDescription)  ?> 
						</label>
					<?php endforeach ?>
					
				</div>


			</div>

			</div><!-- /form-body -->

		<hr class="card-divider" />

 
      <!-- ─── Footer ─── -->
      <div class="form-footer">
        <span class="footer-note">Le modifiche hanno effetto immediato.</span>
        <div class="footer-actions">
          <button type="button" class="btn-ghost" id="btnReset">Scarta</button>
          <button type="submit" class="btn-primary-custom" id="btnSave">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Salva
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