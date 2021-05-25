@extends('layouts.app')

@section('title', $article['title'])


@section('content')
    <main class="mt-5">
        <div class="container">
            <!--Section: Content-->
            <section>
                <div class="row">
                    <div class="col-md-6 gx-5 mb-4">
                        <div class="bg-image hover-overlay ripple shadow-2-strong" data-mdb-ripple-color="light">
                            <img src="{{ asset('img/hero-bg.jpg') }}" class="img-fluid" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6 gx-5 mb-4">
                        <h4><strong>{{ $article['title'] }}</strong></h4>
                        <p class="text-muted">
                           {{ $article['content'] }}
                        </p>
                        {{--  <p><strong>Doloremque vero ex debitis veritatis?</strong></p>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                            itaque voluptate nesciunt laborum incidunt. Officia, quam
                            consectetur. Earum eligendi aliquam illum alias, unde optio
                            accusantium soluta, iusto molestiae adipisci et?
                        </p>  --}}
                    </div>
                </div>
            </section>
            {{-- <!--Section: Content--> --}}
    </main>


    @include('footer.footer')
@endsection
