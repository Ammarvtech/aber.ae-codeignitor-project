<?php $this->load->view('admin/common/common-header');?>

<style type="text/css">

.thumb{

  margin: 24px 5px 20px 0;

  width: 150px;

  float: left;

}

#blah {

  border: 2px solid;

  display: block;

  background-color: white;

  border-radius: 5px;

}



.img-wraps {

    position: relative;

    display: inline-block;

   

    font-size: 0;

}

.img-wraps .closes {

    position: absolute;

    top: 5px;

    right: 8px;

    z-index: 100;

    background-color: #FFF;

    padding: 4px 3px;

    

    color: #000;

    font-weight: bold;

    cursor: pointer;

   

    text-align: center;

    font-size: 22px;

    line-height: 10px;

    border-radius: 50%;

    border:1px solid red;

}

.img-wraps:hover .closes {

    opacity: 1;

}

</style>

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

                    <?php if(isset($msg)){?>

                    <div class="success_message"><?php echo $msg; ?></div>

                    <?php }?>

                    <div class="x_content">

                        <div class="x_panel">

                            <?php

                                if(isset($success)){

                            ?>

                            <div class="success_message"><?php echo $success; ?></div>

                            <?php }

                                if(validation_errors() || isset($error)) {

                            ?>

                            <div class="clear"></div>

                            <div class="error_message"><?php echo validation_errors(); echo isset($error) ? $error : ''; ?></div>

                            <?php }?>

                            

                            <br/>

                            <form method="post" name="frm" action=""  class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>

                                

                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Project Type<span class="required">*</span>

                                            </label>



                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <select required="" name="type" class="form-control">

                                                    <option value="">-----Select Type-----</option>

                                                    <option value="residential">RESIDENTIAL</option>

                                                    <option value="commercial">COMMERCIAL</option>

                                                </select>

                                           

                                            </div>

                                        </div> 

                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Title <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['title']) ? $productDetail['title'] : '';?>" />

                                            </div>

                                        </div>
                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Apartments <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <input type="text" name="apartments" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['apartments']) ? $productDetail['apartments'] : '';?>" />

                                            </div>

                                        </div>
                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Bedrooms <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <input type="text" name="bedrooms" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['bedrooms']) ? $productDetail['bedrooms'] : '';?>" />

                                            </div>

                                        </div>
                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Duplex <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <input type="text" name="duplex" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['duplex']) ? $productDetail['duplex'] : '';?>" />

                                            </div>

                                        </div>
                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Slug <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <input type="text" name="slug" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($productDetail['slug']) ? $productDetail['slug'] : '';?>" />

                                            </div>

                                        </div>

                                  

                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <textarea name="description" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['description']) ? $productDetail['description'] : '';?></textarea>

                                            </div>

                                        </div>



                                        <div class="item form-group">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Floor plan <span class="required">*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <textarea name="floor_plan" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['floor_plan']) ? $productDetail['floor_plan'] : '';?></textarea>

                                            </div>

                                        </div>

                               

                                    <div class="form-group">

                                            <input type="hidden" name="pdf_file" id="pdf_file">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Upload File<span>*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>

                                                <div id="myId_pdf" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>

                                            </div>

                                        </div>

             

                                      <div class="form-group">

                                            <input type="hidden" name="image1" id="picture_name">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Main Image<span>*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>

                                                <div id="myId" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <input type="hidden" name="image2" id="picture_name2">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Page Image(D)<span>*Dimension Should be 1050*400</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>

                                                <div id="myId2" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <input type="hidden" name="image3" id="picture_name3">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Page Image<span>*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>

                                                <div id="myId3" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <input type="hidden" name="image4" id="picture_name4">

                                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Detail Page Image<span>*</span>

                                            </label>

                                            <div class="col-md-7 col-sm-7 col-xs-12">

                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">&nbsp;</label>

                                                <div id="myId4" class="dropzone" style="border: 1px solid #e5e5e5; height: 100px; "></div>

                                            </div>

                                        </div>

                             <!--    <div class="item form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Location Map <span class="required">*</span>

                                    </label>

                                    <div class="col-md-7 col-sm-7 col-xs-12">

                                        <textarea name="location_map" class="form-control col-md-7 col-xs-12"><?php echo isset($productDetail['location_map']) ? $productDetail['location_map'] : '';?></textarea>

                                    </div>

                                </div> -->

                        <div class="item form-group">                

                            <label for="field-1" class="control-label col-md-2 col-sm-2 col-xs-12">Search Location</label>             

                            <div class="col-md-7 col-sm-7 col-xs-12">                  

                                <input type="text" class="form-control" id="locationTextField" name="pro_google_address" value="<?=@$row->pro_google_address;?>" placeholder="Search Location" required="required" aria-required="true" autocomplete="off" aria-invalid="false" >  

                                <br>                 

                                <i class="input-group-btn">                      

                                    <button class="btn btn-prosearch" type="button" onclick="codeAddress()">Search</button>

                                </i>  

                                <div class="col-md-5">  

                                <input type="text" name="store_lat" id="pro_lat" value="" class="form-control" placeholder="latitude">       

                                </div>    

                                <div class="col-md-5">                                  

                                <input type="text" name="store_lng" id="pro_lng" value="" class="form-control" placeholder="longitude">  

                                </div>         

                                </div>               

                                <!-- <input type="hidden" name="store_lat" id="pro_lat" value="">      -->

                                 <!-- <input type="hidden" name="store_lng" id="pro_lng" value=""> -->

                                 <input type="hidden" name="store_country" id="store_country" value="" >

                        </div>          

                                 <div style="height:500px;" id="map">       

                                </div>

                                <br>

                                <div class="form-group">

                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                        <button type="submit" class="btn btn-success">Submit</button>

                                    </div>

                                </div>

                                <!-- <input name="image" type="file" id="upload" class="hidden" onChange=""> -->

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

    

    <!-- /datepicker -->

