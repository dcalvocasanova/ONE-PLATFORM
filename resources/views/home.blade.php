@extends('layouts.AdminView')

@section('content')

<div id="colorlib-hero" class="js-fullheight">
    <div class="owl-carousel">

      <div class="item">
        <div class="hero-flex js-fullheight">
          <div class="col-three-forth">
            <div class="hero-img js-fullheight" style="background-image:url(img/background1.jpg)"></div>
          </div>
          <div class="col-one-forth js-fullheight">
            <div class="display-t js-fullheight">
              <div class="display-tc js-fullheight">
                <h2 class="number">J&M</h2>
                <div class="text-inner">
                  <div class="desc">
                    <span class="tag">Confirme su reservación</span>
                    <h2>La boda de Jose y Madelin.</h2>
                    <p>Es con gran ilusión y cariño, que le invitamo a la
                      celebración de nuestras nupcias, para organizarnos mejor le rogamos
                      realizar aquí la confirmación de su reservación.
                    </p>
                    <p><a href="/rsvp" class="btn-view">CONFIRMAR<i class="icon-arrow-right3"></i></a></p>
                    <br><br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="item">
        <div class="hero-flex js-fullheight">
          <div class="col-three-forth">
            <div class="hero-img js-fullheight" style="background-image:url(img/background2.jpg)"></div>
          </div>
          <div class="col-one-forth js-fullheight">
            <div class="display-t js-fullheight">
              <div class="display-tc js-fullheight">
                <h2 class="number">J&M</h2>
                <div class="text-inner">
                  <div class="desc">
                    <span class="tag">El evento</span>
                    <h2>La ceremonia.</h2>
                    <p>
                      Le invitamos a acompañarnos a nuestra boda, que tendrá lugar
                      en la parroquia de San Antonio de Padua, en Escazú.
                      El sábado 28 de Septiembre del 2019 a las 4:30 pm.
                    </p>
                    <p><a href="/event" class="btn-view">detalles<i class="icon-arrow-right3"></i></a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
