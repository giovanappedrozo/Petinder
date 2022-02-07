<main class="container">
        <hr />
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo site_url('usuarios/matches/adotar'); ?>"><?php echo $this->lang->line('Adopt'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('usuarios/solicitacoes'); ?>"><?php echo $this->lang->line('Like'); ?>s</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('usuarios/matches/doar'); ?>">Matches</a>
            </li>
        </ul>
        <?php if($matches){ ?>

            <?php foreach($matches as $match){ ?>
                <div class="card px-3 pt-3">
                    <div class="row mb-4 border-bottom pb-2">
                        <div class="col-9">
                            <h5 class=""><?php echo $match['nome']; ?> - 
                            <?php echo $match['animal']; ?>
                            </h5>
                        <a href="<?php echo site_url('mensagens/'.$match['id_animal'].'/'.$match['id_doador']); ?>" class="red"><?php echo $this->lang->line('Start_chat'); ?></a>
                        </div>
                    </div>
                </div>
            <?php }}
            else{ ?>
                <br><div class="container-fluid text-lg-center text-muted">
                        <p>:(</p>
                        <p><?php echo $this->lang->line('No_notification')?></p>
                </div>
            <?php } ?>             
</main>