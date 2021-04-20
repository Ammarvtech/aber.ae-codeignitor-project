

    <div class="outer_main">



        <div class="container-fluid padd_0">



            <div class="row margin_0">

                <div class="bg_img_s">

                    <?=$this->load->view('common/navbar.php');?>

                    

                </div>



            </div>

            

            <div class="inner_page_banner">

                <div class="banner_inner_figure">

                    <img src="<?=base_url();?>assets/aber-assets/images/about_banner.png" alt="">

                </div>

                <div class="inner_banner_overay">

                    <h2><?=$row[0]->page_title?></h2>

                </div>

            </div>

            

            

            <div class="about_section_content_main">

            <div class="about_section_main">

                

                <div class="sbout_top_section">

                    <div class="row margin_0">

                        <div class="col-md-6 padd_0">

                            <div class="about_sec_top_col_lft">

                                <img src="<?=base_url();?>uploads/data/<?=$row[0]->image1?>" alt="">

                            </div>

                        </div>

                        <div class="col-md-6 padd_0">

                            <div class="about_sec_top_col_rgt">

                                <?=$row[0]->description1?>

                            </div>

                        </div>

                    </div>

                </div>

                

                <div class="sbout_top_section">

                    <div class="row margin_0 d_i_b">

                        

                        <div class="col-md-6 padd_0 move_right">

                            <div class="about_sec_top_col_lft">

                               

                                <img src="<?=base_url();?>uploads/data/<?=$row[0]->image2?>" alt="">



                            </div>

                        </div>

                        

                        <div class="col-md-6 padd_0">

                            <div class="about_sec_top_col_rgt">

                                <?=$row[0]->description2?>

                               

                            </div>

                        </div>

                        

                    </div>

                </div>

                

            </div>

            

            <div class="section_our_team">

                <div class="header_container">

                    <h3>Our Team</h3>

                    

                    <div class="our_team_slider">

                        <div id="demo">

                            <div id="team_carousel" class="owl-carousel">

                                <?php

                                foreach ($team as  $value) {

                                    

                                echo '

                                <div class="item">

                                    <div class="team_member_col">

                                        <div class="team_fig">

                                            <img src="'.base_url().'uploads/data/'.$value->member_image.'" alt="">

                                            <div class="figure_overlay">

                                                <p>'.$value->member_description.'</p>

                                                <div class="social_icons">

                                                    <a href="'.$value->linkedin_url.'" target="_blank"><i class="fab fa-linkedin"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="team_member_titles">

                                            <h5>'.$value->member_name.'</h5>

                                            <p>'.$value->member_designation.'</p>

                                        </div>

                                    </div>

                                </div>

                                ';

                                }

                                ?>

                    

                            </div>

                        </div>

                    </div>

                    

                </div>

            </div>

                

            </div>

