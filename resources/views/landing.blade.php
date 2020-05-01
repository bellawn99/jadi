<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asistensi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('landing/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ url('landing/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{ url('landing/css/jquery.fancybox.min.css')}}">

    <link rel="stylesheet" href="{{ url('landing/css/bootstrap-datepicker.css')}}">

    <link rel="stylesheet" href="{{ url('landing/fonts/flaticon/font/flaticon.css')}}">

    <link rel="shortcut icon" href="{{url('assets/images/logo-mini.svg')}}" />

    <link rel="stylesheet" href="{{ url('landing/css/style.css')}}">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="{{ url('/') }}"><img src="{{ url('assets/images/logo.svg') }}" style="max-width: 100%; height: auto;"></a></div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <li class="cta"><a href="{{ url('/login')}}" class="nav-link" ><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div class="intro-section" id="home-section">
      
      <div class="slide-1" style="background-image: url({{url('landing/images/awal.jpg')}});" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-12 mb-12">
                  <h1  data-aos="fade-up" data-aos-delay="100" style="text-align:center">ASISTENSI PRAKTIKUM KOMSI</h1>

                </div>

              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <div class="site-section" id="programs-section">
      <div class="container">

        <div class="row mb-5 align-items-center">
          <div class="col-lg-5 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ url('landing/images/undraw_teaching.svg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-7 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Syarat dan Ketentuan</h2>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
            <table>  
              
              @foreach ($ketentuans as $item)
              <tr>
              <td><span class="custom-icon-inner mr-3"><span class="icon">{{ $item->id }}</span></span></td>

              <td><div><h3 class="m-0">{{ $item->ketentuan }}</h3></div></td>
              </tr>
              @endforeach
              
            </table>
          </div>
              

          </div>
        </div>

      </div>
    </div>
    
    <div class="site-section courses-title" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Berita</h2>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row">

          <div class="owl-carousel col-12 nonloop-block-14">

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="{{ url('landing/images/img_1.jpg')}}" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <span class="course-price">$20</span>
                <div class="meta"><span class="icon-clock-o"></span>4 Lessons / 12 week</div>
                <h3><a href="#">Study Law of Physics</a></h3>
                <p>Lorem ipsum dolor sit amet ipsa nulla adipisicing elit. </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div>
                <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="{{ url('landing/images/img_2.jpg')}}" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <span class="course-price">$99</span>
                <div class="meta"><span class="icon-clock-o"></span>4 Lessons / 12 week</div>
                <h3><a href="#">Logo Design Course</a></h3>
                <p>Lorem ipsum dolor sit amet ipsa nulla adipisicing elit. </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div>
                <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="{{ url('landing/images/img_3.jpg')}}" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <span class="course-price">$99</span>
                <div class="meta"><span class="icon-clock-o"></span>4 Lessons / 12 week</div>
                <h3><a href="#">JS Programming Language</a></h3>
                <p>Lorem ipsum dolor sit amet ipsa nulla adipisicing elit. </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div>
                <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div>
              </div>
            </div>



            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="{{ url('landing/images/img_4.jpg')}}" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <span class="course-price">$20</span>
                <div class="meta"><span class="icon-clock-o"></span>4 Lessons / 12 week</div>
                <h3><a href="#">Study Law of Physics</a></h3>
                <p>Lorem ipsum dolor sit amet ipsa nulla adipisicing elit. </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div>
                <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="{{ url('landing/images/img_5.jpg')}}" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <span class="course-price">$99</span>
                <div class="meta"><span class="icon-clock-o"></span>4 Lessons / 12 week</div>
                <h3><a href="#">Logo Design Course</a></h3>
                <p>Lorem ipsum dolor sit amet ipsa nulla adipisicing elit. </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div>
                <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="{{url ('landing/images/img_6.jpg')}}" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <span class="course-price">$99</span>
                <div class="meta"><span class="icon-clock-o"></span>4 Lessons / 12 week</div>
                <h3><a href="#">JS Programming Language</a></h3>
                <p>Lorem ipsum dolor sit amet ipsa nulla adipisicing elit. </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div>
                <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div>
              </div>
            </div>

          </div>

         

        </div>
        <div class="row justify-content-center">
          <div class="col-7 text-center">
            <button class="customPrevBtn btn btn-primary m-1">Prev</button>
            <button class="customNextBtn btn btn-primary m-1">Next</button>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-5 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ url('landing/images/undraw_teacher.svg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-7 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h2 class="section-title mb-3">Hubungi Kami</h2>
            @if (count($errors)>0)
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show alert">
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
            @endif
            <form method="post" data-aos="fade" action="/">
            {{csrf_field()}}
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" name="nama" class="form-control" placeholder="Nama">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" name="no_hp" class="form-control" placeholder="No Telepon">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <textarea class="form-control" name="pesan" id="" cols="30" rows="10" placeholder="Tulis pesanmu disini."></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  
                  <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Kirim Pesan">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    
     
    <footer class="footer-section bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3>Tentang Asistensi</h3>
            <p>ASISTENSI merupakan sistem informasi berbasis website yang digunakan untuk pendaftaran calon asisten praktikum.</p>          </div>

          <div class="col-md-3 ml-auto">
            <h3>Follow Us</h3>
              <a href="#"><i class="icon-facebook" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="#"><i class="icon-instagram" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="#"><i class="icon-twitter" aria-hidden="true"></i></a>
          </div>

          <div class="col-md-4">
            <h3>Hubungi Kami</h3>
            <p><i class="icon-phone" aria-hidden="true"> 088-888-888-888 </i></p>
          </div>

        </div>

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> | Made with <i class="icon-heart" aria-hidden="true"></i> and <i class="icon-code" aria-hidden="true"></i>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  
    
  </div> <!-- .site-wrap -->

  <script src="{{ url('landing/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery-ui.js')}}"></script>
  <script src="{{url('assets/js/sweetalert.min.js')}}"></script>
    <script>
      @if(session('status'))
      swal({
        title:'{{ session('status') }}',
        icon : '{{ session('statuscode') }}',
        button : "OK",
      });
      @endif
    </script>
  <script src="{{ url('landing/js/popper.min.js')}}"></script>
  <script src="{{ url('landing/js/bootstrap.min.js')}}"></script>
  <script src="{{ url('landing/js/owl.carousel.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.stellar.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.countdown.min.js')}}"></script>
  <script src="{{ url('landing/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{ url('landing/js/aos.js')}}"></script>
  <script src="{{ url('landing/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.sticky.js')}}"></script>

  
  <script src="{{ url('landing/js/main.js')}}"></script>
    
  </body>
</html>