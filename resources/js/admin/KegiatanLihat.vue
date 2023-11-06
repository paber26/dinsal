<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <div class="flex justify-between">
                <span class="font-bold text-xl mt-3 mb-2">Daftar Kegiatan</span>
                <router-link
                    to="/admin/proyek"
                    class="text-base mt-3 mb-2 text-blue-500"
                    >Ke proyek lain</router-link
                >
            </div>

            <div class="bg-white w-full p-2 rounded-md mb-2">
                <label class="font-medium text-sm">Proyek</label>
                <div
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                >
                    {{ proyek.nama }}
                </div>
            </div>

            <div class="bg-white w-full p-2 rounded-md mb-2">
                <label class="font-medium text-sm">Pilih Status Kegiatan</label>
                <select
                    v-model="status"
                    @change="filterstatus()"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                >
                    <option value="Semua" selected>Semua Kegiatan</option>
                    <option value="Berlangsung">Sedang Berlangsung</option>
                    <option value="Berakhir">Sudah Berakhir</option>
                </select>
            </div>

            <div
                class="grid grid-cols-6 gap-3 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2"
            >
                <input
                    v-model="keyword"
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
        <!-- <div class="mb-5"></div> -->
        <button
            @click.prevent="tambahkankegiatan()"
            v-if="!showtambahkankegiatan"
            class="col-span-4 sm:col-span-1 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-1 px-3 rounded-full my-3"
        >
            <p>Tambahkan Kegiatan</p>
        </button>
        <button
            @click.prevent="tambahkankegiatan()"
            v-else="!showtambahkankegiatan"
            class="col-span-4 sm:col-span-1 bg-red-500 hover:bg-red-700 text-white text-center font-bold py-1 px-3 rounded-full my-3"
        >
            <p>Batal Tambahkan Kegiatan</p>
        </button>
        <div
            class="w-11/12 sm:mt-0 flex flex-col justify-center"
            v-if="showtambahkankegiatan"
        >
            <div class="bg-white w-full p-3 rounded-lg mb-2.5">
                <div class="grid grid-cols-6 items-center">
                    <label class="col-span-1">Proyek</label>
                    <div class="col-span-5">
                        <input
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            v-model="proyek.nama"
                            :placeholder="proyek.nama"
                            disabled
                        />
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Kegiatan</label>
                    <div class="col-span-5">
                        <input
                            required
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan nama kegiatan ..."
                            v-model="fields.kegiatan"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Link</label>
                    <div class="col-span-5">
                        <input
                            required
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan link kegiatan ..."
                            v-model="fields.link"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Short Link</label>
                    <div class="col-span-5">
                        <input
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan short link (jika ada) ..."
                            v-model="fields.shortlink"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Akses</label>
                    <div class="col-span-5">
                        <select
                            required
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan nama kegiatan ..."
                            v-model="fields.akses"
                        >
                            <option value="Semua">Pilih jenis akses</option>
                            <option value="Internal">Internal</option>
                            <option value="Publik">Publik</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Status</label>
                    <div class="col-span-5">
                        <select
                            required
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Pilih Status Kegiatan"
                            v-model="fields.status"
                        >
                            <option value="">Pilih status kegiatan</option>
                            <option value="Berlangsung">Berlangsung</option>
                            <option value="Berakhir">Berakhir</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-2">
                    <button
                        @click.prevent="tambahkan()"
                        class="bg-green-500 hover:bg-green-700 text-sm text-white font-bold py-1 px-2 rounded-lg"
                    >
                        Tambahkan
                    </button>
                </div>
            </div>
        </div>

        <div class="w-11/12 mt-1 sm:mt-0 flex flex-col justify-center">
            <div class="relative overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-sm text-gray-700 uppercase bg-blue-300">
                        <tr class="text-center divide-x divide-gray-400">
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Kegiatan</th>
                            <th class="px-3 py-2">Link</th>
                            <th class="px-3 py-2">Short Link</th>
                            <th class="px-3 py-2">Akses</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Total Kunjungan</th>
                            <th class="px-3 py-2" colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b divide-x divide-gray-400"
                            v-for="index in daftarkegiatanfilter.length"
                        >
                            <td
                                class="p-3 font-medium text-gray-900 text-center"
                            >
                                <p>{{ index }}</p>
                            </td>
                            <td class="p-3">
                                <p>
                                    {{ daftarkegiatanfilter[index - 1].nama }}
                                </p>
                            </td>
                            <td class="p-3 text-blue-400 italic">
                                <div class="flex items-center">
                                    <button
                                        @click="
                                            copytoclipboard(
                                                daftarkegiatanfilter[index - 1]
                                                    .link
                                            )
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 mr-1"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
                                            />
                                        </svg>
                                    </button>
                                    <a
                                        :href="
                                            daftarkegiatanfilter[index - 1].link
                                        "
                                        target="_blank"
                                        >{{
                                            daftarkegiatanfilter[
                                                index - 1
                                            ].link.substr(0, 25) + "...."
                                        }}</a
                                    >
                                </div>
                            </td>
                            <td class="p-3 text-blue-400 italic text-center">
                                <p
                                    v-if="
                                        daftarkegiatanfilter[index - 1]
                                            .shortlink == '-'
                                    "
                                >
                                    -
                                </p>
                                <div class="flex items-center" v-else>
                                    <button
                                        @click="
                                            copytoclipboard(
                                                daftarkegiatanfilter[index - 1]
                                                    .shortlink
                                            )
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 mr-1"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"
                                            />
                                        </svg>
                                    </button>
                                    <a
                                        :href="
                                            daftarkegiatanfilter[index - 1]
                                                .shortlink
                                        "
                                        target="_blank"
                                        >{{
                                            daftarkegiatanfilter[index - 1]
                                                .shortlink
                                        }}</a
                                    >
                                </div>
                            </td>
                            <td class="p-3 text-center">
                                <p>
                                    {{ daftarkegiatanfilter[index - 1].akses }}
                                </p>
                            </td>
                            <td class="p-3 text-center">
                                <p>
                                    {{ daftarkegiatanfilter[index - 1].status }}
                                </p>
                            </td>
                            <td class="p-3 text-center">
                                <p>
                                    {{
                                        daftarkegiatanfilter[index - 1]
                                            .tkunjungan
                                    }}
                                </p>
                            </td>
                            <td class="p-3 flex justify-between">
                                <button
                                    @click.prevent="
                                        editkegiatan(
                                            daftarkegiatanfilter[index - 1].idk
                                        )
                                    "
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-full flex items-center"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="
                                        hapus(
                                            daftarkegiatanfilter[index - 1].idk,
                                            daftarkegiatanfilter[index - 1].nama
                                        )
                                    "
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full flex items-center ml-1"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-12"></div>
    </div>
