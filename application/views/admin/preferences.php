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
                         <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Text Below Slider <span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="text_below_slider" name="text_below_slider" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $text_below_slider;?>" />
                    </div>
                    </div>
              
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">
                            TextBox (Divisions Portions) 
                            <span class="required">*</span> 
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <textarea name="textBoxOne" class="form-control col-md-7 col-xs-12" style="width: 679px;
                            height: 308px;"><?php echo $textBoxOne;?></textarea>
                    
                        </div>
                    </div>
            
                    <br>
                    <br>
                    <h2 style="text-align: center;">CATEGORIES SECTION</h2>
                    <div class="row">
                        <div class="col-md-4" >
                            <h3>Investment</h3>
                            
                            <input type="file" name="investment_picture"/>
                            <br>
                            <?php if(isset($investment_picture) && $investment_picture!=''){?>
                                                    
                                <img src="<?php echo base_url();?>uploads/data/<?php echo $investment_picture?>" width="300px" height="300px" />
                                                           
                            <?php }?>
                                   <br>
                            <br>
                            <textarea name="i_text" class="form-control col-md-7 col-xs-12" style="
                            height: 208px;"><?php echo $i_text;?></textarea>
                        </div>
                        <div class="col-md-4" >
                            <h3>Property</h3>
                            <input type="file" name="property_picture"/>
                            <br>
                            <?php if(isset($property_picture) && $property_picture!=''){?>         

                                        <img src="<?php echo base_url();?>uploads/data/<?php echo $property_picture?>" width="300px" height="300px" />                           
                            
                            <?php }?>
                            <br>
                            <br>
                            <textarea name="p_text" class="form-control col-md-7 col-xs-12" style="
                            height: 208px;"><?php echo $p_text;?></textarea>


                        </div>
                        <div class="col-md-4" >
                            <h3>Lifestyle</h3>
                            <input type="file" name="lifestyle_picture"/>
                            <br>
                                 <?php if(isset($lifestyle_picture) && $lifestyle_picture!=''){?>         
                             
                                        <img src="<?php echo base_url();?>uploads/data/<?php echo $lifestyle_picture?>" width="300px" height="300px" />                           
                            
                                <?php }?>
                            <br>
                            <br>
                             <textarea name="l_text" class="form-control col-md-7 col-xs-12" style="
                            height: 208px;"><?php echo $l_text;?></textarea>
                           
                        </div>
                    </div>
                    <br>
                    <br>
               <!--      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Button Text <span class="required">*</span> </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="footer_button_text" name="footer_button_text" required="required" class="form-control col-md-7 col-xs-12" value="<?=$footer_button_text;?>" />
                        </div>
                    </div> -->
               <!--      <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Button Link <span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="footer_button_link" name="footer_button_link" required="required" class="form-control col-md-7 col-xs-12" value="<?=$footer_button_link;?>" />
                    </div>
                    </div> -->
                      <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Landline <span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="footer_phone_one" name="landline" required="required" class="form-control col-md-7 col-xs-12" value="<?=$landline;?>" />
                    </div>
                    </div>
                    <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Fax<span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="footer_phone_two" name="fax" required="required" class="form-control col-md-7 col-xs-12" value="<?=$fax;?>" />
                    </div>
                    </div>
                    <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Email<span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="footer_phone_two" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?=$email;?>" />
                    </div>
                    </div>
                    <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Footer Address <span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <textarea name="footer_address" class="form-control col-md-7 col-xs-12"><?php echo $footer_address;?></textarea>
                
                    </div>
                    </div>
                    <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Facebook Link<span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="facebook_link" name="facebook_link" required="required" class="form-control col-md-7 col-xs-12" value="<?=$facebook_link;?>" />
                    </div>
                    </div>
                    <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Twitter Link<span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="twitter_link" name="twitter_link" required="required" class="form-control col-md-7 col-xs-12" value="<?=$twitter_link;?>" />
                    </div>
                    </div>
                    <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">linkedin Link<span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="linkedin_link" name="linkedin_link" required="required" class="form-control col-md-7 col-xs-12" value="<?=$linkedin_link;?>" />
                    </div>
                    </div>
                    <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">CopyRight<span class="required">*</span> </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="linkedin_link" name="CopyRight" required="required" class="form-control col-md-7 col-xs-12" value="<?=$CopyRight;?>" />
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

$(document).ready(function() {
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
});
</script>