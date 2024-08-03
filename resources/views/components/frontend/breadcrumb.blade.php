 <div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s"
     style="background: linear-gradient(rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url('{{ asset('front/img/carousel-1.jpg') }}') center center no-repeat;"style="background: linear-gradient(rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url('{{ asset('front/img/carousel-1.jpg') }}') center center no-repeat;">
     <div class="container text-center">
         <h1 class="display-4 text-white animated slideInDown mb-4">{{ $menu }}</h1>
         <nav aria-label="breadcrumb animated slideInDown">
             <ol class="breadcrumb justify-content-center mb-0">
                 <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                 <li class="breadcrumb-item"><a class="text-white" href="">Pages</a></li>
                 <li class="breadcrumb-item text-primary active" aria-current="">{{ $title }}</li>
             </ol>
         </nav>
     </div>
 </div>
