<!DOCTYPE html>
<html class="no-js" lang="">
   	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="x-ua-compatible" content="ie=edge">
    	<title>@yield('title')</title>
    	<meta name="description" content="">
     	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="{{asset('img/image.png')}}">	
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
		<section class="login-block">
    		<div class="container">
    			<div class="row">
        			<div class="col-md-4 login-sec">
            			<h2 class="text-center">Ký túc xá <br> <br>Đại học Bách Khoa Hà Nội</h2>
							@yield('content')
					</div>
                    <div class="col-md-8 banner-sec">
                        
                    </div>
				</div>
            </div>
        </section>
    </body>
</html>