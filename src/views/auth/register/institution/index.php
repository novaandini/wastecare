<?php
$data = Message::getData();
$name = '';
$email = '';
$brn = '';
$address = '';
$phone_number = '';
$social_media = '';
if ($data) {
  $name = $data['name'];
  $email = $data['email'];
  $brn = $data['brn'];
  $address = $data['address'];
  $phone_number = $data['phone_number'];
  $social_media = $data['social_media'];
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
            <div class="bg-[#0A452A] w-2xl p-12 rounded-xl h-fit">
                <h1 class="text-2xl text-center font-bold">Institution Registration</h1>
                <form action="<?= BASEURL . '/institution/register/store' ?>" method="post" class="">
                    <div class="flex flex-wrap justify-between">
                        <!-- <div class=""> -->
                            <div class="mt-2 w-3xs">
                                <p>Business Name</p>
                                <input type="text" name="name" id="name" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $name ?>">
                            </div>
                            <div class="mt-2 w-3xs">
                                <p>Email</p>
                                <input type="email" name="email" id="email" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $email ?>">
                            </div>
                            <div class="mt-2 w-3xs">
                                <p>Password</p>
                                <input type="password" name="password" id="password" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1">
                            </div>
                            <div class="mt-2 w-3xs">
                                <p>Confirm Password</p>
                                <input type="password" name="confirm_password" id="confirm_password" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1">
                            </div>
                        <!-- </div>
                        <div class=""> -->
                            <div class="mt-2 w-3xs">
                                <p>Nomor Induk Berusaha (NIB)</p>
                                <input type="text" name="brn" id="brn" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $brn ?>">
                            </div>
                            <div class="mt-2 w-3xs">
                                <p>Address</p>
                                <input type="text" name="address" id="address" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $address ?>">
                            </div>
                            <div class="mt-2 w-3xs">
                                <p>Nomor Telepon</p>
                                <input type="text" name="phone_number" id="phone_number" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $phone_number ?>">
                            </div>
                            <div class="mt-2 w-3xs">
                                <p>Media Sosial</p>
                                <input type="text" name="social_media" id="social_media" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1" value="<?= $social_media ?>">
                            </div>
                        <!-- </div> -->
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