<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/bootstrap-5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
</head>
<style>
</style>
<body class="bg-light p-5" style="display: flex;justify-content:center;">
    <div class=" container" style="display:flex;flex-wrap:wrap; justify-content:center;">
        <div class=" pt-0 m-3 shadow-lg" style="z-index:1000;max-width:600px;text-align:justify;background: rgb(3, 161, 122);">
            <div style="height: 50px;" class=""></div>
            <div class="p-2 px-5 bg-white">
                <h3 class="" style="color: rgb(3, 161, 122);">TEAM LEADER CENTER</h3>
                <p><b>Wellcome!</b> This application is only for authorised users, which
                     are: <b> teachers, developper, administrator </b>and only other 
                     users who has permission from the administrator to access it .
                    <br>
                    If you are amoung those mentioned, type the button
                     "Connexion" to start or "Register" if you dont have an acount yet.
                </p>
                <div class="text-center"><a href="{{route('login')}}" class="btn rounded-pill text-white m-2" style="background:  rgb(3, 161, 122)">Connexion <i class="fa fa-chevron-right"></i></a><a href="{{route('register')}}" class="btn rounded-pill text-white" style="background:  rgb(6, 126, 182);">Register<i class="fa fa-chevron-right"></i></a></div>
            </div>
        </div>
    </div>
    <img src="/images/backgroud.png" style="width:100%;position:fixed;height:800px;bottom:0;z-index:-1" alt="">

</body>
<script src="/assets/bootstrap-5/dist/js/bootstrap.min.js"></script>
</html>