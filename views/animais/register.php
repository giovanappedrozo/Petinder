<main class="container">
        <?php echo validation_errors(); if($error) echo $error['error'];?>
        <?php echo form_open_multipart('animais/register');?>

        <div class="form-outline mb-4">
                <label for="img" class="form-label form-radio"><?php echo $this->lang->line('Add_photo'); ?>: </label><br>
                <input type="file" name='profile_pic' accept=".jpeg,.jpg,.png,.gif" class="form-control form-control" id="img" required>
        </div>

        <div class="form-floating mb-4">
                <input type="text" id="nome" name="nome" class="form-control" placeholder="<?php echo $this->lang->line('PH_name'); ?>" required>
                <label for="nome"><?php echo $this->lang->line('Name_pet'); ?></label>
        </div>

        <div class="form-outline mb-4">
                <select name="genero" id="genero" class="form-select" placeholder="<?php echo $this->lang->line('Sex'); ?>" required>
                <option value="" selected disabled><?php echo $this->lang->line('Sex'); ?></option>
                <?php foreach ($generos as $genero): ?>
                        <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero[$lang]; ?></option>
                <?php endforeach; ?>
                </select>
        </div>

        <div class="form-floating mb-4">
                <input type="date" name="data" id="data" class="form-control" required 
                min="<?php $data = new DateTime('now'); $data->modify('-35 years'); echo $data->format('Y-m-d');?>"
                        max="<?php $data = new DateTime('now'); echo $data->format('Y-m-d');?>">
                <label for="data"><?php echo $this->lang->line('BirthDate'); ?></label>
        </div>
        

        <div class="form-outline mb-4">
                <select name="especie" onchange="racas();" id="reg-especie" class="form-select" placeholder="<?php echo $this->lang->line('Species'); ?>" required>
                <option selected disabled><?php echo $this->lang->line('Species'); ?></option>
                <?php foreach ($especies as $especie): ?>
                        <option value="<?php echo $especie['id_especies']; ?>"><?php echo $especie[$lang]; ?></option>
                <?php endforeach; ?>
                </select>
        </div>

        <div class="form-outline mb-4">
                <select name="raca" id="reg-raca" class="form-select" placeholder="<?php echo $this->lang->line('Breed'); ?>" required >
                        <option value="" selected disabled><?php echo $this->lang->line('Breed'); ?></option>
                </select>
        </div>        

        <div class="form-outline mb-4">
                <select name="porte" id="porte" class="form-select" placeholder="<?php echo $this->lang->line('Size'); ?>" required>
                <option value="" selected disabled><?php echo $this->lang->line('Size'); ?></option>
                <?php foreach ($portes as $porte): ?>
                        <option value="<?php echo $porte['id_porte']; ?>"><?php echo $porte[$lang]; ?></option>
                <?php endforeach; ?>
                </select>
        </div>

        <div class="form-outline mb-4">
                <select name="pelagem" id="pelagem" class="form-select" placeholder="<?php echo $this->lang->line('Coat'); ?>" required>
                <option value="" selected disabled><?php echo $this->lang->line('Coat'); ?></option>
                <?php foreach ($pelagens as $pelagem): ?>
                        <option value="<?php echo $pelagem['id_pelagem']; ?>"><?php echo $pelagem[$lang]; ?></option>
                <?php endforeach; ?>
                </select>
        </div>

        <div class="form-outline mb-4 form-radio">
                <label for="check" class="form-label"><?php echo $this->lang->line('Special'); ?></label><br>
                <div class="form-check" id="check">
                <input class="form-check-input" type="radio" name="especial" id="espSim" value="TRUE" required>
                        <label class="form-check-label" for="espSim">
                                <?php echo $this->lang->line('Yes'); ?>
                        </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="especial" id="espNao" value="FALSE" required>
                        <label class="form-check-label" for="espNao">
                                <?php echo $this->lang->line('No'); ?>
                        </label>
                </div>
        </div>


        <div class="form-outline mb-4">
                <select name="temperamento" id="temperamento" class="form-select" placeholder="<?php echo $this->lang->line('Temperament'); ?>" required>
                <option value="" selected disabled><?php echo $this->lang->line('Temperament'); ?></option>
                <?php foreach ($temperamentos as $temperamento): ?>
                        <option value="<?php echo $temperamento['id_temperamento']; ?>"><?php echo $temperamento[$lang]; ?></option>
                <?php endforeach; ?>
                </select>
        </div>

        <div class="form-check form-radio">
                <input class="form-check-input" type="checkbox" value="castrado" id="castrado" name="castrado">
                <label class="form-check-label" for="castrado">
                        <?php echo $this->lang->line('Castrated'); ?>
                </label>
        </div>

        <div class="form-floating mb-4">
                <input type="text" id="info" name="info" class="form-control" placeholder="<?php echo $this->lang->line('More_info'); ?>">
                <label for="info"><?php echo $this->lang->line('AddInfo'); ?></label>
        </div>

        <input type="hidden" name="doador" value="<?php echo $this->session->userdata("id"); ?>">

        <input type="submit" name="submit" class="btn btn-primary btn-block mb-4 submit" value="<?php echo $this->lang->line('Submit'); ?>">

        </form>
</main>