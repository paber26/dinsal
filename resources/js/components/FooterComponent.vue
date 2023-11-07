<template>
    <div class="flex flex-col items-center w-full bg-gray-200">
        <div class="w-11/12 justify-center">
            <div class="flex justify-between p-3">
                <router-link
                    v-if="currenturl != '/user/infoaplikasi'"
                    to="/user/infoaplikasi"
                    class="bg-hijaust2 text-white hover:bg-green-700 p-3 font-semibold rounded-md"
                >
                    Info Aplikasi
                </router-link>
                <div v-else></div>
                <button
                    @click.prevent="berikritikdansaran()"
                    v-if="currenturl != '/user/kritik-dan-saran'"
                    class="bg-birumateri text-white hover:bg-blue-900 p-3 font-semibold rounded-md"
                >
                    Beri Kritik dan Saran
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currenturl: window.location.pathname,
        };
    },
    mounted() {
        console.log(this.currenturl == "user/kritik-dan-saran");
    },
    methods: {
        berikritikdansaran() {
            this.$router.push("/user/kritik-dan-saran");
        },
    },
};
</script>
