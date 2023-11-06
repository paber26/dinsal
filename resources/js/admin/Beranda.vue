<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 justify-center mt-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Selamat pagi, {{ namaproper }} ...
                    </h5>
                    <div class="text-gray-700 text-left">
                        Semangat untuk menjalani hari ini
                    </div>
                </div>
            </div>
        </div>

        <div class="w-11/12 grid grid-cols-4 gap-2 justify-center mt-4">
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Proyek Berlangsung
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">5</p>
                    <!-- <p class="text-gray-700 text-3xl font-bold text-right">{{ jumlah.thread }}</p> -->
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Proyek Berakhir
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">5</p>
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Total User
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">5</p>
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Total Kunjungan
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">5</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            namaproper: this.user.nama
                .toLowerCase()
                .replace(/\b\w/g, (s) => s.toUpperCase()),
        };
    },
};
</script>