</template>

<script>
export default {
    props: ["user", "idp"],
    data() {
        return {
            keyword: "",
            daftarproyek: "",
            daftarkegiatan: "",
            daftarkegiatanfilter: "",
            proyekid: this.idp,
            proyek: "",
            status: "Semua",
            showtambahkankegiatan: false,
            fields: {
                proyekid: "",
                kegiatan: "",
                link: "",
                shortlink: "",
                akses: "",
                status: "",
            },
            daftardraft: "",
        };
    },
    mounted() {
        console.log(this.idp);
        this.getproyek();
        this.getkegiatan();
    },
    methods: {
        getproyek() {
            axios
                .get("/api/admin/getproyek/" + this.idp, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    this.daftarproyek = response.data[0];
                    this.proyek = response.data[1][0];

                    this.fields.proyekid = this.proyek.idp;
                    console.log(this.proyek);
                    console.log(response.data);
                });
        },
        getkegiatan() {
            axios
                .get("/api/admin/getkegiatan/" + this.idp, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    this.daftarkegiatan = response.data;
                    this.daftarkegiatanfilter = this.daftarkegiatan;
                });
        },
        filterstatus() {
            if (this.status == "Semua") {
                this.getkegiatan();
            } else {
                axios
                    .get(
                        "/api/admin/getkegiatanfilter/" +
                            this.idp +
                            "/" +
                            this.status,
                        {
                            headers: {
                                "Content-Type": "application/json",
                                Authorization: "Bearer " + this.user.api_token,
                            },
                        }
                    )
                    .then((response) => {
                        this.daftarkegiatan = response.data;
                        console.log(this.daftarkegiatan);
                    });
            }
        },
        tambahkankegiatan() {
            this.showtambahkankegiatan = !this.showtambahkankegiatan;
        },
        tambahkan() {
            if (this.fields.kegiatan == "") {
                this.$swal("Masukkan nama kegiatan");
                return;
            }
            if (this.fields.link == "") {
                this.$swal("Masukkan link kegiatan");
                return;
            }
            if (this.fields.akses == "") {
                this.$swal("Masukkan jenis akses");
                return;
            }
            if (this.fields.status == "") {
                this.$swal("Masukkan status kegiatan");
                return;
            }
            if (this.fields.shortlink == "") {
                this.fields.shortlink = "-";
            }
            axios
                .post("/api/admin/kegiatan/tambahkan", this.fields, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    if (response.data == "Berhasil") {
                        this.showtambahkankegiatan = false;
                        this.getkegiatan();
                        this.fields.kegiatan = "";
                        this.fields.judul = "";
                        this.fields.link = "";
                        this.fields.shortlink = "";
                        this.fields.akses = "";
                        this.fields.status = "";

                        this.$swal("Berhasil Menghapus");
                        this.$swal(
                            "Proyek " + response.data + " berhasil ditambahkan"
                        );
                    } else {
                        this.$swal("Gagal menambahkan proyek");
                    }
                });
        },
        editkegiatan(idk) {
            this.$router.push("/admin/kegiatan/edit/" + idk);
        },
        hapus(idk, nama) {
            this.$swal({
                title: "Apakah kamu yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonText: "Hapus",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.fields.kegiatan = "";
                    this.fields.judul = "";
                    this.fields.link = "";
                    this.fields.shortlink = "";
                    this.fields.akses = "";
                    this.fields.status = "";

                    axios
                        .get("/api/admin/kegiatan/hapus/" + idk, {
                            headers: {
                                "Content-Type": "application/json",
                                Authorization: "Bearer " + this.user.api_token,
                            },
                        })
                        .then((response) => {
                            console.log(response.data);
                            if (response.data == "Berhasil") {
                                this.getkegiatan();
                                this.$swal(
                                    "Kegiatan " + nama + " berhasil dihapus"
                                );
                            } else {
                                this.$swal("Gagal menghapus kegiatan");
                            }
                        });
                }
            });
        },
        copytoclipboard(val) {
            navigator.clipboard.writeText(val);
            this.$swal("Link berhasil di copy");
        },
        filterkegiatan() {
            console.log(this.daftarkegiatan);
            if (this.keyword.length == 0) {
                this.daftarkegiatanfilter = this.daftarkegiatan;
            } else {
                this.daftarkegiatanfilter = this.daftarkegiatan.filter((e) =>
                    e.nama.toLowerCase().includes(this.keyword.toLowerCase())
                );
            }
            console.log(this.daftarkegiatanfilter);
        },
        cari() {
            if (this.keyword.length == 0) {
                this.daftarkegiatanfilter = this.daftarkegiatan;
            } else if (this.keyword.length < 3) {
                this.$swal("Masukkan minimal 3 huruf/angka");
            } else {
                this.filterkegiatan();
            }
        },
    },
};
</script>
