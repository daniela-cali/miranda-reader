<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php 
/*echo 'Username loggato da controller: ' . $loggedUser. '<br>';
foreach ($contactsWith as $contact) {
    echo 'Contatto ' . $contact->bare_peer;
    echo ' - Count: ' . $contact->count. '<br>';

}*/
?>
<?php if (!empty($contactsWith)): ?>
    <table class="table table-bordered table-striped table-hover align-middle datatable" id="primaryTable">
        <thead class="table-secondary">
            <tr>
                <th>Username</th>
                <th>Messaggi totali</th>
                <th class="notexport">Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactsWith as $contact): ?>
                <tr class="data-row" data-username="<?= esc($contact->bare_peer) ?>">
                    <td><?= esc($contact->bare_peer) ?></td>
                    <td><?= esc($contact->count) ?></td>
                    
                    <td>
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?= route_to('chat_conversation').'?bare_peer='. urlencode($contact->bare_peer) ?>">
                                    <i class="bi bi-clock-history"></i> Storico messaggi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="">
                                    <i class="bi bi-pencil"></i> Modifica
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Nessun contatto trovato per l'utente <?=$loggedUser ?>.
    </div>
<?php endif; ?>


<?= $this->endSection(); ?>