</body>

<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>



<script src="<?php echo base_url();?>assets/js/custom.js"></script>







<!-- dropzone -->



<script type="text/javascript" src="<?php echo base_url()?>assets/js/dropzone/dropzone.js"></script>

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

<script type="text/javascript">

    $(document).ready(function(){

        //$("div#myId").dropzone({ url: "upload.php" });

        var myDropzone = new Dropzone(

                                "div#myId",{ 

                                dictDefaultMessage: "Drag image here",

                                uploadMultiple: false,

                                parallelUploads: 1,

                                clickable: true,

                                maxFiles: 1,

                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"

                            });

        myDropzone.on("success", function(file,response) {

            var obj = jQuery.parseJSON(response);

         

            if(obj.error==''){

                $("#picture_name").val(obj.picture_name);

            }else{

                alert(obj.error);

            }

        });

        myDropzone.on("canceled",function(file,response){

            alert('Only one file upload is allowed');

        })

        

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

        //$("div#myId").dropzone({ url: "upload.php" });

        var myDropzone = new Dropzone(

                                "div#myId2",{ 

                                dictDefaultMessage: "Drag image here",

                                uploadMultiple: false,

                                parallelUploads: 1,

                                clickable: true,

                                maxFiles: 1,

                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"

                            });

        myDropzone.on("success", function(file,response) {

            var obj = jQuery.parseJSON(response);

         

            if(obj.error==''){

                $("#picture_name2").val(obj.picture_name);

            }else{

                alert(obj.error);

            }

        });

        myDropzone.on("canceled",function(file,response){

            alert('Only one file upload is allowed');

        })

        

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

        //$("div#myId").dropzone({ url: "upload.php" });

        var myDropzone = new Dropzone(

                                "div#myId3",{ 

                                dictDefaultMessage: "Drag image here",

                                uploadMultiple: false,

                                parallelUploads: 1,

                                clickable: true,

                                maxFiles: 1,

                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"

                            });

        myDropzone.on("success", function(file,response) {

            var obj = jQuery.parseJSON(response);

         

            if(obj.error==''){

                $("#picture_name3").val(obj.picture_name);

            }else{

                alert(obj.error);

            }

        });

        myDropzone.on("canceled",function(file,response){

            alert('Only one file upload is allowed');

        })

        

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

        //$("div#myId").dropzone({ url: "upload.php" });

        var myDropzone = new Dropzone(

                                "div#myId4",{ 

                                dictDefaultMessage: "Drag image here",

                                uploadMultiple: false,

                                parallelUploads: 1,

                                clickable: true,

                                maxFiles: 1,

                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"

                            });

        myDropzone.on("success", function(file,response) {

            var obj = jQuery.parseJSON(response);

         

            if(obj.error==''){

                $("#picture_name4").val(obj.picture_name);

            }else{

                alert(obj.error);

            }

        });

        myDropzone.on("canceled",function(file,response){

            alert('Only one file upload is allowed');

        })

        

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

        //$("div#myId").dropzone({ url: "upload.php" });

        var myDropzone = new Dropzone(

                                "div#myId5",{ 

                                dictDefaultMessage: "Drag image here",

                                uploadMultiple: false,

                                parallelUploads: 1,

                                clickable: true,

                                maxFiles: 1,

                                url: "<?php echo base_url()?>admin/products/uploadAddImage/"

                            });

        myDropzone.on("success", function(file,response) {

            var obj = jQuery.parseJSON(response);

         

            if(obj.error==''){

                $("#picture_name5").val(obj.picture_name);

            }else{

                alert(obj.error);

            }

        });

        myDropzone.on("canceled",function(file,response){

            alert('Only one file upload is allowed');

        })

        

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

        //$("div#myId").dropzone({ url: "upload.php" });

        var myDropzone = new Dropzone(

                                "div#myId_pdf",{ 

                                dictDefaultMessage: "Drag File here",

                                uploadMultiple: false,

                                parallelUploads: 1,

                                clickable: true,

                                maxFiles: 1,

                                url: "<?php echo base_url()?>admin/products/uploadPdf/"

                            });

        myDropzone.on("success", function(file,response) {

            var obj = jQuery.parseJSON(response);

         

            if(obj.error==''){

                $("#pdf_file").val(obj.picture_name);

            }else{

                alert(obj.error);

            }

        });

        myDropzone.on("canceled",function(file,response){

            alert('Only one file upload is allowed');

        })

        

    });

