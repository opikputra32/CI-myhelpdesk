<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Management Komplain</title>
    <meta name="description" content="Free Bootstrap 4 Template by uicookies.com">
    <meta name="keywords" content="Free website templates, Free bootstrap themes, Free template, Free bootstrap, Free website template">

    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/law-icons/font/flaticon.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/fontawesome/css/font-awesome.min.css">


    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick-theme.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/helpers.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/landing-2.css">
</head>

<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">

    <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="pb-navbar">
        <div class="container">
            <a class="navbar-brand font-weight-bolder" href="#">Management Komplain</a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="ion-navicon"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="probootstrap-navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#section-home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-faq">FAQ</a></li>
                    <li class="nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0"><a class="nav-link" href="<?php echo base_url('auth/index'); ?>"><span class="pb_rounded-4 px-4">Member Area</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->




    <section class="pb_cover_v3 overflow-hidden cover-bg-indigo cover-bg-opacity text-left pb_gradient_v1 pb_slant-light" id="section-home">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <h5 class="heading mb-3 font-weight-bolder" style="font-size:35px;">Ajukan Komplain Disini</h5>
                    <div class="sub-heading">
                        <p class="mb-4">Bila Anda merasa kurang puas dengan pelayanan Kami. Silahkan mendaftar dan mengisi data komplain Anda.</p>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-5 relative align-self-center">
                    <form action="<?php echo base_url('landing/add_user'); ?>" method="post" class="bg-white rounded pb_form_v1">
                        <h2 class="mb-0 text-center">Daftar Gratis</h2>
                        <div class="form-group">
                            <span class="text-muted" style="font-size:10px;color:blue;">* Mohon Diingat Username dan Password yang sudah Anda Buat.</span>
                            <input type="text" class="form-control pb_height-40 reverse" name="nama" placeholder="Nama Lengkap" value="<?php echo set_value('nama'); ?>" required>
                            <?php echo form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control pb_height-40 reverse" name="email" placeholder="Alamat Email" value="<?php echo set_value('email'); ?>" required>
                            <?php echo form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                        <div class=" form-group">
                            <input type="text" class="form-control pb_height-40 reverse" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" required>
                            <?php echo form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                        <div class=" row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control pb_height-40 reverse" name="password1" placeholder="Password" required>
                                    <?php echo form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control pb_height-40 reverse" name="password2" placeholder="Ulang Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg btn-block pb_btn-pill  btn-shadow-blue" value="Daftar">
                            <br>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <section class="pb_section bg-light pb_slant-white pb_pb-250" id="section-features">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-6 text-center mb-5">
                    <h5 class="text-uppercase pb_font-15 mb-2 pb_color-dark-opacity-3 pb_letter-spacing-2"><strong>Fitur</strong></h5>
                    <h2>Memudahkan Anda</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md- col-sm-6">
                    <div class="media d-block pb_feature-v1 text-left">
                        <div class="pb_icon"><i class="ion-ios-bookmarks-outline pb_icon-gradient"></i></div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-3 heading">Komplain</h5>
                            <p class="text-sans-serif">Mengajukan keluhan apabila tidak puas dengan pelayanan kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md- col-sm-6">
                    <div class="media d-block pb_feature-v1 text-left">
                        <div class="pb_icon"><i class="ion-ios-speedometer-outline pb_icon-gradient"></i></div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-3 heading">Cepat dan Tanggap</h5>
                            <p class="text-sans-serif">Lebih cepat direspon oleh Pihak Manajemen.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md- col-sm-6">
                    <div class="media d-block pb_feature-v1 text-left">
                        <div class="pb_icon"><i class="ion-ios-infinite-outline pb_icon-gradient"></i></div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-3 heading">Free atau Gratis</h5>
                            <p class="text-sans-serif">Daftar tanpa ada tambahan biaya.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md- col-sm-6">
                    <div class="media d-block pb_feature-v1 text-left">
                        <div class="pb_icon"><i class="ion-ios-color-filter-outline pb_icon-gradient"></i></div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-3 heading">Kemudahan Pengaduan</h5>
                            <p class="text-sans-serif">Mudah mengajukan pengaduan kepuasan pelanggan</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md- col-sm-6">
                    <div class="media d-block pb_feature-v1 text-left">
                        <div class="pb_icon"><i class="ion-ios-wineglass-outline pb_icon-gradient"></i></div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-3 heading">Fleksibel</h5>
                            <p class="text-sans-serif">Komplain bisa dilakukan dimana saja dan kapan saja</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md- col-sm-6">
                    <div class="media d-block pb_feature-v1 text-left">
                        <div class="pb_icon"><i class="ion-ios-paperplane-outline pb_icon-gradient"></i></div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-3 heading">Pelayanan Terpadu</h5>
                            <p class="text-sans-serif">Melayani komplain menggunakan sistem daring.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->





    <section class="pb_section pb_slant-white" id="section-faq">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-6 text-center mb-5">
                    <h5 class="text-uppercase pb_font-15 mb-2 pb_color-dark-opacity-3 pb_letter-spacing-2"><strong>FAQ</strong></h5>
                    <h2>Frequently Ask Questions</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div id="pb_faq" class="pb_accordion" data-children=".item">
                        <div class="item">
                            <a data-toggle="collapse" data-parent="#pb_faq" href="#pb_faq1" aria-expanded="true" aria-controls="pb_faq1" class="pb_font-22 py-4">Apa itu manajemen komplain?</a>
                            <div id="pb_faq1" class="collapse show" role="tabpanel">
                                <div class="py-3">
                                    <p>Kemudahan komplain oleh pelanggan Tanpa batas waktu dan tempat</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a data-toggle="collapse" data-parent="#pb_faq" href="#pb_faq2" aria-expanded="false" aria-controls="pb_faq2" class="pb_font-22 py-4">Bagaimana Caranya?</a>
                            <div id="pb_faq2" class="collapse" role="tabpanel">
                                <div class="py-3">
                                    <p>Mendaftarkan diri anda untuk dapat mengajukan komplain beserta dengan data data yang ada.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a data-toggle="collapse" data-parent="#pb_faq" href="#pb_faq3" aria-expanded="false" aria-controls="pb_faq3" class="pb_font-22 py-4">Bagaimana dengan hasil komplain saya?</a>
                            <div id="pb_faq3" class="collapse" role="tabpanel">
                                <div class="py-3">
                                    <p>Hasil komplain dapat dilihat dengan masuk ke member area menggunakan akun Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a data-toggle="collapse" data-parent="#pb_faq" href="#pb_faq4" aria-expanded="false" aria-controls="pb_faq4" class="pb_font-22 py-4">Apakah data yang saya kirimkan aman?</a>
                            <div id="pb_faq4" class="collapse" role="tabpanel">
                                <div class="py-3">
                                    <p>Kami akan memberikan privasi kepada setiap akun pelanggan yang melakukan komplain.</p>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <a data-toggle="collapse" data-parent="#pb_faq" href="#pb_faq5" aria-expanded="false" aria-controls="pb_faq5" class="pb_font-22 py-4">Apakah saya bisa menghapus atau merevisi komplain?</a>
                            <div id="pb_faq5" class="collapse" role="tabpanel">
                                <div class="py-3">
                                    <p>Anda dapat melakukan edit dan hapus apabila komplain Anda belum direspon oleh Admin kami. </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb_xl_py_cover overflow-hidden pb_slant-light pb_gradient_v1 cover-bg-opacity-8" style="background-image: url(assets/images/1900x1200_img_5.jpg)">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="col-md-1"></div>
                <div class="col-md-5">

                </div>
            </div>
        </div>
    </section>
    <!-- END section -->
    <!-- END section -->

    <footer class="pb_footer bg-light" role="contentinfo">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" class="p-2"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="p-2"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="p-2"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <p class="pb_font-14">&copy; 2019. All Rights Reserved. <br> <a href="https://uicookies.com/bootstrap-html-templates/" target="_blank">Bootstrap Templates</a> by uiCookies</p>
                    <p class="pb_font-14">Created By: <a href="https://adonia.rf.gd" target="_blank" rel="nofollow">Donny Kurniawan</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="pb_loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#1d82ff" /></svg></div>



    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.mb.YTPlayer.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>

</html>