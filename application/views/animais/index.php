<main class="container">
        <div class="video-wrapper">
                <div class="video-text">
                        <h2 class="page-title"><?php echo $this->lang->line('Why_adopt'); ?><span><?php echo $this->lang->line('Adopt'); ?>?</span></h2><br>
                        <button type="submit" class="btn btn-primary btn-rounded btn-lg" name='avaliacao' value='TRUE'>
                                <?php echo $this->lang->line('About_adoption'); ?>
                        </button>
                        <button type="submit" class="btn btn-primary btn-rounded btn-lg" name='avaliacao' value='TRUE'>
                                <?php echo $this->lang->line('About_us'); ?>
                        </button>
                        <button type="submit" class="btn btn-primary btn-rounded btn-lg" name='avaliacao' value='TRUE'>
                                <?php echo $this->lang->line('Curiosities'); ?>
                        </button>
                </div>
                <?php if($this->session->userdata('site_lang') == 'portuguese'){ ?>
                        <iframe class="video" src="https://www.youtube.com/embed/hjOY9BVqtlg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } else { ?>
                        <iframe class="video" src="https://www.youtube.com/embed/3LzNQY3aT4c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } ?>
        </div><br>
        
<?php 

if($this->session->flashdata("danger")) { ?>
        <p class="alert alert-danger"><?=  $this->session->flashdata("danger") ?></p>
        <?php } unset($_SESSION['danger']);?>

<?php if($this->session->flashdata("success")) { ?>
        <p class="alert alert-success"><?=  $this->session->flashdata("success") ?></p>
<?php } unset($_SESSION['success']);?>
        <hr /> 
        <div>
                <?php echo validation_errors(); ?>
                <?php echo form_open('animais'); ?> 

                <ul class='navbar-nav'>
                        <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <input type="text" id="nome" name="nome" class="search" placeholder="<?php echo $this->lang->line('Search_by_name'); ?>">
                        </a>
                        
                        <ul class='dropdown-menu menu' aria-labelledby='navbarDropdownMenuLink'>
                        <li class="dropdown-item">
                                <div class="justify-content-between text-center mb-2 ">
                                        <div>
                                                <p class="mb-0">
                                                        <div class="form-outline mb-4">
                                                                <select name="genero" id="genero" class="form-select" placeholder="<?php echo $this->lang->line('Sex'); ?>">
                                                                <option value="" selected disabled><?php echo $this->lang->line('Sex'); ?></option>
                                                                <?php foreach ($generos as $genero): ?>
                                                                        <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero[$lang]; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                        </div>
                                                </p>
                                        </div>
                                        <div>
                                                <p class="mb-0">
                                                        <div class="form-outline mb-4">
                                                                <select name="especie" onchange="racas();" id="reg-especie" class="form-select" placeholder="<?php echo $this->lang->line('Species'); ?>">
                                                                        <option selected disabled><?php echo $this->lang->line('Species'); ?></option>
                                                                        <?php foreach ($especies as $especie): ?>
                                                                                <option value="<?php echo $especie['id_especies']; ?>"><?php echo $especie[$lang]; ?></option>
                                                                        <?php endforeach; ?>
                                                                </select>
                                                        </div>
                                                </p>
                                        </div>
                                        <div>
                                                <p class="mb-0">
                                                        <div class="form-outline mb-4 raca">
                                                        <select name="raca" id="reg-raca" class="form-select" placeholder="<?php echo $this->lang->line('Breed'); ?>">
                                                                <option value="" selected disabled><?php echo $this->lang->line('Breed'); ?></option>
                                                        </select>
                                                        </div>
                                                </p>
                                        </div>
                                        <div>
                                                <p class="mb-0">
                                                        <div class="form-outline mb-4">
                                                                <select name="porte" id="porte" class="form-select" placeholder="<?php echo $this->lang->line('Size'); ?>">
                                                                <option value="" selected disabled><?php echo $this->lang->line('Size'); ?></option>
                                                                <?php foreach ($portes as $porte): ?>
                                                                        <option value="<?php echo $porte['id_porte']; ?>"><?php echo $porte[$lang]; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                        </div>
                                                </p>
                                        </div>
                                        <div>
                                                <p class="mb-0">
                                                        <div class="form-outline mb-4">
                                                                <select name="pelagem" id="pelagem" class="form-select" placeholder="<?php echo $this->lang->line('Coat_search'); ?>">
                                                                <option value="" selected disabled><?php echo $this->lang->line('Coat_search'); ?></option>
                                                                <?php foreach ($pelagens as $pelagem): ?>
                                                                        <option value="<?php echo $pelagem['id_pelagem']; ?>"><?php echo $pelagem[$lang]; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                        </div>
                                                </p>
                                        </div>
                                        <div>
                                                <p class="mb-0">
                                                        <div class="form-outline mb-4">
                                                                <select name="castrado" id="castrado" class="form-select" placeholder="<?php echo $this->lang->line('Castrated'); ?>">
                                                                <option value="" selected disabled><?php echo $this->lang->line('Castrated'); ?></option>
                                                                <option value="TRUE"><?php echo $this->lang->line('Yes'); ?></option>
                                                                <option value="FALSE"><?php echo $this->lang->line('No'); ?></option>
                                                                </select>
                                                        </div>
                                                </p>
                                        </div>
                                        </div>  
                                
                                <input type="submit" id="submit" class="btn btn-primary btn-block mb-4 submit text-center" name="submit" value="<?php echo $this->lang->line('Submit'); ?>">
                                </form>
                        </li>
                        </ul>
                        </li>
                </ul>


        </div>
        <?php if(!$animais){ ?>
                <div class="container-fluid text-lg-center text-muted">
                        <p>:(</p>
                        <p><?php echo $this->lang->line('No_results')?><a href="<?php echo site_url('animais/register'); ?>"></a></p>
                </div>
        <?php } else{ 

                foreach ($animais as $a): 
                        foreach($a as $animal):
                if(($animal['id_doador'] != $this->session->userdata("id")) && ($animal['id_status'] != 3)){?>
        <div class="card px-3 pt-3 index">
                <a href="<?php echo site_url('animais/view/'.$animal['id_animal']); ?>" class="text-dark">
                        <div class="row mb-4 border-bottom pb-2">
                                <div class="col-3">
                                        <img src="<?php echo base_url('assets/fotos/'.$animal['imagem']); ?>"
                                        class="img-fluid shadow-1-strong rounded img-feed" alt=""/>
                                </div>

                                <div class="col-9">
                                        <h4><?php echo $animal['nome']; ?></h4>
                                        <p class="mb-2">
                                                <?php foreach($racas as $raca){
                                                if($raca['id_raca'] == $animal['id_raca']) echo $raca[$lang]; 
                                                }
                                                ?>
                                        </p>
                                        <p> 
                                                <?php 
                                                        $dataNascimento = new DateTime($animal['datanasci']);
                                                        $idade = $dataNascimento->diff(new DateTime(date('Y-m-d')));
                                                        if($idade->format('%Y') != 00){
                                                                if($idade->format('%Y') > 1) echo $idade->format('%Y ').$this->lang->line("Age_years"); 
                                                                else echo $idade->format('%Y ').$this->lang->line("Age_year");
                                                        }
                                                        elseif($idade->format('%M') != 00){
                                                                if($idade->format('%M') > 1) echo $idade->format('%M ').$this->lang->line("Age_months");
                                                                else echo $idade->format('%M ').$this->lang->line("Age_month");
                                                        }
                                                        else{
                                                                if($idade->format('%D') > 1) echo $idade->format('%D ').$this->lang->line("Age_days");
                                                                else echo $idade->format('%D ').$this->lang->line("Age_day");
                                                        }
                                                ?>
                                        </p>
                                </div>
                        </div>
                </a> 
        </div>
        <?php } endforeach; endforeach; }?>
</main>
