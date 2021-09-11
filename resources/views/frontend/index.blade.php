<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    @php
    $datasetting = DB::table('setting')->orderby('id','desc')->limit(1)->get();
    @endphp
    @foreach($datasetting as $rowset)
    <title>{{$rowset->nama_apps}}</title>
    <meta name="description" content="{{$rowset->meta}}">
    @endforeach
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->

    <div class="lockscreen-wrapper">
        @php
        $datasetting = DB::table('setting')->orderby('id','desc')->limit(1)->get();
        @endphp
        @foreach($datasetting as $rowset)
        <div class="lockscreen-logo">
            <a href="/">{{$rowset->nama_apps}}</a><br>
            <img src="{{asset('img/setting/'.$rowset->logo)}}" alt="User Image" width="60%">
        </div>
        <div class="lockscreen-item">
        </div>
        <div class="help-block text-center">
        {{$rowset->meta}}
        </div>
        @endforeach
        
        
    </div>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>