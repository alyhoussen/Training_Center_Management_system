<x-app-layout>
    <div id="uploadStatus" class="m-2 container" style="z-index: 100000;position:fixed;top:5px;max-width:82%;"></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formations') }}
        </h2>
    </x-slot>
    <div class="modal" id="deleteRecordModal" id-item="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Confirmation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer"><button type="button" class="btn btn-danger btn-sm px-4 rounded-pill" id="confirm-delete-student" student-id="" onclick="del()">Yes</button><button type="button" class="btn rounded-pill px-4 btn-sm" data-bs-dismiss="modal" student-id="" style="background: #eee">No</button></div>
            </div>
        </div>
    </div>
    
    <div class="modal" id="add" id-item="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>New formation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form id="addForm" enctype="multipart/form-data">
                        <div class="p-2">
                            <label for="code_formation">Code</label>
                            <input type="text" class="form-control" id="code_formation" name="code_formation">
                        </div>
                        <div class="p-2">
                            <label for="nom_formation">Name</label>
                            <input type="text" class="form-control" id="nom_formation" name="nom_formation">
                        </div class="">
                        <div class="p-2">
                            <label for="duree">Duration</label>
                            <input type="number" class="form-control" id="duree" name="duree">
                        </div>
                        <div class="d-grid  p-2">
                            <button class="btn btn-primaire btn-block">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="edit" id-item="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Edit formation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form id="editForm" enctype="multipart/form-data" id-item="">
                        <div class="p-2">
                            <label for="code_formation">Code</label>
                            <input type="text" class="form-control" id="code_formation" name="code_formation">
                        </div>
                        <div class="p-2">
                            <label for="nom_formation">Name</label>
                            <input type="text" class="form-control" id="nom_formation" name="nom_formation">
                        </div class="">
                        <div class="p-2">
                            <label for="duree">Duration</label>
                            <input type="number" class="form-control" id="duree" name="duree">
                        </div>
                        <div class="d-grid  p-2">
                            <button class="btn btn-primaire btn-block">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="max-w-7xl py-2 mx-auto sm:px-6 lg:px-8 table-reponsive container bg-white shadow">
            <button class="btn my-2 btn-primaire float-end" id="sup-admin-task" data-bs-toggle="modal" data-bs-target="#add">New formation</button>
            <table class="table">
                <thead class="main-bg text-white">
                    <tr>
                        <td>CODE</td>
                        <td>NAME</td>
                        <td>DURATION</td>
                        <td>ACTIONS</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>

        $(document).ready(function(){
            display();
            $('#addForm').on('submit',function(e){
                e.preventDefault();
                var formData = new FormData(this);
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('formation.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response.success){
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Formation added successfuly!</div></div>');
                            display();   
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Failed to add new formation!</div></div>');
                        }
                    },
                    error: function(response){
                        let errors= response.responseJSON.errors;
                        console.log(errors);
                        let errorMessage = 'Error occured';
                        for (let field in errors){
                            errorMessage += field+":"+errors[field].join(',')+'<br>';
                        }
                        $('#uploadStatus').html('<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>'+errorMessage+'</div>');
                    }
                })
            });
            
            $('#editForm').on('submit',function(e){
                e.preventDefault();
                let id = $(this).attr('id-item');
                var formData = new FormData(this);
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: `/formation/${id}/update`,
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response.success){
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Modification saved!</div></div>');
                            display();   
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Failed to update the formation!</div></div>');
                        }
                    },
                    error: function(response){
                        let errors= response.responseJSON.errors;
                        console.log(errors);
                        let errorMessage = 'Error occured';
                        for (let field in errors){
                            errorMessage += field+":"+errors[field].join(',')+'<br>';
                        }
                        $('#uploadStatus').html('<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button>'+errorMessage+'</div>');
                    }
                })
            });

        });
        function del(){
            let id = $('#deleteRecordModal').attr('id-item');
            $.ajax({
                url:`/formation/${id}/delete`,
                type:'GET',
                success:function(response){
                    if(response.success){
                        display();
                        $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Formation deleted successfully!</div></div>');
                    }
                }
            })
        }
        function sendEditId(item){
            $('#editForm').attr('id-item',$(item).attr('id-item'));   
            $('#editForm #code_formation').val($('#record-'+$(item).attr('id-item')+' #code_formation').html());
            $('#editForm #nom_formation').val($('#record-'+$(item).attr('id-item')+' #nom_formation').html());
            $('#editForm #duree').val($('#record-'+$(item).attr('id-item')+' #duree').html());
        }
        function sendDeleteId(item){
            $('#deleteRecordModal').attr('id-item',$(item).attr('id-item'));
        }
        function display(){
                $('.modal').modal('hide');
                $("tbody").html('');
                $.ajax({
                    url: '/formation/get',
                    type: 'GET',
                    success:function(response){
                                if(response.success){
                                    let formations = response.formations;
                                    $('.table tbody').html('');
                                    formations.forEach(function(formation){
                                        $('.table tbody').append(`
                                            <tr id="record-${formation.id_formation}">
                                                <td id="code_formation">${formation.code_formation}</td>
                                                <td id="nom_formation">${formation.nom_formation}</td>
                                                <td id="duree">${formation.duree}</td>
                                                <td id="sup-admin-task">
                                                    <span class="green"><i class="fa fa-pen px-3" id-item="${formation.id_formation}" onclick="sendEditId(this)" data-bs-toggle="modal" data-bs-target="#edit"></i></span>
                                                    <span class="red"><i class="fa fa-trash px-3" id-item="${formation.id_formation}" onclick="sendDeleteId(this)" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"></i></span>
                                                </td>
                                            </tr>
                                        `);
                                    });
                                }else{
                                    $('.table tbody').html('<div class="text-center text-secondaire"><h5>No formation recorded</h5></div>')
                                }
                        }
            });
        }
    </script>

</x-app-layout>