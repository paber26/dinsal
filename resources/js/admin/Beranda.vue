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
                    <p class="text-gray-700 text-3xl font-bold text-right">
                        {{ info.proyekberlangsung }}
                    </p>
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
                    <p class="text-gray-700 text-3xl font-bold text-right">
                        {{ info.proyekberakhir }}
                    </p>
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Kegiatan Berlangsung
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">
                        {{ info.kegiatanberlangsung }}
                    </p>
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Kegiatan Berakhir
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">
                        {{ info.kegiatanberakhir }}
                    </p>
                </div>
            </div>
        </div>

        <div class="w-11/12 grid grid-cols-3 gap-2 justify-center mt-4">
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Total Kritik dan Saran
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">
                        {{ info.kritikdansaran }}
                    </p>
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Total Admin
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">
                        {{ info.admin }}
                    </p>
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Banyak Kunjungan
                    </h5>
                    <p class="text-gray-700 text-3xl font-bold text-right">
                        {{ info.kegiatanberakhir }}
                    </p>
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
            info: "",
            namaproper: this.user.nama,
        };
    },
    mounted() {
        axios
            .get("/api/admin/getinfoberanda", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.user.api_token,
                },
            })
            .then((response) => {
                console.log(response.data);
                this.info = response.data;
                // this.daftarproyek = response.data[0];
                // this.proyek = response.data[1][0];

                // this.fields.proyekid = this.proyek.idp;
                // console.log(this.proyek);
                // console.log(response.data);
            });
    },
};
</script>
