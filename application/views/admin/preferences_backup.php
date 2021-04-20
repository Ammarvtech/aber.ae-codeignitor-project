<?php $this->load->view('admin/common/common-header');?>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php $this->load->view('admin/common/left-nav');?>
        <!-- top navigation -->
        <?php $this->load->view('admin/common/top-nav');?>
        <!-- /top navigation --> 
        
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="x_content content">
                <div class="page-title">
                    <div class="title_left">
                        <h3><?php echo $page_heading;?></h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php if(isset($msg) && $msg!=''){?>
                <div class="success_message"><?php echo $msg; ?></div>
                <?php }?>
                <div class="x_content">
                    <div class="x_panel">
                        <?php if(isset($success) && $success!=''){?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php }if(validation_errors() || isset($error)) {?>
                        <div class="clear"></div>
                        <div class="alert alert-danger"><?php echo validation_errors(); echo isset($error) ? $error : ''; ?></div>
                        <?php }?>
                        <br/>
                        <form method="post" action="" name="frm" id="demo-form2" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
                            <div class="tab-content"> 
                                <div id="" class="tab-pane fade in active ">
                                    
                                        <input name="image" type="file" id="upload" class="hidden" onChange="">
                                        <input type="hidden" name="id" value="<?php echo isset($userDetail['id']) ? $userDetail['id'] : '';?>">
                                        <!-- <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Our Story Picture<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="file" name="logo_picture"/>
                                            </div>
                                        </div>
                                        <?php //if(isset($logo_picture) && $logo_picture!=''){?>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <img src="<?php //echo base_url();?>uploads/data/<?php //echo $logo_picture?>" width="404px" height="111px" />
                                            </div>
                                        </div>
                                    <?php //}?> -->
                                    <!-- <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Signature Picture<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="file" name="picture"/>
                                            </div>
                                        </div>
                                        <?php //if(isset($picture) && $picture!=''){?>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <img src="<?php //echo base_url();?>uploads/data/<?php //echo $picture?>" width="404px" height="111px" />
                                            </div>
                                        </div>
                                    <?php //}?> -->
                                    <!--  <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Home Page Picture 1<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="file" name="picture_1"/>
                                            </div>
                                        </div>
                                        <?php //if(isset($picture_1) && $picture!=''){?>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <img src="<?php //echo base_url();?>uploads/data/<?php //echo $picture_1?>" width="404px" height="111px" />
                                            </div>
                                        </div>
                                    <?php //}?> -->
                                     <!-- <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Home Picture 2<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="file" name="picture_2"/>
                                            </div>
                                        </div>
                                        <?php //if(isset($picture_2) && $picture!=''){?>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <img src="<?php //echo base_url();?>uploads/data/<?php //echo $picture_2?>" width="404px" height="111px" />
                                            </div>
                                        </div>
                                    <?php //}?> -->
                                    <!--  <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Home Page Picture 3<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="file" name="picture_3"/>
                                            </div>
                                        </div>
                                        <?php //if(isset($picture_3) && $picture!=''){?>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <img src="<?php //echo base_url();?>uploads/data/<?php //echo $picture_3?>" width="404px" height="111px" />
                                            </div>
                                        </div>
                                    <?php //}?> -->
                                    <!-- <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Home Page Picture 4<span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="file" name="picture_4"/>
                                            </div>
                                        </div>
                                        <?php //if(isset($picture_4) && $picture!=''){?>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <img src="<?php //echo base_url();?>uploads/data/<?php //echo $picture_4?>" width="404px" height="111px" />
                                            </div>
                                        </div>
                                    <?php //}?> -->

                                     
                                    <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Of Premier Today <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="description" class="form-control col-md-7 col-xs-12"><?php echo $description;?></textarea>
                                            </div>
                                        </div> 
                                    <!-- <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Our Story heading <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="story_hed" name="story_hed" required="required" class="form-control col-md-7 col-xs-12" value="<?php //echo $story_hed;?>" />
                                        </div>
                                    </div> 
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Our Description <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="story_des" name="story_des" required="required" class="form-control col-md-7 col-xs-12" value="<?php //echo $story_des;?>" />
                                        </div>
                                    </div>  
                                         <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Of Home Page picture 1 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_1" name="home_1" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_1;?>" />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Link Of Home Page picture 1 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_1_link" name="home_1_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_1_link;?>" />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Of Home Page picture 2 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_2" name="home_2" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_2;?>" />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Link Of Home Page picture 2 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_2_link" name="home_2_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_2_link;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Of Home Page picture 3 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_3" name="home_3" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_3;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Link Of Home Page picture 3 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_3_link" name="home_3_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_3_link;?>" />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Of Home Page picture 4 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_4" name="home_4" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_4;?>" />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Link Of Home Page picture 4 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_4_link" name="home_4_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_4_link;?>" />
                                        </div>
                                    </div>
                                      <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Heading Of Home Page picture 1 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_hed_1" name="home_hed_1" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_hed_1;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Heading Of Home Page picture 2 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_hed_2" name="home_hed_2" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_hed_2;?>" />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Heading Of Home Page picture 3 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_hed_3" name="home_hed_3" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_hed_3;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Heading Of Home Page picture 4 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_hed_4" name="home_hed_4" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_hed_4;?>" />
                                        </div>
                                    </div> -->
                                     
                                      <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle of Services and solution <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="services_solution" name="services_solution" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $services_solution;?>" />
                                        </div>
                                    </div>
                                     
                                     <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Services and solution <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="des_services_solution" class="form-control col-md-7 col-xs-12"><?php echo $des_services_solution;?></textarea>
                                            </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Our Product Section <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="product_section" name="product_section" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $product_section;?>" />
                                        </div>
                                    </div>
                                     
                                     <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Our Product Section <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="des_product_section" class="form-control col-md-7 col-xs-12"><?php echo $des_product_section;?></textarea>
                                            </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Success Stories Page <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="success_stories" name="success_stories" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $success_stories;?>" />
                                        </div>
                                    </div>
                                     
                                    <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Success Stories Page <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="des_success_stories" class="form-control col-md-7 col-xs-12"><?php echo $des_success_stories;?></textarea>
                                            </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Product Page <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="product_page" name="product_page" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $product_page;?>" />
                                        </div>
                                    </div>
                                     
                                    <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Product Page <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="des_product_page" class="form-control col-md-7 col-xs-12"><?php echo $des_product_page;?></textarea>
                                            </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Services Page <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="services_page" name="services_page" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $services_page;?>" />
                                        </div>
                                    </div>
                                     
                                    <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Services Page <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="des_services_page" class="form-control col-md-7 col-xs-12"><?php echo $des_services_page;?></textarea>
                                            </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Tittle Services Page 2 <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="services_page_2" name="services_page_2" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $services_page_2;?>" />
                                        </div>
                                    </div>
                                     
                                    <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description Services Page 2 <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea name="des_services_page_2" class="form-control col-md-7 col-xs-12"><?php echo $des_services_page_2;?></textarea>
                                            </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Map Key <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="map" name="map" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $map;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Facebook link <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="facebook_link" name="facebook_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $facebook_link;?>" />
                                        </div>
                                    </div>
                                     <!-- <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Home Page Video link <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="home_page_video_link" name="home_page_video_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $home_page_video_link;?>" />
                                        </div>
                                    </div> -->
                                    <!-- <div class="item form-group">
                                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Header Video/Image</label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <select name="header_content" id="type" class="form-control">
                                                <option value="image">Image</option>
                                                <option value="video">Video</option>
                                            </select>
                                            <?php //if(isset($header_content)){?>
                                            <script type="text/javascript">
                                                document.frm.header_content.value='<?php //echo $header_content ?>';
                                            </script>
                                            <?php //}?>
                                        </div>
                                    </div> -->
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name"> linked in link<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="twitter_link" name="twitter_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $twitter_link;?>" />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Twitter link <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="linkedin_link" name="linkedin_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $linkedin_link;?>" />
                                        </div>
                                    </div> 
                                   <!--  <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Google link <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="insta_link" name="insta_link" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $insta_link;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Play store link <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="play_store" name="play_store" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $play_store;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">App store link <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="app_store" name="app_store" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $app_store;?>" />
                                        </div>
                                    </div> -->
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Contact NO <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="num" name="num" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $num;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Copyright <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="footer_copyright" name="footer_copyright" required="required" class="form-control col-md-7 col-xs-12 textareashow" value='<?php echo $footer_copyright;?>' />
                                        </div>
                                    </div>
                                     <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Site By Link <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="site_by_link" name="site_by_link" required="required" class="form-control col-md-7 col-xs-12 textareashow" value='<?php echo $site_by_link;?>' />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Site By <span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="site_by" name="site_by" required="required" class="form-control col-md-7 col-xs-12 textareashow" value='<?php echo $site_by;?>' />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="adress">Adress<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="address" name="address" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $address;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="telephone">Telephone<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="telephone" name="telephone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $telephone;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="telephone">Email<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $email;?>" />
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="telephone">Email 2<span class="required">*</span> </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="email2" name="email2" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $email2;?>" />
                                        </div>
                                    </div>
                                    
                                   
                                   
                                   
                                  
                                   
                                  
                                    
                                   
                                    
                                    
                                    
                                     
                                    
                                    
                                    
                                   
                                     
                                   
                                   
                                   
                                    
                                   
                                   
                                   
                                   
                                    
                                   
                                   
                                   
                                    
                                </div>
                            
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <!-- footer content -->
            <?php $this->load->view('admin/common/footer');?>
            <!-- /footer content --> 
            
        </div>
        <!-- /page content --> 
    </div>
