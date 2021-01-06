<?php

/**
 * The template for displaying the footer.
 *
 *
 * @package WordPress
 */
?>
<footer class="footer" class="woowContentFull">

</footer>




<!-- General Scripts -->
<script type="text/JavaScript" src="<?php echo JSURL ?>html5.js"></script>

<!-- Contact Form -->
<!-- <script src="<?php echo JSURL ?>jquery.form.min.js"></script> -->

<!-- Woow Custom Scripts -->
<script type='text/javascript' src='<?php echo JSURL ?>jswoow.js?v=<?php echo VCACHE ?>'></script>

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<!-- Fullpage -->
<script src="https://rawgit.com/alvarotrigo/fullPage.js/master/dist/fullpage.js" crossorigin="anonymous"></script>
<!-- <script src="https://pagecdn.io/lib/fullpage/3.0.9/fullpage.extensions.min.js" crossorigin="anonymous"  ></script> -->



<script>
  $(document).ready(function() {

    if ($('#user_login')) {
      $('#user_login').attr('placeholder', 'Usuario');
    }
    if ($('#user_pass')) {

      $('#user_pass').attr('placeholder', 'Password');
    }




    //Validamos si en localstorage esta guardado el pais del usuario
    if (localStorage.getItem('userCountry')) {
      console.log('Pais: ' + localStorage.getItem('userCountry'));
      // $('.pais').slideUp();
    } else {
      //Obtenemos por medio del api es pais
      $.get("https://ipinfo.io", function(response) {
        console.log(response.country);
        userCountry = response.country;
        $('.pais').css('display', 'flex');
        //De acuerdo a la abrebiatura estblecemos el nombre completo del pais
        switch (response.country) {
          case 'CO':
            $('.country').text('Colombia');
            break;
          case 'MX':
            $('.country').text('Mexico');
            break;
          default:
            console.log('default');
        }
      }, "jsonp");


    }
    //Cuando el usuario da click en el boton seguir guardamos el pais
    $('.seguir').click(function() {
      localStorage.setItem('userCountry', userCountry);
      $('.pais').css('display', 'none');
    });



    //Registro
    $("#register").on("submit", function(event) {
      event.preventDefault();

      var user = $('#user').val();
      var email = $('#email').val();
      var pais = $('#pais').val();
      var ciudad = $('#ciudad').val();
      var celular = $('#celular').val();
      var deporte = $('#deporte').val();


      //La llamada AJAX
      $.ajax({
        type: "post",
        url: MyAjax.url, // Pon aquí tu URL
        data: {
          action: "register",
          user: user,
          email: email,
          pais: pais,
          ciudad: ciudad,
          celular: celular,
          deporte: deporte
        },
        beforeSend: function() {
          $('#loader').css('display', 'flex');
        },
        error: function(response) {
          console.log(response);
        },
        success: function(response) {
          // Actualiza el mensaje con la respuesta
          console.log(response);
          $('.msgAlert').css('display', 'flex');
          $('.msgAlert').css('opacity', '1');
          $('.msgAlert p').html(response);
          $('#loader').css('display', 'none');
        }
      })


    });





    $(".interes").on("submit", function(event) {
      event.preventDefault();
      var selectedCategorias = [];
      $('.cat').each(function() {
        if ($(this).is(":checked")) {
          selectedCategorias.push($(this).attr('nameCat'));
        }
      });

      var selectedEtiquetas = [];
      $('.eti').each(function() {
        if ($(this).is(":checked")) {
          selectedEtiquetas.push($(this).attr('nameEti'));
        }
      });

      var userId = $('#idUser').val();
      console.log(userId);


      //La llamada AJAX
      $.ajax({
        type: "post",
        url: MyAjax.url, // Pon aquí tu URL
        data: {
          action: "update_profile",
          datosCat: selectedCategorias,
          datosEti: selectedEtiquetas,
          idUser: userId
        },
        beforeSend: function() {
          $('#loader').css('display', 'flex');
        },
        error: function(response) {
          console.log(response);
          $('#loader').css('display', 'none');
        },
        success: function(response) {
          // Actualiza el mensaje con la respuesta
          console.log(response);
          $('#txtMessage').text(response);
          $('#loader').css('display', 'none');
        }
      })


    });


    $(document).ready(function() {

      var ajaxUrl = "<?php echo admin_url('admin-ajax.php') ?>";
      var page = 1; // What page we are on.
      var ppp = 2; // Post per page


      init();

      function init() {
        $('#fullpage').fullpage({
          navigation: true,
          scrollBar: false,
          lazyLoading: true,
          continuousVertical: false,
          continuousHorizontal: false,
          loopHorizontal: false,
          dragAndMove: true,
          scrollingSpeed: 400,
          autoScrolling: true,
          afterLoad: function(origin, destination, direction) {
            var params = {
              origin: origin,
              destination: destination,
              direction: direction
            };

            if (destination.isLast == true) {
              //La llamada AJAX
              $.ajax({
                type: "post",
                url: MyAjax.url, // Pon aquí tu URL
                data: {
                  action: "more_post_ajax",
                  offset: (page * ppp) + 1,
                  ppp: ppp
                },
                beforeSend: function() {
                  $('#infinite').css('display', 'flex');
                },
                error: function(response) {
                  console.log(response);
                },
                success: function(response) {
                  page++;
                  console.log('Pagina' + page);


                  // Actualiza el mensaje con la respuesta
                  console.log(response);
                  $('#fullpage').append(response);

                  //remembering the active section / slide
                  var activeSectionIndex = $('.fp-section.active').index();
                  var activeSlideIndex = $('.fp-section.active').find('.slide.active').index();

                  $.fn.fullpage.destroy('all');

                  //setting the active section as before
                  $('.section').eq(activeSectionIndex).addClass('active');

                  //were we in a slide? Adding the active state again
                  if (activeSlideIndex > -1) {
                    $('.section.active').find('.slide').eq(activeSlideIndex).addClass('active');
                  }

                  init();


                  $('#txtMessage').text("oka");
                  $('#infinite').css('display', 'none');
                }
              })
            }
            console.log("--- afterLoad ---");
            console.log(params);
            console.log('===============');

          }
        });
      }

    });

  });
</script>

<?php wp_footer(); ?>
</body>

</html>