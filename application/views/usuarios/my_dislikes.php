<main class="container">
        <hr/>
        <ul class="nav nav-tabs">
                <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('usuarios/mi-au-doreis'); ?>"><?php echo $this->lang->line('Like'); ?>S</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link active" href="<?php echo site_url('usuarios/des-au-gosteis'); ?>"><?php echo $this->lang->line('Dislike'); ?>S</a>
                </li>
        </ul>
        <?php if($animais){
        foreach ($animais as $animal): ?>
            <div class="card px-3 pt-3">
                <div class="row mb-4 border-bottom pb-2">
                        <div class="col-3">
                        <a href="<?php echo site_url('animais/view/'.$animal['id_animal']); ?>" class="text-dark">
                                <img src="<?php echo base_url('assets/fotos/'.$animal['imagem']); ?>"
                                class="img-fluid shadow-1-strong rounded img-feed" alt=""/>
                        </a>
                        </div>

                        <div class="col-9">
                                <a href="<?php echo site_url('animais/view/'.$animal['id_animal']); ?>" class="text-dark">
                                        <h4><?php echo $animal['nome']; ?></h4>
                                <?php if($animal['id_doador'] == $this->session->userdata('id')){ ?>
                                        <br><a onclick="confirm(<?php echo $animal['id_animal']; ?>);" class="icones"><i class="bi bi-trash-fill"></i></a>&nbsp;
                                        <a class="icones" href="<?php echo site_url('animais/edit/'.$animal['id_animal']); ?>"><i class="bi bi-pencil-fill"></i></a>&nbsp;&nbsp;
                                <?php } ?>
                                </a>
                        </div>
                </div>
            </div>

        <?php endforeach; } ?>                   
</main>