<main class="container">
  <?php if($this->session->userdata('site_lang') == 'portuguese') $lang = 'pt_br'; else $lang = 'en_us'; ?>
    <div class="card-body">
        <?php if(!$this->session->flashdata('danger')){ ?>
          <p class="red pointer" onclick="report();"><i class="bi bi-flag-fill"></i> <?php echo $this->lang->line('Report'); ?></p>
          <div class="chat" id="chat_area"></div>
        <?php echo validation_errors(); ?>
        <?php echo form_open('mensagens/addMessage'); ?>
        <p></p>

        <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
            <textarea class="form-control form-control-lg" name="mensagem" rows="1" placeholder="<?php echo $this->lang->line('Type_message'); ?>" required></textarea>
            <?php if($usuario){ ?>
              <input type="hidden" name="usuario" value="<?php echo $usuario['id_usuario']; ?>">
            <?php } else {?>
              <input type="hidden" name="usuario" value="<?php echo $animal['id_doador']; ?>">
            <?php } ?>

            <input type="hidden" name="animal" value="<?php echo $animal['id_animal']; ?>">
            <button type="submit" class="ms-3 btn btn-info btn-rounded float-end">Ok</button>        
            <img onclick="confirm_adoption();" class="patinha pointer adopted" src="<?php echo base_url('assets/img/patinha.png'); ?>" alt="">      

        </div>
      </div>

        <?php } else{ ?>
          <p class="text-lg-center text-muted">:(</p>
          <p class="text-lg-center text-muted"><?php echo $this->lang->line('Animal_deleted')?><a href="<?php echo site_url('animais'); ?>"><?php echo $this->lang->line('Here'); ?></a></p>
          <?php unset($_SESSION['danger']); } ?>
</main>
<script>
  window.onload = function(){<?php if(!$mensagens || !$remetente){ 
      if($animal['id_doador'] == $this->session->userdata('id')){ ?>
        bootbox.alert("<p class='text-center'><?php echo $this->lang->line('Ca_begin_donor').' '.
        $animal['nome'].' '.$this->lang->line('And').' '.$usuario['nome'].$this->lang->line('Ca_middle_donor'); ?>
        <img class='patinha adopted' src='<?php echo base_url('assets/img/patinha.png'); ?>' alt=''><br>"+
        "<span class='font-weight-bold'><?php echo $this->lang->line('Ca_end_donor');?></span></p>");
    <?php } else{ ?>
        bootbox.alert("<p class='text-center'><?php echo $this->lang->line('Ca_begin_adopter').' '.
        $animal['nome'].$this->lang->line('Ca_middle_adopter').' '; 
        if($usuario['id_genero'] == 1) echo $this->lang->line('Donor_male').' '; else echo $this->lang->line('Donor_female').' ';
        if($animal['id_genero'] == 1) echo $this->lang->line('His').' '; else echo $this->lang->line('Her').' ';
        echo $this->lang->line('Ca_end_adopter');?>
        <img class='patinha adopted' src='<?php echo base_url('assets/img/patinha.png'); ?>' alt=''><br>"+
        "<span class='font-weight-bold'><?php echo $this->lang->line('Ca_end_donor');?></span></p>");
    <?php }} ?> 
  }

  load_chat_data();

  function load_chat_data(){
    $.ajax({
      url:"<?php echo site_url('mensagens/'.$animal['id_animal'].'/'.$usuario['id_usuario']); ?>",
      method:"POST",
      data: {action: 'true'},
      dataType: 'json',
      success:function(data){
        var output = '';
        if(data.length > 0)
        {
          for(var count = 0; count < data.length; count++)
          {
            if(data[count].direcao == 'esquerda')
              output += '<div class="d-flex flex-row justify-content-start">'+
            '<div><p class="small p-2 ms-3 mb-1 rounded-3 msg-text-light">'+data[count].conteudo+'</p>'+
             '</div></div>';

            else
              output += '<div class="d-flex flex-row justify-content-end mb-4 pt-1">'+
              '<div><p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">'+data[count].conteudo+'</p>'+
              '</div></div>';
          }
        } 
        $('#chat_area').html(output);
      }
    }) 
  }

  setInterval(function(){
    load_chat_data();
  }, 1000);

  function report(){
    bootbox.dialog({ 
    title: '<?php echo $this->lang->line('Report'); ?>',
    message: '<p><?php echo $this->lang->line('Report_reason'); ?></p>',
    size: 'small',
    buttons: {
        fee: {
            label: '<p class="denuncia text-center" ><?php echo $motivos[0][$lang]; ?></p>',
            className: 'btn-primary btn-denuncia',
            callback: function(){
              denuncia = <?php echo $motivos[0]['id_motivo']; ?>;
              call_report(denuncia);
            }
        },
        fi: {
            label: '<p class="denuncia text-center"><?php echo $motivos[1][$lang]; ?></p>',
            className: 'btn-primary btn-denuncia',
            callback: function(){
              denuncia = <?php echo $motivos[1]['id_motivo']; ?>;
              call_report(denuncia);
            }
        },
        fo: {
            label: '<p class="denuncia text-center"><?php echo $motivos[2][$lang]; ?></p>',
            className: 'btn-primary btn-denuncia',
            callback: function(){
              denuncia = <?php echo $motivos[2]['id_motivo']; ?>;
              call_report(denuncia);            
            }
        },
        fum: {
            label: '<p class="denuncia text-center"><?php echo $motivos[3][$lang]; ?></p>',
            className: 'btn-primary btn-denuncia',
            callback: function(){
              denuncia = <?php echo $motivos[3]['id_motivo']; ?>;
              call_report(denuncia);          
            }
        },
        fa: {
            label: '<p class="denuncia text-center"><?php echo $motivos[4][$lang]; ?></p>',
            className: 'btn-primary btn-denuncia',
            callback: function(){
              denuncia = <?php echo $motivos[4]['id_motivo']; ?>;
              call_report(denuncia);          
            }
        },
        fim: {
            label: '<p class="denuncia text-center"><?php echo $motivos[5][$lang]; ?></p>',
            className: 'btn-primary btn-denuncia',
            callback: function(){
              denuncia = <?php echo $motivos[5]['id_motivo']; ?>;
              call_report(denuncia);          
            }
        }
      }
    })
  }

  function call_report(denuncia){
    window.location = '<?php echo site_url('');?>'+'/usuarios/denuncia/'+<?php echo $this->session->userdata('id'); ?>+'/'+<?php echo $usuario['id_usuario'] ?>+'/'+denuncia+'/'+<?php echo $animal['id_animal'] ?>;
  }

  function confirm_adoption(){
    bootbox.dialog({ 
    title: '<?php echo $this->lang->line('Adopted'); ?>',
    message: '<p><?php echo $this->lang->line('Adopted_reason'); ?></p>',
    size: 'small',
    buttons: {
        fee: {
            label: '<?php echo $this->lang->line('Yes') ?>',
            className: 'btn-primary',
            callback: function(){
              <?php if($animal['id_doador'] == $this->session->userdata('id')){ ?>
                window.location = '<?php echo site_url('animais/adopted/'.$animal['id_animal'].'/'.$usuario['id_usuario'].'/'.'TRUE'); ?>';
              <?php } else{ ?>
                window.location = '<?php echo site_url('animais/adopted/'.$animal['id_animal'].'/'.$this->session->userdata('id').'/'.'TRUE'); ?>';                
              <?php } ?>
            }
        },
        fi: {
            label: '<?php echo $this->lang->line('No') ?>',
            className: 'btn-primary',
            callback: function(){
              <?php if($animal['id_doador'] == $this->session->userdata('id')){ ?>
                window.location = '<?php echo site_url('animais/adopted/'.$animal['id_animal'].'/'.$usuario['id_usuario'].'/'.'FALSE'); ?>';
              <?php } else{ ?>
                window.location = '<?php echo site_url('animais/adopted/'.$animal['id_animal'].'/'.$this->session->userdata('id').'/'.'FALSE'); ?>';                
              <?php } ?>              }
        }
      }
    })
  }
</script>
