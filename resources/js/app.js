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
Vue.component('reviews-modal', require('./components/ReviewsModal.vue').default);
Vue.component('proposals-modal', require('./components/ProposalsModal.vue').default);
Vue.component('tasks-proposals-modal', require('./components/TasksProposalsModal.vue').default);
Vue.component('tasks-filters', require('./components/TasksFilter.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import counterUp from 'counterup2';

 window.onload = function(){
    function typeElementSwticher(el, show = true){
      if(show){
        $(el).parent().show();
        $(el).prop('required', true);
      }else{
        $(el).parent().hide();
        $(el).prop('required', false);
      }
      return true;
    }

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

          $('input.account-type-radio').change(function(){
            let inputID = $(this).attr('id');
            let typeInput = $('input[name="type"]');

            if(inputID == 'freelancer-radio'){
              typeInput.val(2);
              typeElementSwticher($('input[name="ogrn"]'));
              typeElementSwticher($('input[name="legal_address"]'));
              typeElementSwticher($('input[name="address"]'));
              typeElementSwticher($('input[name="phone"]'));
            }
            else{
              typeInput.val(1);
              typeElementSwticher($('input[name="ogrn"]'), false);
              typeElementSwticher($('input[name="legal_address"]'), false);
              typeElementSwticher($('input[name="address"]'), false);
              typeElementSwticher($('input[name="phone"]'), false);
            }
          });

          $('input.account-type-radio#freelancer-radio').trigger('change');
          $('input.account-type-radio#freelancer-radio').prop('checked', true);

          $('label[for="remember"]').click(function(){
            let rememberMe = $(this).parent().find('input#remember-login-popup');
            if(rememberMe.prop('checked')){
              rememberMe.prop('checked', false);
            }else{
              rememberMe.prop('checked', true);
            }
          });

          $("#header .left-side").css("width", "100%");
          console.log('Boom');
        }
    });
 }

