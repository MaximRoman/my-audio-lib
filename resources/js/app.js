/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import MultyUpload from './components/multyUpload.vue';
import AudioPlayer from './components/audioPlayer.vue';
import TotalAudioDuration from './components/totalAudioDuration.vue';
import LikeBookSystem from './components/likeBookSystem.vue';
import CommentsSystem from './components/commentsSystem.vue';
import CalcGrade from './components/calcBookGrade.vue';
import TopNavbar from './components/topNavbar.vue';
import CategoriesMenu from './components/categoriesMenu.vue';
import EditDeleteBtns from './components/editDeleteBtns.vue';
import AddToFav from './components/addToFav.vue';
import AddBookLink from './components/addBookLink.vue';
import ListItem from './components/listItem.vue';
import ImagesList from './components/imagesList.vue';


app.component('example-component', ExampleComponent);
app.component('multy-upload', MultyUpload);
app.component('audio-player', AudioPlayer);
app.component('audio-duration', TotalAudioDuration);
app.component('like-book', LikeBookSystem);
app.component('calc-grade', CalcGrade);
app.component('comments-system', CommentsSystem);
app.component('top-navbar', TopNavbar);
app.component('categories-menu', CategoriesMenu);
app.component('edit-delete-btns', EditDeleteBtns);
app.component('add-to-fav', AddToFav);
app.component('add-book-link', AddBookLink);
app.component('list-item', ListItem);
app.component('images-list', ImagesList);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

// Theme set
const themeBtn = document.getElementById('theme-btn');
const html = document.querySelector('html');
themeBtn.addEventListener('click', () => {
    if (html.classList.contains('light')) {
        html.classList.replace('light', 'dark');
        themeBtn.classList.replace('text-dark', 'text-light');
        localStorage.setItem('theme', 'dark');
    } else if (html.classList.contains('dark')){
        html.classList.replace('dark', 'light');
        themeBtn.classList.replace('text-light', 'text-dark');
        localStorage.setItem('theme', 'light');
    }
});
document.addEventListener('DOMContentLoaded', () => { 
    if (localStorage.getItem('theme')) {
        html.classList = localStorage.getItem('theme');
    }
})

function activateLi(id) {
    const li = document.getElementById('li-' + id);
    const checkbox = document.getElementById('check-' + id);

    if (checkbox.checked) {
        li.classList().add('active');
    } else {
        li.classList().remove('active');
    }
}

