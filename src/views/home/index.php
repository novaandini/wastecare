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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-poppins">
    <nav id="navbar" class="px-12 pt-8 fixed inset-x-0 top-0  bg-transparent transition-all duration-300 z-50">
        <div class="border-b-2 border-black flex justify-between items-center pb-2">
            <p class="font-shrikhand">WasteCare</p>
            <ul class="flex justify-between w-2/5 items-center">
                <li class="font-bold"><a href="<?= BASEURL . '' ?>">Home</a></li>
                <li><a href="<?= BASEURL . '/about' ?>">About</a></li>
                <li><a href="<?= BASEURL . '/services' ?>">Services</a></li>
                <!-- <li><a href="<?php // echo BASEURL . '/blogs' ?>">Blogs</a></li> -->
                <?php if (!isset($_SESSION['user'])) : ?>
                <li><a href="<?= BASEURL . '/login' ?>" class="rounded-full border-black border-1 py-1 px-6">Login</a></li>
                <?php else : ?>
                    <li><a href="<?= BASEURL . '/logout' ?>" class="rounded-full border-black border-1 py-1 px-6">Logout</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <div class="bg-gray-300 rounded-3xl m-4 px-16 py-56 flex flex-col justify-center mb-16 bg-[url('../../../public/image/waste.jpg')] bg-cover bg-center bg-white/30 bg-blend-overlay">
        <h1 class="md:text-8xl lg:text-9xl text-4xl text-center mb-4 font-shrikhand">WasteCare</h1>
        <p class="md:text-2xl text-lg text-center mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
        <a href="<?= BASEURL . '#services' ?>" class="m-auto rounded-full border-black border-2 py-2 px-8 md:text-xl text-base font-bold">Cari Layanan</a>
    </div>
    <div class="w-6xl m-auto mb-16">
        <div class="w-4xl m-auto flex flex-col justify-center text-center mb-8">
            <h2 class="text-4xl mb-4 font-shrikhand">Lembaga Terpercaya di Bali</h2>
            <p class="text-2xl text-lg mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
            <a href="" class="m-auto rounded-full border-black border-1 py-1 px-4 md:text-base text-sm">Lihat Selengkapnya</a>
        </div>
        <div class="flex justify-content-between overflow-x-auto mb-8 no-scrollbar">
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
            <button type="button" class="rounded-full border-black border-1 py-1 px-6 me-4">Denpasar</button>
        </div>
        <div class="flex justify-content-between overflow-x-auto">
            <div class="bg-gray-300 w-96 h-96 me-4"></div>
            <div class="bg-gray-300 w-64 h-96 me-4"></div>
            <div class="bg-gray-300 w-64 h-96 me-4"></div>
            <div class="bg-gray-300 w-64 h-96 me-4"></div>
        </div>
    </div>
    <div class="w-6xl m-auto mb-16" id="services">
        <div class="w-4xl m-auto flex flex-col justify-center text-center mb-8">
            <h2 class="text-4xl mb-4 font-shrikhand">Layanan Unggulan</h2>
            <p class="text-2xl text-lg mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
            <a href="<?= BASEURL . '/services' ?>" class="m-auto rounded-full border-black border-1 py-1 px-4 md:text-base text-sm">Lihat Selengkapnya</a>
        </div>
        <div class="flex gap-4 overflow-x-auto pb-4">
            <?php if (!empty($services)) : ?>
                <?php foreach ($services as $service) : ?>
                    <div
                    class="basis-[32%] h-96 p-8 rounded-2xl flex flex-col justify-between bg-cover bg-center bg-white/60 bg-blend-overlay"
                    style="background-image: url('<?= BASEURL . ($service['image'] ? '/public/uploads/services/' . $service['image'] : '/assets/img/default-service.jpg') ?>');"
                    >
                        <div class="">
                            <h3 class="text-xl font-shrikhand"><?= htmlspecialchars($service['name']) ?></h3>
                            <p class="line-clamp-3"><?= htmlspecialchars($service['description']) ?></p>
                        </div>
                        <div class="bottom-0">
                            <div class="flex w-full justify-between mb-2 text-xl">
                                <!-- <h4 class="font-bold">Rp <?php // number_format($service['price'], 0, ',', '.') ?></h4> -->
                                <?php if ($service['is_active']) : ?>
                                    <h4 class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                        Aktif
                                    </h4>
                                <?php else : ?>
                                    <h4 class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">
                                        Nonaktif
                                    </h4>
                                <?php endif; ?>
                            </div>
                            <a href="<?= BASEURL . '/service/detail/' . $service['service_id'] ?>" class="block m-auto rounded-full border-black border-2 py-2 px-8 md:text-xl text-base font-bold text-center">Pesan</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- <div class="w-6xl m-auto mb-16">
        <div class="w-4xl m-auto flex flex-col justify-center text-center mb-8">
            <h2 class="text-4xl mb-4 font-shrikhand">Berita Terkini</h2>
            <p class="text-2xl text-lg mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
            <a href="" class="m-auto rounded-full border-black border-1 py-1 px-4 md:text-base text-sm">Lihat Selengkapnya</a>
        </div>
        <div class="flex justify-content-between overflow-x-auto">
            <div class="bg-gray-300 w-1/3 h-64 me-4"></div>
            <div class="bg-gray-300 w-1/3 h-64 me-4"></div>
            <div class="bg-gray-300 w-1/3 h-64 me-4"></div>
        </div>
    </div> -->
    <!-- <div class="w-6xl m-auto mb-16">
        <div class="w-4xl m-auto flex flex-col justify-center text-center mb-8">
            <h2 class="text-4xl mb-4 font-shrikhand">Frequently Asked Question</h2>
            <p class="text-2xl text-lg mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
        </div>
        <div class="flex flex-col overflow-x-auto">
            <div class="bg-gray-300 mb-4 px-5 rounded-lg overflow-hidden">
                <div class="flex justify-between items-center py-3">
                    <h2>Apa saja layanan yang ditawarkan Indo Jasa Legality?</h2>
                    <div class="border-2 h-8 min-w-8 text-center ml-3 rounded-full ease-in-out duration-500 cursor-pointer ">+</div>
                </div>
                <p class="ease-in-out duration-500 max-h-0 py-0">Seluruh transaksi hanya dilakukan melalui rekening resmi atas nama PT Indo Jasa Legality atau melalui sistem COD. Hal ini untuk memastikan keamanan dan kepercayaan penuh bagi klien.</p>
            </div>
        </div>
    </div> -->
    <footer class="bg-[#0A452B] text-white py-8">
        <div class="w-6xl flex justify-between m-auto">
            <div class="w-1/3">
                <h5 class="text-2xl mb-2 font-shrikhand">WasteCare</h5>
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