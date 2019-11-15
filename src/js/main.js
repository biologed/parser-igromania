//= jquery-3.4.1.min.js
// //= popper.min.js
//
//
$(window).on('load', function() {
    setInterval(function() {
        $('#loader').addClass('hidden');
        $('#loader').removeClass('visible');
        $('#loader').addClass('none');
        $('#body').addClass('visible');
        $('#body').removeClass('hidden');
        $('#body').removeClass('opacity1');
    }, 1000);
});
//
// $( document ).ready(function() {
//     $("#ordercall").removeAttr("action");
//     $("#ordercall #js").remove();
//     $("#ordercall button").attr("type", "button");
//     $("#ordercall button").click(function(){
//         if($("#ordercall input")[0].validity.valid == true && $("#ordercall input")[1].validity.valid == true) {
//             console.log(1);
//             $.ajax({
//                 url: "../send.php?action=ordercall",
//                 type: "POST",
//                 dataType: "json",
//                 data: $("#ordercall").serialize(),
//                 success: function(data) {
//                     console.log(data);
//                     if(data[0] == 1) {
//                         $('.card-img-top').attr('src','../img/success.png');
//                         $('.card-title').html('Спасибо за заявку!');
//                         $('.card-text').html(data[1]);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         })
//                     } else {
//                         $('.card-img-top').attr('src','../img/error.png');
//                         $('.card-title').html('Ошибка');
//                         $('.card-text').html(data);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         })
//                     }
//                 },
//                 error: function(data) {
//                     console.log(data);
//                 }
//             });
//         }
//     });
//
//     $("#phoneval").removeAttr("action");
//     $("#phoneval #js").remove();
//     $("#phoneval button").attr("type", "button");
//     $("#phoneval button").click(function(){
//         if($("#phoneval input")[0].validity.valid == true) {
//             $.ajax({
//                 url: "../send.php?action=phone",
//                 type: "POST",
//                 dataType: "json",
//                 data: $("#phoneval").serialize(),
//                 success: function(data) {
//                     console.log(data);
//                     if(data[0] == 1) {
//                         $('.card-img-top').attr('src','../img/success.png');
//                         $('.card-title').html('Ваш номер прошел проверку!');
//                         $('.card-text').html(data[1]);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         })
//                     } else {
//                         $('.card-img-top').attr('src','../img/error.png');
//                         $('.card-title').html('Ошибка');
//                         $('.card-text').html(data);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         })
//                     }
//                 },
//                 error: function(data) {
//                     console.log(data);
//                 }
//             });
//         }
//     });
//
//     $("#reg").removeAttr("action");
//     $("#reg #js").remove();
//     $("#reg button").attr("type", "button");
//     $("#reg button").click(function(){
//         if($("#reg input")[0].validity.valid == true && $("#reg input")[1].validity.valid == true && $("#reg input")[2].validity.valid == true && $("#reg input")[3].validity.valid == true) {
//             $.ajax({
//                 url: "../send.php?action=reg",
//                 type: "POST",
//                 dataType: "json",
//                 data: $("#reg").serialize(),
//                 success: function(data) {
//                     console.log(data);
//                     if(data[0] == 1) {
//                         $('.card-img-top').attr('src','../img/success.png');
//                         $('.card-title').html('Вы успешно зарегистрировались!');
//                         $('.card-text').html(data[1]);
//                         $('#back-btn').html(data[2]);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                             window.open(data[3],'_blank');
//                         })
//                     } else {
//                         $('.card-img-top').attr('src','../img/error.png');
//                         $('.card-title').html('Ошибка');
//                         $('.card-text').html(data);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         })
//                     }
//                 },
//                 error: function(data) {
//                     console.log(data);
//                 }
//             });
//         }
//     });
//
//     $("#login").removeAttr("action");
//     $("#login #js").remove();
//     $("#login #loginform").attr("type", "button");
//     $("#login #loginform").click(function(){
//         if($("#login input")[0].validity.valid == true && $("#login input")[1].validity.valid == true) {
//             $.ajax({
//                 url: "../send.php?action=login",
//                 type: "POST",
//                 dataType: "json",
//                 data: $("#login").serialize(),
//                 success: function(data) {
//                     console.log(data);
//                     if(data[0] == 1) {
//                         $('.card-img-top').attr('src','../img/success.png');
//                         $('.card-title').html('Вы успешно авторизировались!');
//                         $('.card-text').html(data[1]);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             window.location.replace("/");
//                         });
//                         $('#back-btn').click(function() {
//                             window.location.replace("/");
//                         })
//                     } else {
//                         $('.card-img-top').attr('src','../img/error.png');
//                         $('.card-title').html('Ошибка');
//                         $('.card-text').html(data);
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         })
//                     }
//                 },
//                 error: function(data) {
//                     console.log(data);
//                 }
//             });
//         }
//     });
//
//     $("#forgot").removeAttr("action");
//     $("#forgot #js").remove();
//     $("#forgot #forgotform").click(function(){
//         if($("#forgot input")[0].validity.valid == false) {
//             $("#forgot input")[0].oninvalid = function(){
//                 this.setCustomValidity('Укажите корретный логин или почту, длинна логина должна быть не менее 3 символов и не более 25');
//             }
//             $("#forgot input")[0].oninput = function(){
//                 this.setCustomValidity('');
//             }
//         }
//         else if($("#forgot input")[0].validity.valid == true) {
//             $('#forgot').submit(false);
//             $.ajax({
//                 url: "../send.php?action=forgot",
//                 type: "POST",
//                 dataType: "json",
//                 data: $("#forgot").serialize(),
//                 beforeSend: function() {
//                     $('#loader').show();
//                 },
//                 complete: function() {
//                     $('#loader').hide();
//                 },
//                 success: function(data) {
//                     if(data[0] == 1) {
//                         $('.card-img-top').attr('src','../img/success.png');
//                         $('.card-title').html('Успех!');
//                         $('.card-text').html(data[1]);
//                         if(data[2]) {
//                             $('#back-btn').html(data[2]);
//                         }
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                         });
//                         $('#back-btn').click(function() {
//                             $('.overlay_popup, .popup').hide();
//                             if(data[3]){
//                                 window.open(data[3],'_blank');
//                             }
//                         })
//                     } else {
//                         $('.card-img-top').attr('src','../img/error.png');
//                         $('.card-title').html('Ошибка');
//                         $('.card-text').html(data[1]);
//                         if(data[2]) {
//                             $('#back-btn').html(data[2]);
//                         } else {
//                             $('#back-btn').html("Вернуться на сайт");
//                         }
//                         $('.overlay_popup, .popup').show();
//                         $('.overlay_popup').click(function() {
//                             if(data[3]) {
//                                 window.open(data[3],'_self');
//                             } else {
//                                 $('.overlay_popup, .popup').hide();
//                             }
//                         });
//                         $('#back-btn').click(function() {
//                             if(data[3]) {
//                                 window.open(data[3],'_self');
//                             } else {
//                                 $('.overlay_popup, .popup').hide();
//                             }
//                         })
//                     }
//                 },
//                 error: function(data) {
//                     console.log(data);
//                 }
//             });
//         }
//     });
// });