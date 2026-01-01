<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <nav id="navbar" class="px-12 pt-8 fixed inset-x-0 top-0  bg-transparent transition-all duration-300 z-50">
        <div class="border-b-2 border-black flex justify-between items-center pb-2">
            <p class="font-shrikhand">WasteCare</p>
            <ul class="flex justify-between w-2/5 items-center">
                <li><a href="<?= BASEURL . '' ?>">Home</a></li>
                <li><a href="<?= BASEURL . '/about' ?>">About</a></li>
                <li class="font-bold"><a href="<?= BASEURL . '/services' ?>">Services</a></li>
                <!-- <li><a href="<?php // echo BASEURL . '/blogs' ?>">Blogs</a></li> -->
                <?php if (!isset($_SESSION['user'])) : ?>
                <li><a href="<?= BASEURL . '/login' ?>" class="rounded-full border-black border-1 py-1 px-6">Login</a></li>
                <?php else : ?>
                    <li><a href="<?= BASEURL . '/logout' ?>" class="rounded-full border-black border-1 py-1 px-6">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="bg-gray-300 rounded-3xl m-4 px-16 py-56 flex flex-col justify-center mb-16 items-center">
        <h1 class="md:text-8xl lg:text-9xl text-4xl font-shrikhand text-center mb-4 uppercase">Services</h1>
        <p class="md:text-2xl text-lg text-center mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
        <div class="flex w-xl mt-5">
            <a href="<?= BASEURL . '/services#services' ?>" class="m-auto rounded-full border-black border-2 py-2 px-8 md:text-xl text-base font-bold">Lihat Layanan</a>
            <a href="<?= BASEURL . '/institution/register' ?>" class="m-auto rounded-full bg-black border-black border-2 py-2 px-8 md:text-xl text-base text-white font-bold">Daftar Lembaga</a>
        </div>
    </div>
    <div class="w-6xl m-auto mb-16" id="services">
        <div class="w-4xl m-auto flex flex-col justify-center text-center mb-8">
            <h2 class="text-4xl font-shrikhand mb-4">Layanan Unggulan</h2>
            <p class="text-2xl text-lg mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
            <div class="flex justify-between overflow-x-auto no-scrollbar">
                <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            </div>
        </div>
        <div class="flex flex-wrap justify-between overflow-x-auto gap-4">
            <?php if (!empty($services)) : ?>
                <?php foreach ($services as $service) : ?>
                    <div class="basis-[30%] m-5 shadow-md hover:shadow-lg transition-shadow rounded-2xl">
                        <div class="rounded-2xl overflow-hidden bg-white h-full">

                            <!-- IMAGE -->
                            <div 
                                class="h-44 bg-cover bg-center relative"
                                style="background-image: url('<?= BASEURL . ($service['image'] ? '/public/uploads/services/' . $service['image'] : '/assets/img/default-service.jpg'); ?>');"
                            >
                                <span class="absolute top-3 right-3 text-xs px-2 py-1 rounded-full
                                    <?= $service['is_active']
                                        ? 'bg-blue-100 text-blue-700'
                                        : 'bg-red-100 text-red-700' ?>">
                                    <?= $service['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                            </div>

                            <!-- CONTENT -->
                            <div class="p-6 flex flex-col justify-between h-[260px]">
                                <div>
                                    <h3 class="text-xl font-shrikhand mb-2">
                                        <?= htmlspecialchars($service['name']) ?>
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-3">
                                        <?= htmlspecialchars($service['description']) ?>
                                    </p>
                                </div>

                                <a href="<?= BASEURL . '/service/detail/' . $service['service_id'] ?>" class="block text-center rounded-full border-2 border-black py-2 font-bold
                                        hover:bg-[#0A452B] hover:text-white transition">
                                    Pesan
                                </a>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
    <footer class="bg-[#0A452B] text-white py-8">
        <div class="w-6xl flex justify-between m-auto">
            <div class="w-1/3">
                <h5 class="text-2xl font-shrikhand mb-2">WasteCare</h5>
                <p class="text-base">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
            </div>
            <div class="">
                <h6 class="font-bold mb-2">Related Links</h6>
                <ul>
                    <li class="mb-2"><a href="<?= BASEURL . '/index' ?>">Home</a></li>
                    <li class="mb-2"><a href="<?= BASEURL . '/about' ?>">About</a></li>
                    <li class="mb-2"><a href="<?= BASEURL . '/services' ?>">Services</a></li>
                    <li class="mb-2"><a href="<?= BASEURL . '/blogs' ?>">Blogs</a></li>
                </ul>
            </div>
            <div class="">
                <h6 class="font-bold mb-2">Social Media</h6>
                <div class="flex">
                    <div class="h-8 w-8 rounded-full bg-gray-300 me-2"></div>
                    <div class="h-8 w-8 rounded-full bg-gray-300 me-2"></div>
                    <div class="h-8 w-8 rounded-full bg-gray-300 me-2"></div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const navbar = document.getElementById("navbar");
        const firstDiv = document.querySelector("#navbar div");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 10) {
                navbar.classList.add("bg-[#0A452B]", "shadow", "py-4", "text-white");
                navbar.classList.remove("bg-transparent", "pt-8", "text-black");
                firstDiv.classList.remove("border-b-2", "border-black", "pb-2");
                document.querySelector("#navbar div ul li:last-child a").classList.remove("border-black");
                document.querySelector("#navbar div ul li:last-child a").classList.add("border-white");
            } else {
                navbar.classList.add("bg-transparent", "text-black", "pt-8");
                navbar.classList.remove("bg-white", "shadow", "text-white");
                firstDiv.classList.add("border-b-2", "border-black", "pb-2");
                document.querySelector("#navbar div ul li:last-child a").classList.add("border-black");
                document.querySelector("#navbar div ul li:last-child a").classList.remove("border-white");
            }
        });
    </script>
</body>
</html>