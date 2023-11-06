<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Daftar User</span>
            <div class="relative overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-sm text-gray-700 uppercase bg-blue-300">
                        <tr class="text-center divide-x divide-gray-400">
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Nama</th>
                            <th class="px-3 py-2">Username</th>
                            <th class="px-3 py-2" colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b divide-x divide-gray-400"
                            v-for="index in daftaruser.length"
                        >
                            <td
                                class="p-3 font-medium text-gray-900 text-center"
                            >
                                <p>{{ index }}</p>
                            </td>
                            <td class="p-3">
                                <p>
                                    {{ daftaruser[index - 1].nama }}
                                </p>
                            </td>
                            <td class="p-3 text-center">
                                <p>{{ daftaruser[index - 1].username }}</p>
                            </td>
                            <td class="p-3 flex justify-center">
                                <button
                                    @click="edituser(daftaruser[index - 1].id)"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-full"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="
                                        hapus(
                                            daftaruser[index - 1].username,
                                            daftaruser[index - 1].nama
                                        )
                                    "
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full ml-2"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <button
            @click.prevent="tambahkanuser()"
            v-if="!showtambahkanuser"
            class="col-span-4 sm:col-span-1 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-1 px-3 rounded-full my-3"
        >
            <p>Tambahkan User</p>
        </button>
        <button
            @click.prevent="tambahkanuser()"
            v-else="!showtambahkanuser"
            class="col-span-4 sm:col-span-1 bg-red-500 hover:bg-red-700 text-white text-center font-bold py-1 px-3 rounded-full my-3"
        >
            <p>Batal Tambahkan User</p>
        </button>

        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <div
                class="bg-white w-full p-3 rounded-lg mb-2.5"
                v-if="showtambahkanuser"
            >
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
    props: ["user"],
    data() {
        return {
            daftaruser: "",
            showtambahkanuser: false,
            fields: {
                nama: "",
                username: "",
                password: "",
            },
            daftardraft: "",
        };
    },
    mounted() {
        this.getuser();
    },
    methods: {
        getuser() {
            axios
                .get("/api/admin/getuser", {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    this.daftaruser = response.data;
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
            // console.log(this.fields.nama);
            axios
                .post("/api/admin/user/tambahkan", this.fields, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + this.user.api_token,
                    },
                })
                .then((response) => {
                    if (response.data == "Sudah terdaftar") {
                        this.$swal(
                            "Akun " + this.fields.nama + " sudah terdaftar"
                        );
                    } else if (response.data == "Berhasil") {
                        this.tampilkanberhasil();
                    }
                    console.log(response.data);
                });
        },
        tampilkanberhasil() {
            this.getuser();
            this.$swal("Berhasil menambahkan " + this.fields.nama);
            this.fields.nama = "";
            this.fields.username = "";
            this.fields.password = "";
            this.showtambahkanuser = false;
        },
        edituser(id) {
            this.$router.push("/admin/user/edit/" + id);
        },
        hapus(username, nama) {
            this.$swal({
                title: "Apakah kamu yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonText: "Hapus",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/api/admin/user/hapus/" + username, {
                            headers: {
                                "Content-Type": "application/json",
                                Authorization: "Bearer " + this.user.api_token,
                            },
                        })
                        .then((response) => {
                            console.log(response.data);
                            if (response.data == "Berhasil") {
                                this.getuser();
                                this.$swal(
                                    "User " + nama + " berhasil dihapus"
                                );
                            } else {
                                this.$swal("Gagal menghapus proyek");
                            }
                        });
                }
            });
        },
        tambahkanuser() {
            this.showtambahkanuser = !this.showtambahkanuser;
        },
    },
};
</script>
