<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 justify-center mt-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        DINSAL
                        <small>(Dashboard Informasi Satu Link)</small>
                    </h5>
                    <div class="text-gray-700 text-left italic">
                        Cari link kegiatan? Ini tempatnya ...
                    </div>
                </div>
            </div>
        </div>

        <button
            @click.prevent="kembali()"
            class="col-span-4 sm:col-span-1 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-1 px-3 rounded-full my-3"
        >
            <p>Kembali ke Halaman Awal</p>
        </button>

        <div class="w-11/12 justify-center">
            <div class="bg-white w-full p-2 rounded-md mb-3">
                <label class="font-medium text-sm">Status Kegiatan</label>
                <select
                    v-model="status"
                    @change="filterstatus()"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                >
                    <option value="Semua">Semua kegiatan</option>
                    <option value="Berlangsung">Sedang berlangsung</option>
                    <option value="Berakhir">Sudah berakhir</option>
                </select>
            </div>
        </div>

        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <div
                class="bg-hijaust w-full p-3 rounded-lg mb-2.5"
                v-if="daftarkegiatan.length == 0"
            >
                <h5 class="mb-2 text-xl font-semibold text-white text-left">
                    {{ proyeknama }}
                </h5>
                <div class="italic">Belum ada kegiatan</div>
            </div>

            <div
                class="bg-hijaust w-full p-3 rounded-lg mb-2.5"
                v-else="daftarkegiatan.length == 0"
            >
                <h5 class="mb-2 text-xl font-semibold text-white text-left">
                    {{ proyeknama }}
                </h5>
                <div
                    class="bg-white rounded-md px-3 py-1 mb-3"
                    v-for="dkegiatan in daftarkegiatan"
                >
                    <div class="flex flex-row items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-3 h-3"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"
                            />
                        </svg>

                        <div class="font-bold ml-1">
                            {{ dkegiatan.nama }}
                        </div>
                    </div>
                    <div class="flex flex-row items-center">
                        <div class="text-gray-600">Link:</div>
                        <a
                            :href="dkegiatan.link"
                            target="_blank"
                            @click="kunjungi(dkegiatan.idk)"
                            class="text-blue-600 italic mx-2"
                        >
                            {{ dkegiatan.link }}
                        </a>
                        <button @click="copytoclipboard(dkegiatan.link)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
                                />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-row items-center">
                        <div class="text-gray-600 mr-2">Shortlink:</div>
                        <a
                            :href="dkegiatan.shortlink"
                            target="_blank"
                            class="text-blue-600 italic"
                        >
                            {{ dkegiatan.shortlink }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["idp"],
    data() {
        return {
            daftarkegiatan: "",
            proyeknama: "",
            status: "Semua",
        };
    },
    mounted() {
        axios.get("/api/user/getnamaproyek/" + this.idp).then((response) => {
            this.proyeknama = response.data.nama;
        });
        this.filterstatus();
    },
    methods: {
        getkegiatan() {
            axios.get("/api/user/getkegiatan/" + this.idp).then((response) => {
                this.daftarkegiatan = response.data;
            });
        },
        getkegiatanfilter() {
            console.log("oke");
            axios
                .get(
                    "/api/user/getkegiatanfilter/" +
                        this.idp +
                        "/" +
                        this.status
                )
                .then((response) => {
                    console.log(response.data);
                    this.daftarkegiatan = response.data;
                });
        },
        filterstatus() {
            if (this.status == "Semua") {
                this.getkegiatan();
            } else {
                this.getkegiatanfilter();
            }
        },
        kembali() {
            this.$router.push("/");
        },
        copytoclipboard(val) {
            navigator.clipboard.writeText(val);
            this.$swal("Link berhasil di copy");
        },
        kunjungi(idk) {
            axios.get("/api/user/getkegiatan/" + this.idp).then((response) => {
                this.daftarkegiatan = response.data;
                console.log(response.data);
            });
            axios.get("/api/user/kegiatan/kunjungi/" + idk).then((response) => {
                console.log(response.data);
            });
        },
    },
};
</script>
