

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

                    <h2>Our Projects</h2>

                </div>

            </div>

            

            

            <div class="section_tabs_outer">

                

                

                <div class="header_container">

                  <!-- Nav tabs -->

                  <ul class="nav nav-tabs">

                   <li class="nav-item">

                      <a class="nav-link active" data-toggle="tab" href="#home">ALL</a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" data-toggle="tab" href="#menu1">Residential</a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" data-toggle="tab" href="#menu2">Commercial</a>

                    </li>

                  </ul>



                  <!-- Tab panes -->

               

                          <!-- Tab panes -->

                  <div class="tab-content">

           
                     <div id="home" class="tab-pane active">
                      <div class="projects_tabs_content">
                            <div class="row">
                                <?php

                                    foreach ($row as $value) {

                                        echo ' 

                                            <div class="col-md-3">

                                                <div class="projects_col">

                                                <a href="'.base_url().'detail/'.$value->slug.'">

                                                    <div class="project_fig">

                                                        <img src="'.base_url().'uploads/data/'.$value->image1.'" alt="" height="344px">

                                                        <div class="project_col_overlay"></div>

                                                    </div>

                                                    <div class="project_col_title">

                                                        <h5>'.$value->title.'</h5>

                                                    </div>

                                                </a>

                                                </div>

                                            </div>';

                                    }

                                ?>
                      <!--           <div class="col-md-3">

                                    <div class="projects_col">
                                        <div class="project_fig">
                                            <img src="images/projetcs_img_1.png" alt="">
                                            <div class="project_col_overlay"></div>
                                        </div>
                                        <div class="project_col_title">
                                            <h5>dubai arch tower</h5>
                                        </div>
                                    </div>
                                </div>
                                 -->
                   
                                
                            </div>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane">

                      

                      <div class="projects_tabs_content">

                            <div class="row">

                                                          

                                

                            <?php

                                    foreach ($residential as $value) {

                                        echo ' 

                                            <div class="col-md-3">

                                                <div class="projects_col">

                                                <a href="'.base_url().'detail/'.$value->slug.'">

                                                    <div class="project_fig">

                                                        <img src="'.base_url().'uploads/data/'.$value->image1.'" alt="" height="344px">

                                                        <div class="project_col_overlay"></div>

                                                    </div>

                                                    <div class="project_col_title">

                                                        <h5>'.$value->title.'</h5>

                                                    </div>

                                                </a>

                                                </div>

                                            </div>';

                                    }

                                ?>

                                

                                

                                

                            </div>

                        </div>

                    </div>

                    <div id="menu2" class="tab-pane fade">

                      

                      <div class="projects_tabs_content">

                            <div class="row">

           

               

                         

                             <?php

                                    foreach ($commercial as $value) {

                                        echo ' 

                                            <div class="col-md-3">

                                                <div class="projects_col">

                                                <a href="'.base_url().'detail/'.$value->slug.'">

                                                    <div class="project_fig">

                                                        <img src="'.base_url().'uploads/data/'.$value->image1.'" alt="" height="344px">

                                                        <div class="project_col_overlay"></div>

                                                    </div>

                                                    <div class="project_col_title">

                                                        <h5>'.$value->title.'</h5>

                                                    </div>

                                                </a>

                                                </div>

                                            </div>';

                                    }

                                ?>

                                

                            </div>

                        </div>

                    </div>

                  </div>

                </div>         

                

            </div>

