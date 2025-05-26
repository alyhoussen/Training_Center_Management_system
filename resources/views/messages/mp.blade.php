<x-app-layout>
    <x-slot name="Sender">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$name}}
            <a href="{{route('messages.index')}}" class="float-end"><i class="fa fa-arrow-right"></i></a>
        </h2>
    </x-slot>
    <style>
        #body{
            background: white;
            height: screen;
        }
    </style>
    <div class="container bg-white p-3">
        <div class="max-w-7xl mx-auto py-5">
            <div style="min-height: 500px;">
                @foreach ($messages as $item)
                    @if ($item->sender == Auth::user()->id)
                        <div class="d-flex justify-end">
                            <div>
                                <div class="p-3 m-2 btn-primaire text-white" style="border-radius:10px;width: 300px;border-bottom-right-radius:0;">
                                    {{$item->message}}
                                </div>
                                <div class="text-end px-3">
                                    <span class="blue" style="font-size:.7rem;">{{$item->date}}</span>
                                </div>
                            </div>
                        </div> 
                    @else
                        <div>
                            <div class="p-3 m-2" style="border-radius:10px;width: 300px;border-bottom-left-radius:0;background:#eee;">
                                {{$item->message}}
                            </div>
                            <div class="text-start px-3">
                                <span class="" style="font-size:.7rem;color:#666;">{{$item->date}}</span>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
            <div class="p-4 my-4 container" style="position:fixed;bottom:0;right:0;">
                <form class="input-group" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="message" name="message">
                    <input type="number" class="form-control d-none" id="sender" name="sender" value="{{$sender}}">
                    <button type="submit"><i class="fa fa-paper-plane float-end p-2 text-primaire input-group-text" style="font-size: 1.2rem;cursor:pointer"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(()=>{
            $(".input-group").on('submit',function(e){
                e.preventDefault();
                var formData = new FormData(this);
                alert();
                for(var pair of formData.entries())
                {
                    console.log(pair[0]+':'+pair[1]);
                }
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('messages.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response.success){
                        }
                        else{
                            
                        }
                    },
                })
            })
        });
    </script>
</x-app-layout>