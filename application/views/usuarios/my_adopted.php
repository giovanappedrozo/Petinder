<main class="container">
        <hr/>
        <ul class="nav nav-tabs">
                <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('usuarios/my_animals'); ?>"><?php echo $this->lang->line('For_adoption'); ?></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('usuarios/my_donated'); ?>"><?php echo $this->lang->line('Donated_by_me'); ?></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link active" href="<?php echo site_url('usuarios/my_adopted'); ?>"><?php echo $this->lang->line('Adopted_by_me'); ?></a>
                </li>
        </ul>
        <?php foreach ($animais as $animal): ?>
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
                                <?php if($animal['id_adotante'] == $this->session->userdata('id')){ ?>
                                        <br><a href="<?php echo site_url('animais/back_to_adoption/'.$animal['id_animal']); ?>" class="red"><?php echo $this->lang->line('Rehome_pet'); ?></a>&nbsp;
                                <?php } ?>
                                </a>
                        </div>
                </div>
            </div>

        <?php endforeach; ?>                   
</main>
