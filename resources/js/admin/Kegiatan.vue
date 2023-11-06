<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Daftar Kegiatan</span>

            <div class="bg-white w-full p-2 rounded-md mb-2">
                <label class="font-medium text-sm">Status Kegiatan</label>
                <select
                    v-model="fields.status"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                >
                    <option value="Semua" selected>Semua kegiatan</option>
                    <option value="Berlangsung">Sedang berlangsung</option>
                    <option value="Berakhir">Sudah berakhir</option>
                </select>
            </div>

            <div class="bg-white w-full p-2 rounded-md mb-2">
                <label class="font-medium text-sm">Jenis Akses</label>
                <select
                    v-model="fields.akses"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                >
                    <option value="Semua" selected>Semua akses</option>
                    <option value="Publik">Publik</option>
                    <option value="Internal">Internal</option>
                </select>
            </div>

            <div
                class="grid grid-cols-6 gap-3 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2"
            >
                <input
                    v-model="fields.keyword"
                    class="bg-white p-1 border-2 rounded col-span-5"
                    placeholder="Masukkan kata yang ingin dicari"
                />
                <button
                    @click.prevent="cari()"
                    class="bg-blue-700 hover:bg-blue-800 focus:ring-4 px-4 py-1.5 text-white col-span-1"
                >
                    Cari
                </button>
            </div>
        </div>

        <div
            class="w-11/12 sm:mt-0 flex flex-col justify-center"
            v-if="showhasilpencarian"
        >
            <div class="font-bold text-xl mt-3">Hasil Pencarian</div>
        </div>

        <div
            class="w-11/12 mt-1 sm:mt-0 flex flex-col justify-center"
            v-if="daftarpencarian"
        >
            <div
                class="bg-hijaust3 w-full p-3 rounded-lg mb-2.5"
                v-if="daftarpencarian == 'tidak ada'"
            >
                <h5 class="text-base italic font-semibold text-white text-left">
                    Pencarian tidak ditemukan, coba kata lainnya ...
                </h5>
            </div>

            <div
                class="bg-hijaust3 w-full p-3 rounded-lg mb-4"
                v-else
                v-for="proyek in daftarpencarian"
            >
                <a
                    :href="'/admin/kegiatan/lihat/' + proyek[0].idp"
                    class="mb-2 text-xl font-semibold text-white text-left"
                >
                    {{ proyek[0].proyeknama }}
                </a>
                <div v-for="kegiatan in proyek">
                    <div class="bg-white rounded-md px-3 py-1 mb-2">
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
                                {{ kegiatan.nama }}
                            </div>
                        </div>
                        <div class="flex flex-row items-center">
                            <div class="text-gray-600">Link:</div>
                            <a
                                :href="kegiatan.link"
                                target="_blank"
                                @click="kunjungi(kegiatan.idk)"
                                class="text-blue-600 italic mx-2"
                            >
                                {{ kegiatan.link }}
                            </a>
                            <button @click="copytoclipboard(kegiatan.link)">
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
                                :href="kegiatan.shortlink"
                                target="_blank"
                                @click="kunjungi(kegiatan.idk)"
                                class="text-blue-600 italic mx-2"
                            >
                                {{ kegiatan.shortlink }}
                            </a>
                            <button
                                v-if="kegiatan.shortlink != '-'"
                                @click="copytoclipboard(kegiatan.shortlink)"
                            >
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
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-12"></div>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            showhasilpencarian: false,
            daftarpencarian: "",
            fields: {
                keyword: "",
                status: "Semua",
                akses: "Semua",
            },
        };
    },
    methods: {
        cari() {
            if (this.fields.keyword == "") {
                this.$swal("Masukkan kegiatan yang ingin dicari");
                return;
            } else if (this.fields.keyword.length < 3) {
                this.$swal("Minimal pencarian 3 huruf/angka");
            } else {
                axios
                    .post("/api/admin/kegiatan/pencarian", this.fields, {
                        headers: {
                            "Content-Type": "application/json",
                            Authorization: "Bearer " + this.user.api_token,
                        },
                    })
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
