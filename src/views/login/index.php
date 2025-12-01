<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title><?= $title ?></title>
</head>
<body>
    <div class="h-svh p-5">
        <div class="bg-stone-300 h-full rounded-xl text-white flex justify-center items-center">
            <div class="bg-[#0A452A] w-sm p-12 rounded-xl h-fit">
                <h1 class="text-2xl text-center font-bold">Login</h1>
                <form action="<?= BASEURL . '/login/verify' ?>" method="post" class="">
                    <div class="mt-2">
                        <p>Email</p>
                        <input type="email" name="email" id="email" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1">
                    </div>
                    <div class="mt-2">
                        <p>Password</p>
                        <input type="password" name="password" id="password" class="bg-white rounded-md text-black w-full py-1 px-2 mt-1">
                    </div>
                    <button type="submit" class="mt-4 bg-white rounded-md text-black w-full py-1 px-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>