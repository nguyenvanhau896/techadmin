<?php require_once '../app/component/checkAdminLogin.php';
    if(isset($_POST['user_id'])){   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../app/component/head.php';?>
    <title>Edit | ADMIN</title>
</head>
<body>
<?php
        require_once('../app/component/nav.php');
    ?>
    <main class="grid grid-cols-12 p-6">
    <div class="col-span-6">
        <?php 
            if($data['avatar'] == null){
        ?>
        <div class="transition ease-in-out delay-150 hover:scale-110"><img src="/techadmin/admin/img/profile.png" alt="default avatar" width="200px" height="200px" class="block mx-auto"></div>
        <p class="text-center font-bold transition ease-in-out delay-150 text-blue-500 hover:-translate-y-1 hover:scale-110 hover:text-indigo-500 duration-300">This account is <?php echo $data['name'];?></p>
        <?php
            }
        ?>
    </div>
    <div class="col-span-6">
        <div>
            <h1 class="mb-[1rem] text-lg font-bold">Chỉnh sửa thông tin</h1>
        </div>
        
        <form action="/techadmin/admin/mguser/changeinfo" method="post" class="mb-3">
            <label for="name">Name</label><br>
            <input type="text" class="w-[50%]" value="<?php echo $data['name'];?>" id="name" disabled>
            <br>
            <label for="email">Email</label><br>
            <input type="email" name="email" class="w-[50%]  focus:rounded-lg" value="<?php echo $data['email'];?>" id="email">
            <br>
            <p class="relative">
                <label for="password">Password</label><br>
                <input type="password" name="password" class="w-[50%] focus:rounded-lg" value="<?php echo $data['password'];?>" id="password">
                <i class="bi bi-eye-slash text-lg text-slate-500  font-semibold absolute top-[2rem] left-[46%] hover:text-slate-950 active:text-red-600" id="togglePassword"></i>  
            </p>
            
            <label for="firstname">First Name</label><br>
            <input type="text" name="firstname" class="w-[50%] focus:rounded-lg" value="<?php echo $data['firstname'];?>" id="firstname">
            <br>
            <label for="lastname">Last Name</label><br>
            <input type="text" name="lastname" class="w-[50%] focus:rounded-lg" value="<?php echo $data['lastname'];?>" id="lastname">
            <br>
            <label for="phone">Phone</label><br>
            <input type="number" name="phone" class="w-[50%] focus:rounded-lg" value="<?php echo $data['phone'];?>" id="phone">
            <br>
            <input type="hidden" name="id" value="<?php echo $_POST['user_id']?>">
            <button type="submit" class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 w-[80px] py-1 bg-green-600 hover:bg-green-500 border-2 border-black rounded-lg">Save</button>
        </form>
        <div>
        </div>
    </div>
    </main>
</body>
</html>
<?php }
    else{
        echo 'Nothing in there!';
    }
?>
