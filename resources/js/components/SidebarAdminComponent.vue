<template>
    <div class="bg-blue-300 hidden sm:block w-60">
        <a
            href="/admin/"
            class="hover:no-underline p-1 flex flex-col justify-center items-center h-46"
        >
            <img src="/img/logo-bps.png" alt="Logo BPS" class="w-16" />
            <div class="font-bold text-2xl">DINSAL</div>
            <div class="font-bold text-lg -mt-2">Minahasa Selatan</div>
        </a>
        <div class="flex flex-col">
            <router-link
                to="/admin/"
                class="p-1.5 m-1.5 rounded-md hover:bg-yellow-300 font-semibold"
                >Beranda</router-link
            >
            <router-link
                to="/admin/proyek"
                class="p-1.5 m-1.5 rounded-md hover:bg-yellow-300 font-semibold"
                >Proyek</router-link
            >
            <router-link
                to="/admin/kegiatan"
                class="p-1.5 m-1.5 rounded-md hover:bg-yellow-300 font-semibold"
                >Kegiatan</router-link
            >
            <router-link
                to="/admin/user"
                class="p-1.5 m-1.5 rounded-md hover:bg-yellow-300 font-semibold"
                >User</router-link
            >
            <router-link
                to="/admin/kritik-dan-saran"
                class="p-1.5 m-1.5 rounded-md hover:bg-yellow-300 font-semibold"
                >Kritik dan Saran</router-link
            >
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showmateri: false,
            showarsipsoal: false,
        };
    },
    methods: {
        klikmateri: function () {
            this.showmateri = !this.showmateri;
            this.showarsipsoal = false;
        },
        klikarsipsoal: function () {
            this.showarsipsoal = !this.showarsipsoal;
            this.showmateri = false;
        },
    },
};
</script>
