<x-app-layout>
    <x-slot name="header" class="container-fluid">
        <div class="d-flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Students/Badge') }}
            </h2>
            <div class="btn-group">
                <a href="{{route('students.index')}}" class="btn btn-light btn-group-item rounded-pill m-1">Students</a>
                <a href="{{route('payement.index')}}" class="btn btn-light btn-group-item rounded-pill m-1">Payments</a>
                <a href="{{route('badge.index')}}" class="btn btn-light btn-group-item active rounded-pill m-1">Badge</a>
            </div>
        </div>
    </x-slot>
    <div class="py-2">
        <div class="container p-3" style="display: flex;flex-wrap:wrap;justify-content:center;">
            <div class=" p-3">
                <h5 class="text-center">Information</h5>
                <form style="display:flex;flex-wrap:wrap;">
                    <div class="m-2">
                        <div class="container-fluid d-grid file-input" style="position: relative;overflow:hidden;display:inline-block;width: 200px;cursor: pointer;">
                            <button type="button" class="btn text-white" style="border-radius: 0px;cursor: pointer;background:rgb(6, 126, 182)">Picture</button>
                            <input type="file" name="image" onchange="previewPicture(this)" required id="fileInput" accept="image/" style="cursor:pointer;position:absolute;left:0;top:0;opacity:0;">
                            <div class="d-grid container-fluid text-center p-2 bg-white" id="image-preview" style="min-height:100px">
                                <span class="pt-5">Select image</span>
                            </div>
                            <script>
                                const image = document.querySelector('#image-preview');
                                const previewPicture = function(e){
                                    const  [Picture]= e.files
                                    if (Picture) {
                                        image.innerHTML ='<img src="'+URL.createObjectURL(Picture)+'" class="img-thumbnail rounded-pill selectImg" width="200" height="200" alt="" alt="">' ;
                                    }
                                }
                            </script>
                        </div>
                    </div> 
                    <div class="px-4">
                        <div>
                            <label for="fullname">Full name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control">
                        </div>
                        <div>
                            <label for="id">Number</label>
                            <input type="text" name="id" id="id" class="form-control">
                        </div>
                        <div>
                            <label for="level">Level</label>
                            <input type="text" name="level" id="level" class="form-control">
                        </div>
                        <div class="text-center p-3"><button type="button" onclick="generate()" class="btn" style="background: rgb(6, 126, 182);color:white">GENERATE BADGE</button></div>
                    </div>
                </form>
            </div>
            <div class="p-3 pt-0 badge d-grid">
                <div class="border overflow-hidden rounded-lg" id="badge" style="width: 300px;height:420px;background:rgb(255, 255, 255);">
                    <style>
                       .badge .design-row div{
                        height:.2rem;
                        width: .2rem;
                        margin: .2rem;
                        border-radius: 100px;
                        background: rgb(3, 173, 3);z-index:100;
                        }
                        .badge .design{
                        } 

                    </style>
                    <div style="position: absolute;margin-top:4.5rem;z-index:100;" class="design d-none" >
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                        <div class="design-row d-flex">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div>
                    </div>
                    <div class="d-flex p-3 justify-center">
                        <img src="/images/background.png" width="100" height="100"  class="rounded-pill img-center border" style="height:101px" alt="">
                        <div style="position: absolute;height:117px;width:100px;margin-right:-198px;background: rgb(6, 126, 182);">
                            <div class="" style="border-bottom-right-radius:70px;height:100%;width:100%;background:rgb(255, 255, 255)"></div>
                        </div>
                    </div>
                    <div class="p-4 text-white" style="z-index:1000;background: rgb(6, 126, 182);border-top-left-radius:50%;border-top-right-radius:-50px;height:75%">
                        <h4 class="text-center" style="z-index:1000;"><span class="name"></span></h4>
                        <h6 class="text-center">English Student</h6>
                        <div class="p-5 pt-3" style="text-align: left">
                            <p>ID : <span class="id"></span></p>
                            <P>Level : <span class="level"></span></P>
                            <div class="d-flex justify-center">
                                <div id="qrcode">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a hre id="download" class="btn btn-primaire btn-block" onclick="capture()">Save</a>
            </div>
        </div>
    </div>
    <script src="/assets/jquery-3.7.1.min.js"></script>
    <script src="/assets/qrcode.min.js"></script>
    <script src="/assets/jspdf.min.js"></script>
    <script src="/assets/html2canvas.min.js"></script>
    <script>
        function generate(){
            var qrcode = document.getElementById('qrcode');
            qrcode.innerHTML = "";
            var name = document.getElementById('fullname').value;
            var level = document.getElementById('level').value;
            var id = "TL-STU-"+document.getElementById('id').value;
            $('.id').html(id);
            $('.name').html(name);
            $('.level').html(level);
            console.log($('.badge img').attr('src',$('.selectImg').attr("src")));
            var qrcode = new QRCode(qrcode,
                {
                    text: id,
                    width:100,
                    height:100,
                }
            );
        }
        function capture(){
            const element = document.getElementById('badge');
            const pdf = new jsPDF();

            pdf.addHTML(element,10,10,{allowTaint: true, useCORS: true, pagesplit: false},function(){
                pdf.save('monFichier.pdf');
            });
        }
    </script>
</x-app-layout>