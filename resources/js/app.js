
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('test-component',require('./components/TestComponent.vue'));
Vue.component('user-form',require('./components/UserComponent.vue'));
Vue.component('article-component',require('./components/ArticleComponent.vue'));
Vue.component('like-component',require('./components/LikeComponent.vue'));
Vue.component('article-preview',require('./components/ArticlePreviewComponent.vue'));
Vue.component('comment-component',require('./components/CommentComponent.vue'));
Vue.component('add-comment-component',require('./components/AddCommentComponent.vue'));

const app = new Vue({
    el: '#app'
});