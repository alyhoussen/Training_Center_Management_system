<x-app-layout>
    <div id="uploadStatus" class="m-2 container" style="z-index: 10000;position:fixed;top:5px;max-width:82%;"></div>
    <div class="modal" id="deletePaymentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Confirmation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer"><button type="button" class="btn btn-danger btn-sm px-4 rounded-pill" id="confirm-delete-record" record-id="" data-bs-dismiss="modal" onclick="sendDeleteId(this)">Yes</button><button type="button" class="btn rounded-pill px-4 btn-sm" data-bs-dismiss="modal" style="background: #eee">No</button></div>
            </div>
        </div>
    </div>
    <div class="modal" id="outstanding">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Outstanding</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form class="container-fluid" id="outstandingForm" enctype="multipart/form-data">
                        <div>
                            <div class="">
                                <div class="pb-2 px-2">
                                    <label for="name" class="pt-1">Name</label>
                                    <input type="text" id="name" name="name" readonly class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="surname" class="pt-1">Surname</label>
                                    <input type="text" id="surname" name="surname" readonly class="form-control">
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-2 px-2">
                                    <label for="email" class="pt-1">Email</label>
                                    <input type="text" id="email" name="email" readonly class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="description" class="pt-1">Description</label>
                                    <input type="text" id="description"readonly name="description" class="form-control">
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-2 px-2">
                                    <label for="amountPay" class="pt-1">Total to pay</label>
                                    <input type="number" id="amountPay" readonly name="amountPay" class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="amountPaid" class="pt-1">Amount paid</label>
                                    <input type="number" id="amountPaid"readonly name="amountPaid" class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="rest" class="pt-1" >Rest</label>
                                    <input type="number" id="rest"readonly name="rest" class="form-control">
                                </div>
                            </div>
                            <div class="">
                                <div class="px-2">
                                    <label for="pay" class="pt-1 text-success" ><h5>PAY:</h5></label>
                                    <input type="number" id="pay" name="pay" class="form-control" required>
                                </div>
                            </div>
                            <input type="number" id="id-pay" style="display: none;">
                        </div>
                        <div class="py-2">
                            <div class="p-2 d-grid">
                                <button type="submit" class="btn btn-primaire px-3 btn-block">Confirm payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="newPayment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>New payment</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form class="containe" id="payementForm" enctype="multipart/form-data"> 
                        <div>
                            <div class="px-2">
                                <div class="pb-2 px-2">
                                    <label for="name" class="pt-1">Name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="surname" class="pt-1">Surname</label>
                                    <input type="text" id="surname" name="surname" class="form-control">
                                </div>
                            </div>
                            <div class="px-2">
                                <div class="pb-2 px-2">
                                    <label for="email" class="pt-1">Email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="description" class="pt-1">Description</label>
                                    <select name="description" class="form-control" id="description">
                                        <option value="school fee">School fee</option>
                                        <option value="cotisation">Cotisation</option>
                                    </select>
                                </div>
                            </div>
                            <div class="px-2">
                                <div class="pb-2 px-2">
                                    <label for="amountPay" class="pt-1">Amount to pay</label>
                                    <input type="number" id="amountPay" name="amountPay" class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="amountPaid" class="pt-1">Amount paid</label>
                                    <input type="number" id="amountPaid" name="amountPaid" class="form-control">
                                </div>
                                <div class="pb-2 px-2">
                                    <label for="state" class="pt-1" >State</label>
                                    <select name="state" class="form-control" id="state">
                                        <option value="paid">Paid</option>
                                        <option value="notPaid">Not paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 py-2 ">
                            <div class="p-2 d-grid">
                                <button type="submit" class="btn btn-primaire px-3">Confirm payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="header" class="container-fluid">
        <div class="d-flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Students/Payement') }}
            </h2>
            <div class="btn-group">
                <a href="{{route('students.index')}}" class="btn btn-light btn-group-item rounded-pill m-1">Students</a>
                <a href="{{route('payement.index')}}" class="btn btn-light btn-group-item active rounded-pill m-1">Payments</a>
                <a href="{{route('badge.index')}}" class="btn btn-light btn-group-item rounded-pill m-1">Badge</a>
            </div>
        </div>
    </x-slot>
    <style></style>
    <div class="py-2 container">
            <div class="container-fluid p-0 pb-2 mb-2">
                <div class="pb-2 mb-2 rounded-lg" style="z-index: 2;display:flex;flex-wrap:wrap-reverse;justify-content:space-between;" id="search-box">
                    <form class="text-right" id="searchForm">
                        <div class="input-group border bg-white shadow rounded">
                            <i class="fa fa-arrow-left bg-white px-3 py-2" style="display: none;" onclick="refresh()"></i>
                            <button class="btn input-group-text text-black text-center" style="background:#ffffff;color:#b4b4b4;"><i class="fa fa-search"></i></button>
                            <input type="search" name="searchInput" id='searchInput' placeholder="Search" class="form-control" style="border: none;">
                        </div>
                    </form>
                    <div class="grid" style="display:flex;flex-wrap:wrap-reverse;">
                        <div class="d-flex py-1">
                            <label for="description" onchange="" class="pt-2 px-2" class="text-primary"><h6>Description</h6></label>
                            <select name="description" class="form-control shadow border-0" onchange="filter(this)" id="description">
                                <option value="all">All</option>
                                <option value="school fee">School fee</option>
                                <option value="cotisation">Cotisation</option>
                            </select>
                        </div>
                        <div class="py-1">
                            <button class="btn btn float-end" style="background:rgb(6, 126, 182);color:white;" data-bs-toggle="modal" data-bs-target="#newPayment">New payment</button><button class="btn btn float-end mx-2 shadow" style="background:#ffffff;" data-bs-toggle="modal" data-bs-target="#outstanding">Outstanding</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive bg-white shadow">
                    <table class="table" style="min-width: 700px;">
                        <thead style="color:white" class="main-bg">
                        <tr>
                            <td>ID</td>
                            <td>Student</td>
                            <td>Total</td>
                            <td>Paid</td>
                            <td>Rest</td>
                            <td>Description</td>
                            <td>Date</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        
        $(document).ready(function(){
            display();
            $('#payementForm').on('submit', function (e){
                e.preventDefault();
                var formData = new FormData(this);
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('payement.store') }}",
                    type: "GET",
                    data: {
                        name: $('#payementForm #name').val(),
                        surname:$('#payementForm #surname').val(),
                        email:$('#payementForm #email').val(),
                        description:$('#payementForm #description').val(),
                        amountPay:$('#payementForm #amountPay').val(),
                        amountPaid:$('#payementForm #amountPaid').val(),
                        amountRest:($('#payementForm #amountPay').val()-$('#payementForm #amountPaid').val()),
                    },
                    success: function(response){
                        console.log(response.request);
                        if(response.success){
                            $('#uploadStatus').html( `
                            <div class="alert alert-success alert-dismissible">
                                <button class="btn-close" data-bs-dismiss="alert"></button><div>Payement recorded successfully!</div>
                            </div>`);
                            display();
                        }
                        else{
                            let errors= response.data;
                            let errorMessage = '';
                            if(errors){
                                for (let field in errors){
                                    errorMessage += field+":"+errors[field].join(',')+'<br>';
                                }
                                $('#uploadStatus').html('<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>'+errorMessage+'</div>');
                            }else{
                                $('#uploadStatus').html('<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>No student matches those given informations!</div>');
                            
                            }
                        }
                    },
                });
            });
            $('#searchForm').on('submit', function(e){
                e.preventDefault();
                $('.fa-arrow-left').css('display','block');
                var value = $('#searchInput').val();
                $.ajax({
                    url: "/payement/"+value+"/search",
                    type: "GET",
                    success: function(response){
                        if(response.success){
                            display(response.payments);
                        }else{
                            $('.table tbody').html(`<div class='text-center' style="color:var(--text-secondary);"><h6>No result</h6></div>`);
                        }
                    }
                })

            });
            $('#outstandingForm').on('submit',function(e){
                e.preventDefault();
                let idOutstanding = $('#outstandingForm #id-pay').val();
                let value  = $('#outstandingForm #pay').val();
                $.ajax({
                    url:'/payement/'+idOutstanding+'-'+value+'/update',
                    type:'GET',
                    success: function(response){
                        if(response.success){
                            display();
                            $('#uploadStatus').html( `
                            <div class="alert alert-success alert-dismissible">
                                <button class="btn-close" data-bs-dismiss="alert"></button><div>Payement updated successfully!</div>
                            </div>`);
                        }else{
                            $('#uploadStatus').html( `
                            <div class="alert alert-success alert-dismissible">
                                <button class="btn-close" data-bs-dismiss="alert"></button><div>No recorded selected!</div>
                            </div>`);
                        }
                    }
                });
            });
        });
        function deleteRecord(item){
            $('#confirm-delete-record').attr('record-id',$(item).attr('id-pay'));
        }
        function sendDeleteId(item){
            var recordId = $(item).attr('record-id');
            $.ajax({
                url: '/payement/'+recordId+'/delete',
                type: 'GET',
                success:function(response){
                    if(response.success){
                        $('#uploadStatus').html(`
                        <div class="alert alert-success alert-dismissible">
                            <button class="btn-close" data-bs-dismiss="alert"></button>Record deleted successfully!
                        </div>`
                        );
                        display();
                    }else{
                        $('#uploadStatus').html(`
                        <div class="alert alert-danger alert-dismissible">
                            <button class="btn-close" data-bs-dismiss="alert"></button>Record does not exist!
                        </div>`
                        )
                    }
                },
            })
        }
        $('#search-box #description').change(

        );
        function openOutstandingForm(item){
                $('#outstanding').modal('show');
                let id = $(item).attr('id-pay');
                let idPay = $('#payment-'+id+' #id_pay').html();
                let name = $('#payment-'+id+' #student').html();
                let surname = $('#payment-'+id+' #surname').html();
                let email = $('#payment-'+id+' #email').html();
                let totalPay = $('#payment-'+id+' #total_pay').html();
                let montantPaid = $('#payment-'+id+' #montant_pay').html();
                let restePay = $('#payment-'+id+' #reste_pay').html();
                let description = $('#payment-'+id+' #description').html();

                $('#outstandingForm #name').val(name);
                $('#outstandingForm #surname').val(surname);
                $('#outstandingForm #email').val(email);
                $('#outstandingForm #amountPay').val(totalPay);
                $('#outstandingForm #amountPaid').val(montantPaid);
                $('#outstandingForm #rest').val(restePay);
                $('#outstandingForm #description').val(description);
                $('#outstandingForm #id-pay').val(id);
                $('#outstanding').addClass('show');
        }
        $('#closeOutstanding').click(function(){
            $('#outstanding').removeClass('show');
        })
        function filter(entry){
            if($(entry).val()== "all"){
                display();
            }else{
                $.ajax({
                        url: "/payement/"+$(entry).val()+"/filter",
                        type: "GET",
                        success: function(response){
                            if(response.success){
                                display(response.payments);
                            }else{
                                $('.table tbody').html(`<div class='text-center' style="color:var(--text-secondary);"><h6>No result</h6></div>`);
                            }
                        }
                })
            }
        }
        function refresh(){
            $('.fa-arrow-left').css('display','none');
            display();
        }
        function display(entry){
            if(entry){
                if(entry.length>0){
                    $('tbody').html('');
                            entry.forEach(function(payement){
                                let status='';
                                if(payement.reste_pay>0){
                                    status = `<label for="pay" class="px-3 rounded-pill mx-1 py-0 ingoing" style="cursor: pointer;" onclick="openOutstandingForm(this)" id-pay="${payement.id}">Pay</label>                                    
                                    `;
                                }else{
                                    status = `<span><i class='fa fa-check px-4 green'></i></span>`;
                                }
                                $('tbody').append(`
                                    <tr id="payment-${payement.id}">
                                        <td id="id_pay">${payement.id}</td>
                                        <td id="student">${payement.name}</td>
                                        <td id="surname" style="display:none">${payement.surname}</td>
                                        <td id="email" style="display:none">${payement.email}</td>
                                        <td id="total_pay">${payement.total_pay}</td>
                                        <td id="montant_pay">${payement.montant_pay}</td>
                                        <td id="reste_pay">${payement.reste_pay}</td>
                                        <td id="description">${payement.description}</td>
                                        <td id="date_pay">${payement.date_pay}</td>
                                        <td id="actions">
                                            <span id="payment-status">
                                                ${status}
                                            </span>
                                            <span class="p-1 px-2 mx-1 outgoing rounded" onclick="deleteRecord(this)" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deletePaymentModal" id="sup-admin-task" id-pay="${payement.id}">Delete</span>
                                        </td>
                                    </tr> 
                                `);
                            });
                }else{
                    $('tbody').html('<h5 class="text-center">No result</h5>')
                }
            }
            else{
                $('.modal').modal('hide');
                $("tbody").html('');
                $.ajax({
                    url: '/payement/get',
                    type: 'GET',
                    success:function(response){
                        if(response.success){
                            let payments = response.payments; 
                            $('tbody').html('');
                            payments.forEach(function(payement){
                                let status='';
                                if(payement.reste_pay>0){
                                    status = `<label for="pay" class="px-3 rounded-pill mx-1 py-0 ingoing" style="cursor: pointer;" onclick="openOutstandingForm(this)" id-pay="${payement.id}">Pay</label>                                    
                                    `;
                                }else{
                                    status = `<span><i class='fa fa-check px-4 green'></i></span>`;
                                }
                                $('tbody').append(`
                                    <tr id="payment-${payement.id}">
                                        <td id="id_pay">${payement.id}</td>
                                        <td id="student">${payement.name}</td>
                                        <td id="surname" style="display:none">${payement.surname}</td>
                                        <td id="email" style="display:none">${payement.email}</td>
                                        <td id="total_pay">${payement.total_pay}</td>
                                        <td id="montant_pay">${payement.montant_pay}</td>
                                        <td id="reste_pay">${payement.reste_pay}</td>
                                        <td id="description">${payement.description}</td>
                                        <td id="date_pay">${payement.date_pay}</td>
                                        <td id="actions">
                                            <span id="payment-status">
                                                ${status}
                                            </span>
                                            <span id="sup-admin-task" class="p-1 px-2 mx-1 outgoing rounded" onclick="deleteRecord(this)" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deletePaymentModal" id-pay="${payement.id}">Delete</span>
                                        </td>
                                    </tr> 
                                `);
                            });
                        }else{
                            $('tbody').html('<h5 class="text-center">No payment recorded</h5>')
                        }
                    }
                });
            }
        }
    
    </script>
</x-app-layout>