</script>



</html>

<!-- <script src="<?php echo base_url()?>assets/js/validator/validator.js"></script> --> 

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

<script>

    $(function() {

        $("#store_form").submit(function(e) {

            //$('#store_country').

        });

    });

var marker;

var geocoder;

var adr;

var map;

var default_lat = <?= isset($row-> store_lat) ? (!empty($row-> store_lat) ? $row-> store_lat : 31.06016880821905) : 31.06016880821905; ?> ;

var default_lng = <?= isset($row-> store_lng) ? (!empty($row-> store_lng) ? $row-> store_lng : 31.06016880821905) : 31.06016880821905; ?> ;

var default_zoom = 3;



function initMap() {

    geocoder = new google.maps.Geocoder();



    adr = document.getElementById('locationTextField').value;

    map = new google.maps.Map(document.getElementById('map'), {

        zoom: default_zoom,

        center: {

            lat: default_lat,

            lng: default_lng

        }

    });



    var lat = default_lat;

    var lng = default_lng;

    var latlng = new google.maps.LatLng(lat, lng);

    var mapOptions = {

        zoom: default_zoom,

        center: latlng,

    };



    var input = document.getElementById('locationTextField');

    google.maps.event.addDomListener(input, 'keydown', function(e) {

        if (e.keyCode == 13 && $('.pac-container:visible').length) {

            e.preventDefault();

        }

    });

    var autocomplete = new google.maps.places.Autocomplete(input);

    marker = new google.maps.Marker({

        map: map,

        draggable: true,

        animation: google.maps.Animation.DROP,

        position: {

            lat: default_lat,

            lng: default_lng

        }

    });

    marker.addListener('click', toggleBounce);

    google.maps.event.addListener(marker, 'dragend', function() {

        geocoder.geocode({

            'latLng': marker.getPosition()

        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                console.log(results);

                if (results[0]) {

                    $('#pro_lat').val(marker.getPosition().lat());

                    $('#pro_lng').val(marker.getPosition().lng());



                    $.each(results[0].address_components, function(index, obj) {

                        if (obj.types[0] == 'country') {

                            console.log(obj.long_name);

                            $("#store_country").val(obj.long_name);

                        }



                    });

                    $('#locationTextField').val(results[0].formatted_address);

                    console.log(marker.getPosition().lat());

                    console.log(marker.getPosition().lng());

                }

            }

        });

    });

}





function toggleBounce() {

    if (marker.getAnimation() !== null) {

        marker.setAnimation(null);

    } else {

        marker.setAnimation(google.maps.Animation.BOUNCE);

    }

}



function codeAddress() {

    marker.setMap(null);

    $('#pro_lat').default_lat;

    $('#pro_lng').default_lng;

    var address = document.getElementById('locationTextField').value;

    geocoder.geocode({

        'address': address

    }, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {

            var position = results[0].geometry.location;

            var latitude = results[0].geometry.location.lat();

            var longitude = results[0].geometry.location.lng();

            map.setCenter(position);

            marker = new google.maps.Marker({

                position: position,

                map: map,

                draggable: true,

                title: "Drag me!"

            });

            map.setZoom(default_zoom);

            $('#pro_lat').val(latitude);

            $('#pro_lng').val(longitude);

            google.maps.event.addListener(marker, 'dragend', function() {

                geocoder.geocode({

                    'latLng': marker.getPosition()

                }, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {

                        if (results[0]) {

                            $('#pro_lat').val(marker.getPosition().lat());

                            $('#pro_lng').val(marker.getPosition().lng());



                            $.each(results[0].address_components, function(index, obj) {

                                if (obj.types[0] == 'country') {

                                    console.log(obj.long_name);

                                    $("#store_country").val(obj.long_name);

                                }



                            });

                            $('#locationTextField').val(results[0].formatted_address);

                            console.log(marker.getPosition().lat());

                            console.log(marker.getPosition().lng());

                        }

                    }

                });

            });

        } else {

            alert('Geocode was not successful for the following reason: ' + status);

            return false;

        }

    });

    return false;

} </script>



  <script async defer    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&callback=initMap">    </script>