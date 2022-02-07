<main class="container">
  <?php echo validation_errors(); ?>

  <?php if($this->session->flashdata("danger")) { ?>
        <p class="alert alert-danger"><?=  $this->session->flashdata("danger") ?></p>
        <?php } unset($_SESSION['danger']);?>

  <?php echo form_open('usuarios/application'); ?>

    <div class="form-outline mb-4">
      <select name="moradia" id="moradia" class="form-select" placeholder="<?php echo $this->lang->line('Dwelling'); ?>" required>
      <option value="" selected disabled><?php echo $this->lang->line('Dwelling'); ?></option>
      <?php foreach ($moradias as $moradia): ?>
              <option value="<?php echo $moradia['id_moradia']; ?>"><?php echo $moradia[$lang]; ?></option>
      <?php endforeach; ?>
      </select>
    </div>

    <div class="form-outline mb-4 form-radio">
        <label for="acesso" class="form-label"><?php echo $this->lang->line('Dwelling_access'); ?></label><br>
            <div class="form-check" id="acesso">
                <input class="form-check-input" type="radio" name="acesso" id="acesSim" value="TRUE" required>
                <label class="form-check-label" for="acesSim">
                <?php echo $this->lang->line('Yes'); ?>
        </label>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="acesso" id="acesNao" value="FALSE" required>
            <label class="form-check-label" for="acesNao">
                <?php echo $this->lang->line('No'); ?>
            </label>
        </div>
    </div>

    <div class="form-floating mb-4">
        <input type="number" min='0' id="moradores" name="moradores" class="form-control" placeholder="<?php echo $this->lang->line('Amount_people'); ?>" required>
        <label for="moradores"><?php echo $this->lang->line('Amount_people'); ?></label>
    </div>

    <div class="form-outline mb-4 form-radio">
        <label for="criancas" class="form-label"><?php echo $this->lang->line('Children'); ?></label><br>
            <div class="form-check" id="criancas">
                <input class="form-check-input" type="radio" name="criancas" id="criaSim" value="TRUE" required>
                <label class="form-check-label" for="criaSim">
                <?php echo $this->lang->line('Yes'); ?>
        </label>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="criancas" id="criaNao" value="FALSE" required>
            <label class="form-check-label" for="criaNao">
                <?php echo $this->lang->line('No'); ?>
            </label>
        </div>
    </div>

    <div class="form-outline mb-4">
      <select name="outros" id="outros" class="form-select" placeholder="<?php echo $this->lang->line('OtherAnimals'); ?>" required>
      <option value="" selected disabled><?php echo $this->lang->line('OtherAnimals'); ?></option>
      <?php foreach ($outros as $outro): ?>
              <option value="<?php echo $outro['id_outrosanimais']; ?>"><?php echo $outro[$lang]; ?></option>
      <?php endforeach; ?>
      </select>
    </div>

    <div class="form-outline mb-4 form-radio">
        <label for="alergias" class="form-label"><?php echo $this->lang->line('Illnesses'); ?></label><br>
            <div class="form-check" id="alergias">
                <input class="form-check-input" type="radio" name="alergias" id="alergSim" value="TRUE" required>
                <label class="form-check-label" for="alergSim">
                <?php echo $this->lang->line('Yes'); ?>
        </label>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="alergias" id="alergNao" value="FALSE" required>
            <label class="form-check-label" for="alergNao">
                <?php echo $this->lang->line('No'); ?>
            </label>
        </div>
    </div>

    <div class="form-outline mb-4">
      <select name="horas" id="horas" class="form-select" placeholder="<?php echo $this->lang->line('Hours'); ?>" required>
      <option value="" selected disabled><?php echo $this->lang->line('Hours'); ?></option>
      <?php foreach ($horas as $hora): ?>
              <option value="<?php echo $hora['id_horassozinho']; ?>"><?php echo $hora[$lang]; ?></option>
      <?php endforeach; ?>
      </select>
    </div>    

    <div class="form-outline mb-4 form-radio">
        <label for="gastos" class="form-label"><?php echo $this->lang->line('Expenses'); ?></label><br>
            <div class="form-check" id="gastos">
                <input class="form-check-input" type="radio" name="gastos" id="gastSim" value="TRUE" required>
                <label class="form-check-label" for="gastSim">
                <?php echo $this->lang->line('Yes'); ?>
        </label>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gastos" id="gastNao" value="FALSE" required>
            <label class="form-check-label" for="gastNao">
                <?php echo $this->lang->line('No'); ?>
            </label>
        </div>
    </div>

    <input type="hidden" name="id_usuario" value="<?php echo $this->session->userdata('id'); ?>">

  <input type="submit" id="submit" class="btn btn-primary btn-block mb-4 submit" name="submit" value="<?php echo $this->lang->line('Title_reg'); ?>">
  </form>
</main>