<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="/assets/bootstrap-5/dist/css/bootstrap.min.css">
        <style>
            :root{
                --text-principal: #333333;
                --text-secondary: #666666;

            }
            *{
                font-family: Roboto;
            }
            .text-primaire{
                color: #333333;
            }
            .text-secondaire{
                color: #666666;
            }
            body{
                font-size: 15px;
                color: var(--text-principal);
                background: #eee;
            }
            .nav-item.active{
                background: linear-gradient(to right, #ffffff,rgb(255, 255, 255));
                color: white;
            }
            .nav-item {
                color: rgb(180, 180, 180);
            }
            .nav-item{
                padding-left: 1rem;
            }
            .nav .fa {
                width: 2rem;
            }
             
            .btn{
            }
            .btn-group .btn{
                background: #ffffff;
                font-size: .9rem;
                box-shadow: ;
            }
            form{
                min-width: 300px;
            }
            .btn-group .btn.active{
                    background: rgb(231, 5, 73);
                    color: white;
            }
            .orange{
                color: rgb(255, 153, 0);
            }
            .btn-link{
                color:  
            }
            .btn-group .btn.active .btn-link{
                color: var(--text-secondary);
            }
            .form-control{
            }
            span{
                cursor: pointer;
            }
            .btn-primaire{
                background: rgb(18, 146, 185);
                color: white;
            }
            .btn-primaire:hover{
                color: white;
            }
            .border-main{
                border:2px solid rgb(18, 146, 185);
            }
            .main-text{
                color:rgb(18, 146, 185);
            }
            .main-bg{
                background:rgb(18, 146, 185);
            }

            .top-nav .notif{
                color: blueviolet;
            }
            .table td{
                font-size: .9rem;
            }
            #leftnav{
                width:15%; 
                max-width: 15rem;
                min-height:100%;
            }
            #body{
                max-width:85%;
                margin-left:14.4%;
            }
            .modal-content{
                border-radius: 0px;
            }
            .text-primaire{
                color: rgb(18, 146, 185);
            }
            .red{
                color: rgb(231, 5, 73);
            }
            .green{
            color: rgb(10, 202, 106);
            }
            .btn{
                font-size: .9rem;
            }
            .dropdown-item{
                font-size: .8rem;
            }
            .list div{
                max-width: 1005px;
            }
            .outgoing{
                font-size:.7rem;
                color:rgb(231, 5, 73);
                background:rgba(231, 5, 73, 0.137);
            }
            .ingoing{
                font-size:.7rem;
                color:rgb(10, 202, 106);
                background:rgba(10, 202, 106, 0.171);
            }
            .blue{
                color: rgb(18, 146, 185);
            }
            .verified{
                font-size: .8rem;
                color: rgb(10, 202, 106);
                padding:5px;
                border-radius: 30px;
            }
            .pending{
                color: rgb(255, 153, 0);
                background: rgba(255, 153, 0, 0.164);
                font-size: .8rem;
                padding:5px;
                border-radius: 30px;
            }
            .violet{
                color: blueviolet;
            }
            .verify{
                color: rgb(10, 202, 106);
                background: rgba(10, 202, 106, 0.123);
                font-size: .8rem;
                padding:5px;
                border-radius: 3px;
            }
            #student-task{
                display: none;
            }
            @media only screen and (max-width: 1090px) {
                #leftnav{
                    width: 3rem;
                    z-index: ;
                }
                .fa-chevron-down.float-end{
                    display: none;
                }
                #leftnav span{
                    display: none;
                }
                .navigation{
                    z-index: 1000;
                }
                #body{
                    max-width: 91%;
                    margin-left: 2.8rem;
                }
                .logo{
                    display: none;
                }

            }
        </style>
        @if (Auth::user()->privillege == "student")
            <style>
                #admin-task{
                    display: none;
                }
                #student-task{
                    display: block;
                }
            </style> 
        @elseif(Auth::user()->privillege == "teacher")
            <style>
                #sup-admin-task{
                    display: none;
                }#teacher-task{
                    display: block;
                }
                #student-task{
                    display: block;
                }
            </style> 
        @endif
    </head>
    <body class="font-sans antialiased bg-light">
        <div class="min-h-screen">
            @include('layouts.navigation')


            
            <!-- Page left navigation -->
            <div class=" d-flex">
                <nav class=" fixed" id="leftnav" style="top:0;background:rgb(20, 109, 136);">
                    <div class="container-fluid navbar p-0">
                        <ul class="nav navbar-nav" style="width:100%;">
                            <a href="{{ route('dashboard') }}" class="mb-4 logo" style="font-size: 1.5rem;text-decoration:none;">
                                <h5 class="py-3 px-4 text-white text-center" style="background:;border-bottom:10px double white;">TEAM LEADER</h5>
                                <div class=""><img src="/images/fav.jpg" alt="logo TEAM LEADER CENTER" class="mg-center mx-auto d-block shadow-md d-none" style="width: 80px;border:5px solid rgb(255, 255, 255);"></div>
                            </a>
                            <div class="pb-2 mt-3" style="border-top:;">
                                <li class="nav-item {{request()->routeIs('dashboard') ? 'active':''}}"><a href="{{ route('dashboard') }}" class="nav-link {{request()->routeIs('dashboard') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-th-large"></i><span>Dashboard</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                <li class="nav-item {{request()->routeIs('students.index') || request()->routeIs('payement.index') || request()->routeIs('badge.index') ? 'active':''}}"><a href="{{ route('students.index') }}" class="nav-link {{request()->routeIs('students.index') || request()->routeIs('payement.index') || request()->routeIs('badge.index')? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-users"></i><span>Students</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                <li class="nav-item {{request()->routeIs('programs.index') ? 'active':''}}"><a href="{{ route('programs.index') }}" class="nav-link {{request()->routeIs('programs.index')? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-calendar"></i><span>Programs</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                <li class="nav-item d-none {{request()->routeIs('certifications.index') ? 'active':''}}"><a href="{{ route('certifications.index') }}" class="nav-link {{request()->routeIs('certifications.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-file-alt"></i><span>Certifications</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                            </div>
                            <div class="pt-2" style="">
                                <li id="admin-task" class="nav-item {{request()->routeIs('formationSession.index') ? 'active':''}}"><a href="{{ route('formationSession.index') }}" class="nav-link {{request()->routeIs('formationSession.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-file"></i><span>Session</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                <li id="admin-task" class="nav-item {{request()->routeIs('formation.index') ? 'active':''}}"><a href="{{ route('formation.index') }}" class="nav-link {{request()->routeIs('formation.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-file"></i><span>Formation</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                <li class="nav-item d-non {{request()->routeIs('notifications.index') ? 'active':''}}"><a href="{{ route('notifications.index') }}" class="nav-link {{request()->routeIs('notifications.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-file"></i><span>Centre</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>

                                <li id="admin-task" class="nav-item {{request()->routeIs('teachers.index') ? 'active':''}}"><a href="{{ route('teachers.index') }}" class="nav-link {{request()->routeIs('teachers.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-chalkboard"></i><span>Teachers</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                <li id="admin-task" class="nav-item {{request()->routeIs('budget.index') ? 'active':''}}"><a href="{{ route('budget.index') }}" class="nav-link {{request()->routeIs('budget.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-wallet"></i><span>Budget</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                
                                <li id="sup-admin-task" class="nav-item d-none {{request()->routeIs('stats.index') ? 'active':''}}"><a href="{{ route('stats.index') }}" class="nav-link {{request()->routeIs('stats.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-chart-pie"></i><span>Stats</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                                <li id="sup-admin-task" class="nav-item d-none {{request()->routeIs('email.index') ? 'active':''}}"><a href="{{ route('email.index') }}" class="nav-link {{request()->routeIs('email.index') ? 'text-primaire':'text-white'}}" style="color: #333"><i class="fa fa-paper-plane"></i><span>Email</span><i class="fa fa-chevron-down float-end p-1"></i></a></li>
                            </div>

                    </div>
                </nav>
                <div class="container-fluid" id="body" style="">
                    <!-- Page Heading -->
                    @isset($header)
                    <header class="">
                        <div class="max-w-7xl mx-auto px-4 py-2 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                    @endisset

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
                
            </div>


        </div>
    <script src="/assets/bootstrap-5/dist/js/bootstrap.bundle.js"></script>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            
            setInterval(() => {
                $.ajax({
                url:'/notifications/getNumber',
                type:'GET',
                success:function(response){
                    if(response.success){
                        if(response.number > 0){
                            $('#nb-notif').css('display','block');
                            $('#nb-notif').html(response.number);
                        }
                        if(response.message_number > 0){
                            $('#nb-message').css('display','block');
                            $('#nb-message').html(response.message_number);
                            console.log(response.message_number);
                        }
                    }
                    }
                })
            }, 3000);
        });
    </script>
    </body>
</html>
