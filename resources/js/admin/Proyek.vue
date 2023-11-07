<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Daftar Proyek</span>

            <div class="bg-white w-full p-2 rounded-md mb-3">
                <label class="font-medium text-sm">Status Proyek</label>
                <select
                    v-model="status"
                    @change="filterstatus()"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                >
                    <option value="Semua">Semua Proyek</option>
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
            @click.prevent="tambahkanproyek()"
            v-if="!showtambahkanproyek"
            class="col-span-4 sm:col-span-1 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-1 px-3 rounded-full my-3"
        >
            <p>Tambahkan Proyek</p>
        </button>
        <button
            @click.prevent="tambahkanproyek()"
            v-else="!showtambahkanproyek"
            class="col-span-4 sm:col-span-1 bg-red-500 hover:bg-blue-700 text-white text-center font-bold py-1 px-3 rounded-full my-3"
        >
            <p>Batal Tambahkan User</p>
        </button>

        <div class="w-11/12 sm:mt-0 flex flex-col justify-center">
            <div
                class="bg-white w-full p-3 rounded-lg mb-2.5"
                v-if="showtambahkanproyek"
            >
                <div class="grid grid-cols-6 items-center">
                    <label class="col-span-1">Nama Proyek</label>
                    <div class="col-span-5">
                        <input
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            name="proyek"
                            type="text"
                            placeholder="Masukkan nama proyek ..."
                            v-model="fields.nama"
                        />
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

        <div
            class="w-11/12 sm:mt-0 flex flex-col justify-center"
            v-if="daftarproyekfilter.length > 0"
        >
            <div class="relative overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-sm text-gray-700 uppercase bg-blue-300">
                        <tr class="text-center divide-x divide-gray-400">
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Proyek</th>
                            <th class="px-3 py-2">Banyak Kegiatan</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Akses</th>
                            <th class="px-3 py-2" colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b divide-x divide-gray-400"
                            v-for="index in daftarproyekfilter.length"
                        >
                            <td
                                class="p-3 font-medium text-gray-900 text-center"
                            >
                                <p>{{ index }}</p>
                            </td>
                            <td class="p-3">
                                <p>
                                    {{
                                        daftarproyekfilter[index - 1]["proyek"]
                                            .nama
                                    }}
                                </p>
                            </td>
                            <td class="p-3 text-center">
                                <p>
                                    {{
                                        daftarproyekfilter[index - 1][
                                            "banyakkegiatan"
                                        ]
                                    }}
                                </p>
                            </td>
                            <td class="p-3 text-center">
                                <p>
                                    {{
                                        daftarproyekfilter[index - 1]["proyek"]
                                            .status
                                    }}
                                </p>
                            </td>
                            <td class="p-3 text-center">
                                <p>
                                    {{
                                        daftarproyekfilter[index - 1]["proyek"]
                                            .akses
                                    }}
                                </p>
                            </td>
                            <td class="p-3 flex justify-between">
                                <button
                                    @click.prevent="
                                        lihatkegiatan(
                                            daftarproyekfilter[index - 1][
                                                'proyek'
                                            ].idp
                                        )
                                    "
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-full flex items-center"
                                >
                                    Lihat Kegiatan
                                </button>
                                <button
                                    @click.prevent="
                                        editproyek(
                                            daftarproyekfilter[index - 1][
                                                'proyek'
                                            ].idp
                                        )
                                    "
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full flex items-center"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="
                                        hapus(
                                            daftarproyekfilter[index - 1][
                                                'proyek'
                                            ].idp,
                                            daftarproyekfilter[index - 1][
                                                'proyek'
                                            ].nama
                                        )
                                    "
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full flex items-center"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-11/12 mt-1 sm:mt-0 flex flex-col justify-center" v-else>
            <div class="bg-white w-full p-3 rounded-md mb-2">
                <div class="text-sm italic text-gray-500">
                    Tidak ditemukan, coba cari yang lain
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
            showtambahkanproyek: false,
            status: "Berlangsung",
            keyword: "",
            daftarproyek: "",
            daftarproyekfilter: "",
            fields: {
                nama: "",
            },
        };
    },
    mounted() {
        this.getproyekfilter();
        this.filterproyek();
    },
    methods: {
        getproyek() {
            axios
                .get("/api/admin/getproyek", {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    this.daftarproyek = response.data;
                    this.daftarproyekfilter = this.daftarproyek;
                });
        },
        tambahkan() {
            console.log(this.fields);
            if (this.fields.nama.length < 0) {
                this.daftarproyekfilter = this.daftarproyek;
            }
            axios
                .post("/api/admin/proyek/tambahkan", this.fields, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    if (response.data == "Berhasil") {
                        this.$swal(
                            "Proyek " + this.fields.nama + " ditambahkan"
                        );
                        this.fields.nama = "";
                        this.showtambahkanproyek = false;
                        this.getproyek();
                    } else {
                        this.$swal("Gagal menambahkan proyek");
                    }
                });
        },
        editproyek(idp) {
            this.$router.push("/admin/proyek/edit/" + idp);
        },
        hapus(idp, nama) {
            this.$swal({
                title: "Apakah kamu yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonText: "Hapus",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/api/admin/proyek/hapus/" + idp, {
                            headers: {
                                "Content-Type": "application/json",
                                Authorization: "Bearer " + this.user.api_token,
                            },
                        })
                        .then((response) => {
                            console.log(response.data);
                            if (response.data == "Berhasil") {
                                this.getproyek();
                                this.$swal(
                                    "Proyek " + nama + " berhasil dihapus"
                                );
                            } else {
                                this.$swal("Gagal menghapus proyek");
                            }
                        });
                }
            });
        },
        tambahkanproyek() {
            this.showtambahkanproyek = !this.showtambahkanproyek;
        },
        lihatkegiatan(id) {
            this.$router.push("/admin/kegiatan/lihat/" + id);
        },
        getproyekfilter() {
            axios
                .get("/api/admin/getproyekfilter/" + this.status, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    this.daftarproyek = response.data;
                    this.filterproyek();
                });
        },
        filterstatus() {
            if (this.status == "Semua") {
                this.getproyek();
            } else {
                this.getproyekfilter();
            }
        },
        filterproyek() {
            console.log(this.keyword.length);
            if (this.keyword.length == 0) {
                this.daftarproyekfilter = this.daftarproyek;
            } else {
                this.daftarproyekfilter = this.daftarproyek.filter((e) =>
                    e.proyek.nama
                        .toLowerCase()
                        .includes(this.keyword.toLowerCase())
                );
            }
            console.log(this.daftarproyekfilter);
        },
        cari() {
            this.status = "Semua";
            if (this.keyword.length == 0) {
                this.daftarproyekfilter = this.daftarproyek;
            } else if (this.keyword.length < 3) {
                this.$swal("Masukkan minimal 3 huruf/angka");
            } else {
                this.filterproyek();
            }
        },
    },
};
</script>
