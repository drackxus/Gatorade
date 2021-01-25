<?php

/**
 * The template for displaying the footer.
 *
 *
 * @package WordPress
 */
?>
</div>
<footer class="footer" class="woowContentFull">

</footer>


<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6005e026c2e3b59c35e06719" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="<?php echo JSURL ?>scripts.js" type="text/javascript"></script>

<!-- General Scripts -->
<script type="text/JavaScript" src="<?php echo JSURL ?>html5.js"></script>

<!-- Contact Form -->
<!-- <script src="<?php echo JSURL ?>jquery.form.min.js"></script> -->

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<!-- Woow Custom Scripts -->
<script type='text/javascript' src='<?php echo JSURL ?>jswoow.js?v=<?php echo VCACHE ?>'></script>

<!-- Fullpage -->
<script src="<?php echo JSURL ?>fullpage/fullpage.js" crossorigin="anonymous"></script>
<script src="<?php echo JSURL ?>fullpage/ext.js" crossorigin="anonymous"  ></script>
<script src="<?php echo JSURL ?>fullpage/scroll.js" crossorigin="anonymous"  ></script>

<!-- <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script> -->



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




  });

  // Favoritos
  $("#favorites").on("click", function(event) {
    //event.preventDefault();
    //console.log(event)

    var user = $('#userId').val();
    var post = $('#postId').val();
    console.log(user)
    console.log(post)
    if (user == '' || post == '') {
      alert('Debe registrarse para guardar en favortos')
    } else {
      $.ajax({
        type: "post",
        url: MyAjax.url, // Pon aquí tu URL
        data: {
          action: "user_favorites",
          user: user,
          post: post,

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
    }


  });
</script>

<?php wp_footer(); ?>
</body>

</html>