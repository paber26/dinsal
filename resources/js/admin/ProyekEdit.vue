<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Edit Proyek</span>
            <div class="bg-white w-full p-3 rounded-lg mb-2.5">
                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Nama Proyek</label>
                    <div class="col-span-5">
                        <input
                            required
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan nama proyek ..."
                            v-model="fields.nama"
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
    props: ["user", "idp"],
    data() {
        return {
            kegiatan: "",
            proyek: "",
            status: "semua",
            fields: {
                idp: this.idp,
                nama: "",
                akses: "",
                status: "",
            },
        };
    },
    mounted() {
        console.log(this.idp);
        this.getdetailproyek();
    },
    methods: {
        getdetailproyek() {
            // return this.idp;
            axios
                .get("/api/admin/getdetailproyek/" + this.idp, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    this.proyek = response.data;
                    this.fields.idp = response.data.idp;
                    this.fields.nama = response.data.nama;
                    this.fields.akses = response.data.akses;
                    this.fields.status = response.data.status;
                    // this.daftarkegiatan = response.data;
                });
        },
        simpan() {
            if (this.fields.nama == "") {
                this.$swal("Masukkan nama proyek");
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
            axios
                .post("/api/admin/proyek/edit", this.fields, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    if (response.data == "Berhasil") {
                        this.tampilkanberhasil();
                    }
                });
        },
        tampilkanberhasil() {
            this.$swal("Berhasil memperbaharui data");
            this.$router.push("/admin/proyek");
        },
    },
};
</script>
