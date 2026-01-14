
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

    <script>
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