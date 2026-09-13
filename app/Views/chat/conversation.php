<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php if(!empty($messages)): ?>
<div class = container>
    <div class="chat-container">
        <div class="chat-box">
            <?php foreach($messages as $msg): ?>

                <article class="msg-balloon align-middle mb-2 <?= $msg->isSender? 'msg-outgoing': 'msg-incoming'?> ">
                    <span class="msg-from text-dark text-start"><?= $msg->sender ?></span>
                    <?= $msg->txt ?>
                    <span class="msg-time text-dark text-end"><?= $msg->timestamp ?></span>
                </article>
            <?php endforeach ?>                

        </div>
    </div>
</div>
<?php else: ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Nessun messaggio trovato per l'utente.
    </div>
<?php endif ?>


<?= $this->endSection(); ?>