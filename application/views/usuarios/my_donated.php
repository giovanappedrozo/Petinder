<main class="container">
    <hr/>
    <ul class="nav nav-tabs">
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('usuarios/my_animals'); ?>"><?php echo $this->lang->line('For_adoption'); ?></a>
            </li>
            <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('usuarios/my_donated'); ?>"><?php echo $this->lang->line('Donated_by_me'); ?></a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('usuarios/my_adopted'); ?>"><?php echo $this->lang->line('Adopted_by_me'); ?></a>
            </li>
    </ul>                
        <?php foreach ($animais as $animal): 
        if($animal && $animal['id_status'] == 3){?>
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
                                </a>
                        </div>
                </div>
            </div>
        <?php } endforeach; ?>                   
</main>