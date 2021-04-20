

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

                        <div class="title_right">

                   <!--          <form name="frm">

								<input type="hidden" name="per_page" value="<?php if(isset($_REQUEST['per_page'])){ echo $_REQUEST['per_page'];}?>" />

                                <div class="col-md-10 col-sm-5 col-xs-12 pull-right top_search">

                                    <div class="col-md-5 col-sm-5 col-xs-12 pull-right top_search">

                                        <div class="input-group">

                                        <input type="text" class="form-control" name="name" placeholder="Search Divisions..." value="<?php echo ($this->input->get('name')) ?$this->input->get('name') : ''; ?>">

                                        <span class="input-group-btn">

                                            <button class="btn btn-default" type="submit">Go!</button>

                                        </span>

                                        </div>

                                    </div>

                                </div>

                            </form> -->

                        </div>

    

                    </div>

                    <div class="clearfix"></div>

                    <?php if(isset($msg) && $msg!=''){?>

                    <div class="alert alert-success"><?php echo $msg; ?></div>

                    <?php }?>

                    <div class="table-responsive">

                        <table id="example" class="table table-striped responsive-utilities jambo_table">

                            <thead>

                                <tr class="headings">

    								<th>Picture</th>

    								<th>Name</th>

                                    <th>Description</th>

                                    <th>Project Name</th>

                                 <!--    <th>Type</th> -->

    								<!-- <th>Branch</th> -->

                                    <th class=" no-link last"><span class="nobr">Action</span></th>

                                </tr>

                            </thead>

                            <tbody>

                                 <?php 

    								foreach($products as $product){

                                 

                                ?> 

                                <tr class="odd pointer">

                                    <td><?php if($product->picture!=''){?>

                                        <img src="<?php echo base_url()?>uploads/data/<?php echo $product->picture;?>" width="100px" height="100px" /><?php }else{echo 'No Image';}?>

                                    </td>



                                    <td><?php echo $product->product_name; ?></td>  

                                    <td><?php echo strip_tags($product->description); ?></td>                            

                                    <td><?php echo $product->category; ?></td>                            

                                    <!-- <td><?php echo $product->subcategory; ?></td>                             -->

                    

                           

                                    <td class=" last" width="100">

                                        <a href="<?php echo base_url()?>admin/divisions/editDivision/<?php echo $product->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>

    									<a href="<?php echo base_url()?>admin/divisions/deleteDivision?id=<?php echo $product->id?>" onClick="return confirm('Are you sure to delete this product ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>

                                    </td>

                                </tr>

                                <?php }?>

                            </tbody>

                        </table>

                        <p> <?php echo $links; ?></p>

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

    <?php $this->load->view('admin/common/common-scripts.php')?>

    <!-- /datepicker -->

</body>



</html>