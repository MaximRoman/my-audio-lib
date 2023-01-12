<template>
  <ul  id="top-navbar" class="col-6 nav mr-auto d-flex align-items-center d-flex h-100">
    <li id="search-input-container" class="nav-item col-10 h-100 d-flex align-items-center justify-content-center invisible">
      <div id="search-input-container" class="row h-100 p-3 bg-gray w-100">
        <div class="col-10 p-0 m-0">
          <input id="search-input" class="form-control rounded-0 rounded-start w-100 h-100 bg-secondary text-light"  placeholder="Поиск...">
        </div>
        <div class="col-2 p-0 m-0">
          <button id="search-clear" class="btn btn-danger rounded-0 rounded-end w-100 h-100 border-start-0 border-light" @click="hiddenSearchInput()"><i class="fa-solid fa-xmark"></i></button>
        </div>
      </div>  
    </li>
    <li id="search-icon-container" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center ">
      <button class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" @click="showSearchInput()"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/search.png" alt=""></button>
    </li>
    <li id="fav" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="/fav-books"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/fav.png" alt=""></a>
    </li>
    <li id="chats" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/obshalka.png" alt=""></a>
    </li>
    <li id="faq" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src="https://my-audio-lib-icons-6vnqjd8ju-maximroman.vercel.app/icons/faq1.png" alt=""></a>
    </li>       
    <li id="theme" class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
      <a class="text-dark nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-2 border-end-2 rounded-0" id="theme-btn"><h1><i class="fa-solid fa-moon" ></i></h1></a>
    </li> 
  </ul>
</template> 


<script>
    export default {
        data() {
            return {
                searchIcon: undefined,
                fav: undefined,
                chats: undefined,
                faq: undefined,
                theme: undefined,
                searchContainer: undefined,
                searchInput: undefined,
                searchClear: undefined,
            }
        },
        mounted() {
          this.searchIcon = document.getElementById('search-icon-container');
          this.fav = document.getElementById('fav');
          this.chats = document.getElementById('chats');
          this.faq = document.getElementById('faq');
          this.theme = document.getElementById('theme');
          this.searchContainer = document.getElementById('search-input-container');
          this.searchInput = document.getElementById('search-input');
          this.searchClear = document.getElementById('search-clear');
          this.searchInput.addEventListener('keypress', (event) => {
            switch (event.key) {
              case 'Enter':
                this.globalSearch();
                break;
            }
          });
        },
        methods: {
          showSearchInput() {
            this.searchIcon.classList.add('invisible');
            this.fav.classList.add('invisible');
            this.chats.classList.add('invisible'); 
            this.faq.classList.add('invisible');
            this.theme.classList.add('invisible');
            this.searchContainer.classList.remove('invisible'); 
          },
          hiddenSearchInput() {
            this.searchIcon.classList.remove('invisible');
            this.fav.classList.remove('invisible');
            this.chats.classList.remove('invisible'); 
            this.faq.classList.remove('invisible');
            this.theme.classList.remove('invisible');
            this.searchContainer.classList.add('invisible'); 
          },
          globalSearch() {
            let text = this.searchInput.value;
            this.searchInput.value = ''
            window.location = '/search/' + text + '/';
          },
        },
    }
</script>
