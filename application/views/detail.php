<style>

       /* Set the size of the div element that contains the map */

      #map {

        height: 400px;  /* The height is 400 pixels */

        width: 100%;  /* The width is the width of the web page */

       }

</style>

<script defer

    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&callback=initMap">

</script>

<!-- <script type="text/javascript">

function initMap() {
var container = document.getElementById('map');
var mapOptions = {
  zoom: 11,
  center: new google.maps.LatLng(<?=$row[0]->store_lat;?>, <?=$row[0]->store_lng;?>),
  styles: [{
    stylers: [{
      saturation: -100
    }]
  }]
};

var map = new google.maps.Map(container, mapOptions);
}

</script> -->
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

                <div class="inner_banner_overay banner_for_detail">

                    <div class="header_container">

                        <h2><?=$row[0]->title;?></h2>

                     <ul>
                            <li><?=$row[0]->apartments;?></li>
                            <li><?=$row[0]->bedrooms;?></li>
                            <li><?=$row[0]->duplex;?></li>

                      </ul>
                    </div>

                </div>

            </div>





            <div class="section_detail_main">

                <div class="header_container">

                    <div class="section_gallery">

                        <div class="product_single_slider">



                            <div class="preview">

                                <div class="row">



                                    <div class="preview-pic tab-content col-md-10 padd_r_0">

                                        <div class="tab-pane active" id="pic-1">

                                            <img src="<?=base_url();?>uploads/data/thumb_401_<?=$row[0]->image2;?>" alt="" >

                                        </div>

                                        <div class="tab-pane" id="pic-2">

                                            <img src="<?=base_url();?>uploads/data/thumb_401_<?=$row[0]->image3;?>" alt="" >

                                        </div>

                                        <div class="tab-pane" id="pic-3">

                                            <img src="<?=base_url();?>uploads/data/thumb_401_<?=$row[0]->image4;?>" alt="" >

                                        </div>



                                    </div>



                                    <ul class="preview-thumbnail nav nav-tabs col-md-2">

                                        <li class="active">

                                            <a data-target="#pic-1" data-toggle="tab">

                                                <img src="<?=base_url();?>uploads/data/thumb_400_<?=$row[0]->image2;?>" alt="" >

                                            </a>

                                        </li>



                                        <li>

                                            <a data-target="#pic-2" data-toggle="tab">

                                                <img src="<?=base_url();?>uploads/data/thumb_400_<?=$row[0]->image3;?>" alt="" >

                                            </a>

                                        </li>



                                        <li>

                                            <a data-target="#pic-3" data-toggle="tab">

                                                <img src="<?=base_url();?>uploads/data/thumb_400_<?=$row[0]->image4;?>" alt="" >

                                            </a>

                                        </li>



                                    </ul>



                                </div>

                            </div>

                        </div>

                    </div>

                    

                    <div class="gallery_lower_content">

                        <div class="header_container">

                            <p><?=$row[0]->description;?></p>

                            <div class="downloads_buttons">

                                <a href="<?=base_url();?>contact" class="enquire_btn">ENQUIRE NOW</a>

                                <?php if($row[0]->pdf_file != ''){ ?>

                                <a href="<?=base_url();?>download/<?=$row[0]->pdf_file;?>" class="broucher_btn">

                                    <img src="<?=base_url();?>assets/aber-assets/images/download_arrow.svg" alt=""> DOWNLOAD BROCHURE</a>

                                <?php } ?>

                            </div>

                        </div>

                    </div>

                    

                </div>

            </div>

            

            

             

            <div class="section_tabs_outer detail_page_tabs">

                

                

                <div class="header_container">

                  <!-- Nav tabs -->

                  <ul class="nav nav-tabs">

                    <li class="nav-item">

                      <a class="nav-link active" data-toggle="tab" href="#home">DESCRIPTION </a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" data-toggle="tab" href="#menu1">FLOOR PLAN </a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" data-toggle="tab" href="#menu2">LOCATION MAP</a>

                    </li>

                  </ul>



                  <!-- Tab panes -->

                  <div class="tab-content">

                    <div id="home" class="tab-pane active">

                      <div class="projects_tabs_content">

                          <p><?=$row[0]->description;?></p>

                        </div>

                    </div>

                    <div id="menu1" class="tab-pane fade">

                      

                      <div class="projects_tabs_content">

                          <p><?=$row[0]->floor_plan;?></p>

                        </div>

                    </div>

                    <div id="menu2" class="tab-pane fade">

                      

                      <div class="projects_tabs_content">

                          <div id="map"></div>

                      

                        </div>

                    </div>

                  </div>

                </div>       

            </div>



</div>







<script type="text/javascript">

    $(window).load(function(){



     $('#title').css('display', 'block');





    });

</script>