

            <div class="margin_0 footer_outer">

                <div id="contactus" class="footer_row animatable fadeInUp">

                    <div class="footer">

                        <p class="p_mt_mb">

                                <?=$this->Preferences_model->getValue('footer_address');?>



                        </p>

                        <p class="footer_call_info"> 

                            <span class="smal_text_1">LandLine  <span class="smal_text_2"><a href="tel:<?=$this->Preferences_model->getValue('landLine');?>" style="color: #ffffff"><?=$this->Preferences_model->getValue('landLine');?></a></span> &nbsp;&nbsp;<span class="smal_text_3">|</span>&nbsp;&nbsp;</span>  

                            

                            <span class="smal_text_1">Fax <span class="smal_text_2"><a href="tel:<?=$this->Preferences_model->getValue('fax');?>" style="color: #ffffff"><?=$this->Preferences_model->getValue('fax');?></a></span> &nbsp;&nbsp;<span class="smal_text_3">|</span>&nbsp;&nbsp; </span> 

                            <span class="smal_text_1">Email  <span class="smal_text_2"><a href="mailto:<?=$this->Preferences_model->getValue('email');?>" style="color: #ffffff"><?=$this->Preferences_model->getValue('email');?></a></span></span> 

                        </p>

                    </div>

                    <div class="social_media_icons_div">
                        <a href="<?=$this->Preferences_model->getValue('facebook_link');?>" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="<?=$this->Preferences_model->getValue('twitter_link');?>" target="_blank"><i class="fab fa-twitter"></i> </a>
                        <a href="<?=$this->Preferences_model->getValue('linkedin_link');?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>

                    <div class="copy_rights">

                        <p><?=$this->Preferences_model->getValue('CopyRight');?> Site By<span> <a href="https://www.gcc-marketing.com" target="_blank">GCC-Marketing</a></span></a></span></p>

                    </div>

                </div>

            </div>





        </div>

    </div>



        <a href="#" id="scroll" style="display: none;"><span></span></a>

        <script  src="<?=base_url();?>assets/aber-assets/js/jquery.min.js"></script>

        <script  src="<?=base_url();?>assets/aber-assets/js/bootstrap.js"></script>

        <script  src="<?=base_url();?>assets/aber-assets/js/common.js"></script>

        <script  src="<?=base_url();?>assets/aber-assets/js/owl.carousel.js"></script>

        

        

        <script>

            $(document).ready(function() {

                var owl = $("#team_carousel");

                owl.owlCarousel({

                    itemsCustom: [

                        [0, 1],

                        [450, 1],

                        [600, 2],

                        [700, 2],

                        [1000, 3],

                        [1200, 3],

                        [1400, 3],

                        [1600, 3]

                    ],

                    navigation: true,

                    autoPlay: 4000,

                    rtl: true

                });

            });

        </script>

        





</body>



</html>