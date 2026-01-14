<div class="bg-gray-300 rounded-3xl m-4 px-16 py-56 flex flex-col justify-center mb-16 bg-[url('<?= BASEURL ?>/public/image/waste.jpg')] bg-cover bg-center bg-white/30 bg-blend-overlay">
    <h1 class="md:text-8xl lg:text-9xl text-4xl text-center mb-4 font-shrikhand">WasteCare</h1>
    <p class="md:text-2xl text-lg text-center mb-4">Kami membantu pengelolaan sampah yang lebih tertib, terjadwal, dan transparan dengan dukungan armada serta petugas profesional.</p>
    <a href="<?= BASEURL . '#services' ?>" class="m-auto rounded-full border-black border-2 py-2 px-8 md:text-xl text-base font-bold">Cari Layanan</a>
</div>
<!-- <div class="w-6xl m-auto mb-16">
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
</div> -->
<div class="w-6xl m-auto mb-16" id="services">
    <div class="w-4xl m-auto flex flex-col justify-center text-center mb-8">
        <h2 class="text-4xl mb-4 font-shrikhand">Layanan Unggulan</h2>
        <p class="text-2xl text-lg mb-4">Setiap layanan dirancang dengan sistem langganan yang jelas, armada tetap, dan petugas yang bertanggung jawab.</p>
        <a href="<?= BASEURL . '/services' ?>" class="m-auto rounded-full border-black border-1 py-1 px-4 md:text-base text-sm">Lihat Selengkapnya</a>
    </div>
    <div class="flex gap-4 overflow-x-auto pb-4">
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