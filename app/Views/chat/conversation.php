<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex">
    <div class="d-flex flex-column flex-shrink-0 p-3 history-dates" >
    <h2 class="sidebar-heading mt-2 mb-1 text-muted jstree-anchor">
        <i class="bi bi-clock-history"></i> 
        <strong> STORICO CHAT </strong>
    </h2>


    <div id="history-dates">
        <ul class="nav nav-pills flex-column mb-auto">
            <?php foreach($historyTree as $year => $months): ?>
                <li class="nav-item">
                    <?= esc($year) ?>
                    <ul>
                        <?php foreach($months as $month => $dates): ?>
                            <li class="nav-item">
                                <?=  esc($month) ?>
                                <ul>
                                    <?php foreach ($dates as $date): ?>
                                        <li class="nav-item">
                                            <?=  esc(format_date($date)) ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        <?php endforeach ?>
                    </ul>

                </li>
            <?php endforeach ?>
            
        </ul>

    </div>
    </div>
    <div class="rounded-1">

        <?php if (!empty($messages)): ?>
            <div class="container chat-container">
                <div class="chat-box py-3">
                    <?php foreach ($messages as $msg): ?>

                        <article class="msg-balloon align-middle mb-2 <?= $msg->isSender ? 'msg-outgoing' : 'msg-incoming' ?> ">
                            <span class="msg-from text-dark text-start"><?= $msg->sender ?></span>
                            <?= esc($msg->txt) ?>
                            <span class="msg-time text-dark text-end"><?= $msg->timestamp ?></span>
                        </article>
                    <?php endforeach ?>

                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Nessun messaggio trovato per l'utente.
            </div>
        <?php endif ?>


        <?= $this->endSection(); ?>
        <?= $this->section('scripts') ?>
        <script> 
        $( document ).ready(function() {
            $(function () { $('#history-dates').jstree(); 
            });
        });

        </script>

        <?= $this->endSection() ?>
    </div>
</div>