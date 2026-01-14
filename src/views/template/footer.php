<footer class="bg-[#0A452B] text-white py-8">
        <div class="w-6xl flex justify-between m-auto">
            <div class="w-1/3">
                <h5 class="text-2xl mb-2 font-shrikhand">WasteCare</h5>
                <p class="text-base">WasteCare adalah lembaga independen yang menyediakan layanan pengangkutan sampah berbasis langganan untuk RT, RW, Banjar, dan Desa.</p>
            </div>
            <div class="">
                <h6 class="font-bold mb-2">Related Links</h6>
                <ul>
                    <li class="mb-2"><a href="<?= BASEURL . '/index' ?>">Home</a></li>
                    <li class="mb-2"><a href="<?= BASEURL . '/about' ?>">About</a></li>
                    <li class="mb-2"><a href="<?= BASEURL . '/services' ?>">Services</a></li>
                    <!-- <li class="mb-2"><a href="<?php // BASEURL . '/blogs' ?>">Blogs</a></li> -->
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
        const firstDiv = navbar.querySelector("div");
        const actionBtn = navbar.querySelector("ul li:last-child .action-btn");

        function toggleClasses(el, add = [], remove = []) {
            add.forEach(c => el.classList.add(c));
            remove.forEach(c => el.classList.remove(c));
        }

        window.addEventListener("scroll", () => {
            const isScrolled = window.scrollY > 10;

            toggleClasses(
                navbar,
                isScrolled ? ["bg-[#0A452B]", "shadow", "py-4", "text-white"] : ["bg-transparent", "pt-8", "text-black"],
                isScrolled ? ["bg-transparent", "pt-8", "text-black"] : ["bg-[#0A452B]", "shadow", "py-4", "text-white"]
            );

            toggleClasses(
                firstDiv,
                isScrolled ? [] : ["border-b-2", "border-black", "pb-2"],
                isScrolled ? ["border-b-2", "border-black", "pb-2"] : []
            );

            if (actionBtn) {
                toggleClasses(
                    actionBtn,
                    isScrolled ? ["border-white"] : ["border-black"],
                    isScrolled ? ["border-black"] : ["border-white"]
                );
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
    </script>
</body>
</html>