<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-2" id="admin-task">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display:flex;flex-wrap:wrap;justify-content:center;">
            <div class="sm:rounded-lg" style="display:flex;flex-wrap: wrap;justify-content:;">
                <div class="col-12" style="display: flex;flex-wrap:wrap;justify-content:center">
                    <div class="my-2 container p-2 rounded d-flex bg-white shadow" style="width: 330px;">
                        <div><i class="fa fa-users rounded-pill p-3  main-text text-white border-main" style="background: rgb(18, 146, 185);border:none;"></i></div>
                        <div class="px-4">
                            <h6 class="" style="font-size: .8rem">Clean students</h6>
                            <h5>
                                @php
                                    $clean = 0;
                                    foreach ($Payement as $item) {
                                        # code...
                                        if ($item->reste_pay == 0) {
                                            # code...
                                            $clean += 1; 
                                            echo($item->name);
                                        }
                                    }
                                @endphp
                                <span style="color: rgb(18, 146, 185)">{{$clean}}</span>
                                 students</h5>
                        </div>
                    </div>
                    <div class="my-2 container p-2 rounded d-flex bg-white shadow" style="width: 330px;">
                        <div><i class="fa fa-wallet rounded-pill p-3  main-text border-main text-white" style="background: rgb(76, 18, 185);border:none;"></i></div>
                        <div class="px-4">
                            <h6 class="" style="font-size: .8rem">Students with rest</h6>
                            <h5>
                                @php
                                    $with_rest = 0;
                                    foreach ($Payement as $item) {
                                        # code...
                                        if ($item->reste_pay > 0) {
                                            # code...
                                            $with_rest += 1; 
                                            echo($item->name);
                                        }
                                    }
                                @endphp
                                <span style="color: rgb(76, 18, 185)">{{$with_rest}}</span>
                                students</h5>
                        </div>
                    </div>
                    <div class="my-2 container p-2 rounded d-flex bg-white shadow" style="width: 330px;">
                        <div><i class="fa fa-wallet rounded-pill p-3 main-text border-main text-white" style="background: rgb(231, 5, 73);border:none;"></i></div>
                        <div class="px-4">
                            <h6 class="" style="font-size: .8rem">Students who haven't paid</h6>
                            <h5>
                                @php
                                    $have_not = 0;
                                    $counter = 0;
                                    foreach ($Eleve as $item) {
                                        # code...
                                        foreach ($Payement as $item2) {
                                            # code...
                                            if ($item->id == $item2->id_eleve) {
                                                # code...
                                                $counter += 1; 
                                            }
                                        }
                                    }
                                    $have_not = $Eleve->count() - $counter;
                                @endphp
                                <span style="color: rgb(231, 5, 73)">{{$have_not}}</span>
                                 students</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="display: flex;flex-wrap:wrap;justify-content:center">
                    <div class="py-2 px-5 my-2 bg-white shadow rounded container" style="width: 330px;height:200px">
                        <p class="text-secondaire" style="font-size:1.2rem"><b>Number </b> total students :</hp>
                        <h1 class="text-center text-primary">{{$Eleve->count()}}</h4>
                    </div>
                    <div class="bg-white shadow rounded my-2 px-4 container" style="width: 330px;height:200px">
                        <canvas class="my-2" id="mixedChart" width="350" height="200"></canvas>
                    </div>
                    <div class="p-2 bg-white my-2 rounded shadow container" style="width: 330px;height:200px;">
                        <canvas id="daughnutChart" class="col-12" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-center container-fluid p-0 py-2 bg-white shadow " style="max-width:1028px;">
                <div style="display: flex;flex-wrap:wrap;justify-content:space-between">
                    <div class="pt-4 text-secondaire">
                        <h6>LIST OF UNCOMPLETED PAYMENTS</h>
                    </div>
                    <form id="searchForm" style="" class="d-flex my-2" >
                        <i class="fa fa-arrow-left p-2 border rounded-pill mx-5" style="font-size: 1.2rem;visibility:hidden;"></i>
                        <input type="search" id="search" name="search" placeholder="Search" class="rounded form-control" style="width: 330px">
                    </form>
                </div>
                <div class="row container-fluid p-0" style="display: flex;justify-content:center">
                    <div class="table-responsive container-fluid p-0">
                        <table class="table bg-white">
                            <thead class="text-white container" style="background:rgb(6, 126, 182); ">
                                <tr>    
                                    <td>Name</td>
                                    <td>Total</td>
                                    <td>Paid</td>
                                    <td>Rest</td>
                                    <td>Description</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Payement as $item)
                                    @if ($item->reste_pay > 0)
                                        <tr>
                                            @foreach ($Eleve as $item1)
                                                @if ($item1->id == $item->id_eleve)
                                                    <td>
                                                        {{$item1->name}}
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td class="total">{{$item->total_pay}}</td>
                                            <td class="total">{{$item->montant_pay}}</td>
                                            <td class="total">{{$item->reste_pay}}</td>
                                            <td class="total">{{$item->description}}</td>
                                            <td class="total">{{$item->date_pay}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                @php
                                    $english = 0;
                                    $leadership = 0;
                                    $info = 0;
                                    foreach($Eleve as $item){
                                        if ($item->id_formation == 'English') {
                                            # code...
                                            $english += 1;
                                        }elseif ($item->id_formation == 'LeaderShip') {
                                            # code...
                                            $leadership += 1;
                                        }else{
                                            $info += 1;
                                        }
                                    }
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script src="/assets/chart.umd.min.js"></script>
    <script>
        
        
        $(document).ready(function(){

            $('#searchForm').on('submit',function(e){
                e.preventDefault();
                $('.fa-arrow-left').css("visibility","visible");
                var search = $('#searchForm input').val();
                $.ajax({
                    url: '/dashboard/'+search+'/search',
                    type: 'GET',
                    success: (response)=>{
                        if(response.success){
                            $('.table tbody').html('');
                            var data = response.data;
                            console.log(data);
                            data.forEach(function(result){
                                console.log(result);
                                $('.table tbody').append(`
                                        <tr>
                                            <td>
                                                ${result.name}
                                            </td>
                                            <td class="total">${result.total_pay}</td>
                                            <td class="total">${result.montant_pay}</td>
                                            <td class="total">${result.reste_pay}</td>
                                            <td class="total">${result.description}</td>
                                            <td class="total">${result.date_pay}</td>
                                        </tr>
                                `);
                            });
                        }else{
                            $('.table tbody').html(`
                                        <tr>
                                            <td>
                                                <h4>No result</h4>
                                            </td>
                                        </tr>
                                `);
                        }
                    }
                })
            });

            
            $('.fa-arrow-left').on("click",function(){
                $('.fa-arrow-left').css("visibility","hidden");
                $('.table tbody').html(`
                    
                                @foreach ($Payement as $item)
                                    @if ($item->reste_pay > 0)
                                        <tr>
                                            @foreach ($Eleve as $item1)
                                                @if ($item1->id == $item->id_eleve)
                                                    <td>
                                                        {{$item1->name}}
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td class="total">{{$item->total_pay}}</td>
                                            <td class="total">{{$item->montant_pay}}</td>
                                            <td class="total">{{$item->reste_pay}}</td>
                                            <td class="total">{{$item->description}}</td>
                                            <td class="total">{{$item->date_pay}}</td>
                                        </tr>
                                    @endif
                                @endforeach
            
                `);

            });
            formations = new Array();
            numbers = new Array();
            $.ajax({
                url: '/dashboard/get',
                type:'GET',
                success: function(response){
                    if(response.success){
                        let data = response.formations;
                        data.forEach(function(dt){
                            formations.push(dt.nom_formation);
                            numbers.push(dt.number);
                        });
                        
                        var ctx2 =  $('#mixedChart')[0].getContext('2d');
                            var mixedChart = new Chart(ctx2,{
                                type: 'bar',
                                data:{
                                    labels:formations,
                                    datasets:[{
                                        label: 'STUDENTS NUMBER VARIATION',
                                        data:numbers,
                                        backgroundColor: [
                                            'rgb(6, 126, 182)',
                                            'rgb(29, 184, 75)',
                                            'rgb(231, 5, 73)'
                                        ],
                                    }],

                                },
                                options:{
                                    responsive:true,
                                }
                            });
                    }
                }
            })
            console.log(formations);
            console.log(numbers);
            var ctx = $('#daughnutChart')[0].getContext('2d');
            var chart = new Chart(ctx,{
                type: 'doughnut',
                data:{
                    labels:['Clean','Others'],
                    datasets:[{
                        data:[{{$clean}},{{$with_rest + $have_not}}],
                        backgroundColor: [
                            'rgb(29, 184, 75)',
                            'rgb(231, 5, 73)',
                        ],
                    }],

                },
                options:{

                    elements: {
                        center: {
                            text: 'Total: 44',
                            color: '#FF634', //Couleur du text
                            fontStyle: 'Arial',//Style de police
                            sidePadding: 20 //Remplissage autour texte
                        }
                    },
                    responsive:true,
                    maintainAspectRatio: false,
                }
            });
        });
    </script>
</x-app-layout>
