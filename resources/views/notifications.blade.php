<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="container">
        </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            display();
        });

        function del(item){
            let id = $(item).attr('id-item');
            $.ajax({
                url: `/notifications/${id}/delete`,
                type:'GET',
                data:{data:'data'},
                success:function(response){
                    if(response.success){
                        display();
                    }
                }
            })
        }

        function display(){
            $.ajax({
                url:'/notifications/get',
                type:'GET',
                success: function(response){
                    if(response.success){
                        $('#container').html('');
                        let notifications = response.notifications;
                        notifications.forEach(function(notification) {
                            let style = 'blue bg-white';
                            if(notification.state == 'unchecked'){
                                style = "ingoing";
                            }
                            $('#container').append(`
                                <div class="d-flex justify-between p-3 shadow ${style} rounded my-4" style="font-size: .9rem;">
                                    <div>   
                                        <div>${notification.text}</div>
                                        <span class="text-secondaire" style="font-size: .8rem">${notification.date}</span>
                                    </div>
                                    <i class="fa fa-trash red float-end p-2 text-secondary" style="font-size: 1.2rem;cursor:pointer;" id-item="${notification.id}" onclick="del(this)"></i>
                                </div>
                            `);
                        });
                    }else{
                        $('#container').html('<h4 class="text-center text-secondaire">Notification empty.</h4>');
                    }
                }
            })
        }
    </script>
</x-app-layout>