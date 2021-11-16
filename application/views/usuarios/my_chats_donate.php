<main class="container">
        <hr /> 
        <ul class="nav nav-tabs">
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('usuarios/chats/adopt'); ?>"><?php echo $this->lang->line('Adopt'); ?></a>
            </li>
            <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('usuarios/chats/donate'); ?>"><?php echo $this->lang->line('Rehome'); ?></a>
            </li>
        </ul>   
        <?php if($conversas == null){ ?>
                <div class="container-fluid text-lg-center text-muted">
                        <p>:(</p>
                        <p><?php echo $this->lang->line('No_conversations')?></p>
            </div>
        <?php } else{?>  
        <?php foreach ($conversas as $conversa): ?>
                <div class="card px-3 pt-3">
                <a href="<?php echo site_url('mensagens/'.$conversa['id_animal'].'/'.$conversa['id_usuario']); ?>">
                        <div class="row mb-4 border-bottom pb-2">
                            <div class="col-9">
                                <h5 class="red"><?php echo $conversa['nome']; ?> - 
                                <?php echo $conversa['animal']; ?>
                                </h5>
                            </div>
                        </div>
                        </a>
                    </div>
        <?php endforeach; }?>      
</main>