<?php
$data = Message::getData();
$name = '';
$email = '';
$password = '';
$confirm_password = '';
if ($data) {
  $name = $data['name'];
  $email = $data['email'];
  $password = $data['password'];
  $confirm_password = $data['confirm_password'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title><?= $title ?></title>
</head>
<body>
    <?php Message::flash(); ?>
    <div class="h-svh p-5">
        <div class="bg-stone-300 h-full rounded-xl text-white flex justify-center items-center">
            <div class="bg-[#0A452A] w-sm p-12 rounded-xl h-fit">
                <h1 class="text-2xl text-center font-bold">Register</h1>
                <form action="<?= BASEURL . '/register/store' ?>" method="post" class="">
                    <div class="mt-2">
                        <p>Name</p>
                        <input type="text" name="name" id="name" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $name ?>">
                    </div>
                    <div class="mt-2">
                        <p>Email</p>
                        <input type="email" name="email" id="email" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $email ?>">
                    </div>
                    <div class="mt-2">
                        <p>Password</p>
                        <input type="password" name="password" id="password" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1">
                    </div>
                    <div class="mt-2">
                        <p>Confirm Password</p>
                        <input type="password" name="confirm_password" id="confirm_password" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1">
                    </div>
                    <div class="mt-2">
                        <p>Sudah punya akun? <a class="underline" href="<?= BASEURL . '/login' ?>">Login</a></p>
                    </div>
                    <button type="submit" class="mt-4 bg-white rounded-md text-black w-full py-1 px-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>