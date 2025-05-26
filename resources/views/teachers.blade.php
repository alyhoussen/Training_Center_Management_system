<x-app-layout>
    <div id="uploadStatus" class="m-2 container" style="z-index: 100000;position:fixed;top:5px;max-width:82%;"></div>
    <div class="modal" id="DeleteStudentsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Confirmation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer"><button type="button" class="btn btn-danger btn-sm px-4 rounded-pill" id="confirm-delete-student" student-id="" onclick="sendDeleteId(this)">Yes</button><button type="button" class="btn btn-sm px-4 rounded-pill" data-bs-dismiss="modal" student-id="" style="background:#eee;">No</button></div>
            </div>
        </div>
    </div>
    <div class="modal" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>New teacher</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form class="container-fluid" id="addForm" enctype="multipart/form-data">
                        <style>
                            label{
                                text-align: end;
                                margin-right: 2rem;
                            }
                        </style>
                        <div class="">
                            <div class="">
                                <div class=" mb-2 px-2 "><label for="name" class="p-2">Name</label><input name="name" id="name" type="text" class="form-control" required></div>
                                <div class=" mb-2 px-2"><label for="surname" class="p-2">Surname</label><input name="surname" id="surname" type="text" class="form-control" required></div>
                        
                            </div>
                            <div class="">
                                <div class=" mb-2 px-2"><label for="phone" class="p-1">telephone</label><input name="phone" id="phone" type="number" class="form-control required"></div>
                                <div class=" mb-2 px-2"><label for="cin" class="p-1">CIN</label><input name="cin" id="cin" type="number"class="form-control" required></div>
                                <div class=" mb-2 px-2"><label for="email" class="p-1">email</label><input name="email" id="email" type="email" class="form-control" required></div>
                                
                            </div>
                            <div class="">
                                <div class=" mb-2 px-2"><label for="datenaiss" class="p-1 ">Date of birth</label><input name="datenaiss" id="datenaiss" type="date" class="form-control" required></div>
                                <div class=" mb-2 px-2"><label for="center" class="p-1">Center</label>
                                    <select name="center" id="center" class="form-control" required>
                                        @foreach ($centres as $centre)
                                            <option value="{{$centre->ville}}">{{$centre->ville}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class=" mb-2 px-2"><label for="formation" class="p-2">Domain</label>
                                    <select name="formation" id="formation" class="form-control" required>
                                        @foreach ($formations as $formation)
                                            <option value="{{$formation->nom_formation}}">{{$formation->nom_formation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="d-grid p-2 pt-2 pb-0">
                                    <button type="submit" class="btn text-white btn-primaire">Submit</button>
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
    <div class="modal" id="editStudentsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Edit form</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form class="container-fluid d-flex" id="editForm" id-item="" enctype="multipart/form-data">
                        <style>
                            label{
                                text-align: end;
                                margin-right: 2rem;
                            }
                        </style>
                        <div class="col-12 m-2">
                            <div class=""><label for="name">Name</label><input name="name" id="name" type="text" class="form-control" placeholder="Name" required></div>
                            <div class=""><label for="surname">Surname</label><input name="surname" id="surname" type="text" class="form-control" placeholder="Surname" required></div>
                            <div class=""><label for="datenaiss">Date of birth</label><input name="datenaiss" id="datenaiss" type="date" class="form-control" placeholder="Date of birth" required></div>
                            <div class=""><label for="phone">Telephone</label><input name="phone" id="phone" type="number" placeholder="telephone" class="form-control required"></div>
                            <div class=""><label for="cin">CIN</label><input name="cin" id="cin" type="number"class="form-control" placeholder="CIN" required></div>
                            <div class=""><label for="email">Email</label><input name="email" id="email" type="email" class="form-control" placeholder="email" required></div>
                            <div class="">
                                <label for="center">Center</label><label for="center" class="">Center</label>
                                <select name="center" type="text" id="center" class="form-control" required>
                                    @foreach ($centres as $centre)
                                        <option value="{{$centre->ville}}">{{$centre->ville}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <label for="formation" class="">Domain</label>
                                <select name="formation" id="formation" class="form-control" required>
                                    @foreach ($formations as $formation)
                                        <option value="{{$formation->nom_formation}}">{{$formation->nom_formation}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="py-2">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primaire  btn-block">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="header">
        <div class="d-flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight col-9">
                {{ __('Teachers') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-2">
        <div class="">
            <div class="container-fluid p-0">
                <div class="" style="display: flex;flex-wrap:wrap-reverse;justify-content:end;">
                    <div class="">  
                        <form class="text-right d-flex shadow border" id="searchForm" style="max-width: 350px">
                            <i class="fa fa-arrow-left bg-white p-2 px-3" style="display: none;cursor:pointer;"></i>
                            <div class="input-group bg-white rounded">
                                <button class="input-group-text text-black text-center bg-white border-0" style="color:#b4b4b4;"><i class="fa fa-search"></i></button>
                                <input type="search" name="searchInput" id='searchInput' placeholder="Search" class="form-control" style="border: none;">
                            </div>
                        </form>
                    </div>
                    <div class="" id="sup-admin-task">
                        <a href="" data-bs-toggle="modal" data-bs-target="#add" class="btn shadow" style="color:white;margin-left:10px;margin-right:0px;background-color:rgb(18, 146, 185);">Add teacher</a>
                    </div>
                </div>
            </div>
            <div class="my-2 table-responsive bg-white shadow text-gray-900" id="table">
                <table class="table" style="color:var(--text-principal);">
                    <thead class="main-bg text-white">
                    <tr>
                        <td>Name</td>
                        <td>Surname</td>
                        <td>Telephone</td>
                        <td>Email</td>
                        <td>Domain</td>
                        <td>Center</td>
                        <td id="sup-admin-task">Actions</td>
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
            $('#searchForm').on('submit',function(e){  
                e.preventDefault();
                $('.fa-arrow-left').css('display','block');
                var value = $('#searchInput').val();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/teachers/"+value+"/search",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': token
                    }, 
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.success){
                        display(response.data);
                        }else{
                            $('tbody').html("<div class='text-center'><h1>No result</h1></div>");
                        }
                    }
                })
            });
            $('#addForm').on('submit', function (e){
                e.preventDefault();
                var formData = new FormData(this);
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('teachers.store') }}",
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
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>New teacher added successfuly!</div></div>');
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Failed to add new teacher!</div></div>');
                        }
                    },
                    error: function(response){
                        let errors= response.responseJSON.errors;
                        console.log(response.data);
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
                let id = $('#editForm').attr('id-item');
                var formData = new FormData(this);
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: `/teachers/${id}/update`,
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.success){
                            display();
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Record modified successfuly!</div></div>');
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Failed to modify record!</div></div>');
                        }
                    },
                    error: function(response){
                        let errors= response.responseJSON.errors;
                        console.log(response.data);
                        let errorMessage = '';
                        for (let field in errors){
                            errorMessage += field+":"+errors[field].join(',')+'<br>';
                        }
                        $('#uploadStatus').html('<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>'+errorMessage+'</div>');
                    }
                });
            })
            $('.fa-arrow-left').click(function(){
                $('.fa-arrow-left').css('display','none');
                display();
            });

        })
        function getThisId(item){
            $('#confirm-delete-student').attr('student-id',$(item).attr('id-item'));
        }
        function sendEditId(item){
            $('#editForm').attr('id-item',$(item).attr('id-item'));
            let id= $(item).attr('id-item');
            $('#editForm #name').val($('#record-'+id+' #name').html());
            $('#editForm #surname').val($('#record-'+id+' #surname').html());
            $('#editForm #email').val($('#record-'+id+' #email').html());
            $('#editForm #datenaiss').val($('#record-'+id+' #datenaiss').html());
            $('#editForm #center').val($('#record-'+id+' #centre').html());
            $('#editForm #phone').val($('#record-'+id+' #phone').html());
            $('#editForm #cin').val($('#record-'+id+' #cin').html());
            $('#editForm #formation').val($('#record-'+id+' #domaine').html());
        }
        function sendDeleteId(item){
            $('#DeleteStudentsModal').modal('hide');
            var delId = $(item).attr('student-id');
            $.ajax({
                url: "/teachers/"+delId+"/delete",
                type: 'GET',
                data: {
                    _token:$('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    display();
                    $('#uploadStatus').html('<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>Teacher number '+delId+' deleted successfully</div>');

                }
            });
        }
        function selectFilter(item){
            console.log(item);
            $('#filterSelect').attr('selected-filter',item);
            $('#selected').html(item);
            
        }
        
        function display(entry){
            if(entry){
                let teachers = entry; 
                            $('tbody').html('');
                            teachers.forEach(function(teacher){
                                $('tbody').append(`
                                    <tr id="students-${teacher.id}">
                                        <td id="datenaiss" value="nothing" style="display: none">${teacher.datenaiss}</td>
                                        <td id="cin" style="display: none">${teacher.cin}</td>
                                        <td id="name">${teacher.name}</td>
                                        <td id="surname">${teacher.surname}</td>
                                        <td id="phone">${teacher.telephone}</td>
                                        <td id="email">${teacher.email}</td>
                                        <td id="domaine">${teacher.formation}</td>
                                        <td id="centre">${teacher.centre}</td>
                                        <td id="sup-admin-task">
                                            <span class="green px-3" data-bs-toggle="modal" data-bs-target="#editStudentsModal" id-item="${teacher.id_enseignant}" onclick="sendEditId(this)"><i class="fa fa-pen" style="margin-right: .2rem"></i></span>
                                            <span class="red px-3" data-bs-toggle="modal" data-bs-target="#DeleteStudentsModal" id-item="${teacher.id_enseignant}" onclick="getThisId(this)"><i class="fa fa-trash" style="margin-right: .2rem" ></i></span>
                                        </td>
                                    </tr>
                                `);
                            });
            }else{
                $('.modal').modal('hide');
                $("tbody").html('');
                $.ajax({
                    url: '/teachers/get',
                    type: 'GET',
                    success:function(response){
                        if(response.success){
                            let teachers = response.teachers; 
                            $('tbody').html('');
                            teachers.forEach(function(teacher){
                                $('tbody').append(`
                                    <tr id="record-${teacher.id_enseignant}">
                                        <td id="datenaiss" value="nothing" style="display: none">${teacher.datenaiss}</td>
                                        <td id="cin" style="display: none">${teacher.cin}</td>
                                        <td id="name">${teacher.name}</td>
                                        <td id="surname">${teacher.surname}</td>
                                        <td id="phone">${teacher.telephone}</td>
                                        <td id="email">${teacher.email}</td>
                                        <td id="domaine">${teacher.formation}</td>
                                        <td id="centre">${teacher.centre}</td>
                                        <td id="sup-admin-task">
                                            <span class="green px-3" data-bs-toggle="modal" data-bs-target="#editStudentsModal" id-item="${teacher.id_enseignant}" onclick="sendEditId(this)"><i class="fa fa-pen" style="margin-right: .2rem"></i></span>
                                            <span class="red px-3" data-bs-toggle="modal" data-bs-target="#DeleteStudentsModal" id-item="${teacher.id_enseignant}" onclick="getThisId(this)"><i class="fa fa-trash" style="margin-right: .2rem" ></i></span>
                                        </td>
                                    </tr>
                                `);
                            });
                        }else{
                            $('tbody').html('<h5 class="text-center">No tearcher record!</h5>')
                        }
                    }
                });
            }
        }

    </script>
</x-app-layout>