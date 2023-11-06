<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Edit User</span>
            <div class="bg-white w-full p-3 rounded-lg mb-2.5">
                <div class="grid grid-cols-6 items-center">
                    <label class="col-span-1">Nama</label>
                    <div class="col-span-5">
                        <input
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan nama ..."
                            v-model="fields.nama"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Username</label>
                    <div class="col-span-5">
                        <input
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan username ..."
                            v-model="fields.username"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Password</label>
                    <div class="col-span-5">
                        <input
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            type="text"
                            placeholder="Masukkan password ..."
                            v-model="fields.password"
                        />
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
    props: ["user", "id"],
    data() {
        return {
            daftaruser: "",
            fields: {
                id: this.id,
                nama: "",
                username: "",
                password: "",
            },
        };
    },
    mounted() {
        this.getuser();
    },
    methods: {
        getuser() {
            axios
                .get("/api/admin/getuser/" + this.id, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    console.log(this.id);
                    console.log(response.data);
                    this.daftaruser = response.data;
                    this.fields.nama = this.daftaruser.nama;
                    this.fields.username = this.daftaruser.username;
                    // this.daftarkegiatan = response.data;
                });
        },
        simpan() {
            if (this.fields.nama == "") {
                this.$swal("Masukkan nama");
                return;
            }
            if (this.fields.username == "") {
                this.$swal("Masukkan username");
                return;
            }
            if (this.fields.password == "") {
                this.$swal("Masukkan password");
                return;
            }
            axios
                .post("/api/admin/user/edit", this.fields, {
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
            this.$swal("Berhasil memperbaharui data " + this.fields.nama);
            this.$router.push("/admin/user");
        },
    },
};
</script>
