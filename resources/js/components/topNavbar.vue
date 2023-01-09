<template id="top-navbar-template">
    <li id="search" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center ">
      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#" @click="showSearchInput()"><img src="../../../public/pictures/icons/search.png" alt=""></a>
    </li>
    <li id="fav" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src="../../../public/pictures/icons/fav.png" alt=""></a>
    </li>
    <li id="chats" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src="../../../public/pictures/icons/obshalka.png" alt=""></a>
    </li>
    <li id="faq" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src="../../../public/pictures/icons/faq1.png" alt=""></a>
    </li>
    <li id="theme" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="text-dark nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" id="theme-btn"><h1><i class="fa-solid fa-moon" ></i></h1></a>
    </li>
</template> 

<script>
    export default {
        data() {
            return {
                template: undefined,
                search: undefined,
                fav: undefined,
                chats: undefined,
                faq: undefined,
                theme: undefined,
            }
        },
        mounted() {
            this.template = document.getElementById('top-navbar-template');
            this.search = document.getElementById('search');
            this.fav = document.getElementById('fav');
            this.chats = document.getElementById('chats');
            this.faq = document.getElementById('faq');
            this.theme = document.getElementById('theme');
        },
        methods: {
            showSearchInput() {
                console.log(this.template);
            },
        },
    }
</script>
