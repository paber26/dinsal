<template>
    <div class="bg-blue-200 fixed inset-x-0 z-50">
        <div class="sm:flex justify-between hidden">
            <div class="flex items-center">
                <router-link
                    to="/user"
                    class="px-3 py-1 m-1.5 rounded-md hover:bg-yellow-300 hover:no-underline font-bold text-2xl mx-2 text-center"
                    >DINSAL</router-link
                >
            </div>
        </div>
        <div class="sm:hidden flex justify-between items-center">
            ß
            <a href="/user" class="flex flex-row items-center w-52 m-1">
                <div class="font-bold text-right">
                    <div class="text-2xl">Forum Diskusi</div>
                    <div class="text-lg -mt-2">Polstat STIS</div>
                </div>
                <img
                    src="/img/polstat-stis.png"
                    alt="Logo Polstat STIS"
                    class="w-10 h-10"
                />
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            show: false,
            showsidebar: false,
        };
    },
    methods: {
        logout() {
            axios.post("/user/logout").then((response) => {
                window.location.href = response.data;
            });
        },
        ke(link) {
            this.$router.push(link);
            this.showsidebar = false;
        },
    },
};
</script>
