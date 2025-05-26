<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    <style>
        #body{
            background: white;
        }
    </style>
    <div class="py-2">
        <div class="">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="text-gray-900 container">
                    <div class="responsive profil-slide" >
                        <div class="px-4">
                            <h5 class="py-3" ><b>Online users</b></h5>
                            <div class="p-2" style="display: flex;flex-wrap:wrap;justify-content:center;" id="online">
                               
                            </div>
                        </div>
                        <style>
                            .profil-slide a{
                                color: #2e2e2e;
                                text-decoration: none;
                            }
                            .profil-slide .border-bottom:hover{
                                background: #eee;
                            }

                        </style>
                        <div class=" py-3 container">
                            <h5 class="p-3"><b>Messages</b></h5>
                            <div id="messages">
                                <div class="p-2  border-bottom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            display();
        })
        function display(){
            $.ajax({
                url:"/messages/get",
                type: "GET",
                success: function(response){
                    if(response.success){
                        console.log(response.new_messages);
                        let users = response.users;
                        let new_messages = response.new_messages;

                        users.forEach(function(user){
                            $('#online').append(`
                                <div class="m-2">
                                    <img src="/images/fav.ico" class="img-center img-thumbnail" width="50"/>
                                    <p class="text-center text-secondaire"><b>${user.name}</b><br><span class="ingoing px-2 rounded">${user.privillege}</span></p>
                                </div>
                            `);
                        });
                        new_messages.forEach(function(message){
                            $('#messages').append(`
                                <div class="p-2  border-bottom rounded">
                                     <span style="font-size:.7rem" class="green">From :</span> <a href="/messages/${message.sender}">
                                    ${message.user_name}
                                    <div style="font-size:.8rem" class="t"><b>${message.message}</b> <button class="badge float-end btn-primaire blue rounded-pill" style="font-size:.4rem;" id="badge-${message.sender}">.</button></div>
                                    </a>
                                </div>
                            `);
                        });
                    }
                }
            });
        }
    </script>
</x-app-layout>