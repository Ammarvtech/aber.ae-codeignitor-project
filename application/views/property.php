

    <div class="outer_main">



        <div class="container-fluid padd_0">



            <div class="row margin_0">

                <div class="bg_img_s">

                    <?=$this->load->view('common/navbar.php');?>

                    

                </div>



            </div>

            

            <div class="inner_page_banner">

                <div class="banner_inner_figure">

                    <img src="<?=base_url();?>assets/aber-assets/images/inner_banner_1.png" alt="">

                </div>

                <div class="inner_banner_overay">

                    <h2><?=$tittle?></h2>

                </div>

            </div>

      

            

            <div class="section_property_content_outrer">

                

                <div class="custom_container">

                    <?php

                    $count = 1;          

                    foreach ($row as $value) {

                        # code...

                        $remainder = $count % 2;

                            if($remainder == 0){

                                echo '

                                <div class="property_section_col">

                        <div class="row d_i_b">

                            

                            <div class="col-md-6 move_right">

                                <div class="property_col_inner image_pade_left">

                                    <img src="'.base_url().'uploads/data/'.$value->picture.'" alt="">

                                </div>

                            </div>

                            

                            

                            <div class="col-md-6">

                                <div class="property_col_inner_side">

                                    <h4>'.$value->product_name.'</h4>

                                    <p>'.$value->description.'</p>';
                                    if($value->site_link != ''){
                                    echo '
                                    <a href="'.$value->site_link.'" target="_blank">
                                    ';
                                    if($count == 3){
                                        echo 'SEE PROPERTIES';
                                    }else{
                                        echo 'VISIT SITE';
                                    }
                                    echo '
                                    <img src="'.base_url().'assets/aber-assets/images/icon_arrow.svg" alt=""></a>
                                    ';}
                                    echo '

                                </div>

                            </div>

                            

                            

                        </div>

                    </div>';

                            }else{

                                echo  '<div class="property_section_col">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="property_col_inner image_pade_right">

                                    <img src="'.base_url().'uploads/data/'.$value->picture.'" alt="">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="property_col_inner_side">

                                   <h4>'.$value->product_name.'</h4>

                                    <p>'.$value->description.'</p>
                                    ';
                                    if($value->site_link != ''){
                                    echo '
                                    <a href="'.$value->site_link.'" target="_blank">
                                    ';
                                    if($count == 3){
                                        echo 'SEE PROPERTIES';
                                    }else{
                                        echo 'VISIT SITE';
                                    }
                                    echo '
                                    <img src="'.base_url().'assets/aber-assets/images/icon_arrow.svg" alt=""></a>
                                    ';}
                                    echo '

                                </div>

                            </div>

                        </div>

                    </div>';

                            }      

                        $count++;

                    }

                    ?>

                   

                    <?php if($tittle == 'property'){ ?>

                    <div class="browse_button_col">

                        <a href="<?=base_url();?>our-projects">BROWSE PROJECTS</a>

                    </div>

                    <?php } ?>

                    

                </div>

                

            </div>

            