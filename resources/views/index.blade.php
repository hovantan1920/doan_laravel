@extends('layout.main')

@section('content')
<main class="site-main">
    <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
            <img class="img-fluid border-left border-info border-bottom" src="{{asset('images/home/hero-banner.png')}}" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h4>Coff.ca is fun</h4>
              <h2>Browse Our Premium Product</h2>
              <p></p>
              <a class="button button-hero" href="#">Browse Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection