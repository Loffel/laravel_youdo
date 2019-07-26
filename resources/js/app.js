/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('messenger', require('./components/Messenger.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import counterUp from 'counterup2'

 window.onload = function(){
    const app = new Vue({
        el: '#wrapper',
        mounted(){
          let bundleScript = document.createElement('script')
          bundleScript.setAttribute('src', '/js/custom.js')
          document.body.appendChild(bundleScript)

          const el = document.querySelector( '.fun-fact h4' )

          $('.fun-fact h4, .counter').each(function(index, el){
            counterUp(el, {
              duration: 500,
              delay: 5,
            });
          });
          

          console.log('Boom');
        }
    });
 }

