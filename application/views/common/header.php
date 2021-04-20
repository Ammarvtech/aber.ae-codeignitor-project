
 <body id="page-top" class="<?php echo ($this->session->userdata('site_lang')=='arabic') ? 'arabic_set' : ''; ?>" >
     

 <div class="static_banner_outer">  

    <div class="header_top_bar">
          <div class="container">
              <div class="register_bar">
                 <?php if($this->session->userdata("user_id")>0){?>
                 <a href="#" class="login_btn"><span onclick="window.location='<?php echo base_url()?>User/myAccount'"><?php echo $this->lang->line('menu_account'); ?></span>/<span onclick="window.location='<?php echo base_url()?>User/logout'"><?php echo $this->lang->line('menu_logout'); ?></span></a>
                  <?php }else{?>
                    <a href="#" class="login_btn"><span data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('menu_login'); ?> </span>/<span data-toggle="modal" data-target="#myModal2"><?php echo $this->lang->line('menu_signup');?></span></a>
                     
                    <?php }?>
                <?php if($this->session->userdata('site_lang')=='english'){?>
                  <a href="<?php echo base_url()?>languageswitcher/switchLang/arabic" class="arabic_lang"><img src="<?php echo base_url() ?>assets/home/images/arbi.png" alt=""></a>
                <?php }else{?>
                  <a href="<?php echo base_url()?>languageswitcher/switchLang/english" class="arabic_lang">English</a>
                <?php }?>
              </div>
          </div>
      </div>

       
       <header class="header_outer">
          
         <!--navigation-->
         <div class="nav-main">
            <div class="container">
               <div class="rows">
                  <nav class="navbar navbar-default" role="navigation">
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand logo" href="<?php echo base_url()?>">
                        <img src="<?php echo base_url() ?>assets/home/images/logo.png" alt="Logo">
                        </a>
                     </div>
                     
                     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"  data-aos="fade-left" data-aos-duration="1200">
                        <ul class="nav navbar-nav navbar-right nav-links custom_nav">
                          <li><a href="<?php echo base_url()?>Booking"><?php echo $this->lang->line('menu_book_a_session'); ?></a></li>
                          <li><a href="<?php echo base_url()?>About"><?php echo $this->lang->line('menu_about'); ?></a></li>
                          <li><a href="<?php echo base_url()?>Franchize"><?php echo $this->lang->line('menu_franchize');  ?></a></li>
                          <li><a href="<?php echo base_url()?>Media"><?php echo $this->lang->line('menu_media'); ?></a></li>
                          <li><a href="<?php echo base_url()?>Junk"><?php echo $this->lang->line('menu_we_take_your_junk'); ?></a></li>
                          <li><a href="<?php echo base_url()?>Products"><?php echo $this->lang->line('menu_merchandise'); ?></a></li>
                          <li><a href="<?php echo base_url()?>Contactus"><?php echo $this->lang->line('menu_contact_us'); ?></a></li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
         <!--navigation-->
      </header>
      