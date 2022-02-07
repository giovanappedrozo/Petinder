<main class="container">
    <?php echo validation_errors(); ?>

    <?php if($this->session->flashdata("danger")) { ?>
        <p class="alert alert-danger"><?=  $this->session->flashdata("danger") ?></p>
        <?php } unset($_SESSION['danger']);

        if($this->session->flashdata("success")) { ?>
        <p class="alert alert-success"><?=  $this->session->flashdata("success") ?></p>
        <?php } unset($_SESSION['success']);?>

    <?php echo form_open('usuarios/login'); ?>

    <div class="form-floating mb-4">
    <input type="email" id="email" class="form-control" required name="email" placeholder="email@exemplo.com"/>
    <label for="email"><?php echo $this->lang->line('Email'); ?></label>
  </div>

    <!-- Password input -->
    <div class="form-floating mb-4">
        <input type="password" id="senha" class="form-control" required name="senha" placeholder="********"/>
        <label for="senha"><?php echo $this->lang->line('Password'); ?></label>
    </div>


        <!-- Simple link -->
        <a class="col pointer" onclick="recover_passwd();"><?php echo $this->lang->line('FgPasswd'); ?></a>
 
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4 submit"><?php echo $this->lang->line('Login'); ?></button>

            <div class="text-center">
                <p><?php echo $this->lang->line('Wo_register'); ?> <a class="col" href="<?php echo site_url("usuarios/register"); ?>"><?php echo $this->lang->line('Title_reg'); ?></a></p>
            </div>
    </form>
</main>
<script>
    function recover_passwd(){
        bootbox.prompt({ 
        size: "small",
        title: "<?php echo $this->lang->line('Type_email'); ?>",
        inputType: 'email',
        callback: function(result){ 
            $.ajax({
            url:"<?php echo site_url('usuarios/recover_password'); ?>",
            method:"POST",
            data: {action: result},
            success: function(){
                    location.reload();
            }
            });
        }
        });
    }
</script>