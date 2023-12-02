<?php require_once '../app/component/checkAdminLogin.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../app/component/head.php';?>
    <title>Manage User | ADMIN</title>
    <script>
        $(document).ready(function(){
            $('.boxTheme').ready(function(){
                $.ajax({
                    url: '/techadmin/admin/api/getusr',
                    method: 'GET',
                    dataType: 'json',
                    success: function(res){
                        console.log(res);
                        res.forEach((value) => {
                            div = '<div class="transition ease-in-out delay-150 bg-[#9bf6ff] hover:scale-110 md:col-span-3 col-span-3 mx-auto  border-2 border-black py-5 px-5 rounded-lg" value="'+value['user_id']+'">';
                            div += '<p class="text-xl font-bold md:text-lg bg-yellow-600 p-2 rounded-lg">'+ value['user_name']+'</p>';
                            div += '<p class="text-lg md:text-base"> First Name:'+ value['first_name']+'</p>';
                            div += '<p class="text-lg md:text-base"> Last Name: '+ value['last_name']+'</p>';
                            div += '<p class="text-lg md:text-base"> Email:'+ value['email']+'</p>';
                            div += '<p class="text-lg md:text-base"> Modified At: '+ value['modified_at']+'</p>';
                            
                            div += '<p class="hidden" id="p'+value['user_id']+'"> Password: '+ value['password']+'</p>';
                            div += '<button type="button" class="seepassword inline-block ms-3 bg-white border-2 border-black rounded-lg px-1 mt-4 hover:bg-yellow-700 active:bg-yellow-600" title="see passowrd"><img src="/techadmin/admin/svg/eye.svg" alt="eye icons" width="30px" class="hover:text-red-600"></button>' ;
                            div += '<button type="button" class="edit inline-block ms-3  border-2 border-black rounded-lg px-1 mt-4 bg-green-600 hover:bg-green-700 active:bg-green-400" title="Edit This Account"><img src="/techadmin/admin/svg/edit.svg" alt="eye icons" width="30px" class="hover:text-red-600"></button>' ;
                            div += '<button type="button" class="delete inline-block ms-3 bg-red-600 border-2 border-black rounded-lg px-1 mt-4 hover:bg-red-700 active:bg-red-400" title="Remove This Account"><img src="/techadmin/admin/svg/trash.svg" alt="eye icons" width="30px" class="hover:text-red-600"></button>' ;
                            div += '</div>';
                            $('.boxTheme').append(div);
                        });
                    },
                    error: function(e){
                        console.log(e);
                    }
                });
            });
            $('.boxTheme').on('click', '.edit', function(){
                // Get the user_id from the clicked button's parent div
                var user_id = $(this).parent().attr('value');

                // Create a form dynamically
                var form = $('<form action="/techadmin/admin/mguser/edit" method="post"></form>');
                // Add an input field for user_id
                form.append('<input type="hidden" name="user_id" value="' + user_id + '">');
                // Append the form to the body
                $('body').append(form);
                // Submit the form
                form.submit();
        });
            $('.boxTheme').on('click', '.delete', function(){
                // let selector = '#delete' + $(this).parent().attr('value');
                $.post('/techadmin/admin/mguser/deleteuser', {user_id: parseInt($(this).parent().attr('value'))}, function(res){
                    location.reload();
                });
            });
            $('.boxTheme').on('click', '.seepassword', function(){
                let selector = '#p' + $(this).parent().attr('value');
                $(selector).removeClass('hidden').addClass('text-red-700');
                $(this).addClass('hidepassword').removeClass('seepassword');
                $(this).find('img').attr('src', '/techadmin/admin/svg/eyehide.svg');
            });
            $('.boxTheme').on('click', '.hidepassword', function(){
                let selector = '#p' + $(this).parent().attr('value');
                $(selector).removeClass('text-red-700').addClass('hidden');
                $(this).addClass('seepassword').removeClass('hidepassword');
                $(this).find('img').attr('src', '/techadmin/admin/svg/eye.svg');
            });
            $('.themebtn').click(function(){
                if(!$(this).hasClass('selected')){
                        $(this).siblings().attr('class', 'col themebtn px-3 py-1 cursor-pointer hover:bg-[#eee]')
                        $(this).attr('class', 'col themebtn selected px-3 py-1 cursor-pointer bg-[#111] text-white hover:bg-[#777]');
                }
                
            });
            $('#adduser').click(function(){
                window.location.href = '/techadmin/admin/mguser/add';
            })
        });
    </script>
</head>
<body>
    <?php require_once '../app/component/nav.php';?>
    <h1 class="text-2xl font-bold text-center">Quản Lý người dùng</h1>
    <div class="grid md:grid-cols-2 md:p-1 p-0 mb-5">
        <div class="md:col-span-1 col-span-2 cursor-pointer w-[max-content] px-5 py-1 border-2 border-gray-900 rounded-lg bg-green-600 hover:bg-green-800 active:bg-yellow-600" id="adduser">
            <img src="/techadmin/admin/svg/add.svg" alt="add icons" class="inline-block md:w-[30px] w-[10px]">
            <p class="inline-block w-[max-content] text-white font-bold">Thêm Người Dùng</p>
        </div>
        <div class="md:col-span-1 col-span-2 md:absolute md:right-0 md:me-4 border-2 border-gray-900 rounded-lg flex flex-row w-[max-content]">
            <div class="col themebtn selected px-3 py-1 cursor-pointer bg-[#111] text-white hover:bg-[#777]" id="opt1">Box</div>
            <div class="col themebtn px-3 py-1 cursor-pointer hover:bg-[#eee]" id="opt2">List</div>
        </div>
    </div>
    <div class="boxTheme grid md:grid-cols-12 grid-cols-6 w-[80%] mx-auto p-3 gap-3">
        
    </div>
</body>
</html>