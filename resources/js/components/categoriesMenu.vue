<template>
    <div class="d-flex flex-column">
        <h3 class="d-flex align-items-center gap-2" @click="pageWidth < 768 ? showHidden() : ''"><img src="https://my-audio-lib-icons.vercel.app/icons/left-menu.png" alt=""> Категории:</h3>
        <ul class="list-group" id="categories-menu">
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/audiospektakl/">Аудиоспектакль</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/alternativnaya-istoriya/">Альтернативная история</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/biznes/">Бизнес</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/biografiya/">Биографии, мемуары</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/boevik/">Боевик</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/detektivy-trillery/">Детективы, триллеры</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/dlya-detey/">Для детей</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/istoriya/">История</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/klassika/">Классика</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/lyubovnyy-romani/">Любовный роман</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/lyubovnoe-fentezi/">Любовное фэнтези</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/medicina-zdorove/">Медицина, здоровье</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/nauchno-populyarnoe/">Научно-популярное</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/obuchenie/">Обучение</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/poznavatelnaya-literatura/">Познавательная литература</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/postapokalipsis/">Постапокалипсис</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/poeziya/">Поэзия</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/priklyucheniya/">Приключения</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/psihologiya-filosofiya/">Психология, философия</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/ranobe/">Ранобэ</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/raznoe/">Разное</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/religiya/">Религия</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/roman-proza/">Роман, проза</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/skazki/">Сказки</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/uzhasy-mistika/">Ужасы, мистика</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/ezoterika/">Эзотерика</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/yumor-satira/">Юмор, сатира</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/fantastika-fenteze/">Фантастика, фэнтези</a>
            </li>
            <hr class="mt-2 mb-2">
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/stalker/">S.T.A.L.K.E.R.</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/s-t-i-k-s/">S-T-I-K-S</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/litrpg/">LitRPG</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/metro-2033/">Метро 2033</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/etnogenez/">Этногенез</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/tehnotma/">Технотьма</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/eve-online/">EVE online</a>
            </li>
            <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                <a class="btn btn-outline-success w-100 text-start p-1" href="/category/popadanci/">Попаданцы</a>
            </li>
        </ul> 
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ul: undefined,
                pageWidth: null
            }
        },
        mounted() {
            this.ul = document.getElementById('categories-menu')
            this.pageWidth = document.querySelector('html').clientWidth;
            if (this.pageWidth < 768) {
                this.ul.classList.add('invisible');
            }
        },
        methods: {
            showHidden() {
                console.log(this.ul.classList);
                if (this.ul.classList.contains('invisible')) {
                    this.ul.classList.remove('invisible');
                } else {
                    this.ul.classList.add('invisible');
                }
            },
        }
    }
</script>
