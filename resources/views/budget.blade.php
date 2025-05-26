<x-app-layout>
    <style>
        .fa-dollar-sign{
            background: rgba(18, 146, 185, 0.11);
            color: rgb(18, 146, 185);
            font-size: 1.5rem;
            padding: .5rem;  
            border-radius: 10px;
            margin-right: 1rem;
        }
        .fa-minus{
            color: rgb(231, 5, 73);
            margin-right: .5rem;
        }
        .fa-plus{
            color: rgb(10, 202, 106);
            margin-right: .5rem;
        }
    </style>
    <div id="uploadStatus" class="m-2 container" style="z-index: 100000;position:fixed;top:5px;max-width:82%;"></div>
    <x-slot name="header">
        <div class="modal" id="ingoing">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><h4>Ingoing</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <form class="d-grid" enctype="multipart/form-data">
                            <label for="somme">Amount</label>
                            <input type="number" id="somme" name="somme" class="form-control">
                            <label for="type">Type</label>
                            <input type="text" id="type" name="type" value="Ingoing" class="form-control" readonly>
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" class="form-control">
                            <button class="btn btn-primaire btn-block my-2">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="outgoing">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><h4>Outgoing</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <form class="d-grid">
                            <label for="somme">Amount</label>
                            <input type="number" id="somme" name="somme" class="form-control">
                            <label for="type">Type</label>
                            <input type="text" id="type" name="type" value="Outgoing" class="form-control" readonly>
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" class="form-control">
                            <button class="btn btn-primaire btn-block my-2">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-2" style="border-bottom-left-radius:50px;border-bottom-right-radius:50px;" id="sup-admin-task">
            <h2 class="font-semibold text-xl leading-tight pb-2">
                {{ __('Budgets') }}
            </h2>
            <div style="display: flex;flex-wrap:wrap;justify-content:center;">
                <div class="" style="display: flex;flex-wrap:wrap;justify-content:center;">
                    <div class="d-grid">
                        <div class="bg-white shadow my-2 p-4 rounded container" style="width: 330px;">
                            <h6 class=""><i class="fa fa-dollar-sign"></i>Total budget</h6>
                            <h2 class="text-center pt-5" style=""><i class="fa fa-plus"></i>Ar 
                                <span id="total_budget">{{$total_budget}}</span>
                            </h2>
                        </div>
                    </div>
                    <div style="">
                        <div class="bg-white shadow my-2 p-4 rounded container mx-2" style="width: 330px;">
                            <h6 class=""><i class="fa fa-dollar-sign"></i>Depense <span class="float-end" style="font-size:.8rem;color:rgb(18, 146, 185);">Ce mois ci.</span></h6>
                            <h6 class="text-center pt-2"><i class="fa fa-minus"></i>Ar 
                                <span id="depense">{{$depense}}</span>
                            </h6>
                        </div>
                        <div class="bg-white shadow my-2 p-4 rounded container mx-2" style="width: 330px;">
                            <h6 class=""><i class="fa fa-dollar-sign"></i>Rest</h6>
                            <h6 class="text-center pt-2" style="color:"><i class="fa fa-plus"></i>Ar 
                                <span id="rest">{{$rest}}</span>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow my-2 pb-4 rounded overflow-hidden">
                    <h5 class="p-3 m-2" style="border-radius: 3px;">Scholl fee</h5>
                    <div class="rounded container" style="width:330px;">
                        <span class="green">Paid</span>
                        <span class="text-center float-end"><i class="fa fa-plus"></i><span id="paid_fee">{{$paid_fee}}</span></span>
                    </div>
                    <div class="rounded container " style="width:330px;">
                        <span class="red">Unpaid</span>
                        <span class="text-center float-end"><i class="fa fa-minus"></i><span id="unpaid_fee">{{$unpaid_fee}}</span></span>
                    </div>
                    <h5 class="p-3 m-2" style="border-radius: 3px;">Cotisation <span></span></h5>
                    <div class="rounded container" style="width:330px;">
                        <span class="green">Paid</span>
                        <span class="text-center float-end"><i class="fa fa-plus"></i><span id="paid_cotisation">{{$paid_cotisation}}</span></span>
                    </div>
                    <div class="rounded container" style="width:330px;">
                        <span class="red">Unpaid</span>
                        <span class="text-center float-end"><i class="fa fa-minus"></i><span id="unpaid_cotisation">{{$unpaid_cotisation}}</span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="list" style="display: flex;flex-wrap:wrap-reverse;justify-content:center;">
            <div class="table-responsive bg-white shadow container px-2">
                <div style="display: flex;flex-wrap:wrap;justify-content:end;">
                    <button class="btn my-2 text-white" style="background:rgb(231, 5, 73);" data-bs-toggle="modal" data-bs-target="#outgoing">Spend</button>
                    <button class="btn my-2 text-white" style="margin-left:1rem;background:rgb(18, 146, 185)" data-bs-toggle="modal" data-bs-target="#ingoing">Add balance</button>
                </div>
                <h5 class="my-3 mx-2">Transaction list</h5>
                <table class="table">
                    <thead class="text-white" style="background: rgb(18, 146, 185);">
                        <tr>
                            <td>ID</td>
                            <td>Amount</td>
                            <td>By</td>
                            <td class="text-center">Type</td>
                            <td>Description</td>
                            <td>Date</td>
                            <td>State</td>
                            <td id="sup-admin-task">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </x-slot>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            display();
        });
        $('.modal form').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            for(var pair of formData.entries())
            {
                console.log(pair[0]+':'+pair[1]);
            }
            
            var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:"{{ route('budget.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.success){
                            display();
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Transaction successfull</div></div>');
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Cannot make transaction!</div></div>');
                        }
                    },
                    error: function(response){
                        let errors= response.responseJSON.errors;
                        console.log(errors);
                        let errorMessage = '';
                        for (let field in errors){
                            errorMessage += field+":"+errors[field].join(',')+'<br>';
                        }
                        $('#uploadStatus').html('<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>'+errorMessage+'</div>');
                    }
                });
        });
        function verify(item,value){
            let id = $(item).attr('id-item');
            $.ajax({
                url: `/budget/${id}-${value}/verify`,
                type: 'GET',
                data:'no data',
                success:function(response){
                    if(response.success){
                        display();
                    }
                }
            });
        }
        function display(){
                $('.modal').modal('hide');
                $.ajax({
                    url: '/budget/get',
                    type: 'GET',
                    success:function(response){
                                if(response.success){
                                    $('#total_budget').html(response.total_budget);
                                    $('#rest').html(response.rest);
                                    $('#depense').html(response.depense);
                                    $('#paid_fee').html(response.paid_fee);
                                    $('#unpaid_fee').html(response.unpaid_fee);
                                    $('#paid_cotisation').html(response.paid_cotisation);
                                    $('#unpaid_cotisation').html(response.unpaid_cotisation);
                                    $('.table tbody').html('');
                                    let result = response.data;
                                    result.forEach(function(data){
                                        if(data.id >1){
                                            let action = '';
                                            //type styling
                                            if(data.type == 'Ingoing'){
                                                data.type =`<span class="label rounded-pill p-1 px-3 ingoing" style="">${data.type}</span>`;
                                            }else{
                                                data.type =`<span class="label rounded-pill p-1 px-3 outgoing" style="">${data.type}</span>`;
                                            }
                                            //state styling
                                            if(data.state == 'Pending'){
                                                data.state = `<span class="rounded-pill px-3 py-1 pending">${data.state}</span>`;
                                                action = `<span class="verify dropdown" id="sup-admin-task">
                                                                <span class="dropdown-toggle" data-bs-toggle="dropdown">Verify</span>
                                                                <ul class="dropdown-menu">
                                                                    <li><span class="dropdown-item green" id-item="${data.id}" onclick="verify(this,'verified')">Aproove</span></li>
                                                                    <li><span class="dropdown-item red" id-item="${data.id}" onclick="verify(this,'rejected')">Reject</span></li>
                                                                </ul>
                                                            </span>`;
                                            }else {
                                                action = `<span class="px-3" id="sup-admin-task"><i class="green fa fa-check"></i></span>`;
                                                if(data.state == 'verified'){
                                                    data.state = `<span class="rounded-pill px-3 py-1 verified">${data.state} <i class="fa fa-check green"></i></span>`;
                                                }else{
                                                    data.state = `<span class="rounded-pill px-3 py-1 red" style="font-size:.8rem;">${data.state}</span>`;
                                                }
                                            }
                                            $('.table tbody').append(`
                                                <tr>
                                                    <td>${data.id-1}</td>
                                                    <td>Ar ${data.somme}</td>
                                                    <td>${data.user}</td>
                                                    <td class="text-center">
                                                        ${data.type}
                                                    </td>
                                                    <td>${data.description}</td>
                                                    <td>${data.date}</td>
                                                    <td>
                                                        ${data.state}
                                                    </td>
                                                    <td>
                                                        ${action}
                                                    </td>
                                                </tr>
                                            `);
                                        }
                                    });
                            }
                        }
            });
        }
    </script>
</x-app-layout>