<main class="container">
  <?php if($this->session->flashdata("danger")) { ?>
  <p class="alert alert-danger"><?=  $this->session->flashdata("danger") ?></p>
  <?php } unset($_SESSION['danger']);?>

  <div class="row d-flex justify-content-center align-items-center h-100">
     <div class="card">
        <div class="card-body text-center">
          
          <!--Se nao for o perfil do usuario logado !--> 
          <?php if($usuario['id_usuario'] != $this->session->userdata('id')){ ?>
          <p class="text-muted mb-4">
          <?php $dataNascimento = new DateTime($usuario['datanasci']);
            $idade = $dataNascimento->diff(new DateTime(date('Y-m-d')));

            if($idade->format('%Y') != 00){
              if($idade->format('%Y') > 1) $idade = $idade->format('%Y ').$this->lang->line("Age_years"); 
              else $idade = $idade->format('%Y ').$this->lang->line("Age_year");
            }
            elseif($idade->format('%M') != 00){
              if($idade->format('%M') > 1) $idade = $idade->format('%M ').$this->lang->line("Age_months");
              else $idade = $idade->format('%M ').$this->lang->line("Age_month");
            }
            else{
              if($idade->format('%D') > 1) $idade = $idade->format('%D ').$this->lang->line("Age_days");
              else $idade = $idade->format('%D ').$this->lang->line("Age_day");
            }
            echo $idade; ?>

            <?php 
            if($distance){
            foreach($distance as $d): ?>
              <span class="mx-2">|</span><i class="bi bi-geo-alt-fill"></i>&nbsp;
              <?php $l = (pi() * 6371 * $d) / 180; echo round($l, 1).'km';?>
            <?php endforeach; } ?></p>

          <div class="mb-4 pb-2">
            <?php echo form_open_multipart('usuarios/review/'.$usuario['id_usuario'].'/'.$animal);?>
              <button type="submit" class="<?php if($likes) echo 'btn btn-primary btn-rounded btn-lg'; else echo 'btn btn-primary-0 btn-rounded btn-lg';?>" name='avaliacao' value='TRUE'>
                <i class="bi bi-heart-fill"></i> <?php echo $this->lang->line('Like'); ?>
              </button>
              <button type="submit" class="<?php if($dislikes) echo 'btn btn-primary btn-rounded btn-lg'; else echo 'btn btn-primary-0 btn-rounded btn-lg';?>" name='avaliacao' value='FALSE'>
                <i class="bi bi-x-circle-fill"></i> <?php echo $this->lang->line('Dislike'); ?>
              </button>
            </form>
          </div>
          <hr/>
          <div class="justify-content-between text-center application">
                <div>
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Dwelling_type'); ?></p>
                  <p class="text-muted mb-0">
                    <?php foreach ($moradias as $moradia): 
                        if($moradia['id_moradia'] == $usuario['id_moradia']) echo $moradia[$lang];
                    endforeach; ?>
                  </p>
                </div>
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Secure_access'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['acessoprotegido'] === TRUE)
                      echo $this->lang->line('Yes');
                    else
                      echo $this->lang->line('No'); ?>
                  </p>
                </div>
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('People'); ?></p>
                  <p class="text-muted mb-0">
                    <?php echo $usuario['qtdmoradores']; ?>
                  </p>
                </div>
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Children_edit'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['criancas'] === TRUE)
                      echo $this->lang->line('Yes');
                    else
                      echo $this->lang->line('No'); ?>
                  </p>
                </div>
                <div>
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Ill'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['alergia'] === TRUE)
                        echo $this->lang->line('Yes');
                      else
                        echo $this->lang->line('No'); ?>
                  </p>
                </div>
              </div>

              <div class="justify-content-between text-center application">
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Hours_alone'); ?></p>
                  <p class="text-muted mb-0">
                    <?php foreach ($horas as $hora): 
                      if($hora['id_horassozinho'] == $usuario['id_horassozinho'])
                        echo $hora[$lang];
                    endforeach; ?>
                  </p>
                </div>
                <div class="px-3">
                <p class="mb-2 h5 application title"><?php echo $this->lang->line('Expenses_edit'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['gastos'] === TRUE)
                        echo $this->lang->line('Yes');
                      else
                        echo $this->lang->line('No'); ?>
                  </p>
                </div>
                <div>
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Other_edit'); ?></p>
                  <p class="text-muted mb-0">
                    <?php foreach ($outros as $outro): 
                      if($outro['id_outrosanimais'] == $usuario['id_outrosanimais'])
                        echo $outro[$lang]; 
                      endforeach; ?></p>
                </div>
              </div>

          <?php } else {?>

            <!--Se for o perfil do usuario logado !--> 
            <?php echo validation_errors(); ?> 
            <?php echo form_open('usuarios/edit/'.$this->session->userdata('id')); ?>

            <p><?php if($usuario['localizacao']){
            $l = explode('(', $usuario['localizacao']); 
            $lat = explode(',', $l[1]);
            $long = explode(')', $lat[1]); ?>
            
            <div class="mapa">
              <div id="mapid"></div>
            </div>
            <?php }?>

            <p class="text-muted mb-4 view"><?php $dataNascimento = new DateTime($usuario['datanasci']);
            echo $dataNascimento->format('d/m/Y');?></p>
            <p class="view"><span class="mx-2 barra">|</span>
            <a onclick="confirm();" class='icones'><i class="bi bi-trash-fill"></i> <?php echo $this->lang->line('Delete_account'); ?></a></p>
            <p class="view"><?php if($usuario['localizacao'] == NULL){ ?>
            <span class="mx-2 barra">|</span>
            <a class='icones' onclick="getLocation();"><i class="bi bi-geo-alt-fill"></i> <?php echo $this->lang->line('Add_Location'); ?></a>
            <?php } else {?>
            <span class="mx-2 barra">|</span>
            <a class='icones' onclick="getLocation();"><i class="bi bi-geo-alt-fill"></i> <?php echo $this->lang->line('Change_Location'); ?></a>
            <?php } ?>
            <button class="btn-hidden" id="submit"></button>
            </p>

            <div class="justify-content-between text-center mb-2 application">
              <div>
                <p class="mb-0">
                  <div class="form-floating mb-4 application">
                      <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $usuario['nome'];?>">
                      <label for="nome"><?php echo $this->lang->line('Name'); ?></label>
                  </div>
                </p>
              </div>
              <div>
                <p class="mb-0">
                  <div class="form-floating mb-4 application">
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $usuario['email']; ?>">
                    <label for="email"><?php echo $this->lang->line('Email'); ?></label>
                  </div>
                </p>
              </div>
              <div>
                <p class="mb-0">
                  <div class="form-floating mb-4 application">
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="********" minlength="6">
                    <label for="senha"><?php echo $this->lang->line('New_password'); ?></label>
                  </div>
                </p>
              </div>
              <div>
                <p class="mb-0">
                  <div class="form-floating mb-4 select application">
                    <select name="genero" id="genero" class="form-select" placeholder="<?php echo $this->lang->line('Gender'); ?>">
                      <?php foreach ($generos as $genero): 
                      if($genero['id_genero'] == $usuario['id_genero']){ ?>
                        <option value="<?php echo $genero['id_genero']; ?>" selected><?php echo $genero[$lang]; ?></option>
                      <?php } else {?>
                          <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero[$lang]; ?></option>
                      <?php } endforeach; ?>
                    </select>
                    <label for="horas"><?php echo $this->lang->line('Gender'); ?></label>
                  </div>
                </p>
              </div>
            </div>  
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">      
            <input type="submit" id="submit" class="btn btn-primary btn-block mb-4 submit" name="submit" value="<?php echo $this->lang->line('Submit'); ?>">
          </form>
            
            <?php if($usuario['qtdmoradores'] != null) { ?>
              <hr/>
              <div class="justify-content-between text-center application">
                <div>
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Dwelling_type'); ?></p>
                  <p class="text-muted mb-0">
                    <?php foreach ($moradias as $moradia): 
                        if($moradia['id_moradia'] == $usuario['id_moradia']) echo $moradia[$lang];
                    endforeach; ?>
                  </p>
                </div>
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Secure_access'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['acessoprotegido'] === TRUE)
                      echo $this->lang->line('Yes');
                    else
                      echo $this->lang->line('No'); ?>
                  </p>
                </div>
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('People'); ?></p>
                  <p class="text-muted mb-0">
                    <?php echo $usuario['qtdmoradores']; ?>
                  </p>
                </div>
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Children_edit'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['criancas'] === TRUE)
                      echo $this->lang->line('Yes');
                    else
                      echo $this->lang->line('No'); ?>
                  </p>
                </div>
                <div>
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Ill'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['alergia'] === TRUE)
                        echo $this->lang->line('Yes');
                      else
                        echo $this->lang->line('No'); ?>
                  </p>
                </div>
              </div>

              <div class="justify-content-between text-center application">
                <div class="px-3">
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Hours_alone'); ?></p>
                  <p class="text-muted mb-0">
                    <?php foreach ($horas as $hora): 
                      if($hora['id_horassozinho'] == $usuario['id_horassozinho'])
                        echo $hora[$lang];
                    endforeach; ?>
                  </p>
                </div>
                <div class="px-3">
                <p class="mb-2 h5 application title"><?php echo $this->lang->line('Expenses_edit'); ?>?</p>
                  <p class="text-muted mb-0">
                    <?php if($usuario['gastos'] === TRUE)
                        echo $this->lang->line('Yes');
                      else
                        echo $this->lang->line('No'); ?>
                  </p>
                </div>
                <div>
                  <p class="mb-2 h5 application title"><?php echo $this->lang->line('Other_edit'); ?></p>
                  <p class="text-muted mb-0">
                    <?php foreach ($outros as $outro): 
                      if($outro['id_outrosanimais'] == $usuario['id_outrosanimais'])
                        echo $outro[$lang]; 
                      endforeach; ?></p>
                </div>
              </div>
              <a class="icones" href="<?php echo site_url('usuarios/application'); ?>">EDITAR <i class="bi bi-pencil-fill"></i></a>
              <hr/>
            <?php } ?>
          <?php } ?>
        </div>
    </div>
  </div>
