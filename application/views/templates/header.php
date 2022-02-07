<!DOCTYPE html>
        <html>
                <head>
                        <meta charset='UTF-8'>
                        <title><?php echo $title; ?> | PETINDER</title>
                        <link rel="stylesheet" href="<?php echo base_url('assets/css/stylesheet.css');?>">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet"/>
                        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
                        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

                        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js" integrity="sha512-K3MtzSFJk6kgiFxCXXQKH6BbyBrTkTDf7E6kFh3xBZ2QNMtb6cU/RstENgQkdSLkAZeH/zAtzkxJOTTd8BqpHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                        <script src="<?php  echo base_url('assets/js/script.js');?>"></script>
                        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>                       

                        <!-- API mapa -->
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
                        

                </head>
                <body>
                        <header>    
                        <?php 
                                $doador = $this->session->userdata("doador"); 
                                $logged = $this->session->userdata("logged"); 
                                $usuario = $this->session->userdata("usuario");
                                $usuario = explode(" ", $usuario);
                                $id = $this->session->userdata("id");  
                                $localizacao = $this->session->userdata('localizacao');       
                        ?>
                                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                        <div class="container-fluid">
                                                <a class="navbar-brand" href="<?php echo site_url("animais"); ?>">
                                                        <img class="img-responsive" alt="PETINDER" src="<?php echo base_url('assets/img/logo.jpeg');?>">
                                                </a>
                                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                                        <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
                                                </button>
                                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                                        <ul class="navbar-nav">
                                                                <li class="nav-item">
                                                                        <a class="nav-link active" aria-current="page" href="<?php echo site_url('animais'); ?>"><?php echo $this->lang->line('Home'); ?></a>
                                                                </li>

                                                                <ul class='navbar-nav'>
                                                                        <li class='nav-item dropdown'>
                                                                                <a class='nav-link dropdown-toggle menu' id='navbarDropdownMenuLink' role='button' 
                                                                                data-bs-toggle='dropdown' aria-expanded='false'><?php echo $this->lang->line('Adopt'); ?></a>
                                                                                <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                                                                        <li><a class='dropdown-item' href='<?php echo site_url('howtoadopt'); ?>'><?php echo $this->lang->line('How_to'); ?></a></li>
                                                                                        <li><a class='dropdown-item' href='<?php echo site_url('match'); ?>'><?php echo $this->lang->line('Match_happened'); ?></a></li>
                                                                                </ul>
                                                                        </li>
                                                                </ul>
                                                
                                                                <li class="nav-item">
                                                                        <a class="nav-link" href='<?php if(!$logged){ echo site_url('usuarios/login');
                                                                                } elseif(!$localizacao){ 
                                                                                        echo site_url('usuarios/'.$id); 
                                                                                }
                                                                                else echo site_url('animais/register'); ?>'>
                                                                                <?php echo $this->lang->line('Rehome'); ?></a>
                                                                </li>                                                                

                                                                <li class="nav-item">
                                                                        <a class="nav-link" href="<?php if($logged) echo site_url('usuarios/match'); else echo site_url('usuarios/login'); ?>"><?php echo $this->lang->line('PftMatch'); ?></a>
                                                                </li>
                                                        </ul>
                                                </div>
                                                        <ul class='navbar-nav'>
                                                                <li class='nav-item dropdown'>
                                                                <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' role='button' 
                                                                data-bs-toggle='dropdown' aria-expanded='false'>

                                                                <?php if($this->session->get_userdata('site_lang')) $lang = $this->session->get_userdata('site_lang');
                                                                $lang = $lang['site_lang'];

                                                                if($lang == 'portuguese'){ ?>
                                                                        <i class='flag flag-brazil'></i></a>
                                                                <?php }
                                                                else { ?>
                                                                        <i class='flag flag-us'></i></a>
                                                                <?php } ?>
                                                                
                                                                <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                                                        <?php 
                                                                        if($lang == 'portuguese'){ ?>
                                                                                <li><a class='dropdown-item' href='<?php echo site_url('languageSwitcher/switchLang/english'); ?>'><i class="flag flag-us"></i></a>
                                                                        <?php }
                                                                        else { ?>
                                                                                <li><a class='dropdown-item' href='<?php echo site_url('languageSwitcher/switchLang/portuguese'); ?>'><i class="flag flag-brazil"></i></a>
                                                                        <?php } ?>
                                                                </ul>
                                                                </li>
                                                        </ul>

                                                        <?php
                                                        if(!$logged) {
                                                                echo "<a class='btn-login' href='".site_url('usuarios/login')."'>".$this->lang->line("Login")."</a>&nbsp;"; 
                                                                echo "<a class='btn-login' href='".site_url('usuarios/register')."'>".$this->lang->line("Title_reg")."</a>";
                                                        }
                                                        else{ ?>
                                                                &nbsp;<a href="<?php echo site_url('usuarios/solicitacoes'); ?>"><i class="bi bi-bell-fill icones" id="notifications"></i></a>&nbsp;&nbsp;

                                                        <ul class='navbar-nav'>
                                                                <li class='nav-item dropdown'>
                                                                        <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' role='button' 
                                                                        data-bs-toggle='dropdown' aria-expanded='false' onclick="load_messages();"><i class="bi bi-chat-dots-fill" id="msg-not"></i></a>
                                                                        <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink' id="message_area">
                                                                                <li>
                                                                                        <div class="dropdown-item" ></div>                                                                                
                                                                                </li>
                                                                        </ul>
                                                                </li>
                                                        </ul>

                                                        <?php echo 
                                                                "<ul class='navbar-nav'>
                                                                        <li class='nav-item dropdown'>
                                                                                <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' role='button' 
                                                                                data-bs-toggle='dropdown' aria-expanded='false'>".$this->lang->line('Hello').$usuario[0]." &nbsp;<i class='bi bi-person-circle'></i></a>
                                                                                <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                                                                        <li><a class='dropdown-item' href='".site_url('usuarios/'.$id)."'>".$this->lang->line("Profile")."</a></li>
                                                                                        <li><a class='dropdown-item' href='".site_url('usuarios/my_animals')."'>".$this->lang->line("My_animals")."</a></li>                                                                                       
                                                                                        <li><a class='dropdown-item' href='".site_url('usuarios/mi-au-doreis')."'>".$this->lang->line("Interactions")."</a></li>  
                                                                                        <li><a class='dropdown-item' href='".site_url('usuarios/logout')."'>".$this->lang->line("Logout")."&nbsp;<i class='bi bi-box-arrow-in-right'></i></a></li>                                                                        
                                                                                </ul>
                                                                        </li>
                                                                </ul>";
                                                        } ?>
                                        </div>
                                </nav>                    
                        </header>
                        <h1 class="page-title"><?php echo $title; ?></h1>