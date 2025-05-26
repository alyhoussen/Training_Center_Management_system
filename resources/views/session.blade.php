<x-app-layout>
    <div id="uploadStatus" class="m-2 container" style="z-index: 100000;position:fixed;top:5px;max-width:82%;"></div>
    <div class="modal" id="deleteRecordModal" id-item="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Confirmation</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this record?</div>
                <div class="modal-footer"><button type="button" class="btn btn-danger btn-sm px-4 rounded-pill" id="confirm-delete-student" student-id="" onclick="del()">Yes</button><button type="button" class="btn rounded-pill px-4 btn-sm" data-bs-dismiss="modal" student-id="" style="background: #eee">No</button></div>
            </div>
        </div>
    </div>
    <div class="modal" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>New session</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="addForm">
                        <div>
                            <label for="start">Start</label>
                            <input type="date" name="start" id="start" class="form-control">
                        </div>
                        <div>
                            <label for="end">End</label>
                            <input type="date" name="end" id="end" class="form-control">
                        </div>
                        <div>
                            <label for="echeance">Date of payment</label>
                            <input type="date" name="echeance" id="echeance" class="form-control">
                        </div>
                        <div>
                            <label for="formation">formation</label>
                            <select name="formation" id="formation" class="form-control">
                               @foreach ($formations as $formation)
                                   <option value="{{$formation->nom_formation}}">{{$formation->nom_formation}}</option>
                               @endforeach 
                            </select>
                        </div>
                        <div>
                            <label for="niveau">Level</label>
                            <input type="text" name="niveau" id="niveau" class="form-control">
                        </div>
                        <div>
                            <label for="frais">School fee</label>
                            <input type="number" name="frais" id="frais" class="form-control">
                        </div>
                        <div>
                            <label for="centre">Center</label>
                            <select name="centre" id="centre" class="form-control">
                                @foreach ($centres as $centre)
                                    <option value="{{$centre->ville}}">{{$centre->ville}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid py-2">
                            <button type="submit" class="btn btn-primaire btn-block">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4>Edit session</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="editForm">
                        <div>
                            <label for="start">Start</label>
                            <input type="date" name="start" id="start" class="form-control">
                        </div>
                        <div>
                            <label for="end">End</label>
                            <input type="date" name="end" id="end" class="form-control">
                        </div>
                        <div>
                            <label for="echeance">Date of payment</label>
                            <input type="date" name="echeance" id="echeance" class="form-control">
                        </div>
                        <div>
                            <label for="formation">formation</label>
                            <select name="formation" id="formation" class="form-control">
                               @foreach ($formations as $formation)
                                   <option value="{{$formation->nom_formation}}">{{$formation->nom_formation}}</option>
                               @endforeach 
                            </select>
                        </div>
                        <div>
                            <label for="niveau">Level</label>
                            <input type="text" name="niveau" id="niveau" class="form-control">
                        </div>
                        <div>
                            <label for="frais">School fee</label>
                            <input type="number" name="frais" id="frais" class="form-control">
                        </div>
                        <div>
                            <label for="centre">Center</label>
                            <select name="centre" id="centre" class="form-control">
                                @foreach ($centres as $centre)
                                    <option value="{{$centre->ville}}">{{$centre->ville}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid py-2">
                            <button type="submit" class="btn btn-primaire btn-block">Save modification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sessions') }}
        </h2>
    </x-slot>
    <div class="bg-white container shadow px-2 rounded">
        <div class="py-3">
            <button class="btn btn-white border" style="visibility: hidden">Filtre</button>
            <button class="btn btn-primaire float-end" data-bs-toggle="modal" data-bs-target="#add">New session</button>
        </div>
        <div class="table-responsive p-0">
            <table class="table">
                <thead class="main-bg text-white">
                    <tr>
                        <td>Start</td>
                        <td>End</td>
                        <td>Date of payment</td>
                        <td class="text-center">State</td>
                        <td>Formation</td>
                        <td>Level</td>
                        <td>School fee</td>
                        <td>Center</td>
                        <td id="sup-admin-task">Actions</td>
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
                    url: "{{ route('formationSession.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response.success){
                            $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Session added successfuly!</div></div>');
                            display();   
                        }
                        else{
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Failed to add new session!</div></div>');
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
                    url: `/formationSession/${id}/update`,
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
                            $('#uploadStatus').html ( '<div class="alert alert-danger alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Failed to update the session!</div></div>');
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
                url:`/formationSession/${id}/delete`,
                type:'GET',
                success:function(response){
                    if(response.success){
                        display();
                        $('#uploadStatus').html( '<div class="alert alert-success alert-dismissible"><button class="btn-close" data-bs-dismiss="alert"></button><div>Session deleted successfully!</div></div>');
                    }
                }
            })
        }
        function sendEditId(item){
            $('#editForm').attr('id-item',$(item).attr('id-item'));
            $('#editForm #start').val($('#record-'+$(item).attr('id-item')+' #start').html());
            $('#editForm #end').val($('#record-'+$(item).attr('id-item')+' #end').html());
            $('#editForm #echeance').val($('#record-'+$(item).attr('id-item')+' #echeance').html());
            $('#editForm #formation').val($('#record-'+$(item).attr('id-item')+' #formation').html());
            $('#editForm #niveau').val($('#record-'+$(item).attr('id-item')+' #niveau').html());
            $('#editForm #frais').val($('#record-'+$(item).attr('id-item')+' #frais').html());
            $('#editForm #centre').val($('#record-'+$(item).attr('id-item')+' #centre').html());
        }
        function sendDeleteId(item){
            $('#deleteRecordModal').attr('id-item',$(item).attr('id-item'));
        }
        function display(){
                $('.modal').modal('hide');
                $("tbody").html('');
                $.ajax({
                    url: '/formationSession/get',
                    type: 'GET',
                    success:function(response){
                                if(response.success){
                                    let sessions = response.sessions;
                                    sessions.forEach(function(session){
                                        if(session.id >0){
                                            //
                                            let state = '';
                                            if(session.state == 'Pending'){
                                                state = '<span class="pending px-3" id="state">Pending</span>';
                                            }
                                            else{
                                                state = '<span class="outgoing px-3" id="state">Expired</span>';
                                            }
                                            $('.table tbody').append(`
                                                <tr id="record-${session.id}">
                                                    <td class="" id="start">${session.start}</td>
                                                    <td class="" id="echeance">${session.echeance}</td>
                                                    <td class="" id="end">${session.end}</td>
                                                    <td class="text-center">${state}</td>
                                                    <td>
                                                        <span class="text-secondaire" id="formation">${session.formation}</span>
                                                    </td>
                                                    <td>
                                                        <span class="orange" style="font-size: .8rem" id="niveau">${session.niveau}</span>
                                                    </td>
                                                    <td>Ar <span id="frais">${session.frais}</span></td>
                                                    <td class="text-secondaire" id="centre">${session.centre}</td>
                                                    <td id="sup-admin-task">
                                                        <span class="green"><i class="fa fa-pen px-3" id-item="${session.id}" onclick="sendEditId(this)" data-bs-toggle="modal" data-bs-target="#edit"></i></span>
                                                        <span class="red"><i class="fa fa-trash px-3" id-item="${session.id}" onclick="sendDeleteId(this)" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"></i></span>
                                                    </td>
                                                </tr>
                                            `);
                                        }
                                    });
                                }else{
                                    $('.table tbody').html('<div class="text-center text-secondaire"><h5>No session recorded</h5></div>')
                                }
                        }
            });
        }
    </script>
</x-app-layout>