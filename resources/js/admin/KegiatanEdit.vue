<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Daftar Kegiatan</span>

            <div class="bg-white w-full p-2 rounded-md mb-2">
                <label class="font-medium text-sm">Proyek</label>
                <div
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                >
                    {{ kegiatan.proyeknama }}
                </div>
            </div>
        </div>

        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Daftar Kegiatan</span>
            <div class="bg-white w-full p-3 rounded-lg mb-2.5">
                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Kegiatan</label>
                    <div class="col-span-5">
                        <input
                            required
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan nama kegiatan ..."
                            v-model="fields.nama"
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
                            <option value="">Pilih jenis akses</option>
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
                        @click.prevent="simpan()"
                        class="bg-green-500 hover:bg-green-700 text-sm text-white font-bold py-1 px-2 rounded-lg"
                    >
                        Simpan
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-12"></div>
    </div>
</template>

<script>
export default {
    props: ["user", "idk"],
    data() {
        return {
            keywords: "",
            kegiatan: "",
            proyek: "",
            status: "semua",
            showtambahkankegiatan: false,
            fields: {
                idk: this.idk,
                nama: "",
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
        this.getdetailkegiatan();
    },
    methods: {
        getdetailkegiatan() {
            axios
                .get("/api/admin/getdetailkegiatan/" + this.idk, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    this.kegiatan = response.data;
                    this.fields.idk = response.data.idk;
                    this.fields.nama = response.data.nama;
                    this.fields.link = response.data.link;
                    this.fields.shortlink = response.data.shortlink;
                    this.fields.akses = response.data.akses;
                    this.fields.status = response.data.status;
                    // this.daftarkegiatan = response.data;
                });
        },
        simpan() {
            console.log("oke");
            // return;
            if (this.fields.nama == "") {
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
            console.log(this.fields);
            axios
                .post("/api/admin/kegiatan/edit", this.fields, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    if (response.data == "Berhasil") {
                        this.tampilkanberhasil();
                    }
                });
        },
        editkegiatan(idk) {
            this.$router.push("/admin/kegiatan/edit/" + idk);
        },
        tampilkanberhasil() {
            this.$swal("Berhasil memperbaharui data");
            this.$router.push("/admin/kegiatan/lihat/" + this.kegiatan.idp);
        },
    },
};
</script>