</div>
<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
</body>
</html><script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo base_url()?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo base_url()?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url()?>assets/js/icheck/icheck.min.js"></script>
<script src="<?php echo base_url()?>assets/js/custom.js"></script>
<!-- dropzone -->
<script src="<?php echo base_url()?>assets/js/validator/validator.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dropzone/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.colorbox-min.js"></script>
<script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
        .on('keyup blur', 'input', function () {
            validator.checkField.apply($(this).siblings().last()[0]);
        });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function (e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }

        if (submit)
            this.submit();
        return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function () {
        $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function () {
        validator.defaults.alerts = (this.checked) ? false : true;
        if (this.checked)
            $('form .alert').remove();
    }).prop('checked', false);
</script>
<script type="text/javascript">

     $(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements
        $(".group1").colorbox({rel:'group1'});
    });
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

/*$(document).ready(function() {
	tinymce.init({
    	selector: "textarea",
    	theme: "modern",
    	paste_data_images: true,
    	plugins: [
      		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
      		"searchreplace wordcount visualblocks visualchars code fullscreen",
      		"insertdatetime media nonbreaking save table contextmenu directionality",
      		"emoticons template paste textcolor colorpicker textpattern"
    	],
    	toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    	toolbar2: "print preview media | forecolor backcolor emoticons",
    	image_advtab: true,
    	file_picker_callback: function(callback, value, meta) {
      		if (meta.filetype == 'image') {
        		$('#upload').trigger('click');
        		$('#upload').on('change', function() {
					var file = this.files[0];
					var reader = new FileReader();
					reader.onload = function(e) {
						callback(e.target.result, {
							alt: ''
						});
					};
					reader.readAsDataURL(file);
				});
      		}
    	},
    	templates: [{title: 'Test template 1',content: 'Test 1'}, {title: 'Test template 2',content: 'Test 2'}]
  	});
});*/
</script>