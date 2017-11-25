@extends('layout')

@section('content')
    <section>
        <div class="wrap">
            <div class="toggle-wrap">
                <h1>Dev Tools</h1>
            </div>

            <div class="card">
                {{-- <div class="options">
                    <div class="fave-wrap"><span class="count">880</span><i class="fa fa-heart"></i></div>
                </div> --}}
                {{-- <div class="head">
                    <img data-src="http://loremflickr.com/300/250/lan-party">
                </div> --}}
                <div class="bod">
                    <h3 class="title"><a href="{{ url('timestamp', [], true) }}">Timestamp converter</a></h3>
                    <p>A Unix timestamp (or epoch time) is the number of seconds that have elapsed since January 1, 1970 00:00 UTC.</p>
                </div>
                {{-- <div class="foot">
                    <div class="foot-container">
                        <span class="avatar"></span>
                        <span class="name">Bob</span>
                    </div>
                </div> --}}
            </div>

        </div>
    </section>
@endsection