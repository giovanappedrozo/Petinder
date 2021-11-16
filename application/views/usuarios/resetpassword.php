<main class="container">
    <?php echo validation_errors(); ?>

    <?php echo form_open('usuarios/change_password'); ?>

    <!-- Password input -->
    <div class="form-floating mb-4">
        <input type="password" id="senha" class="form-control" required name="senha" placeholder="********"/>
        <label for="senha"><?php echo $this->lang->line('New_passwd'); ?></label>
    </div>

    <div class="form-floating mb-4">
        <input type="password" id="senha" class="form-control" required name="confirmacao" placeholder="********"/>
        <label for="senha"><?php echo $this->lang->line('Conf_new_passwd'); ?></label>
    </div>

    <input type="hidden" name="email" value="<?php echo $email; ?>">

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4 submit"><?php echo $this->lang->line('Submit'); ?></button>
    <div class="text-center">
                <p><?php echo $this->lang->line('Wo_register'); ?> <a class="col" href="<?php echo site_url("usuarios/register"); ?>"><?php echo $this->lang->line('Title_reg'); ?></a></p>
            </div>
    </form>
</main>