<?php $this->load->view('admin/common/common-header');?>



<body style="background:#F7F7F7;">

    

    <div class="">

        <a class="hiddenanchor" id="toregister"></a>

        <a class="hiddenanchor" id="tologin"></a>



        <div id="wrapper">

            <div id="login" class="animate form">

                <section class="login_content">

                    <form action="" method="post">

                        <h1>Admin Login</h1>

                        <?php

                            if(isset($success)){

                        ?>

                        <div class="success_message"><?php echo $success; ?></div>

                        <?php }

                            if(validation_errors() || isset($error)) {

                        ?>

                        <div class="clear"></div>

                        <div class="alert alert-danger"><?php echo validation_errors(); echo isset($error) ? $error : ''; ?></div>

                        <?php }?>

                        <div>

                            <input type="text" name="username" class="form-control" placeholder="Username" required="" />

                        </div>

                        <div>

                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />

                        </div>

                        <div>

                            <input type="submit" class="btn btn-default submit" value="Login">

                            <a class="change_link" href="<?php echo base_url()?>admin/login/forgotPassword">Lost your password?</a>

                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">

                            <div class="clearfix"></div>

                            <br />

                            <div>

                                <h1><a href="<?php echo base_url()?>" style="font-size:24px">Aber Group</a></h1>



                                <p><?=$this->Preferences_model->getValue('CopyRight');?><span> <a href="https://www.gcc-marketing.com" target="_blank">GCC-Marketing</a></span></a></span></p>

                            </div>

                        </div>

                    </form>

                    <!-- form -->

                </section>

                <!-- content -->

            </div>

            



        </div>

    </div>



</body>



</html>