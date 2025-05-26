<x-app-layout>
    
    <div id="uploadStatus" class="m-2 container" style="z-index: 100000;position:fixed;top:5px;max-width:82%;"></div>
    <div class="modal" id="DeleteStudentsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Confirmation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer"><button type="button" class="btn btn-danger btn-sm px-4 rounded-pill" id="confirm-delete-student" student-id="" onclick="sendDeleteId(this)">Yes</button><button type="button" class="btn rounded-pill px-4 btn-sm" data-bs-dismiss="modal" student-id="" style="background: #eee">No</button></div>
            </div>
        </div>
    </div>
    <div class="modal" id="addStudentsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>New student</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="bg-white">
                        <form class="container rounded-sm pb-2" style="background:" id="addForm" enctype="multipart/form-data">
                            <style>
                                label{
                                    text-align: end;
                                    margin-right: 2rem;
                                }
                            </style>
                            <div class="">
                                <input type="text" style="display: none" name="user" value="{{ Auth::user()->name }}">
                                <div class="">
                                    <div class="px-2"><label for="name" class="p-2">Name</label><input name="name" id="name" type="text" class="form-control" required></div>
                                    <div class="px-2"><label for="surname" class="p-2">Surname</label><input name="surname" id="surname" type="text" class="form-control"></div>
                                </div>
                                <div class="">
                                    <div class="px-2"><label for="phone" class="p-1">telephone</label><input name="phone" id="phone" type="number" class="form-control required"></div>
                                    <div class="px-2"><label for="cin" class="p-1">CIN</label><input name="cin" id="cin" type="number"class="form-control"></div>
                                    <div class="px-2"><label for="email" class="p-1">email</label><input name="email" id="email" type="email" class="form-control" required></div>
                                    
                                </div>
                                <div class="">
                                    <div class="px-2"><label for="datenaiss" class="p-1 ">Date of birth</label><input name="datenaiss" id="datenaiss" type="date" class="form-control" required></div>
                                    <div class="px-2"><label for="center" class="p-1">Center</label>
                                        <select name="center" type="number" id="center" class="form-control" required>
                                            @foreach ($centres as $centre)
                                                <option value="{{$centre->ville}}">{{$centre->ville}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="px-2"><label for="formation" class="p-2">Formation</label>
                                        <select name="formation" id="formation" class="form-control" required>
                                            @foreach ($formations as $formation)
                                                <option value="{{$formation->nom_formation}}">{{$formation->nom_formation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="px-2"><label for="id_session" class="p-2">Session</label>
                                        <select name="id_session" id="id_session" class="form-control" required>
                                            @foreach ($sessions as $session)
                                                <option value="{{$session->id}}">{{$session->start}} to {{$session->end}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="px-2"><label for="level" class="p-2">Level</label>
                                        <select name="level" id="level" class="form-control" required>
                                            <option value="aucun">Aucun</option>
                                            <option value="level 1">Level 1</option>
                                            <option value="level 2">Level 2</option>
                                            <option value="level 3">Level 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="d-grid px-1 py-2 ">
                                        <button type="submit" class="btn mx-1 text-white btn-primaire btn-block">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- 
                            <div class="col-3 m-2 d">
                                <div class="container-fluid d-grid file-input" style="position: relative;overflow:hidden;display:inline-block;width: 200px;cursor: pointer;">
                                    <button type="button" class="btn btn-success" style="border-radius: 0px;cursor: pointer;">Picture</button>
                                    <input type="file" name="image" onchange="previewPicture(this)" required id="fileInput" accept="image/" style="cursor:pointer;position:absolute;left:0;top:0;opacity:0;">
                                    <div class="d-grid container-fluid bg-light" id="image-preview" style="min-height:200px">
                                        <span class="pt-5">No picture selected</span>
                                    </div>
                                    <script>
                                        const image = document.querySelector('#image-preview');
                                        const previewPicture = function(e){
                                            const  [Picture]= e.files
                                            if (Picture) {
                                                image.innerHTML ='<img src="'+URL.createObjectURL(Picture)+'" alt="">' ;
                                            }
                                        }
                                    </script>
                                </div>
                            </div> 
                            -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .fa-location-dot{
            font-size: .8rem;
        }
    </style>
    <div class="modal" id="editStudentsModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Edit form</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    
                    <form class="container-fluid d-flex" id="editForm" enctype="multipart/form-data">
                        <style>
                            label{
                                text-align: end;
                                margin-right: 2rem;
                            }
                        </style>
                        <div class="col-12 m-2">
                            <input type="text" style="display: none;" name="user" value="{{ Auth::user()->name }}">
                            <input type="number" style="display:none;" name="id" id="studentId" value="">
                            <div class="mb-2"><label for="name">Name</label><input name="name" id="name" type="text" class="form-control" placeholder="Name" required></div>
                            <div class="mb-2"><label for="name">Surname</label><input name="surname" id="surname" type="text" class="form-control" placeholder="Surname" required></div>
                            <div class="mb-2"><label for="name">Date of birth</label><input name="datenaiss" id="datenaiss" type="date" class="form-control" placeholder="Date of birth" required></div>
                            <div class="mb-2"><label for="name">Phone</label><input name="phone" id="phone" type="number" placeholder="telephone" class="form-control required"></div>
                            <div class="mb-2"><label for="name">CIN</label><input name="cin" id="cin" type="number"class="form-control" placeholder="CIN" required></div>
                            <div class="mb-2"><label for="name">Email</label><input name="email" id="email" type="email" class="form-control" placeholder="email" required></div>
                            <div class="mb-2"><label for="center" class="p-2">Center</label>
                                <select name="center" type="text" id="center" class="form-control" required>
                                    @foreach ($centres as $centre)
                                        <option value="{{$centre->ville}}">{{$centre->ville}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2"><label for="formation" class="p-2">Formation</label>
                                <select name="formation" id="formation" class="form-control" required>
                                    @foreach ($formations as $formation)
                                        <option value="{{$formation->nom_formation}}">{{$formation->nom_formation}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=""><label for="id_session" class="p-2">Session</label>
                                <select name="id_session" id="id_session" class="form-control" required>
                                    @foreach ($sessions as $session)
                                        <option value="{{$session->id}}">{{$session->start}} to {{$session->end}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2"><label for="level" class="p-2">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="aucun">Aucun</option>
                                    <option value="level 1">Level 1</option>
                                    <option value="level 2">Level 2</option>
                                    <option value="level 3">Level 3</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <div class="d-grid pt-0 pb-0">
                                    <button type="submit" class="btn btn-primaire btn-block ">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <x-slot name="header">
        <div class="d-flex justify-between">
            <div class="float-start">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                    {{ __('Students') }}
                </h2>
            </div>
            <div class="btn-group float-end">
                <a href="{{route('students.index')}}" class="btn btn-light btn-group-item active rounded-pill m-1" >Students</a>
                <a href="{{route('payement.index')}}" class="btn btn-light btn-group-item rounded-pill m-1" >Payments</a>
                <a href="{{route('badge.index')}}" class="btn btn-light btn-group-item rounded-pill m-1" >Badge</a>
            </div>
        </div>
    </x-slot>
    <style>
        .table #level{
            padding-right: .5rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .fa-location-dt{
            color:  rgb(18, 146, 185);
            font-size: .8rem;
        }
        .table #centre{
            color:  rgb(18, 146, 185);
            font-size: .8rem;
        }

    </style>
    <div class="py-2" id="admin-task">
        <div class="container" style="display: flex;flex-wrap:wrap;justify-content:center;">
            <div class="col-12">
                <div class="row" style="display: flex;flex-wrap:wrap;justify-content:end;">
                    <div class="mb-2 d-flex"  style="width:350px">
                        <form class="text-right" id="searchForm">
                            <div class="input-group shadow bg-white rounded d-flex">
                                <i class="fa fa-arrow-left bg-white px-3 py-2" style="display: none;" onclick="refresh()"></i>
                                <button class="input-group-text text-black text-center" style="background:#ffffff;color:#b4b4b4;border:none;"><i class="fa fa-search"></i></button>
                                <input type="search" name="searchInput" id='searchInput' placeholder="Search" class="form-control" style="border: none;">
                            </div>
                        </form>
                    </div>
                    <div class="pb-2" style="width: 138px;"><a href="" data-bs-toggle="modal" data-bs-target="#addStudentsModal" class="btn btn-primaire shadow" style="background: rgb(6, 126, 182);">Add student</a></div>
                </div>
            </div>
            <div class="text-gray-900 container-fluid table-responsive shadow bg-white p-0" id="table">
                <table class="table " style="color:var(--text-principal);">
                    <thead class="text-white main-bg" style="">
                    <tr>
                        <td>Student details</td>
                        <td>No.</td>
                        <td class="text-center">Formation</td>
                        <td>Contact</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    @if ($students)
                    <tbody> 
                    @foreach ($students as $item)
                    <tr id="students-{{$item->id}}" style="color:var(--text-secondary);">
                        <td id="cin" style="display: none;">{{$item->CIN}}</td>
                        <td id="datenaiss" style="display: none;">{{$item->datenaiss}}</td>
                        <td style="font-size: 1rem">    
                            
                                <span id="name">{{$item->name}}</span>
                                <span id="surname">{{$item->surname}}</span>
                            <br>
                            <span style="font-size: .9rem" class="green"><i class="fa fa-location-dot px-2"></i><span id="">{{$item->id_centre}}</span></span>
                        </td>
                        <td id="">{{$item->id}}</td>
                        <td class="text-center">
                            <div><span id="domaine">{{$item->id_formation}}</span></div>
                            <div><span id="level" class="orange" style="font-size:.8rem;">{{$item->level}}</span></div>
                        </td>
                        <td>
                            <i class="fa fa-envelope orange"></i> Email : <span id="email">{{$item->email}}</span><br>
                            <i class="fa fa-phone green"></i> Phone : <span id="phone">{{$item->telephone}}</span>
                        </td>
                        <td><span id="start">Date</span></td>
                        <td><span id="end">Date</span></td>
                        <td><span id="certificate" class="pending px-3">Pending</span></td>
                        <td>
                            <div class="dropdown">
                                <button data-bs-toggle="dropdown" class="btn-sm bg-light dropdown-toggle"><i class="fa fa-ellipsis"></i></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <span class="btn btn-sm dropdown-item green" data-bs-toggle="modal" data-bs-target="#editStudentsModal" id-item="{{$item->id}}" onclick="sendEditId(this)"><i class="fa fa-" style="margin-right: .2rem"></i>Edit</span>
                                    </li>
                                    <li>
                                        <span class="btn btn-sm dropdown-item red" data-bs-toggle="modal" data-bs-target="#DeleteStudentsModal" id-item="{{$item->id}}" onclick="getThisId(this)"><i class="fa " style="margin-right: .2rem" ></i>Delete</span>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    
                    @endif
                </table>
            </div>
        </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            display();
            $('#searchForm').on('submit',function(e){
                e.preventDefault();
                $('.fa-arrow-left').css("display","block");
                var filter = $('#filterSelect').attr('selected-filter');
                var value = $('#searchInput').val();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "students/"+value+"/search",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': token
                    }, 
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.success){
                            display(response.students);
                        }else{
                            $('tbody').html("<h4>No result</h4>");
                        }
                    }
                })
            });

            $('#addForm').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData(this);
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('students.store') }}",
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
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>New student added successfully!</div></div>');
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Failed to add new student!</div></div>');
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
            $('#editForm').on('submit', function (e){
                e.preventDefault();
                var formData = new FormData(this);
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                $('#editStudentsModal').modal('hide');
                
                
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "students/"+$('#editForm #studentId').val()+"/update",
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
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Modification saved</div></div>');
                            
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Cannot edit this record!</div></div>');
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
            })
        })
        function getThisId(item){
            $('#confirm-delete-student').attr('student-id',$(item).attr('id-item'));
        }
        function sendEditId(item){
            $('#editForm #studentId').val($(item).attr('id-item'));
            let id= $(item).attr('id-item');
            $('#editForm #name').val($('#students-'+id+' #name').html());
            $('#editForm #surname').val($('#students-'+id+' #surname').html());
            $('#editForm #email').val($('#students-'+id+' #email').html());
            $('#editForm #datenaiss').val($('#students-'+id+' #datenaiss').html());
            $('#editForm #center').val($('#students-'+id+' #centre').html());
            $('#editForm #phone').val($('#students-'+id+' #phone').html());
            $('#editForm #cin').val($('#students-'+id+' #cin').html());
            $('#editForm #formation').val($('#students-'+id+' #domaine').html());
            $('#editForm #level').val($('#students-'+id+' #level').html());
            
        }
        function sendDeleteId(item){
            $('#DeleteStudentsModal').modal('hide');
            var delId = $(item).attr('student-id');
            $.ajax({
                url: "students/"+delId+"/delete",
                type: 'GET',
                data: {
                    _token:$('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    display();
                    $('#uploadStatus').html('<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>Student number '+delId+' deleted successfully</div>');

                }
            });
        }
        function selectFilter(item){
            console.log(item);
            $('#filterSelect').attr('selected-filter',item);
            $('#selected').html((item));
        }
        function refresh(){
            $('.fa-arrow-left').css('display','none');
            display();
        }
        function filter(){

        }
        function display(entry){
            if(entry){
                if(entry.length>0){
                    $('tbody').html('');
                    entry.forEach(function(teacher){
                                $('tbody').append(`
                                    <tr id="students-${teacher.id}" style="color:var(--text-secondary);">
                                    <td id="cin" style="display: none;">${teacher.cin}</td>
                                    <td id="datenaiss" style="display: none;">${teacher.date_naiss}</td>
                                    <td style="font-size: 1rem">    
                                            <span id="name">${teacher.name}</span>
                                            <span id="surname">${teacher.surname}</span>
                                        <br>
                                        <span style="font-size: .9rem" class="blue"><i class="fa fa-location-dot px-2"></i><span id="">${teacher.id_centre}</span></span>
                                    </td>
                                    <td id="">${teacher.id}</td>
                                    <td class="text-center">
                                        <div><span id="domaine">${teacher.id_formation}</span></div>
                                        <div><span id="level" class="violet" style="font-size:.8rem;">${teacher.level}</span></div>
                                    </td>
                                    <td>
                                        <i class="fa fa-envelope orange"></i> Email : <span id="email">${teacher.email}</span><br>
                                        <i class="fa fa-phone blue"></i> Phone : <span id="phone">${teacher.telephone}</span>
                                    </td>
                                    <td><span id="start">${teacher.start}</span></td>
                                    <td><span id="end">${teacher.end}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button data-bs-toggle="dropdown" class="btn-sm bg-light dropdown-toggle"><i class="fa fa-ellipsis"></i></button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <span class="btn btn-sm dropdown-item green" data-bs-toggle="modal" data-bs-target="#editStudentsModal" id-item="${teacher.id}" onclick="sendEditId(this)"><i class="fa fa-" style="margin-right: .2rem"></i>Edit</span>
                                                </li>
                                                <li id="sup-admin-task">
                                                    <span class="btn btn-sm dropdown-item red" data-bs-toggle="modal" data-bs-target="#DeleteStudentsModal" id-item="${teacher.id}" onclick="getThisId(this)"><i class="fa " style="margin-right: .2rem" ></i>Delete</span>
                                                </li>
                                            </ul>
                                        </div>
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
                    url: '/students/get',
                    type: 'GET',
                    success:function(response){
                        if(response.success){
                            let students = response.students; 
                            console.log(students);
                            $('tbody').html('');
                            students.forEach(function(teacher){
                                $('tbody').append(`
                                    <tr id="students-${teacher.id}" style="color:var(--text-secondary);">
                                    <td id="cin" style="display: none;">${teacher.cin}</td>
                                    <td id="datenaiss" style="display: none;">${teacher.date_naiss}</td>
                                    <td style="font-size: 1rem">    
                                            <span id="name">${teacher.name}</span>
                                            <span id="surname">${teacher.surname}</span>
                                        <br>
                                        <span style="font-size: .9rem" class="blue"><i class="fa fa-location-dot px-2"></i><span id="">${teacher.id_centre}</span></span>
                                    </td>
                                    <td id="">${teacher.id}</td>
                                    <td class="text-center">
                                        <div><span id="domaine">${teacher.id_formation}</span></div>
                                        <div><span id="level" class="violet" style="font-size:.8rem;">${teacher.level}</span></div>
                                    </td>
                                    <td>
                                        <i class="fa fa-envelope orange"></i> Email : <span id="email">${teacher.email}</span><br>
                                        <i class="fa fa-phone blue"></i> Phone : <span id="phone">${teacher.telephone}</span>
                                    </td>
                                    <td><span id="start">${teacher.start}</span></td>
                                    <td><span id="end">${teacher.end}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button data-bs-toggle="dropdown" class="btn-sm bg-light dropdown-toggle"><i class="fa fa-ellipsis"></i></button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <span class="btn btn-sm dropdown-item green" data-bs-toggle="modal" data-bs-target="#editStudentsModal" id-item="${teacher.id}" onclick="sendEditId(this)"><i class="fa fa-" style="margin-right: .2rem"></i>Edit</span>
                                                </li>
                                                <li id="sup-admin-task">
                                                    <span class="btn btn-sm dropdown-item red" data-bs-toggle="modal" data-bs-target="#DeleteStudentsModal" id-item="${teacher.id}" onclick="getThisId(this)"><i class="fa " style="margin-right: .2rem" ></i>Delete</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                `);
                            });
                        }else{
                            $('tbody').html('<h5 class="text-center">No student recorded!</h5>')
                        }
                    }
                });
            }

        }

    </script>
</x-app-layout>