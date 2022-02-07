<main class="container">
        <hr />
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo site_url('usuarios/solicitacoes'); ?>"><?php echo $this->lang->line('Like'); ?>s</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('usuarios/matches/doar'); ?>">Matches</a>
            </li>
        </ul>
        <?php if($likes){ ?>

            <?php foreach ($likes as $like): ?>
                <div class="card px-3 pt-3">
                    <div class="row mb-4 border-bottom pb-2">
                        <div class="col-9">
                            <h5 class=""><?php echo $like['nome']; ?> - 
                            <?php echo $like['animal']; ?>
                            </h5>
                            <a href="<?php echo site_url('usuarios/'.$like['id_usuario'].'/'.$like['id_animal']); ?>" class="red"><?php echo $this->lang->line('See_more'); ?></a>
                        </div>
                    </div>
                </div>

        <?php endforeach; }
            else{ ?>
                <br><div class="container-fluid text-lg-center text-muted">
                        <p>:(</p>
                        <p><?php echo $this->lang->line('No_notification')?></p>
                </div>
        <?php } ?>            
</main>
