<template>
    <div class="flex flex-col items-center w-full">
        <div class="w-11/12 mt-3 sm:mt-0 flex flex-col justify-center">
            <span class="font-bold text-xl mt-3 mb-2">Kritik dan Saran</span>
            <div
                class="bg-white rounded-lg shadow-md mb-2"
                v-for="kritikdansaran in daftarkritikdansaran"
            >
                <div class="p-3 rounded-lg w-full">
                    <div class="flex flex-row">
                        <svg
                            v-for="i in 5"
                            xmlns="http://www.w3.org/2000/svg"
                            :fill="
                                i <= kritikdansaran.bintang ? '#FFD700' : 'none'
                            "
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                            />
                        </svg>
                    </div>
                    <div class="text-sm italic text-gray-600">
                        {{ kritikdansaran.date }}
                    </div>
                    <div class="text-gray-700 mt-2">
                        {{ kritikdansaran.isi }}
                    </div>
                </div>
            </div>
        </div>
        <div class="w-11/12 justify-center mt-4"></div>
        <div class="mb-12"></div>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            daftarkritikdansaran: "",
        };
    },
    mounted() {
        axios
            .get("/api/admin/getkritikdansaran", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.user.api_token,
                },
            })
            .then((response) => {
                console.log(response.data);
                this.daftarkritikdansaran = response.data;
                // if (response.data == "Berhasil") {
                //     this.getproyek();
                //     this.$swal("Proyek " + nama + " berhasil dihapus");
                // } else {
                //     this.$swal("Gagal menghapus proyek");
                // }
            });
    },
    methods: {},
};
</script>
