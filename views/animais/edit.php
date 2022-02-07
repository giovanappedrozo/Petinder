<main class="container">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('animais/edit/'.$animal['id_animal']);?>

        <div class="form-floating mb-4">
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $animal['nome']; ?>">
                <label for="nome"><?php echo $this->lang->line('Name_pet'); ?></label>
        </div>

        <p class="form-radio"><?php $dataNascimento = new DateTime($animal['datanasci']);
              echo $this->lang->line('BirthDate').': '.$dataNascimento->format('d/m/Y'); ?></p>

        <div class="form-outline mb-4">
            <label for="genero" class="form-radio"><?php echo $this->lang->line('Sex'); ?>:</label>
                <select name="genero" id="genero" class="form-select" placeholder="<?php echo $this->lang->line('Sex'); ?>" disabled>
                <?php foreach ($generos as $genero): 
                    if($genero['id_genero'] == $animal['id_genero']){?>
                        <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero[$lang]; ?></option>
                <?php } endforeach; ?>
                </select>
        </div>

        <div class="form-outline mb-4">
            <label for="raca" class="form-radio"><?php echo $this->lang->line('Breed'); ?>:</label>
                <select name="raca" id="raca" class="form-select" placeholder="<?php echo $this->lang->line('Breed'); ?>" disabled>
                <?php foreach ($racas as $raca): 
                    if($raca['id_raca'] == $animal['id_raca']){?>
                        <option value="<?php echo $raca['id_raca']; ?>"><?php echo $raca[$lang]; ?></option>
                <?php } endforeach; ?>
                </select>
        </div>

        <div class="form-outline mb-4">
            <label for="porte" class="form-radio"><?php echo $this->lang->line('Size'); ?>:</label>
                <select name="porte" id="porte" class="form-select" placeholder="<?php echo $this->lang->line('Size'); ?>">
                <?php foreach ($portes as $porte): 
                    if($porte['id_porte'] == $animal['id_porte']){ ?>
                        <option value="<?php echo $porte['id_porte']; ?>" selected><?php echo $porte[$lang]; ?></option>
                    <?php } else {?>
                    <option value="<?php echo $porte['id_porte']; ?>"><?php echo $porte[$lang]; ?></option>
                <?php } endforeach; ?>
                </select>
        </div>

        <div class="form-outline mb-4">
            <label for="pelagem" class="form-radio"><?php echo $this->lang->line('Coat'); ?>:</label>
                <select name="pelagem" id="pelagem" class="form-select" placeholder="<?php echo $this->lang->line('Coat'); ?>">
                <?php foreach ($pelagens as $pelagem): 
                    if($pelagem['id_pelagem'] == $animal['id_pelagem']){ ?>
                        <option value="<?php echo $pelagem['id_pelagem'];?>" selected><?php echo $pelagem[$lang]; ?></option>
                    <?php } else {?>
                        <option value="<?php echo $pelagem['id_pelagem']; ?>"><?php echo $pelagem[$lang]; ?></option>
                <?php } endforeach; ?>
                </select>
        </div>

        <?php if($animal['especial'] == TRUE){ ?>
            <div class="form-outline mb-4 form-radio">
                    <label for="check" class="form-label"><?php echo $this->lang->line('Special'); ?></label><br>
                    <div class="form-check" id="check">
                    <input class="form-check-input" type="radio" name="especial" id="espSim" value="TRUE" checked disabled>
                            <label class="form-check-label" for="espSim">
                                    <?php echo $this->lang->line('Yes'); ?>
                            </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="especial" id="espNao" value="FALSE" disabled>
                            <label class="form-check-label" for="espNao">
                                    <?php echo $this->lang->line('No'); ?>
                            </label>
                    </div>
            </div>
        <?php } else { ?>
            <div class="form-outline mb-4 form-radio">
                <label for="check" class="form-label"><?php echo $this->lang->line('Special'); ?></label><br>
                <div class="form-check" id="check">
                <input class="form-check-input" type="radio" name="especial" id="espSim" value="TRUE">
                        <label class="form-check-label" for="espSim">
                                <?php echo $this->lang->line('Yes'); ?>
                        </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="especial" id="espNao" value="FALSE" checked>
                        <label class="form-check-label" for="espNao">
                                <?php echo $this->lang->line('No'); ?>
                        </label>
                </div>
            </div>
        <?php } ?>

        <div class="form-outline mb-4">
            <label for="porte" class="form-radio"><?php echo $this->lang->line('Temperament'); ?></label>
                <select name="temperamento" id="temperamento" class="form-select" placeholder="<?php echo $this->lang->line('Temperament'); ?>" required>
                <?php foreach ($temperamentos as $temperamento): 
                    if($temperamento['id_temperamento'] == $animal['id_temperamento']){ ?>
                        <option value="<?php echo $temperamento['id_temperamento']; ?>" selected><?php echo $temperamento[$lang]; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $temperamento['id_temperamento']; ?>"><?php echo $temperamento[$lang]; ?></option>
                <?php } endforeach; ?>
                </select>
        </div>

        <?php if($animal['castrado'] == TRUE){ ?>
            <div class="form-check form-radio">
                    <input class="form-check-input" type="checkbox" value="castrado" id="castrado" name="castrado" checked disabled>
                    <label class="form-check-label" for="castrado">
                            <?php echo $this->lang->line('Castrated'); ?>
                    </label>
            </div>
        <?php } else {?>
            <div class="form-check form-radio">
                    <input class="form-check-input" type="checkbox" value="castrado" id="castrado" name="castrado">
                    <label class="form-check-label" for="castrado">
                            <?php echo $this->lang->line('Castrated'); ?>
                    </label>
            </div>
        <?php } ?>

        <div class="form-floating mb-4">
                <input type="text" id="info" name="info" class="form-control" value="<?php echo $animal['infoadicional'] ?>">
                <label for="info"><?php echo $this->lang->line('AddInfo'); ?></label>
        </div>

        <input type="submit" name="submit" class="btn btn-primary btn-block mb-4 submit" value="<?php echo $this->lang->line('Submit'); ?>">

        </form>
</main>
