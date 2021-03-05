jQuery(document).ready(function($){
    $('#agregar-foto-producto').on('click', function(){
        $('#fotos > div').append('<input id="productoform-fotos" name="ProductoForm[fotos][]" accept=".jpg,.jpeg,.png" type="file">');
    });

    $('.quitar-foto.producto').on('click', function(){
        var id = $(this).attr('id');
        $(this).parent().remove();
        $('.edita-fotos').append(' <div class="form-group field-productoform-fotos_elim"><input id="productoform-fotos_elim" class="form-control"name="ProductoForm[fotos_elim][]" value="'+id+'" type="hidden"><p class="help-block help-block-error"></p></div>')
    });

    $('#fotos-producto').slick({
        'autoplay': true,
        'autoplaySpeed': 5000,
        'arrows': true,
        'dots': false
    });

    $('.video-vocamx').each(function(){
        var id = $(this).attr('id');
        if(id != ''){
            // var player = videojs(id, {
            //     autoplay: false,
            //     muted: false,
            //     loop: false
            // });
        }
    });

    $('#marcar-enviado').on('click', function(e){
        if(confirm('El pedido se marcará como enviado.')){
            return true;
        }
        return false;
    });

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);

    $("#editar-portada-fondo").click(function(){
        $("#portada-fondo-select").trigger("click");
    });
    $("#editar-portada-fondo-movil").click(function(){
        $("#portada-fondo-movil-select").trigger("click");
    });
    $( "#portada-imagen1" ).click(function() {
        $("#portada-imagen1-select").trigger("click");
    });
    $( "#portada-imagen2" ).click(function() {
        $("#portada-imagen2-select").trigger("click");
    });
    $( "#editar-portada-fondo2" ).click(function() {
        $("#portada-fondo2-select" ).trigger( "click" );
    });
    $( "#editar-bloque3-fondo" ).click(function() {
        $("#bloque3-fondo-select" ).trigger( "click" );
    });
    $( "#bloque3-imagen1" ).click(function() {
        $("#bloque3-imagen1-select").trigger( "click" );
    });
    $( "#editar-bloque4-imagen1" ).click(function() {
        $("#bloque4-imagen1-select" ).trigger( "click" );
    });
    $( "#editar-bloque5-imagen1" ).click(function() {
        $("#bloque5-imagen1-select" ).trigger( "click" );
    });
    $( "#editar-bloque6-imagen" ).click(function() {
        $("#bloque6-imagen-select" ).trigger( "click" );
    });
    $( "#editar-bloque7-imagen" ).click(function() {
        $("#bloque7-imagen-select" ).trigger( "click" );
    });
    $( "#editar-bloque8-imagen" ).click(function() {
        $("#bloque8-imagen-select" ).trigger( "click" );
    });
    $( "#editar-bloque9-imagen" ).click(function() {
        $("#bloque9-imagen-select" ).trigger( "click" );
    });
    $( "#editar-bloque10-fondo" ).click(function() {
        $("#bloque10-fondo-select" ).trigger( "click" );
    });
    $( "#editar-garantias-imagen1" ).click(function() {
        $("#garantias-imagen1-select" ).trigger( "click" );
    });
    $( "#editar-garantias-imagen2" ).click(function() {
        $("#garantias-imagen2-select" ).trigger( "click" );
    });
    $( "#editar-contacto-imagen1" ).click(function() {
        $("#contacto-imagen1-select" ).trigger( "click" );
    });
    $( "#editar-nosotros-imagen1" ).click(function() {
        $("#nosotros-imagen1-select" ).trigger( "click" );
    });
    $( "#nosotros-logo1" ).click(function() {
        $("#nosotros-logo1-select" ).trigger( "click" );
    });
    $( "#header-imagen2" ).click(function() {
        $("#header-imagen2-select" ).trigger( "click" );
    });
    $( "#header-imagen3" ).click(function() {
        $("#header-imagen3-select" ).trigger( "click" );
    });
    $( "#header-imagen4" ).click(function() {
        $("#header-imagen4-select" ).trigger( "click" );
    });
    $( "#header-imagen5" ).click(function() {
        $("#header-imagen5-select" ).trigger( "click" );
    });
    $( "#header-imagen6" ).click(function() {
        $("#header-imagen6-select" ).trigger( "click" );
    });
    $( "#header-imagen7" ).click(function() {
        $("#header-imagen7-select" ).trigger( "click" );
    });
    $( "#head-imagen1" ).click(function() {
        $("#head-imagen1-select" ).trigger( "click" );
    });
    $( "#head-imagen2" ).click(function() {
        $("#head-imagen2-select" ).trigger( "click" );
    });
    $( "#foot-imagen1" ).click(function() {
        $("#foot-imagen1-select" ).trigger( "click" );
    });
    $( "#foot-imagen2" ).click(function() {
        $("#foot-imagen2-select" ).trigger( "click" );
    });
    $( "#foot-imagen3" ).click(function() {
        $("#foot-imagen3-select" ).trigger( "click" );
    });
    $( "#foot-imagen4" ).click(function() {
        $("#foot-imagen4-select" ).trigger( "click" );
    });
    $( "#header-imagen1" ).click(function() {
        $("#header-imagen1-select" ).trigger( "click" );
    });
    $( "#header2-imagen1" ).click(function() {
        $("#header2-imagen1-select" ).trigger( "click" );
    });
    $("#bombers-bloque1-fondo1").click(function(){
        $("#bombers-bloque1-fondo1-select").trigger("click");
    });
    $("#bombers-bloque1-imagen1").click(function(){
        $("#bombers-bloque1-imagen1-select").trigger("click");
    });
    $("#bombers-bloque1-imagen2").click(function(){
        $("#bombers-bloque1-imagen2-select").trigger("click");
    });
    $("#bombers-bloque2-fondo1").click(function(){
        $("#bombers-bloque2-fondo1-select").trigger("click");
    });
    $("#bombers-bloque2-imagen1").click(function(){
        $("#bombers-bloque2-imagen1-select").trigger("click");
    });
    $("#bombers-bloque2-imagen2").click(function(){
        $("#bombers-bloque2-imagen2-select").trigger("click");
    });
    $("#bombers-bloque3-fondo1").click(function(){
        $("#bombers-bloque3-fondo1-select").trigger("click");
    });
    $("#bombers-bloque3-imagen1").click(function(){
        $("#bombers-bloque3-imagen1-select").trigger("click");
    });
    $("#bombers-bloque3-imagen2").click(function(){
        $("#bombers-bloque3-imagen2-select").trigger("click");
    });
    $("#bombers-popup1-imagen1").click(function(){
        $("#bombers-popup1-imagen1-select").trigger("click");
    });
    $("#editar-banner-movil").click(function(){
        $("#banner-movil-select").trigger("click");
    });


    $('#portada-fondo-select').on('change', function(){
        if (document.getElementById('portada-fondo-select').files && document.getElementById('portada-fondo-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.main-banner').css('background-image', 'url('+e.target.result+')');
            }
            reader.readAsDataURL(document.getElementById('portada-fondo-select').files[0]);
        }
    });
    $('#portada-fondo-movil-select').on('change', function(){
        if (document.getElementById('portada-fondo-movil-select').files && document.getElementById('portada-fondo-movil-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.main-banner-movil').css('background-image', 'url('+e.target.result+')');
            }
            reader.readAsDataURL(document.getElementById('portada-fondo-movil-select').files[0]);
        }
    });
    $('#portada-fondo2-select').on('change', function(){
        if (document.getElementById('portada-fondo2-select').files && document.getElementById('portada-fondo2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#div-fondo2').css('background-image', 'url('+e.target.result+')');
            }
            reader.readAsDataURL(document.getElementById('portada-fondo2-select').files[0]);
        }
    });
    $('#bloque3-fondo-select').on('change', function(){
        if (document.getElementById('bloque3-fondo-select').files && document.getElementById('bloque3-fondo-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque3-fondo').css('background-image', 'url('+e.target.result+')');
            }
            reader.readAsDataURL(document.getElementById('bloque3-fondo-select').files[0]);
        }
    });
    $('#portada-imagen1-select').on('change', function(){
        if (document.getElementById('portada-imagen1-select').files && document.getElementById('portada-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#portada-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('portada-imagen1-select').files[0]);
        }
    });
    $('#portada-imagen2-select').on('change', function(){
        if (document.getElementById('portada-imagen2-select').files && document.getElementById('portada-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#portada-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('portada-imagen2-select').files[0]);
        }
    });
    $('#bloque3-imagen1-select').on('change', function(){
        if (document.getElementById('bloque3-imagen1-select').files && document.getElementById('bloque3-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque3-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bloque3-imagen1-select').files[0]);
        }
    });
    $('#bloque4-imagen1-select').on('change', function(){
        if (document.getElementById('bloque4-imagen1-select').files && document.getElementById('bloque4-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque4-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bloque4-imagen1-select').files[0]);
        }
    });
    $('#bloque5-imagen1-select').on('change', function(){
        if (document.getElementById('bloque5-imagen1-select').files && document.getElementById('bloque5-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque5-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bloque5-imagen1-select').files[0]);
        }
    });
    $('#bloque6-imagen-select').on('change', function(){
        if (document.getElementById('bloque6-imagen-select').files && document.getElementById('bloque6-imagen-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque6-imagen').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bloque6-imagen-select').files[0]);
        }
    });
    $('#bloque7-imagen-select').on('change', function(){
        if (document.getElementById('bloque7-imagen-select').files && document.getElementById('bloque7-imagen-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque7-imagen').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bloque7-imagen-select').files[0]);
        }
    });
    $('#bloque8-imagen-select').on('change', function(){
        if (document.getElementById('bloque8-imagen-select').files && document.getElementById('bloque8-imagen-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque8-imagen').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bloque8-imagen-select').files[0]);
        }
    });
    $('#bloque9-imagen-select').on('change', function(){
        if (document.getElementById('bloque9-imagen-select').files && document.getElementById('bloque9-imagen-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque9-imagen').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bloque9-imagen-select').files[0]);
        }
    });
    $('#bloque10-fondo-select').on('change', function(){
        if (document.getElementById('bloque10-fondo-select').files && document.getElementById('bloque10-fondo-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bloque10-fondo').css('background-image', 'url('+e.target.result+')');
            }
            reader.readAsDataURL(document.getElementById('bloque10-fondo-select').files[0]);
        }
    });
    $('#garantias-imagen1-select').on('change', function(){
        if (document.getElementById('garantias-imagen1-select').files && document.getElementById('garantias-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#garantias-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('garantias-imagen1-select').files[0]);
        }
    });
    $('#garantias-imagen2-select').on('change', function(){
        if (document.getElementById('garantias-imagen2-select').files && document.getElementById('garantias-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#garantias-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('garantias-imagen2-select').files[0]);
        }
    });
    $('#contacto-imagen1-select').on('change', function(){
        if (document.getElementById('contacto-imagen1-select').files && document.getElementById('contacto-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#contacto_imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('contacto-imagen1-select').files[0]);
        }
    });

    $('#nosotros-logo1-select').on('change', function(){
        if (document.getElementById('nosotros-logo1-select').files && document.getElementById('nosotros-logo1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#nosotros-logo1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('nosotros-logo1-select').files[0]);
        }
    });
    $('#nosotros-imagen1-select').on('change', function(){
        if (document.getElementById('nosotros-imagen1-select').files && document.getElementById('nosotros-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#nosotros-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('nosotros-imagen1-select').files[0]);
        }
    });
    $('#header-imagen1-select').on('change', function(){
        if (document.getElementById('header-imagen1-select').files && document.getElementById('header-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header-imagen1-select').files[0]);
        }
    });
    $('#header-imagen2-select').on('change', function(){
        if (document.getElementById('header-imagen2-select').files && document.getElementById('header-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header-imagen2-select').files[0]);
        }
    });
    $('#header-imagen3-select').on('change', function(){
        if (document.getElementById('header-imagen3-select').files && document.getElementById('header-imagen3-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header-imagen3').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header-imagen3-select').files[0]);
        }
    });
    $('#header-imagen4-select').on('change', function(){
        if (document.getElementById('header-imagen4-select').files && document.getElementById('header-imagen4-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header-imagen4').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header-imagen4-select').files[0]);
        }
    });
    $('#header-imagen5-select').on('change', function(){
        if (document.getElementById('header-imagen5-select').files && document.getElementById('header-imagen5-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header-imagen5').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header-imagen5-select').files[0]);
        }
    });
    $('#header-imagen6-select').on('change', function(){
        if (document.getElementById('header-imagen6-select').files && document.getElementById('header-imagen6-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header-imagen6').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header-imagen6-select').files[0]);
        }
    });
    $('#header-imagen7-select').on('change', function(){
        if (document.getElementById('header-imagen7-select').files && document.getElementById('header-imagen7-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header-imagen7').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header-imagen7-select').files[0]);
        }
    });
    $('#head-imagen1-select').on('change', function(){
        if (document.getElementById('head-imagen1-select').files && document.getElementById('head-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#head-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('head-imagen1-select').files[0]);
        }
    });
    $('#head-imagen2-select').on('change', function(){
        if (document.getElementById('head-imagen2-select').files && document.getElementById('head-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#head-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('head-imagen2-select').files[0]);
        }
    });
    $('#foot-imagen1-select').on('change', function(){
        if (document.getElementById('foot-imagen1-select').files && document.getElementById('foot-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foot-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('foot-imagen1-select').files[0]);
        }
    });
    $('#foot-imagen2-select').on('change', function(){
        if (document.getElementById('foot-imagen2-select').files && document.getElementById('foot-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foot-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('foot-imagen2-select').files[0]);
        }
    });
    $('#foot-imagen3-select').on('change', function(){
        if (document.getElementById('foot-imagen3-select').files && document.getElementById('foot-imagen3-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foot-imagen3').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('foot-imagen3-select').files[0]);
        }
    });
    $('#foot-imagen4-select').on('change', function(){
        if (document.getElementById('foot-imagen4-select').files && document.getElementById('foot-imagen4-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foot-imagen4').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('foot-imagen4-select').files[0]);
        }
    });
    $('#header2-imagen1-select').on('change', function(){
        if (document.getElementById('header2-imagen1-select').files && document.getElementById('header2-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#header2-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('header2-imagen1-select').files[0]);
        }
    });
    $('#bombers-bloque1-fondo1-select').on('change', function(){
        if (document.getElementById('bombers-bloque1-fondo1-select').files && document.getElementById('bombers-bloque1-fondo1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque1-fondo1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque1-fondo1-select').files[0]);
        }
    });
    $('#bombers-bloque1-imagen1-select').on('change', function(){
        if (document.getElementById('bombers-bloque1-imagen1-select').files && document.getElementById('bombers-bloque1-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque1-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque1-imagen1-select').files[0]);
        }
    });
    $('#bombers-bloque1-imagen2-select').on('change', function(){
        if (document.getElementById('bombers-bloque1-imagen2-select').files && document.getElementById('bombers-bloque1-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque1-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque1-imagen2-select').files[0]);
        }
    });
    $('#bombers-bloque2-fondo1-select').on('change', function(){
        if (document.getElementById('bombers-bloque2-fondo1-select').files && document.getElementById('bombers-bloque2-fondo1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque2-fondo1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque2-fondo1-select').files[0]);
        }
    });
    $('#bombers-bloque2-imagen1-select').on('change', function(){
        if (document.getElementById('bombers-bloque2-imagen1-select').files && document.getElementById('bombers-bloque2-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque2-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque2-imagen1-select').files[0]);
        }
    });
    $('#bombers-bloque2-imagen2-select').on('change', function(){
        if (document.getElementById('bombers-bloque2-imagen2-select').files && document.getElementById('bombers-bloque2-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque2-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque2-imagen2-select').files[0]);
        }
    });
    $('#bombers-bloque3-fondo1-select').on('change', function(){
        if (document.getElementById('bombers-bloque3-fondo1-select').files && document.getElementById('bombers-bloque3-fondo1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque3-fondo1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque3-fondo1-select').files[0]);
        }
    });
    $('#bombers-bloque3-imagen1-select').on('change', function(){
        if (document.getElementById('bombers-bloque3-imagen1-select').files && document.getElementById('bombers-bloque3-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque3-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque3-imagen1-select').files[0]);
        }
    });
    $('#bombers-bloque3-imagen2-select').on('change', function(){
        if (document.getElementById('bombers-bloque3-imagen2-select').files && document.getElementById('bombers-bloque3-imagen2-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-bloque3-imagen2').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-bloque3-imagen2-select').files[0]);
        }
    });
    $('#bombers-popup1-imagen1-select').on('change', function(){
        if (document.getElementById('bombers-popup1-imagen1-select').files && document.getElementById('bombers-popup1-imagen1-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#bombers-popup1-imagen1').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('bombers-popup1-imagen1-select').files[0]);
        }
    });
    $('#banner-movil-select').on('change', function(){
        if (document.getElementById('banner-movil-select').files && document.getElementById('banner-movil-select').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#banner-movil').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('banner-movil-select').files[0]);
        }
    });

    $('#contacto-telefono-boton').click(function(){
        $("#contacto-telefono-input" ).slideToggle();
    })
    $('#garantias-enlace1-boton').click(function(){
        $("#garantias-enlace1-input" ).slideToggle();
    })
    $('#home-enlace1-boton').click(function(){
        $("#home-enlace1-input" ).slideToggle();
    })
    $('#home-enlace2-boton').click(function(){
        $("#home-enlace2-input" ).slideToggle();
    })
    $('#home-enlace3-boton').click(function(){
        $("#home-enlace3-input" ).slideToggle();
        $("#home-enlace4-input").slideUp();
        $("#home-enlace5-input").slideUp();
        $("#home-enlace6-input").slideUp();
        $("#home-enlace7-input").slideUp();
    })
    $('#home-enlace4-boton').click(function(){
        $("#home-enlace4-input" ).slideToggle();
        $("#home-enlace3-input").slideUp();
        $("#home-enlace5-input").slideUp();
        $("#home-enlace6-input").slideUp();
        $("#home-enlace7-input").slideUp();
    })
    $('#home-enlace5-boton').click(function(){
        $("#home-enlace5-input" ).slideToggle();
        $("#home-enlace4-input").slideUp();
        $("#home-enlace3-input").slideUp();
        $("#home-enlace6-input").slideUp();
        $("#home-enlace7-input").slideUp();
    })
    $('#home-enlace6-boton').click(function(){
        $("#home-enlace6-input" ).slideToggle();
        $("#home-enlace4-input").slideUp();
        $("#home-enlace5-input").slideUp();
        $("#home-enlace3-input").slideUp();
        $("#home-enlace7-input").slideUp();
    })
    $('#home-enlace7-boton').click(function(){
        $("#home-enlace7-input" ).slideToggle();
        $("#home-enlace4-input").slideUp();
        $("#home-enlace5-input").slideUp();
        $("#home-enlace6-input").slideUp();
        $("#home-enlace3-input").slideUp();
    })


    $('#head-enlace1-boton').click(function(){
        $("#head-enlace1-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace2-boton').click(function(){
        $("#head-enlace2-input" ).slideToggle();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace3-boton').click(function(){
        $("#head-enlace3-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace4-boton').click(function(){
        $("#head-enlace4-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace5-boton').click(function(){
        $("#head-enlace5-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace6-boton').click(function(){
        $("#head-enlace6-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace7-boton').click(function(){
        $("#head-enlace7-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace8-boton').click(function(){
        $("#head-enlace8-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace9-boton').click(function(){
        $("#head-enlace9-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace10-boton').click(function(){
        $("#head-enlace10-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace1-input").slideUp();
        $("#head-enlace11-input").slideUp();
    })
    $('#head-enlace11-boton').click(function(){
        $("#head-enlace11-input" ).slideToggle();
        $("#head-enlace2-input").slideUp();
        $("#head-enlace3-input").slideUp();
        $("#head-enlace4-input").slideUp();
        $("#head-enlace5-input").slideUp();
        $("#head-enlace6-input").slideUp();
        $("#head-enlace7-input").slideUp();
        $("#head-enlace8-input").slideUp();
        $("#head-enlace9-input").slideUp();
        $("#head-enlace10-input").slideUp();
        $("#head-enlace1-input").slideUp();
    })

    $('#head-enlace12-boton').click(function(){
        $("#head-enlace12-input" ).slideToggle();
        $("#head-enlace13-input").slideUp();
        $("#head-enlace14-input").slideUp();
        $("#head-enlace15-input").slideUp();
        $("#head-enlace16-input").slideUp();
        $("#head-enlace17-input").slideUp();
        $("#head-enlace18-input").slideUp();
    })
    $('#head-enlace13-boton').click(function(){
        $("#head-enlace13-input" ).slideToggle();
        $("#head-enlace12-input").slideUp();
        $("#head-enlace14-input").slideUp();
        $("#head-enlace15-input").slideUp();
        $("#head-enlace16-input").slideUp();
        $("#head-enlace17-input").slideUp();
        $("#head-enlace18-input").slideUp();
    })
    $('#head-enlace14-boton').click(function(){
        $("#head-enlace14-input" ).slideToggle();
        $("#head-enlace13-input").slideUp();
        $("#head-enlace12-input").slideUp();
        $("#head-enlace15-input").slideUp();
        $("#head-enlace16-input").slideUp();
        $("#head-enlace17-input").slideUp();
        $("#head-enlace18-input").slideUp();
    })
    $('#head-enlace15-boton').click(function(){
        $("#head-enlace15-input" ).slideToggle();
        $("#head-enlace13-input").slideUp();
        $("#head-enlace14-input").slideUp();
        $("#head-enlace12-input").slideUp();
        $("#head-enlace16-input").slideUp();
        $("#head-enlace17-input").slideUp();
        $("#head-enlace18-input").slideUp();
    })
    $('#head-enlace16-boton').click(function(){
        $("#head-enlace16-input" ).slideToggle();
        $("#head-enlace13-input").slideUp();
        $("#head-enlace14-input").slideUp();
        $("#head-enlace15-input").slideUp();
        $("#head-enlace12-input").slideUp();
        $("#head-enlace17-input").slideUp();
        $("#head-enlace18-input").slideUp();
    })
    $('#head-enlace17-boton').click(function(){
        $("#head-enlace17-input" ).slideToggle();
        $("#head-enlace13-input").slideUp();
        $("#head-enlace14-input").slideUp();
        $("#head-enlace15-input").slideUp();
        $("#head-enlace16-input").slideUp();
        $("#head-enlace12-input").slideUp();
        $("#head-enlace18-input").slideUp();
    })
    $('#head-enlace18-boton').click(function(){
        $("#head-enlace18-input" ).slideToggle();
        $("#head-enlace13-input").slideUp();
        $("#head-enlace14-input").slideUp();
        $("#head-enlace15-input").slideUp();
        $("#head-enlace16-input").slideUp();
        $("#head-enlace17-input").slideUp();
        $("#head-enlace12-input").slideUp();
    })
    $('#bombers-bloque1-enlace1-boton').click(function(){
        $("#bombers-bloque1-enlace1-input" ).slideToggle();
        $("#bombers-bloque2-enlace1-input").slideUp();
        $("#bombers-bloque3-enlace1-input").slideUp();
    })
    $('#bombers-bloque2-enlace1-boton').click(function(){
        $("#bombers-bloque2-enlace1-input" ).slideToggle();
        $("#bombers-bloque1-enlace1-input").slideUp();
        $("#bombers-bloque3-enlace1-input").slideUp();
    })
    $('#bombers-bloque3-enlace1-boton').click(function(){
        $("#bombers-bloque3-enlace1-input" ).slideToggle();
        $("#bombers-bloque2-enlace1-input").slideUp();
        $("#bombers-bloque1-enlace1-input").slideUp();
    })

    if($('#agregar-fotoscolor').length){
        $('#agregar-fotoscolor').on('click', function(){
            let color = $('tr.imagen-color').first().clone();
            color.find('#productoform-imagen_color').attr('id','').val('');
            color.find('#productoform-imagen_color_ruta').attr('id','').val('');
            $('#imagenes-color tbody').append(color);
        });
    }

    if($('#agregar-variante').length){
        $('#agregar-variante').on('click', function(){
            let variante = $('tr.variante').first().clone();
            variante.find('#productoform-colores').attr('id','').val('');
            variante.find('#productoform-medidas').attr('id','').val('');
            variante.find('#productoform-precios_variante').attr('id','').val('');
            variante.find('#productoform-precios_usd_variante').attr('id','').val('');
            $('#variantes tbody').append(variante);
        });
    }

    document.querySelector('#contenidonosotrosform-bloque1_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidonosotrosform-bloque2_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidonosotrosform-bloque3_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidonosotrosform-bloque4_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidonosotrosform-bloque5_texto').addEventListener('keydown', autosize);

    document.querySelector('#contenidocontactoform-bloque1_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidocontactoform-bloque2_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidogarantiasform-bloque2_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidogarantiasform-bloque3_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidogarantiasform-bloque4_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidogarantiasform-bloque5_texto').addEventListener('keydown', autosize);
    document.querySelector('#contenidogarantiasform-bloque5_texto2').addEventListener('keydown', autosize);

});

function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}
