        <?php 
        $page_id = null;
        $comp_model = new SharedController;
        ?>
        <div  class=" py-5 fondo-Login">
            <div class="container">
                <div class="row ">
                    <div class="col-md-10 bg-primary login-card-holder comp-grid">
                        <div  class="">
                            <div class="container">
                                <div class="row ">
                                    <div class="col-sm-8 svg comp-grid">
                                    </div>
                                    <div class="col-sm-4 bg-white comp-grid">
                                        <h4 class="mt-4 mb-3 bold px-3">Bienvenidos</h4>
                                        <h6 class="mt-4 mb-3 bold px-3">Ingrese usuario y contraseña para iniciar sesion</h6>
                                        <?php $this :: display_page_errors(); ?>
                                        
                                        <div  class=" p-3 hide-line animated fadeIn page-content">
                                            <div>
                                                <h4><i class="fa fa-key"></i> Inicio de sesión de usuario</h4>
                                                <hr />
                                                <?php 
                                                $this :: display_page_errors(); 
                                                ?>
                                                <form name="loginForm" action="<?php print_link('index/login/?csrf_token=' . Csrf::$token); ?>" class="needs-validation form page-form" method="post">
                                                    <div class="input-group form-group">
                                                        <input placeholder="Nombre de usuario o correo electrónico" name="username"  required="required" class="form-control" type="text"  />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="form-control-feedback fa fa-user"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="input-group form-group">
                                                        <input  placeholder="Contraseña" required="required" v-model="user.password" name="password" class="form-control " type="password" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="form-control-feedback fa fa-key"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix mt-3 mb-3">
                                                        <div class="col-6">
                                                            <label class="">
                                                                <input value="true" type="checkbox" name="rememberme" />
                                                                Recuérdame
                                                            </label>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="<?php print_link('passwordmanager') ?>" class="text-danger"> Restablecer la contraseña</a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button class="btn btn-primary btn-block btn-md" type="submit"> 
                                                            <i class="load-indicator">
                                                                <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                                                            </i>
                                                            Iniciar sesión <i class="fa fa-key"></i>
                                                        </button>
                                                    </div>
                                                    <hr />
                                                    <div class="text-center">
                                                        ¿No tienes una cuenta? <a href="<?php print_link("index/register") ?>" class="btn btn-success">Registro
                                                        <i class="fa fa-user"></i></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 comp-grid">
                        <h4 ></h4>
                        <div class="">
                            <style>
                                .login-card-holder{
                                border-radius:10px;
                                box-shadow:0 0 30px rgba(0,0,0,0.3);
                                overflow:hidden;
                                margin-top:70px;
                                }
                                button.btn{
                                border-radius:30px;
                                box-shadow:0 0 30px rgba(0,0,0,0.3);
                                }
                                .hide-line hr {
                                display:none;
                                }
                                .hide-line h4{
                                display:none;
                                }
                                .input-group-append{
                                display:none;
                                }
                                .form-control{
                                padding:10px;
                                border-width:0 0 1px 0;
                                font-size:17px;
                                }
                                .fondo-Login{
                                    background:url('<?php echo SITE_ADDR."assets/images/fondo.png"?>');
                                    background-size:cover;
                                }
                            </style>
                            <!-- .js script, function is to disfigur PHPRad default login button. so that we can style proper -->
                            <script>
                                $("button.btn").removeClass("btn-block btn-md")
                            </script></div>
                        </div>
                    </div>
                </div>
            </div>
            