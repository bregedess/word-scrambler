<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Word Scrambler</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .sub-title {
                font-size: 42px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .m-b-sm {
                margin-bottom: 20px;
            }
        </style>

        <script src="{{mix('js/app.js')}}"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Word Scrambler
                </div>

                <div class="sub-title m-b-sm">
                    guess the word!
                </div>

                @if(\App\Word::first())
                <div class="sub-title m-b-mm">
                    @php
                        $id = \App\Word::first()->id ?? 0;
                    @endphp

                    @php
                        $lastId = \App\Word::get()->last()->id ?? 0;
                    @endphp

                    {{ \App\Word::find(rand($id, $lastId))->scrambler }}
                </div>

                <form id="guessForm">
                    @csrf
                    <div class="form-group row">

                        <div class="col-md-6">
                            <input id="id" name="id" type="text" class="form-control" value="{{$id}}" hidden>
                            <input id="value" type="text" class="form-control" name="value" required autofocus>
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary guess">
                                {{ __('Guess!') }}
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>

        <script>

            $(".guess").click(function(event){
                event.preventDefault();

                let id = $("input[name=id]").val();
                let value = $("input[name=value]").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                console.log(id)

                $.ajax({
                    url: "/guess",
                    type:"POST",
                    data:{
                        id:id,
                        value:value,
                        _token: _token
                    },

                    success:function(response){
                        console.log('abc');
                            if(response) {
                                $('.success').text(response.success);
                                $("#guessForm")[0].reset();
                            }
                    },
                });
            });
        </script>

    </body>
</html>
