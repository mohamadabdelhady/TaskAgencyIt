<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

</head>
<body>
<header>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
        <div class="container">
            <a class="navbar-brand" href="/">WorkLog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse d-sm-inline-flex justify-content-end">
                        @if(Auth::check())
                            <div>
                                @if(auth()->user()->is_admin)
                                    <span>Admin : </span>
                                @else
                                    <span>Employee : </span>
                                @endif
                                    <span class="pe-5">{{auth()->user()->name}}</span>
                                        <a class="" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="ml-1">Sign out</span></a>
                                        <form id="logout-form" action="{{route('signout')}}" method="post" hidden>
                                            @csrf
                                        </form>
                            </div>
                           @endif
            </div>
        </div>
    </nav>
</header>
<div class="alert alert-warning alert-dismissible fade m-auto" id="alert-pop" role="alert" style="display:none;">
    <p id="notification message"></p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<script>
</script>
