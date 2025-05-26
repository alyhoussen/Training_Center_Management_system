<x-app-layout>
    <div id="uploadStatus" class="m-2 container" style="z-index: 10000;position:fixed;top:5px;max-width:82%;"></div>
    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Confirmation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer"><button type="button" class="btn btn-danger btn-sm px-4 rounded-pill" id="confirm-delete-record" id-item="" data-bs-dismiss="modal" onclick="del(this)">Yes</button><button type="button" class="btn rounded-pill px-4 btn-sm" data-bs-dismiss="modal" style="background: #eee">No</button></div>
            </div>
        </div>
    </div>
    <div class="modal" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>New scedule</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body p-3">
                    <form id="newForm">
                        <div class="">
                            <label for="day" class="">Day</label>
                            <select name="day" id="day" class="form-control">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="hour" class="">Hour</label>
                            <input type="time" name="hour" id="hour" class="form-control">
                        </div>
                        <div class="">
                            <label for="formation" class="">Formation</label>
                            <input type="text" name="formation" id="formation" class="form-control">
                        </div>
                        <div class="">
                            <label for="level" class="">Level</label>
                            <input type="text" name="level" id="level" class="form-control">
                        </div>
                        <div class="">
                            <label for="teacher" class="t">Teacher</label>
                            <input type="text" name="teacher" id="teacher" class="form-control">
                        </div>
                        <div class="">
                            <label for="centre" class="">Centre</label>
                            <select name="centre" id="centre" class="form-control">
                                @foreach ($centres as $item)
                                    <option value="{{$item->ville}}">{{$item->ville}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="date" class="">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                        <div class="">
                            <label for="type" class="">Type</label>
                            <input type="text" name="type" id="type" class="form-control">
                        </div>
                        <div class="text-center d-grid input-group">
                            <button class="btn btn-block text-white btn-primaire">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Edit form</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body container-fluid">
                    <form id="editForm" class="">
                        <div class="">
                            <label for="day" class="">Day</label>
                            <input type="text" name="day" id="day" class="form-control">
                        </div>
                        <div class="">
                            <label for="hour" class="">Hour</label>
                            <input type="time" name="hour" id="hour" class="form-control">
                        </div>
                        <div class="">
                            <label for="formation" class="">Formation</label>
                            <input type="text" name="formation" id="formation" class="form-control">
                        </div>
                        <div class="">
                            <label for="level" class="">Level</label>
                            <input type="text" name="level" id="level" class="form-control">
                        </div>
                        <div class="">
                            <label for="teacher" class="">Teacher</label>
                            <input type="text" name="teacher" id="teacher" class="form-control">
                        </div>
                        <div class="">
                            <label for="date" class="">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                        <div class="">
                            <label for="type" class="">Type</label>
                            <input type="text" name="type" id="type" class="form-control">
                        </div>
                        <div class="text-center d-grid input-group">
                            <button class="btn btn-block text-white btn-primaire mt-2" id-item="" data-bs-dismiss="modal" data-bs-target="editModal">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Programs') }}
        </h2>
    </x-slot>
    <style>
        .input-group-text{
            width: 100px;
            background:  #ffffff;
        }
        .input-group{
            margin: .2rem;
        }

    </style>

    <div class="container mb-4" id="student-task">
        <div class="container p-3 shadow bg-white rounded border">
            <div style="display: flex;flex-wrap:wrap;justify-content:space-between;" class="bg-white ">
                <h5>Week program</h5>
                <div class="text-center">
                    <div style="display: flex;flex-wrap:wrap;">
                        <div class="mx-2" id="sup-admin-task">
                            <label for="centre" class="">Centre</label>
                            <select name="cente" id="centre" class="form-control px-4" onchange="filter()">
                                @foreach ($centres as $item)
                                    <option value="{{$item->ville}}" class="hover:bg-primary">{{$item->ville}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mx-2">
                            <label for="from" class="">Week of</label>
                            <select name="from" id="from" class="form-control px-4" onchange="filter()">
                                <option value="2024-08-12/2024-08-18">12-08-2024 to 18-08-2024</option>
                                <option value="2024-08-19/2024-08-25">19-08-2024 to 25-08-2024</option>
                                <option value="2024-08-26/2024-09-02">26-08-2024 to 02-09-2024</option>
                                <option value="2024-09-03/2024-09-09">03-09-2024 to 09-09-2024</option>
                                <option value="2024-09-10/2024-09-16">10-09-2024 to 16-09-2024</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primaire my-2 float-end" style="display: none;" id="filterBtn" onclick="getEdt()">Confirm</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table my-3 table-bordered table-stripped">
                    <thead class="text-primaire bg-light">
                        <tr>
                            <td>Monday</td>
                            <td>Tuesday</td>
                            <td>Wednesday</td>
                            <td>Thursday</td>
                            <td>Friday</td>
                            <td>Saturday</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="Monday"></td>
                            <td class="Tuesday"></td>
                            <td class="Wednesday"></td>
                            <td class="Thursday"></td>
                            <td class="Friday"></td>
                            <td class="Saturday"></td>
                        </tr>   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="container" id="sup-admin-task" style="">
        <div>
            <div>
                <button class="btn mb-2 " style="color: rgb(6, 126, 182);border:1px solid rgb(6, 126, 182);" onclick="document.getElementById('student-task').style.display = 'block'">Show schedule</button>
                <button class="btn mb-2 text-white" data-bs-toggle="modal" data-bs-target="#add" style="background: rgb(6, 126, 182);">New schedule</button>
            </div>
            <div class="container table-responsive p-0 bg-white shadow rounded" style="font-size:.8rem;">
                <table class="table">
                    <thead class="main-bg text-white">
                        <tr>
                            <td>Day</td>
                            <td>Date</td>
                            <td>Hour</td>
                            <td>Type</td>
                            <td>Formation</td>
                            <td>Level</td>
                            <td>Teacher</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($edts as $item)
                            <tr id='{{$item->id}}'>
                                <td>{{$item->jour}}</td>
                                <td>{{$item->date_edt}}</td>
                                <td>{{$item->heur}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->nom_formation}}</td>
                                <td>{{$item->niveau}}</td>
                                <td>{{$item->nom_enseignant}}</td>
                                <td><span id-item='{{$item->id}}' class="verify" data-bs-toggle="modal" data-bs-target="#editModal" onclick="sendEditId(this)"> edit</span><span id-item='{{$item->id}}'  onclick="sendDeleteId(this)" class="pending rounded mx-2" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            getEdt();
        })
        $('#newForm').on('submit', function (e){
                e.preventDefault();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('programs.store') }}",
                    type: "GET",
                    data: {
                        day: $('#day').val(),
                        hour: $('#hour').val(),
                        date: $('#date').val(),
                        level: $('#level').val(),
                        formation: $('#formation').val(),
                        teacher: $('#teacher').val(),
                        type: $('#type').val(),
                        centre: $('#centre').val(),
                    },
                    success: function(response){
                        if(response.success){
                            console.log("success");
                            $('.table tbody').append(`
                                <tr id="${response.data.id}">
                                    <td>${$('#day').val()}</td> 
                                    <td>${$('#hour').val()}</td> 
                                    <td>${$('#date').val()}</td> 
                                    <td>${$('#level').val()}</td> 
                                    <td>${$('#formation').val()}</td> 
                                    <td>${$('#teacher').val()}</td> 
                                    <td>${$('#type').val()}</td>                             
                                    <td>
                                        <span id-item='${response.data.id}' class="verify" data-bs-toggle="modal" data-bs-target="#editModal" onclick="sendEditId(this)"> edit</span>
                                        <span id-item='${response.data.id}'  onclick="sendDeleteId(this)" class="pending rounded mx-2" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</span>
                                    </td>
                                </tr>
                            
                            `);
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Student added successfuly!</div></div>');
                        }
                    },
                    error:function(response){
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
       
        function sendDeleteId(item){
            $("#deleteModal .btn-danger").attr('id-item',$(item).attr('id-item'));
        }
        function del(item){
            $.ajax({
                    url: "/programs/"+$(item).attr('id-item')+"/delete",
                    type: "GET",
                    success: function(response){
                        if(response.success){
                            console.log("success");
                            $('table #'+$(item).attr('id-item')).remove();
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Record deleted successfuly!</div></div>');
                        }
                    },
                    error:function(response){
                        let errors= response.responseJSON.errors;
                            console.log(errors);
                            let errorMessage = '';
                            for (let field in errors){
                                errorMessage += field+":"+errors[field].join(',')+'<br>';
                            }
                            $('#uploadStatus').html('<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>'+errorMessage+'</div>');
                    
                    }
                });
        }
        function sendEditId(item){
            $.ajax({
                    url: "/programs/"+$(item).attr('id-item')+"/search",
                    type: "GET",
                    success: function(response){
                        $('#editModal #day').val(response.data.jour);
                        $('#editModal #hour').val(response.data.heur);
                        $('#editModal #date').val(response.data.date_edt);
                        $('#editModal #formation').val(response.data.nom_formation);
                        $('#editModal #teacher').val(response.data.nom_enseignant);
                        $('#editModal #level').val(response.data.niveau);
                        $('#editModal #type').val(response.data.type);
                        $('#editModal button').attr('id-item',response.data.id);
                    }
                });
        }
        $('#editForm').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                    url: "/programs/edit",
                    type: "GET",
                    data: {
                        jour:$('#editModal #day').val(),
                        heur: $('#editModal #hour').val(),
                        date: $('#editModal #date').val(),
                        formation:$('#editModal #formation').val(),
                        teacher: $('#editModal #teacher').val(),
                        niveau: $('#editModal #level').val(),
                        type: $('#editModal #type').val(),
                        id:$('#editModal button').attr('id-item'),
                    },
                    success: function(response){
                        if(response.success){
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Record modified successfuly!</div></div>');
                            $('table #'+response.data.id).html(`
                                    <td>${response.data.jour}</td> 
                                    <td>${response.data.date_edt}</td> 
                                    <td>${response.data.heur}</td> 
                                    <td>${response.data.type}</td> 
                                    <td>${response.data.nom_formation}</td> 
                                    <td>${response.data.niveau}</td>  
                                    <td>${response.data.nom_enseignant}</td>                                  
                                    <td>
                                        <span id-item='${response.data.id}' class="verify" data-bs-toggle="modal" data-bs-target="#editModal" onclick="sendEditId(this)"> edit</span>
                                        <span id-item='${response.data.id}'  onclick="sendDeleteId(this)" class="pending rounded mx-2" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</span>
                                    </td>

                            `);
                        
                        }
                    }
                });
        });

        function filter(){
            $('#filterBtn').css('display','block');
        }
        function getEdt(){
            $('#filterBtn').css('display','none');
            let intervale = $('#from').val();
            let centre = $('#student-task #centre').val();
            $.ajax({
                url:`/programs/${intervale}/${centre}/edt`,
                type:'GET',
                success: function(response){
                    if(response.success){
                        $('#student-task tbody').html(`
                            <tr>
                                <td class="Monday"></td>
                                <td class="Tuesday"></td>
                                <td class="Wednesday"></td>
                                <td class="Thursday"></td>
                                <td class="Friday"></td>
                                <td class="Saturday"></td>
                            </tr> 
                        `);
                        console.log(response.data);
                        let edts = response.data;
                        edts.forEach(function(edt){
                            if(edt.niveau == "aucun"){
                                edt.niveau = '';
                            }
                            $(`.${edt.jour}`).append(`
                                <div class="border-bottom text-secondaire">
                                    <div><h5 class="text-secondaire">${edt.heur}</h5></div>
                                    <div><span class='' style='font-size:1.2rem'>${edt.nom_formation} ${edt.niveau}</span></div>
                                    <div>Teacher : <span class='' style='font-size:1.2rem'>${edt.nom_enseignant}</span></div>    
                                </div>
                            `);
                        });
                    }else{
                        $('#student-task tbody').html('<td class="text-secondaire"><h4>No schedule</h4></td>');
                    }
                }
            })
        }

    </script>
</x-app-layout>