

    <div class="overlay">

        <div class="overlayDoor"></div>

        <div class="overlayContent">

            <div class="loader">

                <div class="inner"></div>

            </div>

            <div class="skip">

                <img src="<?=base_url();?>assets/aber-assets/images/logo.png" alt="">

            </div>

        </div>

    </div>



    <div class="outer_main">



        <div class="container-fluid padd_0">



            <div class="row margin_0">

                <div class="bg_img_s">

                    

                    <?=$this->load->view('common/navbar.php');?>

                    









                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000" data-pause="false">



                        <div class="carousel-inner">

                            <!--<div class="carousel-item active">-->

                            <!--    <img class="d-block w-100" src="<?=base_url();?>assets/aber-assets/images/slide_img_1.jpg" alt="First slide">-->



                            <!--    <div class="heading animated_2 animatable fadeInDown">-->

                            <!--        <h1>Live your Life</h1>-->

                            <!--        <button class="btn_more_about_us">MORE ABOUT US</button>-->



                            <!--    </div>-->

                            <!--</div>-->

                          <?php 

                          $count  = 1;

                          foreach ($slider->result() as  $value) { 

                            if($count == 1){ 

                                echo '<div class="carousel-item active">';

                            }else{

                                echo '<div class="carousel-item">';

                            }

                            ?>



                                <img class="d-block w-100" src="<?=base_url();?>uploads/data/<?=$value->picture?>" alt="Second slide">



                                <div class="heading animated_2 animatable moveUp">

                                    <h1><?=$value->tittle?></h1>

                                    <a href="<?=$value->link?>">

                                    <button class="btn_more_about_us"><?=$value->button_text?></button>

                                    </a>



                                </div>

                            </div>

                        <?php $count++; } ?>          

                   

                        </div>





                    </div>



                </div>



            </div>



            <div class="middle_content">

                <div class="header_container">





                    <div class="division_heading animatable fadeInDown">

                        <img src="<?=base_url();?>assets/aber-assets/images/ag.svg" alt="">

                        <h2><?=$this->Preferences_model->getValue('text_below_slider');?></h2>

                    </div>



                    <?=$this->Preferences_model->getValue('textBoxOne');?>





                </div>

            </div>



            <div class="steps_bg">



                <div class="steps_bg_inner">



                    <div class="row margin_0">

                        <div id="investment" class="col-lg-4 pl-md-4 pr-md-0">

                            <div class="div_info animatable fadeInDown">

                                <div class="selected_div">

                                    <a href="<?=base_url()?>property/investment" style="text-decoration: none;">

                                    <h2>Investment</h2>

                                    </a>



                                    <img src="<?=base_url();?>assets/aber-assets/images/arrow.png" alt="" class="div_info_img_2">

                                </div>

                                <img src="<?=base_url();?>uploads/data/<?=$this->Preferences_model->getValue('investment_picture');?>" alt="" class="div_info_img_1">



                               

                            </div>

                                <?=$this->Preferences_model->getValue('i_text');?>

                        </div>



                        <div id="property" class="col-lg-4 pl-md-4 pr-md-4">

                            <div class="div_info animatable moveUp">

                                <div class="selected_div">

                                    <a href="<?=base_url()?>property/property" style="text-decoration: none;">



                                    <h2>Property</h2>

                                </a>

                                    <img src="<?=base_url();?>assets/aber-assets/images/arrow.png" alt="" class="div_info_img_2">

                                </div>

                                <img src="<?=base_url();?>uploads/data/<?=$this->Preferences_model->getValue('property_picture');?>" alt="" class="div_info_img_1">



                            

                            </div>

                                <?=$this->Preferences_model->getValue('p_text');?>

                          

                        </div>



                        <div id="lifestyle" class="col-lg-4 pr-md-4 pl-md-0">

                            <div class="div_info animatable fadeInDown">

                                <div class="selected_div">

                                    <a href="<?=base_url()?>property/lifestyle" style="text-decoration: none;">

                                    <h2>Lifestyle</h2>

                                </a>



                                    <img src="<?=base_url();?>assets/aber-assets/images/arrow.png" alt="" class="div_info_img_2">

                                </div>



                                <img src="<?=base_url();?>uploads/data/<?=$this->Preferences_model->getValue('lifestyle_picture');?>" alt="" class="div_info_img_1">

                            </div>

                                <?=$this->Preferences_model->getValue('l_text');?>

                           

                        </div>
                      
                        <a href="<?=base_url();?>about" class="btn_more_about_us_2 btn_more_about_us_black_2 animatable fadeInUp" style="text-decoration: none;color: white;">

                                MORE ABOUT US

                            

                        </a>

                    </div>



                </div>





            </div>



           