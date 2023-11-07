window.Vue = require("vue").default;

import VueRouter from "vue-router";
Vue.use(VueRouter);

const Register = require("../auth/Register.vue").default;
const Login = require("../auth/Login.vue").default;
const LoginGagal = require("../auth/LoginGagal.vue").default;

// Bagian Admin
const AdminLogin = require("../admin/auth/Login.vue").default;

const AdminBeranda = require("../admin/Beranda.vue").default;
const AdminProyek = require("../admin/Proyek.vue").default;
const AdminProyekEdit = require("../admin/ProyekEdit.vue").default;
const AdminKegiatan = require("../admin/Kegiatan.vue").default;
const AdminKegiatanLihat = require("../admin/KegiatanLihat.vue").default;
const AdminKegiatanEdit = require("../admin/KegiatanEdit.vue").default;
const AdminUser = require("../admin/User.vue").default;
const AdminUserEdit = require("../admin/UserEdit.vue").default;
const AdminKritikdanSaran = require("../admin/KritikdanSaran.vue").default;

// Bagian User
const UserBeranda = require("../user/Beranda.vue").default;
const KritikdanSaran = require("../user/KritikdanSaran.vue").default;
const KegiatanProyek = require("../user/KegiatanProyek.vue").default;

const routes = [
    {
        path: "/",
        component: UserBeranda,
    },
    {
        path: "/user/kritik-dan-saran",
        component: KritikdanSaran,
    },
    {
        path: "/user/kegiatan/:idp",
        component: KegiatanProyek,
        props: true,
    },

    {
        path: "/login",
        component: Login,
    },
    {
        path: "/login/gagal",
        component: LoginGagal,
    },
    {
        path: "/user",
        component: UserBeranda,
    },

    // untuk admin
    {
        path: "/admin/login",
        component: AdminLogin,
    },
    {
        path: "/admin",
        component: AdminBeranda,
    },
    {
        path: "/admin/proyek",
        component: AdminProyek,
    },
    {
        path: "/admin/proyek/edit/:idp",
        component: AdminProyekEdit,
        props: true,
    },
    {
        path: "/admin/kegiatan/lihat/:idp",
        component: AdminKegiatanLihat,
        props: true,
    },
    {
        path: "/admin/kegiatan",
        component: AdminKegiatan,
    },
    {
        path: "/admin/kegiatan/edit/:idk",
        component: AdminKegiatanEdit,
        props: true,
    },
    {
        path: "/admin/user",
        component: AdminUser,
    },
    {
        path: "/admin/user/edit/:id",
        component: AdminUserEdit,
        props: true,
    },
    {
        path: "/admin/kritik-dan-saran",
        component: AdminKritikdanSaran,
    },
];

const router = new VueRouter({
    mode: "history",
    routes,
});

export default router;
