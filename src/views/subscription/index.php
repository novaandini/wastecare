<section class="max-w-6xl mx-auto px-6 py-10 my-20">
    <h1 class="text-2xl font-bold mb-6">Langganan Saya</h1>

    <!-- Filter -->
    <div class="flex gap-3 mb-6">
        <!-- <a href="?status=pending" class="px-4 py-2 rounded-full border">Pending</a>
        <a href="?status=active" class="px-4 py-2 rounded-full border">Active</a>
        <a href="?status=pending" class="px-4 py-2 rounded-full border">Paused</a>
        <a href="?status=completed" class="px-4 py-2 rounded-full border">Ended</a> -->
    </div>

    <!-- List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if (!empty($subscriptions)) : ?>
        <?php foreach ($subscriptions as $subscription) : ?>
            <div class="border rounded-2xl p-6 shadow-sm hover:shadow transition">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="text-lg font-semibold"><?= $subscription['package']['package_name'] ?></h3>
                    <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">
                        <?= $subscription['status'] ?>
                    </span>
                </div>

                <p class="text-sm text-gray-600 mb-2">
                    Layanan: <?= $subscription['service']['name'] ?>
                </p>

                <p class="text-sm">
                    Periode:
                    <strong><?= $subscription['start_date'] ?></strong> – <strong><?= $subscription['end_date'] ?></strong>
                </p>

                <p class="text-sm mb-4">
                    Total KK: <strong><?= $subscription['total_kk'] ?></strong>
                </p>

                <div class="flex justify-between items-center">
                    <span class="font-bold text-green-700">
                        Rp <?= number_format($subscription["price_per_kk"], 0, ',', '.') ?>
                    </span>

                    <a href="/subscription/detail/<?= $subscription['subscription_id'] ?>"
                    class="px-4 py-2 rounded-full border border-black font-semibold">
                        Detail
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
