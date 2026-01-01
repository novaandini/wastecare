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
    <?php
    Message::flash();
    ?>
    <nav id="navbar" class="px-12 pt-8 fixed inset-x-0 top-0  bg-transparent transition-all duration-300 z-50">
        <div class="border-b-2 border-black flex justify-between items-center pb-2">
            <p class="font-shrikhand">WasteCare</p>
            <ul class="flex justify-between w-2/5 items-center">
                <li><a href="<?= BASEURL . '' ?>">Home</a></li>
                <li><a href="<?= BASEURL . '/about' ?>">About</a></li>
                <li class="font-bold"><a href="<?= BASEURL . '/services' ?>">Services</a></li>
                <!-- <li><a href="<?php // BASEURL . '/blogs' ?>">Blogs</a></li> -->
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li><a href="<?= BASEURL . '/login' ?>" class="rounded-full border-black border-1 py-1 px-6">Login</a></li>
                <?php else : ?>
                    <li>
                        <button id="userMenuBtn" class="rounded-full border-black border-1 py-1 px-6 flex items-center gap-2">
                            My Account
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute hidden border border-1 mt-2 overflow-hidden bg-white rounded-lg text-black flex flex-col" id="userMenu">
                            <a href="<?= BASEURL ?>" class="py-1 px-6 hover:bg-gray-200">Profile</a>
                            <a href="<?= $_SESSION['user']['role'] == 'admin' ? BASEURL . '/admin/dashboard' : BASEURL . '/dashboard' ?>" class="py-1 px-6 hover:bg-gray-200">My Dashboard</a>
                            <a href="<?= BASEURL ?>" class="py-1 px-6 hover:bg-gray-200">Log Out</a>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <div class="rounded-3xl mx-12 mt-32 flex mb-16 gap-16">
        <div class="w-1/3 rounded-xl bg-cover bg-center" style="background-image: url('<?= BASEURL . ($data['image'] ? '/public/uploads/services/' . $data['image'] : '/assets/img/default-service.jpg') ?>');"></div>
        <div class="w-2/3">
            <h1 class="text-2xl font-bold"><?= $data['name'] ?></h1>
            <p class="text-lg my-4"><?= $data['description'] ?></p>
            <div class="flex items-center justify-between">
                <?php if ($data['is_active']) : ?>
                    <h4 class="text-base bg-blue-100 text-blue-700 px-2 py-1 rounded">
                        Aktif
                    </h4>
                <?php else : ?>
                    <h4 class="text-base bg-red-100 text-red-700 px-2 py-1 rounded">
                        Nonaktif
                    </h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <form method="POST" action="<?= BASEURL . '/service/subscribe' ?>" class="relative">
        <?php if (!$isLoggedIn): ?>
            <div class="absolute inset-0 bg-white/20 backdrop-blur-sm flex items-center justify-center z-10">
                <div class="text-center">
                    <p class="mb-4 font-semibold">Silakan login untuk melanjutkan</p>
                    <a href="<?= BASEURL . '/login' ?>"
                    class="px-6 py-2 rounded-full bg-black text-white">
                        Login
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <fieldset <?= !$isLoggedIn ? 'disabled' : '' ?> class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-8 my-16" >
            <div>
                <h3 class="text-lg font-bold mb-2">Layanan</h3>
                <p class="text-gray-700"><?= htmlspecialchars($data['name']) ?></p>
                <input type="hidden" name="service_id" value="<?= $data['service_id'] ?>">
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Pilih Paket</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($packages as $package): ?>
                        <label class="border rounded-xl p-4 cursor-pointer hover:border-black transition">
                            <input type="radio" name="service_package_id"
                                value="<?= $package['service_package_id'] ?>"
                                class="hidden peer" required>

                            <div class="peer-checked:border-black peer-checked:ring-2 peer-checked:ring-black rounded-xl">
                                <h4 class="font-semibold"><?= $package['package_name'] ?></h4>
                                <p class="text-sm text-gray-600">
                                    <?= $package['duration_value'] ?>
                                    <?= $package['duration_type'] === 'monthly' ? 'Bulan' : 'Tahun' ?>
                                </p>
                                <p class="font-bold mt-2">
                                    Rp <?= number_format($package["price_per_kk"], 0, ',', '.') ?>
                                </p>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-3">Hari Pengangkutan</h3>

                <div class="grid grid-cols-3 gap-3">
                    <?php
                    $days = ['Mon'=>'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>'Jumat'];
                    foreach ($days as $key => $label):
                    ?>
                        <label class="flex items-center gap-2 border rounded-lg px-3 py-2 cursor-pointer">
                            <input type="checkbox" name="pickup_days[]" value="<?= $key ?>">
                            <span><?= $label ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <p class="text-xs text-gray-500 mt-2">
                    Minimal 2 hari per minggu
                </p>
            </div>
            <div class="">
                <h3 class="text-lg font-bold mb-4">Lokasi Pengangkutan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="">
                        <label class="block text-sm font-medium mb-2">Nama Desa/Banjar</label>
                        <input type="text" name="village_name" required
                            class="bg-white rounded-lg px-3 py-2 text-black w-full border border-grey-300 focus:border-black focus:ring-black">
                    </div>
            
                    <div class="">
                        <label class="block text-sm font-medium mb-2">Kecamatan</label>
                        <input type="text" name="district_name" required
                            class="bg-white rounded-lg px-3 py-2 text-black w-full border border-grey-300 focus:border-black focus:ring-black">
                    </div>
            
                    <div class="">
                        <label class="block text-sm font-medium mb-2">Kota/Kabupaten</label>
                        <select name="city_name" id="" class="bg-white rounded-lg px-3 py-2 text-black w-full border border-grey-300 focus:border-black focus:ring-black">
                            <?php foreach ($regions as $region) : ?>
                                <option value="<?= $region['region_name'] ?>"><?= $region['region_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            
                    <div class="">
                        <label class="block text-sm font-medium mb-2">Jumlah KK</label>
                        <input type="number" name="total_kk" min="1" required
                            class="bg-white rounded-lg px-3 py-2 text-black w-full border border-grey-300 focus:border-black focus:ring-black">
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Data Penanggung Jawab</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="flex items-center gap-2 rounded-lg cursor-pointer">
                            <input type="checkbox" name="use_account" id="use_account" value="<?= $key ?>">
                            <span>Pemilik akun sebagai penanggung jawab</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Nama Penanggung Jawab</label>
                        <input type="text" name="contact_name" id="contact_name" required
                        class="bg-white rounded-lg px-3 py-2 text-black w-full border border-grey-300 focus:border-black focus:ring-black">
                    </div>

                    <div class="">
                        <label class="block text-sm font-medium mb-2">Nomor Kontak</label>
                        <input type="text" name="contact_phone" id="contact_phone" required
                            class="bg-white rounded-lg px-3 py-2 text-black w-full border border-grey-300 focus:border-black focus:ring-black">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-2">Alamat Lengkap Penanggung Jawab</label>
                        <input type="text" name="contact_address" id="contact_address" required
                            class="bg-white rounded-lg px-3 py-2 text-black w-full border border-grey-300 focus:border-black focus:ring-black">
                    </div>

                </div>
            </div>
            <div class="pt-6 border-t flex justify-end">
                <button type="submit"
                    class="px-8 py-3 rounded-full bg-white text-black font-bold border border-2 border-black hover:bg-[#0A452B] hover:text-white transition">
                    Ajukan Langganan
                </button>
            </div>
        </fieldset>
    </form>

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
                document.querySelector("#navbar div ul li:last-child button").classList.remove("border-black");
                document.querySelector("#navbar div ul li:last-child button").classList.add("border-white");
            } else {
                navbar.classList.add("bg-transparent", "text-black", "pt-8");
                navbar.classList.remove("bg-white", "shadow", "text-white");
                firstDiv.classList.add("border-b-2", "border-black", "pb-2");
                document.querySelector("#navbar div ul li:last-child button").classList.add("border-black");
                document.querySelector("#navbar div ul li:last-child button").classList.remove("border-white");
            }
        });

        const btn = document.getElementById('userMenuBtn');
        const menu = document.getElementById('userMenu');

        if (btn && menu) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        }

        const loggedUser = <?= json_encode([
            'name'  => $_SESSION['user']['name'] ?? '',
            'phone_number' => $_SESSION['user']['phone_number'] ?? '',
            'address' => $_SESSION['user']['address'] ?? ''
        ]); ?>;

        console.log(loggedUser);

        const checkbox = document.getElementById('use_account');
        const nameInput = document.getElementById('contact_name');
        const phoneInput = document.getElementById('contact_phone');
        const addressInput = document.getElementById('contact_address');

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                nameInput.value = loggedUser.name;
                phoneInput.value = loggedUser.phone_number;
                addressInput.value = loggedUser.address;
            } else {
                nameInput.value = '';
                phoneInput.value = '';
                addressInput.value = '';
            }
        });
    </script>
</body>
</html>