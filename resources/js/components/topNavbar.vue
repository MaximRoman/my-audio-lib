<template>
  <div  id="top-navbar" class="row h-100 p-0 m-0">
    <div v-if="show" id="search-input-container" class="col-10 h-100 row p-3">
      <div class="col-10 p-0 m-0">
        <input id="search-input" class="form-control rounded-0 rounded-start w-100 h-100 bg-secondary text-light"  placeholder="Поиск..." @keypress="press()">
      </div>
      <div class="col-2 p-0 m-0">
        <button id="search-clear" class="btn btn-danger rounded-0 rounded-end w-100 h-100 border-start-0 border-light" @click="hiddenSearchInput()"><i class="fa-solid fa-xmark"></i></button>
      </div>
    </div>
    <div v-if="!show" id="search-icon-container" class="col-4 p-0">
      <button class="h-100 w-100 p-0 d-flex align-items-center justify-content-center btn btn-outline-gray border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" @click="showSearchInput()"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/search.png" alt=""></button>
    </div>
    <div v-if="!show" id="fav" class="col-4 p-0">
      <a class="h-100 w-100 p-0 d-flex align-items-center justify-content-center btn btn-outline-gray border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="/fav-books"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/fav.png" alt=""></a>
    </div>
    <!-- <div id="chats" class="col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/obshalka.png" alt=""></a>
    </li>
    <div id="faq" class="col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/faq1.png" alt=""></a>
    </li>        -->
    <div v-if="!show" id="theme" class="col-4 p-0">
      <a class="h-100 w-100 p-0 d-flex align-items-center justify-content-center text-dark btn btn-outline-gray border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" id="theme-btn"><h1><i class="fa-solid fa-moon" ></i></h1></a>
    </div> 
  </div>
</template> 


<script>
    export default {
        data() {
            return {
                show: false
            }
        },
        mounted() {
        },
        methods: {
          showSearchInput() {
            this.show = true;
          },
          hiddenSearchInput() {
            this.show = false;
          },
          press() {
            console.log(event.target.value);
              switch (event.key) {
                case 'Enter':
                  this.globalSearch(event.target.value);
                  break;
              }
            },
          globalSearch(text) {
            window.location = '/search/' + text + '/';
          },
        },
    }
</script>
