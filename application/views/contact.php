 <style>

       /* Set the size of the div element that contains the map */

      #map {

        height: 200px;  /* The height is 400 pixels */

        width: 100%;  /* The width is the width of the web page */

       }

</style>
<script async src='https://www.google.com/recaptcha/api.js'></script>
<script defer

    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&callback=initMap">

</script>

    <script>
      function initMap() {
        var locationRio = {lat: <?=$row[0]->store_lat;?>, lng: <?=$row[0]->store_lng;?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: locationRio,
          gestureHandling: 'none',
            styles: [{
            
            stylers: [{
              saturation: -100
            }]
          }]
        });
        var marker = new google.maps.Marker({
          position: locationRio,
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
<!-- <script type="text/javascript">

// Initialize and add the map

function initMap() {
var container = document.getElementById('map');
var mapOptions = {
  zoom: 11,
  center: new google.maps.LatLng(<?=$row[0]->store_lat;?>, <?=$row[0]->store_lng;?>),
  gestureHandling: 'greedy',

  styles: [{
    
    stylers: [{
      saturation: -100
    }]
  }]
};

var map = new google.maps.Map(container, mapOptions);
}
</script> -->

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

                    <h2>Contact uS</h2>

                </div>

            </div>



            <div class="section_contact_main">

                <div class="header_container">

                    <div class="row">

                        <div class="col-md-4">

                             <div class="contact_left_col">

                                <h4>Get in Touch</h4>

                                <p>To enquire about our services or for<br> questions about your accounts, please<br> call:</p>
                                <p><?=$row[0]->address?> <br>Local toll free:  <?=$row[0]->phone1?> <br>Int: <?=$row[0]->phone2?><br>[<?=$row[0]->time?> ]</p>

                                <div class="map_section">



                          <div id="map"></div>

                                    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3613.8869662326456!2d55.141471314320704!3d25.07181998395457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6cae9ae7be6d%3A0x8533f8d4bc62a19d!2sAber%20Group%20LLC!5e0!3m2!1sen!2s!4v1597926164141!5m2!1sen!2s" width="100%" height="230" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->

                                </div>

                            </div>


                        </div>

                        

                        

                        <div class="col-md-7">

                              <?php if($this->session->flashdata('success')){?>

                                <div class="alert alert-primary"><?php echo $this->session->flashdata('success'); ?></div>

                            <?php }?>

                              <?php if($this->session->flashdata('error')){?>

                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>

                            <?php }?>
                      
                            <div class="contact_right_col">

                                <h4>Write to us</h4>



                          

                            <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data" id="myForm" >



                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" name="name" placeholder="Full Name*" required="" value="<?=@$mydata['name']?>">

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" name="subject" placeholder="Subject*" required="" value="<?=@$mydata['subject']?>">

                                        </div>

                                    </div>

                                    

                                    

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" name="contact" placeholder="Mobile Number*" required="" value="<?=@$mydata['contact']?>">

                                        </div>

                                        <div class="col-md-6">

                                            <input type="email" class="form-control" name="email" placeholder="Email*" required="" value="<?=@$mydata['email']?>">

                                        </div>

                                    </div>

                                    

                                    

                                    <div class="row">

                                        <div class="col-md-12">

                                            <textarea class="form-control" name="message" placeholder="Message*" required=""><?=@$mydata['message']?></textarea>

                                        </div>

                                    </div>

                                    <div class="row">
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="g-recaptcha" data-sitekey="6LfPtMUZAAAAAPl4WhpBZf3_VpnRV5osp_lHOkNv"></div>
                                    </div>
                                </div>
                                    <br>
                            

                                    <input id="submit_handle" type="submit" style="display: none">

                                    <a href="javascript:;" class="submit_button"  onclick="submitform()">
                                        SUBMIT
                                    </a>

                                    

                                </form>

                            </div>

                        </div>

                        

                    </div>

                </div>

            </div>
<script>
function submitform() {
    $('#submit_handle').click();
}
</script>
<script type="text/javascript">
    function submit(){
        $('#myForm').submit();
    }
</script>
            