</main>
<script>
  <?php if($usuario['id_usuario'] == $this->session->userdata('id')){ ?>
  window.onload =  function(){
    bootbox.prompt({ 
      size: "small",
      title: "<?php echo $this->lang->line('Type_passwd'); ?>",
      inputType: 'password',
      callback: function(result){ 
        $.ajax({
        url:"<?php echo site_url('usuarios/confirm_password'); ?>",
        method:"POST",
        data: {action: result},
        success: senha_errada
        }) 
      }
    });
  }

  function senha_errada(data){
    if(data != true){
      window.location = '<?php echo site_url('animais'); ?>'
    }
  }
  <?php } ?>

  function getLocation(){
    if (navigator.geolocation){
      navigator.geolocation.getCurrentPosition(position,showError);
    }
    else{x.innerHTML="Seu browser não suporta Geolocalização.";}
    }

    function position(position){        
    var latitude = document.getElementById("latitude");
    var longitude = document.getElementById("longitude");

    latitude = latitude.value = position.coords.latitude;
    longitude = longitude.value = position.coords.longitude;

    document.getElementById('submit').click();
  }

  function confirm(){
    bootbox.confirm({ 
      size: "small",
      message: "<?php echo $this->lang->line('Confirm_delete_account'); ?>",
      callback: function(result){
        if(result == true){
          window.location = '<?php echo site_url('usuarios/delete/'.$this->session->userdata('id')); ?>'
        }
      }
    })
  }

  mapa();

function mapa(){
  <?php if($usuario['localizacao'] && $usuario['id_usuario'] == $this->session->userdata('id')){ ?>
    var mymap = L.map('mapid').setView([<?php echo $lat[0]; ?>, <?php echo $long[0]; ?>], 13);

    var patinha = L.icon({
    iconUrl: '<?php  echo base_url('assets/img/patinha.png');?>',
    iconSize:     [20, 20], 
    iconAnchor:   [10, 10], 
    });

    var marker = L.marker([<?php echo $lat[0]; ?>, <?php echo $long[0]; ?>],{icon: patinha}).addTo(mymap);

    var popup = L.popup()
    .setLatLng([<?php echo $lat[0]; ?>, <?php echo $long[0]; ?>])
    .setContent('<p class="pop-up-map"><?php echo $this->lang->line("U_here"); ?></p>')
    .openOn(mymap);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1
    }).addTo(mymap);
  <?php } ?>
}
</script>
