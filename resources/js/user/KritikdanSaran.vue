<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 justify-center mt-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-3 rounded-lg w-full">
                    <h5
                        class="mb-2 text-xl font-semibold text-gray-900 text-left"
                    >
                        Beri Kritik dan Saran
                    </h5>
                    <div class="text-gray-700 text-left">
                        Kritik dan saran kamu akan sangat berguna untuk
                        pengembangan sistem kedepannya
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

        <div class="w-11/12 sm:mt-0 flex flex-col justify-center">
            <div class="bg-white w-full p-3 rounded-lg mb-2.5">
                <div class="grid grid-cols-6 items-start">
                    <label class="col-span-1">Kritik dan Saran</label>
                    <div class="col-span-5">
                        <textarea
                            class="w-full border-2 border-gray-200 rounded-md p-1.5"
                            rows="3"
                            type="text"
                            placeholder="Masukkan kritik dan saran ..."
                            v-model="fields.isi"
                        ></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-6 items-center mt-2">
                    <label class="col-span-1">Bintang</label>
                    <div class="col-span-5">
                        <div class="flex">
                            <button
                                v-for="i in 5"
                                @click.prevent="bintang(i)"
                                class="mr-2"
                            >
                                <svg
                                    :fill="i <= nilai ? '#FFD700' : 'none'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-2">
                    <button
                        @click.prevent="kirim()"
                        class="bg-green-500 hover:bg-green-700 text-sm text-white font-bold py-1 px-2 rounded-lg"
                    >
                        Kirim
                    </button>
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
            showtambahkanproyek: false,
            nilai: 5,
            fields: {
                isi: "",
                bintang: this.nilai,
            },
            daftardraft: "",
        };
    },
    // mounted() {
    //     axios.get("/api/user/kritikdansaran/tes").then((response) => {
    //         console.log(response.data);
    //     });
    // },
    methods: {
        kembali() {
            this.$router.push("/");
        },
        bintang(n) {
            this.nilai = n;
        },
        kirim() {
            console.log(this.fields);
            this.fields.bintang = this.nilai;
            axios
                .post("/api/user/kritikdansaran/kirim", this.fields)
                .then((response) => {
                    console.log(response.data);
                    if (response.data == "Berhasil") {
                        this.$swal(
                            "Terimakasih sudah memberikan kritik dan saran"
                        );
                        window.location.href = "/";
                    }
                });
        },
    },
};
</script>
