<template>
    <div class="flex justify-end mr-3 bg-gray-200 p-3">
        <button
            @click.prevent="berikritikdansaran()"
            v-if="currenturl != '/kritik-dan-saran'"
            class="bg-blue-300 hover:bg-blue-500 p-3 font-semibold rounded-md"
        >
            Beri Kritik dan Saran
        </button>
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
        console.log(this.currenturl == "/kritik-dan-saran");
    },
    methods: {
        berikritikdansaran() {
            this.$router.push("/kritik-dan-saran");
        },
    },
};
</script>
