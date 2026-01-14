<section class="max-w-5xl mx-auto px-6 py-10 mt-20">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Detail Langganan</h1>
        <!-- <p class="text-sm text-gray-600">
            Kode Subscription: SUB-2026-0012
        </p> -->
    </div>

    <div class="grid grid-cols-2 gap-4 mb-8">
        <div class="p-4 border rounded-xl">
            <p class="text-sm text-gray-500">Status</p>
            <p class="font-bold text-green-700"><?= $data['status'] ?></p>
        </div>

        <div class="p-4 border rounded-xl">
            <p class="text-sm text-gray-500">Total Pembayaran</p>
            <p class="font-bold">Rp <?= number_format($data["price_per_kk"], 0, ',', '.') ?></p>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="font-semibold mb-3">Detail Paket</h2>

        <ul class="text-sm space-y-2">
            <li>Nama Paket: <strong><?= $data['package']['package_name'] ?></strong></li>
            <li>Periode: <strong><?= $data['start_date'] ?> - <?= $data['end_date'] ?></strong></li>
            <li>Total KK: <strong><?= $data['total_kk'] ?></strong></li>
        </ul>
    </div>

    <div class="mb-8">
        <h2 class="font-semibold mb-3">Jadwal Pickup</h2>

        <?php
        function hariIndonesia($day) {
            return [
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu',
                'Sun' => 'Minggu',
            ][$day] ?? $day;
        }
        ?>
        <ul class="grid grid-cols-2 gap-3 text-sm">
            <?php foreach ($data['weekly_routes'] as $weekly_route): ?>
            <li class="border rounded-lg p-3"><?= hariIndonesia($weekly_route['weekday']) ?></li>
            <?php endforeach ?>
        </ul>
    </div>

    <div class="mb-8">
        <h2 class="font-semibold mb-3">Armada & Tim</h2>

        <div class="border rounded-xl p-4 text-sm">
            <p>Armada: <strong><?= $data['vehicle']['vehicle_name'] ?></strong></p>
            <p>Nama Petugas: <strong><?= $data['user']['name'] ?></strong></p>
            <p>Email Petugas: <strong><?= $data['user']['email'] ?></strong></p>
            <p>Nomor Telepon Petugas: <strong><?= $data['user']['phone_number'] ?></strong></p>
        </div>
    </div>

    <!-- <div>
        <h2 class="font-semibold mb-3">Riwayat Pengangkutan</h2>

        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2 border">5 Jan 2026</td>
                    <td class="p-2 border text-green-700">Selesai</td>
                </tr>
            </tbody>
        </table>
    </div> -->
</section>
