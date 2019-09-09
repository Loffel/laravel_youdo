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

          $('label[for="remember"]').click(function(){
            let rememberMe = $(this).parent().find('input#remember-login-popup');
            if(rememberMe.prop('checked')){
              rememberMe.prop('checked', false);
            }else{
              rememberMe.prop('checked', true);
            }
          });

          $("a#reviewOpen").on('click', function(){
              var taskElem = $(this).parent().find(".item-content h4");
              var taskLink = taskElem.data("user-url");
              var taskTitle = taskElem.html();
              var userLink = taskElem.data("user-url");
              var userName = taskElem.data("user-name");
              var taskID = taskElem.data("task-id");

              $("a#reviewName").attr("href", userLink);
              $("a#reviewName").html(userName);
              $("a#reviewTask").attr("href", taskLink);
              $("a#reviewTask").html(taskTitle);
              $("input#task_id").val(taskID);
          });

          $("a#reviewOpen.gray").on('click', function(){
            var ratingElem = $(this).parent().find(".star-rating");
            var courtesy = ratingElem.data("courtesy");
            var ID = ratingElem.data("id");
            var punctuality = ratingElem.data("punctuality");
            var adequacy = ratingElem.data("adequacy");
            var comment = $(this).parent().find(".item-description > p").text();

            $("#small-dialog-1").find("input#courtesy-radio-" + courtesy).prop('checked', true);
            $("#small-dialog-1").find("input#punctuality-radio-" + punctuality).prop('checked', true);
            $("#small-dialog-1").find("input#adequacy-radio-" + adequacy).prop('checked', true);
            $("#small-dialog-1").find("#comment").val(comment);
            $("#small-dialog-1").find("#review_id").val(ID);
          });

          $("a#proposalEdit").on('click', function(){
            var ID = $(this).data("id");
            var maxPrice = $(this).data("price");
            var curPrice = $(this).data("current-price");
            var desc = $(this).data("desc");

            $("#small-dialog").find("#proposal_id").val(ID);
            // $("#small-dialog").find(".bidding-slider").data('slider-max', maxPrice);
            // $("#small-dialog").find(".bidding-slider").val(curPrice);
            $("#small-dialog").find("#description").val(desc);
          });

          $("a#openAccept").on('click', function(){
            var ID = $(this).data("id"),
                price = $(this).data("price"),
                actionLink = $(this).data("url"),
                userName = $(this).data("user-name");

            $("#small-dialog-1").find("h3#username").text("Принять предложение от " + userName);
            $("#small-dialog-1").find("#proposal_id").val(ID);
            $("#small-dialog-1").find("form#terms").attr('action', actionLink);
            $("#small-dialog-1").find("#price").html(price.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' руб.');
          });
          
          $("a#openDM").on('click', function(){
            var userID = $(this).data("user-id"),
                userName = $(this).data("user-name");

            $("#small-dialog-2").find("h3#username").text("Сообщение для " + userName);
            $("#small-dialog-2").find("input#contact_id").val(userID);
          });

          console.log('Boom');
        }
    });
 }

