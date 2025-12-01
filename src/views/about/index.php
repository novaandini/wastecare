<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/global.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <nav id="navbar" class="px-12 pt-8 fixed inset-x-0 top-0  bg-transparent transition-all duration-300 z-50">
        <div class="border-b-2 border-black flex justify-between items-center pb-2">
            <p class="font-bold">WasteCare</p>
            <ul class="flex justify-between w-2/5 items-center">
                <li><a href="<?= BASEURL . '/index' ?>">Home</a></li>
                <li class="font-bold"><a href="<?= BASEURL . '/about' ?>">About</a></li>
                <li><a href="<?= BASEURL . '/services' ?>">Services</a></li>
                <li><a href="<?= BASEURL . '/blogs' ?>">Blogs</a></li>
                <li><a href="<?= BASEURL . '/login' ?>" class="rounded-full border-black border-1 py-1 px-6">Login</a></li>
            </ul>
        </div>
    </nav>
    <div class="bg-gray-300 rounded-3xl m-4 px-16 py-56 flex flex-col justify-center mb-16">
        <h1 class="md:text-8xl lg:text-9xl text-4xl font-bold text-center mb-4">About</h1>
        <p class="md:text-2xl text-lg text-center mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
        <a href="" class="m-auto rounded-full border-black border-2 py-2 px-8 md:text-xl text-base font-bold">Cerita Kami</a>
    </div>
    <div class="w-6xl m-auto mb-16">
        <div class="">
            <h2 class="text-4xl font-bold mb-4">Why Choose Us?</h2>
            <p class="text-xl mb-4 w-5xl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo, aliquid? Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus?</p>
            <div class="flex justify-between">
                <div class="">
                    <div class="flex justify-start mb-4 items-center">
                        <div class="h-12 w-12 rounded-full bg-gray-300 me-2"></div>
                        <p class="text-xl">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                    </div>
                    <div class="flex justify-start mb-4 items-center">
                        <div class="h-12 w-12 rounded-full bg-gray-300 me-2"></div>
                        <p class="text-xl">Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus.</p>
                    </div>
                    <div class="flex justify-start mb-4 items-center">
                        <div class="h-12 w-12 rounded-full bg-gray-300 me-2"></div>
                        <p class="text-xl">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                    </div>
                    <div class="flex justify-start mb-4 items-center">
                        <div class="h-12 w-12 rounded-full bg-gray-300 me-2"></div>
                        <p class="text-xl">Perspiciatis nulla eius dolor asperiores repellat velit nam ratione natus</p>
                    </div>
                </div>
                <div class="w-1/3 bg-gray-300 rounded-lg"></div>
            </div>
        </div>
    </div>
    <footer class="bg-[#0A452B] text-white py-8">
        <div class="w-6xl flex justify-between m-auto">
            <div class="w-1/3">
                <h5 class="text-2xl font-bold mb-2">WasteCare</h5>
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