<div class="bg-[url('<?= BASEURL ?>/public/image/services.jpg')] bg-cover bg-center bg-white/30 bg-blend-overlay rounded-3xl m-4 px-16 py-56 flex flex-col justify-center mb-16 items-center">
    <h1 class="md:text-8xl lg:text-9xl text-4xl font-shrikhand text-center mb-4 uppercase">Services</h1>
    <p class="md:text-2xl text-lg text-center mb-4">Setiap layanan dijalankan dengan jadwal tetap, armada khusus, serta petugas yang bertanggung jawab.</p>
    <div class="flex w-xl mt-5">
        <a href="<?= BASEURL . '/services#services' ?>" class="m-auto rounded-full border-black border-2 py-2 px-8 md:text-xl text-base font-bold">Lihat Layanan</a>
    </div>
</div>
<div class="w-6xl m-auto mb-16" id="services">
    <div class="w-4xl m-auto flex flex-col justify-center text-center mb-8">
        <h2 class="text-4xl font-shrikhand mb-4">Layanan Unggulan</h2>
        <p class="text-2xl text-lg mb-4">Setiap layanan dirancang untuk memberikan kepastian jadwal, konsistensi armada, dan kejelasan tanggung jawab selama masa langganan.</p>
        <div class="flex justify-between overflow-x-auto no-scrollbar">
            <?php // if (!empty($regions)) : ?>
            <?php // foreach ($regions as $region) : ?>
                <!-- <label class="flex items-center gap-2 border rounded-lg px-3 py-2 cursor-pointer">
                    <input type="radio" name="pickup_days[]" value="<?= $key ?>">
                    <span><?= $label ?></span>
                </label> -->
            <?php // endforeach; ?>
            <?php // endif; ?>
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
