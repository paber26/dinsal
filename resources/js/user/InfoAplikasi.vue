<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 justify-center mt-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        DINSAL (Dashboard Informasi Satu Link)
                    </h5>
                    <div class="text-gray-700 text-left">
                        Semangat untuk menjalani hari ini
                    </div>
                </div>
            </div>
        </div>

        <button
            @click.prevent="kembali()"
            class="col-span-4 sm:col-span-1 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-1 px-3 rounded-full mt-3"
        >
            <p>Kembali ke Halaman Awal</p>
        </button>

        <div class="w-11/12 justify-center mt-3">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <div class="mb-4 text-gray-900 text-left">
                        Dalam era digital yang terus berkembang, BPS memiliki
                        tanggung jawab yang semakin bertambah. Sebagai penyedia
                        data, BPS bertugas untuk memastikan perolehan data yang
                        cepat dan akurat.
                    </div>
                    <div class="mb-4 text-gray-900 text-left">
                        Dalam menjalankan kegiatannya, BPS sering membagikan
                        informasi terkait kegiatan seperti persiapan, pencacahan
                        lapangan, monitoring, serta evaluasi melalui berbagai
                        link. Distribusi informasi ini sering dilakukan melalui
                        media sosial seperti grup WhatsApp atau melalui surel.
                        Namun, banyaknya informasi dalam bentuk link dari
                        berbagai kegiatan seringkali membuat pegawai maupun
                        mitra statistik kesulitan untuk mengingat dan melakukan
                        pencarian, yang berujung pada kemungkinan kelewatnya
                        informasi-informasi penting terkait kegiatan tersebut.
                    </div>
                    <div class="mb-4 text-gray-900 text-left">
                        Untuk pertanyaan lebih lanjut atau jika mengalami
                        kesulitan dalam menggunakan DINSAL, silakan menghubungi
                        Bernaldo melalui WhatsApp di nomor 0823-6005-4904.
                    </div>
                </div>
            </div>
        </div>

        <div class="w-11/12 justify-center mt-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <div class="text-gray-900 text-left flex">
                        <p>Buku panduan aplikasi dapat diundung</p>
                        <a href="#" target="_blank">disini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    // props: ["user"],
    data() {
        return {
            showtambahkanproyek: false,
            showhasilpencarian: false,
            daftarproyek: "",
            daftarpencarian: false,
            fields: {
                status: "Berlangsung",
                keyword: "",
            },
        };
    },
    mounted() {
        axios.get("/api/user/getproyek").then((response) => {
            // this.daftartanggapan = response.data;
            this.daftarproyek = response.data;
            console.log(response.data);
        });
    },
    methods: {
        kembali() {
            this.$router.push("/");
        },
        lihatkegiatan(idp) {
            this.$router.push("/user/kegiatan/" + idp);
        },

        hapus() {
            this.$swal({
                title: "Apakah kamu yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonText: "Hapus",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.fields.judul = "";
                    this.fields.isi = "";
                    this.$swal("Berhasil Menghapus");
                }
            });
        },
        cari() {
            if (this.fields.keyword == "") {
                this.$swal("Masukkan kegiatan yang ingin dicari");
                return;
            } else if (this.fields.keyword.length < 3) {
                this.$swal("Minimal pencarian 3 huruf/angka");
            } else {
                axios
                    .post("/api/user/kegiatan/pencarian", this.fields)
                    .then((response) => {
                        this.showhasilpencarian = true;
                        this.daftarpencarian = response.data;
                        console.log(response.data);
                    });
            }
        },
    },
};
</script>
