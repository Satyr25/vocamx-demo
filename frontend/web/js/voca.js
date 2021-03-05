function addCommas(nStr){
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function ajusteTamano(campo){
    $('#texto-diseno .'+$(campo).attr('class')).removeClass (function (index, className) {
        return (className.match (/(^|\s)letras-\S+/g) || []).join(' ');
    });
    $('#texto-diseno .'+$(campo).attr('class')).addClass('letras-'+campo.val().length);

    if($('#texto-diseno.pet_lover').length){
        $('#edicion-linea-1').textfill({minFontPixels:4,maxFontPixels:80});
        $('#edicion-linea-2').textfill({minFontPixels:4,maxFontPixels:80});
        $('#edicion-linea-3').textfill({minFontPixels:4,maxFontPixels:80});
    }else{
        $('#texto-diseno span').removeAttr('style');
    }

    if(campo.val().length >= 7){
        if(!$('#texto-diseno .'+$(campo).attr('id')).hasClass('maximo')){
            $('#texto-diseno .'+$(campo).attr('id')).removeClass('minimo medio');
            $('#texto-diseno .'+$(campo).attr('id')).addClass('maximo');
        }
    } else if(campo.val().length >= 4){
        if(!$('#texto-diseno .'+$(campo).attr('id')).hasClass('medio')){
            $('#texto-diseno .'+$(campo).attr('id')).removeClass('maximo minimo');
            $('#texto-diseno .'+$(campo).attr('id')).addClass('medio');
        }
    } else{
        if(!$('#texto-diseno .'+$(campo).attr('id')).hasClass('minimo')){
            $('#texto-diseno .'+$(campo).attr('id')).removeClass('medio maximo');
            $('#texto-diseno .'+$(campo).attr('id')).addClass('minimo');
        }
    }

    if($('#texto-diseno.suerte').length){
        $("#edicion-linea-1 span.texto-custom").lettering();
        $("#edicion-linea-3 span.texto-custom").lettering();
    }else if($('#texto-diseno.karma').length){
        $("#edicion-linea-1 span.texto-custom").lettering();
    }else if($('#texto-diseno.new_black').length){
        $("#edicion-linea-1 span.texto-custom").lettering();
        $("#edicion-linea-2 span.texto-custom").lettering();
        $("#edicion-linea-3 span.texto-custom").lettering();
    }
}

function resize(){
    if($('#bloque-productos').length){
        $('.producto .foto-producto').height(Math.ceil($('.producto').width()));
    }
    // if($('.bombers-linea').length){
    //     $('.bombers-linea .bomber a').height($('.bombers-linea .bomber a').width());
    // }
    if($('#embajadores').length){
        $('#embajadores .embajador').height($('#embajadores .embajador').width());
    }

    if($('#categorias-productos .descripcion-categoria').length){
        if(window.innerWidth > 600){
            $('#categorias-productos .descripcion-categoria').removeAttr('style');
            var altura = 0;
            $('#categorias-productos .descripcion-categoria').each(function(){
                if($(this).height() > altura){
                    altura = $(this).height();
                    console.log(altura);
                }
            });
            $('#categorias-productos .descripcion-categoria').height(altura);
        }else{
            $('#categorias-productos .descripcion-categoria').removeAttr('style');
        }
    }

    if($('#listado-productos #contenedor-productos').length){
        $('#contenedor-productos .producto').removeAttr('style');
        if(window.innerWidth >= 700){
            var maxima = 0;
            $('#contenedor-productos .producto').each(function(){
                maxima = $(this).height() > maxima ? $(this).height() : maxima;
            });
            $('#contenedor-productos .producto').height(maxima);
        }
    }

    if($('#texto-diseno').length){
        $('#texto-diseno').width($('#texto-diseno').height());
    }

    $('#bloque-personalizacion').height(window.innerWidth);
}

var formatter = new Intl.NumberFormat('es-MX', {
    style: 'currency',
    currency: 'MXN',
    minimumFractionDigits: 2,
});

var masonryIsSet = false;

$(document).on('keydown', function (e) {
    if ($('.slick-next').length > 0) {
        switch(e.which){
            case 37:
                $('.slick-next').click();
                break;
            case 39:
                $('.slick-prev').click();
                break;
        }
    }
})

jQuery(document).ready(function($){
    resize();
    $('.desplegar-menu').on('click', function(){
        $('body').toggleClass('desplegado');
        $('body').hasClass('desplegado') ? $(this).text('Cerrar') : $(this).html('Men&uacute');
    });

    $('.slide').slide({
        'slideSpeed': 3000,
        'isShowArrow': true,
        'dotsEvent': 'click',
        'isLoadAllImgs': true,
        isShowDots: true
    });


    jQuery(window).scroll(function(){
        if(window.innerHeight < 850 && window.innerWidth > 990 && $('.checkout-block').length > 0){
            // checkOffset();
        }
    });

    $(window).resize(function(){
        resize();

//        if($('#ver-producto').length > 0) {
//            if (window.innerWidth > 992 && !masonryIsSet) {
//                initMasonryGrid('.grid', '.bloque-ver-compra', '.grid-sizer', true);
//                masonryIsSet = true;
//            }
//        }
    });

    // if($('#bombers-ver-custom').length){
    //     var altura = $('#fotos-producto .foto img').css('height');
    //     $('#fotos-producto .foto img').css('height', 'auto');
    //     $('#fotos-producto .foto img').css('max-height',$('#fotos-producto .foto img').height());
    //     $('#fotos-producto .foto img').css('height', altura);
    // }

    if($('#video-vocamx').length){
        if($('#fotos-producto').length){
            var player = videojs('video-vocamx', {
                autoplay: true,
                muted: false,
                loop: false
            });
        }else{
            var player = videojs('video-vocamx', {
                autoplay: false,
                muted: true,
                loop: true
            });
        }
    }

    $('#embajadores').on('init', function(event, slick){
        $('#embajadores .embajador').height($('#embajadores .embajador').width());
    });

    $('#embajadores').slick({
        'autoplay': true,
        'autoplaySpeed': 5000,
        'arrows': true,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
              breakpoint: 990,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        ]
    });

    jQuery('.smooth-scroll').bind('click', function(e) {
        try {
            e.preventDefault();
            var target = jQuery(this).attr('href');
            if(target.charAt(0) == "/"){
                target = target.substring(1);
            }
            if($('.desplegado').length){
                $('.desplegar-menu').click();
            }
            jQuery('body,html').animate({
                scrollTop: jQuery(target).offset().top - (jQuery('header').height())
            }, 800);
        } catch (error) {
            alert('error - ' + error);
        }
    });

    $('.subir-archivo').on('click', function(){
        var disparador = $(this).data('disparador');
        $('#'+disparador).click();
    });

    $('.archivo-nombre').on('change', function(e){
        $('#'+$(this).data('contenedor')+' a').text(e.target.files[0].name);
    });

    $('#fotos-producto').slick({
        infinite: false,
        autoplay: false,
        arrows: true,
        dots: true,
        asNavFor: '#thumb-fotos',
    });

    $('#fotos-producto').on('afterChange', function (event, slick, currentSlide, nextSlide) {
        $('.youtube-iframe.carrusel').each(function () {
            this.contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
        });
    });

    activaZoom();

    $('#thumb-fotos').slick({
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        focusOnSelect: true,
        vertical: false,
        dots: false,
        arrows: false,
        asNavFor: '#fotos-producto',
    });

    $('#imagen-seleccionada-mobile').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '#carrusel-gato'
    });

    $('#carrusel-gato').slick({
        slidesToShow: 4,
        infinite: false,
        autoplay: false,
        arrows: true,
        asNavFor: '#imagen-seleccionada-mobile',
        dots: false,
        responsive: [
            {
                breakpoint: 990,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '#imagen-seleccionada-mobile',
                    dots: false,
                    centerMode: false,
                    focusOnSelect: true
                }
            }
        ]
    });

     $('#imagen-seleccionada-escritorio').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.carrusel-gato2'
    });
    $('.carrusel-gato2').slick({
        slidesToShow: 4,
        infinite: false,
        autoplay: false,
        arrows: true,
        asNavFor: '#imagen-seleccionada-escritorio',
        dots: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 990,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '#imagen-seleccionada-escritorio',
                    dots: false,
                    centerMode: false,
                    focusOnSelect: true
                }
            }
        ]
    });

   $('#carrusel-rk').slick({
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 1,
        autoplay: false,
        arrows: true,
        dots: false,
        centerMode: true
    });

   $('#carrusel-rk-escritorio').slick({
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 1,
        autoplay: false,
        arrows: true,
        dots: false,
        centerMode: true
    });



    $('.asistencia-clic').on('click', function(){
        //evento-facebook
        fbq('track', 'Contact', {
          content_category: 'asistencia-categoria'
         });
    });

    $('.asistencia-messenger').on('click', function(){
        //evento-facebook
        fbq('track', 'Contact', {
          content_category: 'categoria-messenger'
         });
    });

    //$('#fotos-producto .foto img').magnify();

    $('#selector-talla').on('click', function(){
        $('#tallas').slideToggle();
    });

    $('#tallas .talla').on('click', function(){
        var talla  = $(this).data('talla');
        var talla_id  = $(this).data('talla_id');
        $('#talla-bombers').val(talla_id);
        $('#selector-talla').text(talla);
        $('#tallas').slideUp();
    });

    $('#cantidad-bombers').on('change', function(){
        if($(this).val() == ""){
            $(this).val('1');
        }
    });

    $('#comprar-producto').on('submit', function(e){
        var cantidades = false;
        $('.cantidades-bombers').each(function() {
            if(parseInt($(this).val()) > 0){
                cantidades = true;
            }
        })
        if(!cantidades){
            $('#error-formulario').show();
            e.preventDefault();
        }else{
            $('#loader').fadeIn();
        }
    });

    $('#btn-carrito').on('click', function(event){

        if($('#productoform-color_decoracion').length){
            if($('#productoform-color_decoracion').val() == '' || $('#productoform-medida_decoracion').val() == ''){
                alert('Por favor selecciona color y medida.');
                return false;
            }
        }

        var talla = $('#productoform-talla').val();
        var cantidad = $('#productoform-cantidad').val();
        var producto = $('#productoform-producto').val();
        var comentarios = $('#productoform-comentarios').val();
        if (producto != 113){
            if (!$('#productoform-talla').val()){
                $('.bloque-ver-warning').removeClass('hidden');
                return;
            }
        }
        $('.bloque-ver-warning').addClass('hidden');
        if (parseInt($('#productoform-cantidad').val()) > 0) {
            fbq('track', 'AddToCart', {
                content_name: $('#nombre_facebook').val(),
                content_ids: [$('#producto_sku').val()],
                value: $('#precio_facebook').val() * $('#productoform-cantidad').val(),
                content_type: 'product',
                currency: 'MXN',
                quantity: $('#productoform-cantidad').val()
            });
            dataLayer.push({
                'event': 'addToCart',
                'ecommerce': {
                  'currencyCode': 'MXN',
                  'add': {
                    'products': [{
                      'name': $('#nombre_facebook').val(),
                      'id': $('#producto_sku').val(),
                      'price': $('#precio_facebook').val() * $('#productoform-cantidad').val(),
                      'brand': 'VOCAMX',
                      'category': $('#categoria_clave').val(),
                      'variant': 'Negro',
                      'quantity': $('#productoform-cantidad').val()
                     }]
                  }
                }
            });
            var btn = $('#btn-carrito');
            btn.attr('disabled', 'disabled');
            if($('#productoform-foto_id').length > 0){
                var foto_id = $('#productoform-foto_id').val();
            } else {
                var foto_id = null;
            }
            var diseno = "";
            var linea1 = "";
            var linea2 = "";
            var linea3 = "";
            var imagen_personalizada = "";
            if ($('#diseno_seleccionado').length || $('#imagen_personalizada').val() != '') {
                diseno = $('#diseno_seleccionado').val();
                linea1 = $('#linea1').val();
                linea2 = $('#linea2').val();
                linea3 = $('#linea3').val();
                imagen_personalizada = $('#imagen_personalizada').val();
            }
            if (producto == 113){
                talla = 1;
            }

            let color_id = '';
            let medidas_id = '';
            let costo_variante = '';

            let url = '';
            if($('#precio-variante').length){
                url = $('#base_path').val() + '/decoracion/agrega-carrito'
                color_decoracion = $('#productoform-color_decoracion').val();
                medidas_decoracion = $('#productoform-medida_decoracion').val();
                costo_variante = $('#productoform-costo_variante').val();
            }else{
                url = $('#base_path').val() + '/bombers/agrega-carrito'
            }
            if (talla != '' && cantidad != '' && producto != '') {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        producto,
                        talla,
                        cantidad,
                        comentarios,
                        diseno,
                        linea1,
                        linea2,
                        linea3,
                        imagen_personalizada,
                        foto_id,
                        color_decoracion,
                        medidas_decoracion,
                        costo_variante
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $('#spinner').fadeIn();
                    },
                    success: function (respuesta) {
                        $.magnificPopup.open({
                            items: {
                                src: '#popup-checkout',
                                type: 'inline'
                            },
                            closeBtnInside: true
                        });
                        $('#mensaje-carrito').removeAttr('class');
                        if (respuesta.exito == '0') {
                            $('#mensaje-carrito').addClass('error');
                        } else {
                            $('#mensaje-carrito').addClass('exito');
                            $.ajax({
                                url: $('#base_path').val() + '/bombers/actualizar-carrito',
                                type: 'post',
                                dataType: 'json',
                                success: function (respuesta) {
                                    $('.bolsa #carrito-span').text(respuesta.numero_productos);
                                }
                            });
                        }
                        $('#mensaje-carrito').text(respuesta.mensaje);

                    },
                    complete: function () {
                        btn.removeAttr('disabled');
                        $('#spinner').fadeOut();
                    }
                });
            }
        }
        event.stopImmediatePropagation();
    });

    $('#form-agrega-carrito').on('submit', function () {
        var producto = $('#productoform-producto').val();
        if (producto != 113){
            if (!$('#productoform-talla').val()) {
                $('.bloque-ver-warning').removeClass('hidden');
            }
        }
    });

    $('#registrar').on('click', function(event){
        var btn = $(this);
        btn.removeAttr('href');
        var correo = $('#correo-registro').val();
        var password = $('#password-registro').val();
        if(correo != '' && password != ''){
            if(!validarEmail(correo)){
                $('#correo-registro').addClass('invalido');
                return false;
            }
            $('#correo-registro').removeClass('invalido');
            $.ajax({
                url: $('#base_path').val()+'/clientes/registro',
                type: 'post',
                data: {correo,password},
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.resultado == '0'){
                        alert(respuesta.mensaje);
                        return;
                    }
                    window.location.replace($('#base_path').val()+'/clientes/direccion');
                },
                complete: function() {
                    btn.attr('href', 'javascript:;');
                }
            });
        }
        event.stopImmediatePropagation();
    });

    $('#mostrar-password').on('click', function(){
        if($('#mostrar-password').text() == 'Mostrar'){
            $('#mostrar-password').text('Ocultar')
            $('#password-registro').attr('type', 'text');
        }else{
            $('#mostrar-password').text('Mostrar')
            $('#password-registro').attr('type', 'password');
        }
    });

    $('.siguiente-direccion').on('click', function(){
        var valido = true;
        $('.bloque-campos.bloque-visible .required input').each(function(){
            $(this).focus();
            $('.siguiente-direccion').focus();
            if($(this).val() == "")
                valido = false;
        });
        if(!valido)
            return false;
        $('.bloque-visible').css('left', '-100%');
        var siguiente = $(this).data('siguiente');
        $('.bloque-visible').removeClass('bloque-visible');
        $('#bloque-'+siguiente).removeAttr('style');
        $('#bloque-'+siguiente).addClass('bloque-visible');
        if($('.bloque-visible .cambio-titulo').length){
            $('#titulo-direccion').text($('.bloque-visible .cambio-titulo').val());
        }
    });
    $('.anterior-direccion').on('click', function(){
        var valido = true;
        $('.bloque-campos.bloque-visible .required input').each(function(){
            $(this).focus();
            $('.siguiente-direccion').focus();
            if($(this).val() == "")
                valido = false;
        });
        if(!valido)
            return false;
        var anterior = $('.bloque-visible').prev('.bloque-campos').attr('id');
        if(anterior != undefined){
            $('.bloque-visible').css('left', '100%');
            $('.bloque-visible').removeClass('bloque-visible');
            $('#'+anterior).removeAttr('style');
            $('#'+anterior).addClass('bloque-visible');
            if($('.bloque-visible .cambio-titulo').length){
                $('#titulo-direccion').text($('.bloque-visible .cambio-titulo').val());
            }
        }
    });

    $('input[type="number"]').bind('keypress', function(e){
       var keyCode = (e.which)?e.which:e.keyCode
       return !(keyCode>31 && (keyCode<48 || keyCode>57));
   });

   $('.desglosar').on('click', function(){
      var bloque = $(this).data('bloque');
      $('#'+bloque).slideToggle();
      $(this).toggleClass('desplegado');
   });

   $('#empresaform-asunto').on('change', function(){
       var seleccionado = $(this).val();
       $('.campos-agrupados').hide();
       $('#'+seleccionado).show();
   });

   if($('#slider-disenos').length){
       $('#slider-disenos').slick({
           'autoplay': true,
           'autoplaySpeed': 5000,
           'arrows': true,
           slidesToShow: 4,
           slidesToScroll: 4,
           responsive: [
               {
                 breakpoint: 990,
                 settings: {
                   slidesToShow: 3,
                   slidesToScroll: 3,
                   infinite: true,
                   dots: false
                 }
               },
               {
                 breakpoint: 600,
                 settings: {
                   slidesToShow: 2,
                   slidesToScroll: 2
                 }
               },
               {
                 breakpoint: 480,
                 settings: {
                   slidesToShow: 1,
                   slidesToScroll: 1
                 }
               }
           ]
       });

       $('#slider-disenos').magnificPopup({
    		delegate: 'a',
    		type: 'image',
    		mainClass: 'mfp-img-mobile',
    		gallery: {
    			enabled: true,
    			navigateByImgClick: true,
    			preload: [0,1]
    		},
    		image: {
    			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
    			titleSrc: function(item) {
    			}
    		}
    	});
   }

   if($('.inline-popup').length > 0){
       $('.inline-popup').magnificPopup({
           type: 'inline',
           midClick: true,
           closeOnBgClick: false,
           fixedContentPos: true,
           callbacks: {
               open: function() {
                   if($('.lazy-load').length){
                       $('.lazy-load').Lazy({
                            effect: 'fadeIn'
                        });
                   }
               }
           }
       });
   }

   if($('#slider-personalizacion').length){
       $('#estampas-full').slick({
           'autoplay': false,
           'arrows': true,
           slidesToShow: 1,
           slidesToScroll: 1
       });

       $('#estampas-pre').slick({
           'autoplay': false,
           'arrows': true,
           slidesToShow: 1,
           slidesToScroll: 1
       });

       $('#estampas').slick({
           'autoplay': false,
           'arrows': false,
           slidesToShow: 6,
           slidesToScroll: 6,
           responsive: [
               {
                 breakpoint: 990,
                 settings: {
                   slidesToShow: 6,
                   slidesToScroll: 6,
                   infinite: false,
                   dots: false
                 }
               },
               {
                 breakpoint: 600,
                 settings: {
                   slidesToShow: 4,
                   slidesToScroll: 4
                 }
               },
               {
                 breakpoint: 480,
                 settings: {
                   slidesToShow: 3,
                   slidesToScroll: 3
                 }
               }
           ]
       });

       $('#paso-2').on('click', function(){
          if($('.estampa.seleccionado').length){
              $('#slider-pre').fadeOut();
          }
       });

       var texto_default = true;
       $('.estampa .link-estampa').on('click dblclick', function(event){
           $('.estampa').removeClass('seleccionado');
           $(this).parent().addClass('seleccionado');
           var diseno = $(this).data('diseno');
           var linea1 = $(this).data('linea1');
           var linea2 = $(this).data('linea2');
           var linea3 = $(this).data('linea3');
           $('.textos-personalizacion').removeClass('dos-lineas');
           $('.textos-personalizacion').removeClass('una-linea');
           if(linea2 == ''){
               $('.textos-personalizacion').addClass('una-linea');
           }else if(linea3 == ''){
               $('.textos-personalizacion').addClass('dos-lineas');
           }
           $('#personalizadaform-diseno').val(diseno);
           $('#diseno_seleccionado').val(diseno);
           $('#texto-diseno').removeAttr('class');
           $('#texto-diseno').addClass(diseno);


            if(texto_default){
               $('#texto-diseno .linea-1 span.texto-custom').text(linea1);
               $('.linea-1').val(linea1);
               $('#personalizadaform-linea1').val(linea1);
               $('#texto-diseno .linea-2 span.texto-custom').text(linea2);
               $('.linea-2').val(linea2);
               $('#personalizadaform-linea2').val(linea2);
               $('#texto-diseno .linea-3 span.texto-custom').text(linea3);
               $('.linea-3').val(linea3);
               $('#personalizadaform-linea3').val(linea3);
            }

           ajusteTamano($('.linea-1'));
           ajusteTamano($('.linea-2'));
           ajusteTamano($('.linea-3'));
           if($('#texto-diseno.suerte').length || $('#texto-diseno.new_black').length || $('#texto-diseno.karma').length){
               $('.linea-1').trigger('keyup');
               $('.linea-2').trigger('keyup');
               $('.linea-3').trigger('keyup');
           }
           if (event.type == 'dblclick') {
               $('#slider-pre').fadeOut();
           }
       });

       $('.linea-1').on('keyup', function(){
           texto_default = false;
           var maximo = 10;
           if($('#texto-diseno.suerte').length || $('#texto-diseno.new_black').length || $('#texto-diseno.ultra_mexa').length || $('#texto-diseno.elegante').length){
               var maximo = 8;
           }
           if($(this).val().length <= maximo){
                if ($('#texto-diseno.old-school').length > 0) {
                    var string = $(this).val();
                    string = string.normalize('NFD').replace(/[\u0300-\u036f]/g, "")
                    $('#span-linea-1').text(string);
                }else{
                    $('#span-linea-1').text($(this).val());
                }
           }else{
               $(this).val($(this).val().substr(0, maximo));
           }
           ajusteTamano($(this));
            $('#personalizadaform-linea1').val($(this).val());
       });

       $('.linea-2').on('keyup', function(){
           texto_default = false;
           var maximo = 10;
           if($('#texto-diseno.suerte').length || $('#texto-diseno.new_black').length || $('#texto-diseno.ultra_mexa').length || $('#texto-diseno.elegante').length){
               var maximo = 8;
           }
           if($(this).val().length <= maximo){
               $('#span-linea-2').text($(this).val());
           }else{
               $(this).val($(this).val().substr(0, maximo));
           }
           ajusteTamano($(this));
           $('#personalizadaform-linea2').val($(this).val());
       });
       $('.linea-3').on('keyup', function(){
           texto_default = false;
           var maximo = 10;
           if($('#texto-diseno.suerte').length){
               var maximo = 8;
           }
           if($('#texto-diseno.new_black').length){
               var maximo = 9;
           }
           if($(this).val().length <= maximo){
               $('#span-linea-3').text($(this).val());
           }else{
               $(this).val($(this).val().substr(0, maximo));
           }
           ajusteTamano($(this));
           $('#personalizadaform-linea3').val($(this).val());
       });

       $('#edicion-linea-1').on('click', function(){
           $('.linea-1').focus();
       });

       $('#edicion-linea-2').on('click', function(){
           $('.linea-2').focus();
       });

       $('#edicion-linea-3').on('click', function(){
           $('.linea-3').focus();
       });

       $('.linea-1').on('focus', function(){
           if(texto_default){
                $('.linea-1').val('');
                $('#span-linea-1').text($(this).val());
           }
       });

       $('.linea-2').on('focus', function(){
           if(texto_default){
                $('.linea-2').val('');
                $('#span-linea-2').text($(this).val());
           }
       });

       $('.linea-3').on('focus', function(){
           if(texto_default){
                $('.linea-3').val('');
                $('#span-linea-3').text('');
           }
       });

       $('.btn-comprar-custom').on('click', function(){
           guardarDiseno();
       });

       $('.btn-descargar, .btn-descargar-mob').on('click', function(){
           descargaDiseno();
       });
   }

   if($('#direcciones-guardadas').length){
       $('[name="direccion-guardada"]').on('change', function(){
           $('#loader').fadeIn();
           window.location = $('#redireccion-'+$(this).val()).val();
       });
   }

   $('#desglosar-productos').on('click', function(){
       $(this).toggleClass('desplegado');
       $('#productos-mobile').slideToggle();
   });

   $('body').on('click', '.muestra-loader', function(){
      $('#loader').fadeIn();
   });

   if($('#tarjeta-openpay').length){
       OpenPay.setId($('#openpay_id').val());
       OpenPay.setApiKey($('#openpay_public').val());
       if($('#openpay_production').val() == '1'){
           var sandbox = false;
       }else{
           var sandbox = true;
       }
       OpenPay.setSandboxMode(sandbox);

       var deviceSessionId = OpenPay.deviceData.setup();

       $('#continuar-compra').on('click', function(event) {
           event.preventDefault();
           $("#continuar-compra").prop( "disabled", true);
           OpenPay.token.extractFormAndCreate('tarjeta-openpay', success_callbak, error_callbak);
       });

       var success_callbak = function(response) {
           $('#loader').fadeIn();
           var token_id = response.data.id;
           $('#token_id').val(token_id);
           $('#device_session_id').val(deviceSessionId);
           $('#tarjeta-openpay').submit();
       };

       var error_callbak = function(response) {
           var desc = response.data.description != undefined ? response.data.description : response.message;
           alert("ERROR [" + response.status + "] " + desc);
           $("#continuar-compra").prop("disabled", false);
      };

      $('input[name=metodo-pago]').on('click', function(){
          var id = $(this).attr('id');
          if(id == 'metodo-tarjeta'){
              $('#tarjeta-openpay').slideDown();
          }else{
              $('#tarjeta-openpay').slideUp();
          }
          if(id == 'metodo-efectivo'){
              $('#tienda-openpay').slideDown();
          }else{
              $('#tienda-openpay').slideUp();
          }
          if(id == 'metodo-paypal'){
              $('#boton-paypal').slideDown();
          }else{
              $('#boton-paypal').slideUp();
          }
      });

      $('#tipo-tarjeta input').on('click', function(){
          var tipo = $(this).val();
          if(tipo == 'DEB'){
              $('#mensualidades').hide();
              $('#mensualidades input:radio[value="1"]').click();
          }else{
              $('#mensualidades').show();
          }
      });

      $("#cvv-tarjeta,#mes-tarjeta,#anio-tarjeta").ForceNumericOnly();

      $('#numero-tarjeta').on('blur input change keyup paste', function () {
          if($(this).val().length > 10){
              var cardBrand = OpenPay.card.cardType($(this).val());
              if(cardBrand){
                  var cardType = $('input[name="TarjetaForm[tipo_tarjeta]"]:checked').val();
                  var number = $(this).val();
                  $('.summary.pago').text(cardBrand + ' - ' + (cardType == 'CRE' ? 'TDC' : 'TDD') + ' ' +  number.slice(-4));
                }
          }

          var formatedCard = cc_format($(this).val());
          $(this).val(formatedCard);
      });

        $('.campo-openpay').on('blur', function() {
            if (this.id == 'numero-tarjeta') {
                checkCCField();
            } else {
                if($(this).val() == '') {
                    $(this).closest('.form-group').addClass('has-error');
                    $(this).closest('.form-group').find('.help-block').text($(this).data('tipo') + ' es requerido.');
                } else {
                    $(this).closest('.form-group').removeClass('has-error');
                    $(this).closest('.form-group').find('.help-block').text('');
                }
            }
        });
    }

    $('#registroform-email').keyup(function(){
        $('#registroform-email').val($('#registroform-email').val().replace(/\s+/g, ''));
    })

    $('.bombers-compradas').on('click', '.eliminar-producto', function () {
        var btn_clicked = $(this);
        var producto = $(this).data('producto');
        var talla = $(this).data('talla');
        $.ajax({
            url: $('#base_path').val() + '/bombers/borrar-producto-carrito',
            type: 'post',
            data: { producto, talla },
            dataType: "json",
            beforeSend: function () {
                btn_clicked.prop('disabled', true);
                btn_clicked.siblings('.sk-folding-cube').fadeIn();
            },
            success: function (respuesta) {
                if (respuesta.exito == '0') {
                    console.log(respuesta.mensaje)
                } else {
                    $.ajax({
                        url: $('#base_path').val() + '/bombers/actualizar-carrito',
                        type: 'post',
                        success: function (respuesta) {
                            $('.bombers-compradas').html(respuesta);
                            $('.bolsa #carrito-span').text($('#menu-especial .bomber').length);
                        }
                    });
                }
            },
            // complete: function () {
            // $('#spinner').fadeOut();
            // }
        });
    });

    $('#acepta-terminos-tarjeta').on('change', function(){
        $(this).is(':checked') ? $('button.tarjeta').prop('disabled', false) : $('#continuar-compra.tarjeta').prop('disabled', true);
    })

    $('#acepta-terminos-efectivo').on('change', function(){
        $(this).is(':checked') ? $('button.efectivo').prop('disabled', false) : $('#continuar-compra.efectivo').prop('disabled', true);
    })

    $('#acepta-terminos-paypal').on('change', function(){
        $(this).is(':checked') ? $('.boton-paypal-a').removeClass('oculto') : $('.boton-paypal-a').addClass('oculto');
    })

    $('#muestra-descripcion-btn').on('click', function(){
        if($('#descripcion-ex').is(':visible')){
            $(this).text('Mostrar más');
            $('#descripcion-ex').addClass('hidden');
            $('#descripcion-ex').removeClass('show');
            $('.desc-breve').removeClass('hidden');
            $('.desc-breve').addClass('show');
        } else {
            $(this).text('Mostrar menos');
            $('#descripcion-ex').removeClass('hidden');
            $('#descripcion-ex').addClass('show');
            $('.desc-breve').addClass('hidden');
            $('.desc-breve').removeClass('show');
        }
    })

    if($('#pais-id').val()==55){
        $('.row-eeuu-form').hide();
    }
    $('#pais-id').change(function(){
        if($('#pais-id').val()==55){
            $('.row-eeuu-form').hide()
        } else {
            $('.row-eeuu-form').show()
        }
    });

    if($('.envios').length > 0){
        $('#registroform-cp').change(function(){

//        })
//        $('.registro').on('change', '#registroform-cp', function(){
            if(!$('#zip-auto').is(':visible')){
                $('#zip-auto').show();
            }
        })
        $('#registroform-cp').change(function(){
//        $('.registro').on('input change paste', 'input[name="RegistroForm[cp]"]', function() {
            var caracteres = Array.from($('input[name="RegistroForm[cp]"]').val());
            if(caracteres.length < 3){
                return;
            }
            var zipcode = $('input[name="RegistroForm[cp]"]').val();
            var country = $('select#pais-id option').filter(function () { return $(this).html() == $('#select2-pais-id-container').html(); }).val();
            if(!zipcode || !country){
                alert('Elige un pais y un codigo postal');
                return;
            }
            $.ajax({
                url: $('#base_path').val() + '/checkout/obtener-info-zip',
                type: 'get',
                data: { zipcode, country },
                dataType: "json",
                beforeSend: function () {
                    $('#loader-zip').removeClass('oculto');
                    $('input[name="RegistroForm[cp]"]').attr('disabled', 'disabled');
                },
                success: function (respuesta) {
                    if (respuesta) {
                        var id;
                        if(respuesta.postal_code_information.length > 0){
                            //35123
                            $('#registroform-ciudad').val(respuesta.postal_code_information[0].city);
                            $('#registroform-municipio').val(respuesta.postal_code_information[0].district);
                            $("#estado-id option").each(function () {
                                var estado = $(this).text();
                                estado.normalize('NFD').replace(/[\u0300-\u036f]/g, "")
                                if(estado == respuesta.postal_code_information[0].state){
                                    id = $(this).val();
                                }
                            });
                            if(id){
                                $('#estado-id').val(id).trigger('change');
                            }
                            $('#registroform-colonia').html('');
                            for (var i = 0; i < respuesta.postal_code_information.length; i++) {
                                $('#registroform-colonia').append('<option value="' + respuesta.postal_code_information[i].neighborhood + '">' + respuesta.postal_code_information[i].neighborhood + '</option>')
                            }
                            $('#registroform-colonia').show();
                            $('#registroform-colonia_manual').val('').hide();
                            $('#campos-auto').show();
                            $('#zip-auto').hide();
                            if(!respuesta.postal_code_information[0].district)
                                $('#registroform-municipio').prop('disabled', false);
                            if(!respuesta.postal_code_information[0].city)
                                $('#registroform-ciudad').prop('disabled', false);
                        }else{
                            $('#registroform-ciudad,#registroform-municipio,#registroform-colonia_manual').val('');
                            $('#registroform-ciudad,#registroform-municipio,#registroform-colonia_manual').prop('disabled', false);
                            $('#registroform-colonia').hide();
                            $('#registroform-colonia_manual').show();
                            $('#campos-auto').show();
                        }
                    }
                },
                error: function () {
                    $('#registroform-ciudad,#registroform-municipio,#registroform-colonia_manual').prop('disabled', false);
                    $('#registroform-colonia').hide();
                    $('#registroform-colonia_manual').show();
                    $('#campos-auto').show();
                },
                complete: function (){
                    $('input[name="RegistroForm[cp]"]').removeAttr('disabled');
                    $('#loader-zip').addClass('oculto');
                }
            })
        })

        $('#registro-chk-btn').click(function(){
            var moneda = 'USD';
            var ip = $('#base-moneda').text();
            var pais = $('select#pais-id option').filter(function () { return $(this).html() == $('#select2-pais-id-container').html(); }).val();
            $('select#registroform-continente').val(pais);
            var valorDolar = 20;
            var continente = $('select#registroform-continente').find('option:selected').text();
            var cantidad_chamarras = $('#cantidad-chamarras').val()
            if(ip == ' MXN'){
                if($('input[name="tipo_cupon"]').val() != 'ENV'){
                    if(pais == 42){
                        if(cantidad_chamarras > 2){
                            $('input[name="precio-envio"]').val(150+' MXN' );
                        } else {
                            $('input[name="precio-envio"]').val(90+' MXN' );
                        }
                        $('#mensaje-envio').text('2 a 7 días habiles');
                        $('.span-moneda').text('MXN');
                    } else{
                        if(cantidad_chamarras > 2){
                            $('input[name="precio-envio"]').val(600+' MXN' );
                        } else {
                            $('input[name="precio-envio"]').val(500+' MXN' );
                        }
                        $('#mensaje-envio').text('2 a 7 días habiles');
                        $('.span-moneda').text('MXN');
                    }
                }
                moneda = ' MXN';
            } else {
                if($('input[name="tipo_cupon"]').val() != 'ENV'){
                    var valor = 35;
                    if(pais == 42 || pais == 32 || pais == 55){
                        switch(pais){
                            case '42': //México
                                if(cantidad_chamarras < 3){
                                    $('input[name="precio-envio"]').val(4.5+' USD' );
                                    $('#mensaje-envio').text('2 a 7 días habiles');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(4.5+' USD')
                                    valor = 4.5;
                                } else {
                                    $('input[name="precio-envio"]').val(7.5+' USD' );
                                    $('#mensaje-envio').text('2 a 7 días habiles');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(7.5+' USD')
                                    valor = 7.5;
                                }
                                break;
                            case '32':  //Canadá
                                $('input[name="precio-envio"]').val(28+' USD');
                                $('#mensaje-envio').text('8 días');
                                $('.span-moneda').text('USD');
                                break;
                            case '55': //Estados Unidos
                                var i;
                                switch(cantidad_chamarras){
                                    case '1':
                                        valor = 9.9;
                                        break;
                                    case '2':
                                        valor = 10.7;
                                        break;
                                    case '3':
                                        valor = 12.6;
                                        break;
                                    case '4':
                                        valor = 13.6;
                                        break;
                                    case '5':
                                        valor = 17.9;
                                        break;
                                    case '6':
                                        valor = 18.9;
                                        break;
                                    case '7':
                                        valor = 21.5;
                                        break;
                                    case '8':
                                        valor = 22.5;
                                        break;
                                    case '9':
                                        valor = 24.9;
                                        break;
                                    case '10':
                                        valor = 25.9;
                                        break;

                                }
//                                for(i = 2; i <= cantidad_chamarras; i++){
//                                    valor += 5;
//                                }
                                $('input[name="precio-envio"]').val(valor+' USD');
                                $('#mensaje-envio').text('8 días');
                                $('.span-moneda').text('USD');
                                break;
                        }
                    }else{
                        switch(continente){
                            case '3': //Asia
                                $('input[name="precio-envio"]').val(45+' USD');
                                $('#mensaje-envio').text('8 días');
                                $('.span-moneda').text('USD');
                                break;
                            case '5': //Europa
                                $('input[name="precio-envio"]').val(40+' USD');
                                $('#mensaje-envio').text('8 días');
                                $('.span-moneda').text('USD');
                                break;
                            case '7': //Sudamerica
                                $('input[name="precio-envio"]').val(39+' USD');
                                $('#mensaje-envio').text('8 días');
                                $('.span-moneda').text('USD');
                                break;
                            case '6': //Norteamerica
                                $('input[name="precio-envio"]').val(39+' USD');
                                $('#mensaje-envio').text('8 días');
                                $('.span-moneda').text('USD');
                                break;
                            default:
                                $('input[name="precio-envio"]').val(45+' USD');
                                $('#mensaje-envio').text('8 días');
                                $('.span-moneda').text('USD');
                                break;
                        }
                    }
                }
            }
            if($('input[name="tipo_cupon"]').val() != 'ENV'){
                $('.costo-envio').text($('input[name="precio-envio"]').val());
                updatePrices();
            }
            $('html,body').animate({
                scrollTop: $("#datos_personales-compra-bloque").offset().top
            }, 500);
        })

        $('.registro').on('click', '#registro-chk-btn', function (e) {
            if ($('#formulario-direccion .has-error').length > 0 || !$('#registroform-email').val() || !validarEmail($('#registroform-email').val()) || !verificaNombreApellidos() || !verificaDireccion()) {
                if(!$('#registroform-email').val()){
                    alert('Email es obligatorio')
                }
                if (!validarEmail($('#registroform-email').val())){
                    alert('Email invalido')
                }
                if(!verificaNombreApellidos()){
                    alert('Se requiere el nombre completo')
                }
                e.preventDefault();
                return;
            }
            var nombre = $('.product-info').first().find('.nombre_producto').val();
            var categoria = $('.product-info').first().find('.categoria_producto').val();
            fbq('track', 'Lead', {
                content_name: nombre,
                content_category: categoria,
                value: parseInt($('input[name="precio-total"]').val()),
                currency: 'MXN'
                }
            );
            $('.calle-text').text($('#registroform-direccion').val());
            $('.colonia-text').text($('#registroform-colonia').val());
            $('#bloque-registro-chk').slideUp();
            $('#seleccion-envio').slideDown();
            $('.registro.bloque .muestra-bloque').addClass('inactive pass');
            $('.envios.bloque .muestra-bloque').removeClass('inactive');
            $('.summary.registro').text($('#registroform-calle').val() + ' ' + $('#registroform-externo').val());
            cambiaPasoActivo(3);
            // $.ajax({
            //     url: $('#base_path').val() + '/checkout/obtener-envios',
            //     type: 'post',
            //     data: formData,
            //     dataType: "html",
            //     beforeSend: function () {
            //         $('#registro-chk-btn').attr('disabled', 'disabled');
            //         $('#loader-envios').removeClass('oculto');
            //         $('#bloque-registro-chk').slideUp();
            //         goToByScroll('main');
            //     },
            //     success: function (respuesta) {
            //         if(respuesta){
            //             $('#bloque-envios').html(respuesta);
            //             $('#seleccion-envio').slideDown();
            //             $('.registro.bloque .muestra-bloque').addClass('inactive pass');
            //             $('.envios.bloque .muestra-bloque').removeClass('inactive');
            //             $('.summary.registro').text($('#registroform-calle').val() + ' ' + $('#registroform-externo').val());
            //             cambiaPasoActivo(3);
            //             goToByScroll('.bloque.envios');
            //             if($('input[name="tipo_cupon"]').val() == 'ENV' || $('input[name="tipo_cupon"]').val() == 'CAL'){
            //                 selectShippingCoupon();
            //             }
            //         } else {
            //             $('#bloque-registro-chk').slideDown();
            //             $('#registro-chk-btn').removeAttr('disabled');
            //             goToByScroll('.bloque.opciones-identidad');
            //         }
            //     },
            //     error: function (){
            //         $('#bloque-registro-chk').slideDown();
            //         $('#registro-chk-btn').removeAttr('disabled');
            //         goToByScroll('.bloque.opciones-identidad');
            //     },
            //     complete: function () {
            //         $('#loader-envios').addClass('oculto');
            //         $('#registro-chk-btn').removeAttr('disabled');
            //     }
            // });
            e.preventDefault();
        })

        $('.envios').on('click', '#envio-chk-btn', function(){
            if ($('.envios input[name="PedidoForm[envio]"]:checked').length > 0 || !$('#metodos-envio').is(':visible')){

                $.magnificPopup.open({
                    items: {
                        src: '#popup-extra-custom',
                        type: 'inline'
                    },
                    closeBtnInside: true,
                    fixedContentPos: true
                });

                $('.col-perso').show();
                $('#resumen-compra-bloque').removeClass('hidden-sm hidden-xs');
                $('#seleccion-envio').slideUp();
                $('#metodos-pago').slideDown(function(){
                    goToByScroll('.formas-pago.bloque')
                });

                $('.envios.bloque .muestra-bloque').addClass('inactive pass');
                $('.formas-pago.bloque .muestra-bloque').removeClass('inactive');
                var moneda = $('#base-moneda').text();
                if (moneda == " USD"){
                    $("#metodo-tarjeta").trigger('click');
                }
                var valoresInput = $('.envios input[name="PedidoForm[envio]"]:checked').val().split('|');
                $('.summary.envio').text(valoresInput[4] + ' - ' + valoresInput[6]);
                cambiaPasoActivo(4);
            }
            else{
                alert('Selecciona un envio');
            }
        })

        $('.envios').on('click', '#muestra-envios-ocultos', function(){
            $('.envios-ocultos').toggleClass('oculto');
            if($('.envios-ocultos').is(':visible')){
                $(this).text('Ver menos opciones');
            } else {
                $(this).text('Ver mas opciones');
            }
        })

        $('.checkout-block').on('click', '.muestra-bloque', function(){;
            if ($(this).parent().hasClass('opciones-identidad')){
                $('#bloque-opciones-login').slideDown();
                $('#bloque-registro-chk').slideUp();
                $('#seleccion-envio').slideUp();
                $('#metodos-pago').slideUp();
                $('.bloque .muestra-bloque').addClass('inactive');
                $(this).removeClass('inactive');
            } else if ($(this).parent().hasClass('registro')){
                if ($('#bloque-opciones-login').is(':visible')) {
                    return;
                }
                $('#bloque-opciones-login').slideUp();
                $('#bloque-registro-chk').slideDown();
                $('#seleccion-envio').slideUp();
                $('#metodos-pago').slideUp();
                $('.bloque .muestra-bloque').addClass('inactive');
                $(this).removeClass('inactive');
            } else if ($(this).parent().hasClass('envios')) {
                if ($('#bloque-opciones-login').is(':visible') || $('#bloque-registro-chk').is(':visible')) {
                    return;
                }
                $('#bloque-opciones-login').slideUp();
                $('#bloque-registro-chk').slideUp();
                $('#seleccion-envio').slideDown();
                $('#metodos-pago').slideUp();
                $('.bloque .muestra-bloque').addClass('inactive');
                $(this).removeClass('inactive');
            }
        })

        $('.envios').on('change', 'input[name="PedidoForm[envio]"]', function () {
            var stringVal = $('.envios input[name="PedidoForm[envio]"]:checked').val();
            var stringSep = stringVal.split('|');
            var costoEnvio = Math.round(stringSep[3] * 100) / 100;
            $('input[name="precio-envio"]').val(costoEnvio);
            $('#span-envio').addClass('selected cupon');
            updatePrices();
            verificaCamposHabilitaFinalizar();
        })

        $('.formas-pago').on('change', 'input[name="metodo-pago"]', function () {
            verificaCamposHabilitaFinalizar();
        })

        $('#resumen-compra-bloque').on('change', '#acepta-terminos-out', function () {
            verificaCamposHabilitaFinalizar();
            $(this).is(':checked') ? $('.help-terms').addClass('hidden') : $('.help-terms').removeClass('hidden');
        })

        $('.checkout-block').on('blur input change', '.campo-openpay', function() {
            verificaCamposHabilitaFinalizar();
        })

        $('.checkout-block').on('click', '#finalizar-compra-out', function () {
            $('#loader-pago').removeClass('hidden');
            $('#registro-chk-btn').attr('disabled', 'disabled');
            $('#finalizar-compra-out').attr('disabled', 'disabled');
            if($('#metodo-tarjeta').is(':checked')){
                var number = $('#numero-tarjeta').val();
                $('#numero-tarjeta').val(number.replace(/\s+/g, ''));
                OpenPay.token.extractFormAndCreate('tarjeta-openpay', success_callbak, error_callbak);
            } else {
                enviaDataPagoGuest();
            }
        });

        $('.checkout-block').on('click', '#pre-finalizar', function () {
            if (!$('#registroform-email').val()){
                $('#checkout-terminos > span').text('Para continuar debes registrar un correo electrónico válido');
            } else if (!$('#registroform-nombre').val() || !$('#registroform-apellido').val() || !$('#registroform-telefono').val() || !$('#registroform-direccion').val() || !$('#registroform-externo').val() || !$('#registroform-cp').val() || !$('#registroform-ciudad').val()){
                $('#checkout-terminos > span').text('Para continuar debes llenar sus datos de compra.');
            } else if (!$('input[name="metodo-pago"]').val()){
                $('#checkout-terminos > span').text('Para continuar debes seleccionar una forma de pago.');
            } else if ($('#metodo-tarjeta').is(':checked')) {
                if(!$('#numero-tarjeta').val() || !$('#nombre-tarjeta').val() || !$('#mes-tarjeta').val() || !$('#anio-tarjeta').val() || !$('#cvv-tarjeta').val()){
                    $('#checkout-terminos > span').text('Para continuar debes llenar los campos de la tarjeta.');
                }
            } else if (!$('#acepta-terminos-out').is(':checked')){
                $('#checkout-terminos > span').text('Para continuar debes seleccionar la opcion términos y condiciones');
            } else {
                $('#checkout-terminos > span').text('Verifique que todos los campos esten llenados correctamente para proceder con su pago.');
            }
            $.magnificPopup.open({
                    items: {
                        src: '#popup-terminos',
                        type: 'inline'
                    },
                    closeBtnInside: true
                }
            );
        });

        var success_callbak = function (response) {
            $('#loader').fadeIn();
            var token_id = response.data.id;
            $('#token_id').val(token_id);
            $('#device_session_id').val(deviceSessionId);
            enviaDataPagoGuest();
        };

        var error_callbak = function (response) {
            var desc = response.data.description != undefined ? response.data.description : response.message;
            alert("ERROR [" + response.status + "] " + desc);
            $("#continuar-compra").prop("disabled", false);
            $('#registro-chk-btn').attr('disabled', 'disabled');
            $('#finalizar-compra-out').hide();
            $('#finalizar-compra-out').attr('disabled', 'disabled');
            $('#pre-finalizar').show();
            $('#loader-pago').addClass('hidden');
        };

        $('.opciones-identidad').on('click', '#email-continue-btn', function(){
            fbq('track', 'Subscribe', {
                predicted_ltv: 720,
                value: parseInt($('input[name="precio-total"]').val()),
                currency: 'MXN'
              });
            if (validarEmail($('#registroform-email').val())){
                var correo = $('#registroform-email').val();
                $('#bloque-registro-chk').slideDown(function(){
                    goToByScroll('.registro.bloque')
                });
                $('#bloque-opciones-login').slideUp();
                $('.summary.email').text(correo);
                $('.opciones-identidad.bloque .muestra-bloque').addClass('inactive pass');
                $('.registro.bloque .muestra-bloque').removeClass('inactive');
                $.ajax({
                    url: $('#base_path').val() + '/checkout/registra-mail',
                    type: 'post',
                    data: { correo },
                    dataType: "json",
                    success: function (respuesta) {
                       if(respuesta){
                           console.log('exito');
                       } else {
                           console.log('error');
                       }
                    },
                    error: function() {
                        console.log('error');
                    }
                })
            }else{
                alert('Correo invalido');
            }
        })

        $('.opciones-identidad').on('click', '#login-chk-btn', function(){
            var formData = $('#formulario-login').serialize();
            $.ajax({
                url: $('#base_path').val() + '/clientes/login',
                type: 'post',
                data: formData,
                beforeSend: function () {
                    $('#login-chk-btn').attr('disabled', 'disabled');
                    $('#bloque-registro-chk').slideUp();
                },
                success: function (respuesta) {
                    if (respuesta) {
                        window.location.reload(true)
                    } else {
                        $('#bloque-registro-chk').slideDown();
                        $('#login-chk-btn').removeAttr('disabled');
                        alert("Usuario o contraseña incorrectos");
                    }
                },
                error: function () {
                    $('#bloque-registro-chk').slideDown();
                    alert("Error");
                },
                complete: function () {
                    $('#login-chk-btn').removeAttr('disabled');
                }
            });
        })
    }

    $('.cantidades-bombers').on('focus', function(){
        var cantidad = $(this).val();
        if(cantidad == '0'){
            $(this).val('');
        }
    });
    $('.cantidades-bombers').on('focusout', function(){
        var cantidad = $(this).val();
        if(cantidad == ''){
            $(this).val(0);
        }
    });

    $('#reviewform-review').on('keyup', function(){
        if(parseInt($(this).val().length) < 200){
            $('#contador-letras span').text($(this).val().length);
            $('#contador-letras span').removeClass('completo');
        }else{
            $('#contador-letras span').text('200');
            $('#contador-letras span').addClass('completo');
        }
    });

    $('#review-estrellas .estrella').on('click', function(){
        var estrella = parseInt($(this).attr('id').split('-')[1]);
        $('#reviewform-puntuacion').val(estrella);
        for(i = 5; i > estrella; i--){
            $('#estrella-'+i).removeClass('puntaje');
        }
        for(i = 1; i <= estrella; i++){
            $('#estrella-'+i).addClass('puntaje');
        }
    });

    $('.info-perso').click(function(){
        alert('Te contactaremos después de recibir tu pedido para que tu personalización quede como quieres.');
    })

//    if ($('#ver-producto').length > 0) {
//        if(window.innerWidth > 992){
//            $('#ver-producto-container').imagesLoaded(function () {
//                initMasonryGrid('.grid', '.bloque-ver-compra', '.grid-sizer', true);
//                masonryIsSet = true;
//            });
//        }
//    }

    /*if($('#pasos-trazos').length > 0) {
        $('#carrusel-gato img').magnificPopup({
            type: 'image',
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            fixedContentPos: true,
            gallery: {
                enabled: true
            },
        });
    }*/

    $('.img-link').magnificPopup({
        type: 'image',
        closeOnContentClick: false,
        fixedContentPos: true,
        closeOnBgClick: false,
        mainClass: 'mfp-no-margins mfp-with-zoom',
        image: {
            verticalFit: true
        },
    })



    $('.btn-sel-talla').on('click', function(){
        //Facebook event
        fbq('track', 'CustomizeProduct', {});
        $('.btn-sel-talla').each(function(){
            $(this).removeClass('selected');
        })
        $('#productoform-talla').val($(this).data('talla-id'));
        $(this).addClass('selected');
        $('.bloque-ver-warning').addClass('hidden');
        switch($(this).text().trim()){
            case 'JR':
                $('.hombro-txt').html('45cm');
                $('.pecho-txt').html('47cm');
                $('.cintura-txt').html('41cm');
                $('.manga-txt').html('57cm');
                $('.largo-txt').html('59cm');
            break;
            case 'XCH':
                $('.hombro-txt').html('46cm');
                $('.pecho-txt').html('48cm');
                $('.cintura-txt').html('42cm');
                $('.manga-txt').html('58cm');
                $('.largo-txt').html('61cm');
            break;
            case 'CH':
                $('.hombro-txt').html('54cm');
                $('.pecho-txt').html('51cm');
                $('.cintura-txt').html('46cm');
                $('.manga-txt').html('59cm');
                $('.largo-txt').html('67cm');
            break;
            case 'M':
                $('.hombro-txt').html('56cm');
                $('.pecho-txt').html('54cm');
                $('.cintura-txt').html('48cm');
                $('.manga-txt').html('61cm');
                $('.largo-txt').html('69cm');
            break;
            case 'G':
                $('.hombro-txt').html('59cm');
                $('.pecho-txt').html('57cm');
                $('.cintura-txt').html('51cm');
                $('.manga-txt').html('62cm');
                $('.largo-txt').html('70cm');
            break;
            case 'XG':
                $('.hombro-txt').html('62cm');
                $('.pecho-txt').html('59cm');
                $('.cintura-txt').html('53cm');
                $('.manga-txt').html('63cm');
                $('.largo-txt').html('71cm');
            break;
        }
    });

    $('.btn-sel-cantidad').on('click', function(){
        var cantidad = parseInt($('.numero-cantidad').html());
        if($(this).attr('id') == 'plus'){
            cantidad++;
            $('.numero-cantidad').html(cantidad)
            $('#productoform-cantidad').val(cantidad);
        } else if ($(this).attr('id') == 'minus'){
            if(cantidad > 1){
                cantidad--;
                $('.numero-cantidad').html(cantidad)
                $('#productoform-cantidad').val(cantidad);
            }
        }
    });

    $('#customphotoform-elementos').on('input', function(){
        var cantidad = parseInt($(this).val().replace(/,/g , ''));
        if(isNaN(cantidad) || cantidad == 0){
            $(this).val(1);
            cantidad = 1;
        }
        if(isNaN(cantidad) || cantidad == 0){
            $(this).val(1);
            cantidad = 1;
        }
        cantidad_string = cantidad+'';
        if(cantidad_string.length > 1){
            cantidad = parseInt(cantidad_string[cantidad_string.length -1]);
            if(cantidad == 0){
                cantidad = 1;
            }
            $(this).val(cantidad);
        }
        if(cantidad > 5){
            $(this).val(5);
            cantidad = 5;
        }
        var base = parseInt($('#precio_base').val());
        var base_tachado = parseInt($('#precio_base_tachado').val());
        if(cantidad < 3){
            $('#customphotoform-precio').val(addCommas(base));
            $('#numero-precio').text(addCommas(base));
            $('.precio-producto-chico s').text('$' + addCommas((base / 80 * 100).toFixed(2)));
            $('.ahorro-bomber .number').text(((base / 80 * 100) * .20).toFixed(2))
        }else if(cantidad == 3){
            $('#customphotoform-precio').val(addCommas(base+100));
            $('#numero-precio').text(addCommas(base + 100));
            $('.precio-producto-chico s').text('$' + addCommas(((base + 100) / 80 * 100).toFixed(2)));
            $('.ahorro-bomber .number').text((((base + 100) / 80 * 100) * .20).toFixed(2))
        }else if(cantidad == 4){
            $('#customphotoform-precio').val(addCommas(base+200));
            $('#numero-precio').text(addCommas(base + 200));
            $('.precio-producto-chico s').text('$' + addCommas(((base + 200) / 80 * 100).toFixed(2)));
            $('.ahorro-bomber .number').text((((base + 200) / 80 * 100) * .20).toFixed(2))
        }else if(cantidad == 5){
            $('#customphotoform-precio').val(addCommas(base+300));
            $('#numero-precio').text(addCommas(base + 300));
            $('.precio-producto-chico s').text('$' + addCommas(((base + 300) / 80 * 100).toFixed(2)));
            $('.ahorro-bomber .number').text((((base + 300) / 80 * 100) * .20).toFixed(2))
        }
    });

    $('.checkout-block').on('click', '#cupon-btn-chk',function(){
        var cupon = $('input[name="codigo_descuento"]').val();
        if(!cupon){
            alert('Ingrese su cupon para continuar');
            return;
        } else if ($('input[name="cupon_aplicado"]').val() == cupon){
            alert('Este cupon ya fue ocupado');
            return;
        }
        $.ajax({
            url: 'checkout/check-coupon-available',
            type: 'post',
            data: { cupon },
            dataType: 'json',
            beforeSend: function(){
                $('#loader-cupon').removeClass('hidden');
            },
            success: function (respuesta) {
                if(respuesta.exito){
                    $('input[name="cupon_aplicado"]').val(cupon);
                    $('input[name="tipo_cupon"]').val(respuesta.tipo);
                    if(respuesta.tipo == 'DES' || respuesta.tipo == 'DEP') {
                        $('input[name="cantidad_descuento"]').val(respuesta.cantidad_descuento)
                    }
                    updatePrices();
                    if($('input[name="tipo_cupon"]').val() != 'ENV'){
                        $('#span-subtotal').addClass('line-trough');
                        $('#cupon-info, #ahorro-info, #subtotal-desc').removeClass('hidden');
                        $('#subtotal-info h3').text('PRECIO ORIGINAL');
                    }
                    if ($('input[name="tipo_cupon"]').val() == 'ENV' || $('input[name="tipo_cupon"]').val() == 'CAL'){
                        if($('#seleccionar-envio').length > 0){
                            selectShippingCoupon();
                        }
                            $('#span-envio').addClass('selected cupon');
                            $('#span-envio').text('GRATIS');
                    }
                    $('.row.letrero-cupones').removeClass('hidden');
                    $('.letrero-cupon').text(respuesta.mensaje);
                    $('input[name="codigo_descuento"], #cupon-btn-chk').attr('disabled', 'disabled');
                } else {
                    $('.row.letrero-cupones').removeClass('hidden');
                    $('.letrero-cupon').text(respuesta.mensaje);
                }
            },
            complete: function () {
                $('#loader-cupon').addClass('hidden');
            },
            error: function () {
            }
        });
    });

    $('#copiar-btn').on('click', function() {
        copyToClipboard('cupon-text');
    })

    if ($('#bombers-index').length > 0){
        if($('.popup-display').val() == '0'){
            $.magnificPopup.open({
                items: {
                    src: '#popup-cupon'
                },
                type: 'inline'
            });
        }
    }

    if($('.producto-img-wrapper .product-img').length){
       $('.producto-img-wrapper .product-img').Lazy({
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onFinishedAll: function() {
                console.log('fin');
            }

        });
    }

        if($('.lazy-load').length){
       $('.lazy-load').Lazy({
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onFinishedAll: function() {
                console.log('fin');
            }

        });
    }


    if ($('.youtube-iframe.normal').length > 0) {
        $(".youtube-iframe.normal").Lazy();
    }

    if ($('.youtube-iframe.carrusel').length > 0) {
        $(".youtube-iframe.carrusel").Lazy({
            delay: 2000,
        });
    }

    $('.link-desc').on('click', function() {
        $('.descripcion-lg').toggleClass('hidden');
        if($(this).data('desc') == 'hidden'){
            $(this).text('Ver menos');
            $(this).data('desc', 'displayed');
        } else {
            $(this).text('Ver más');
            $(this).data('desc', 'hidden');
        }
    })

    if($('#productoform-comentarios').length > 0){
        handleNewlinePlaceholder('#productoform-comentarios',
            'PERSONALIZA TU CHAMARRA \n ESCRIBE TUS PETICIONES',
            'not-focus'
        )
    }

    $('.checkout-block').on('click', '#editar-direccion', function() {
        $('#seleccion-envio').slideUp();
        $('.registro.bloque .muestra-bloque').removeClass('inactive');
        $('.bloque .muestra-bloque').addClass('inactive');
        $('#bloque-registro-chk').slideDown( function() {
            goToByScroll('.registro.bloque');
        });
    });

    $('.checkout-block').on('click', '.eliminar-producto-check', function(){
        var producto = $(this).data('producto');
        var talla = $(this).data('talla');
        $.ajax({
            url: 'bombers/borrar-producto-carrito',
            type: 'post',
            data: { producto, talla },
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.exito == '0') {
                    alert(respuesta.mensaje)
                } else {
                    $.pjax.reload({
                         container: '#pjax-products-check'
                        });
                }
            },
        });
    });
    $('.checkout-block').on('click', '.eliminar-producto-check2', function(){
        var producto = $(this).data('producto');
        var talla = $(this).data('talla');
        $.ajax({
            url: 'bombers/borrar-producto-carrito',
            type: 'post',
            data: { producto, talla },
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.exito == '0') {
                    alert(respuesta.mensaje)
                } else {
                    $.pjax.reload({
                         container: '#pjax-products-check2'
                        });
                }
            },
        });
    });

    $('#pjax-products-check').on('pjax:end', function(){
        updatePrices();
    })
    $('#pjax-products-check2').on('pjax:end', function(){
        updatePrices();
    })

    $('#pjax-coleccion').on('pjax:end', function(){
        $('.producto-img-wrapper .product-img').Lazy({
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
        });
    })

    $('.checkout-block').on('change', '.change-size', function(){
        var talla = $(this).val();
        var producto = $(this).data('producto');
        $.ajax({
            url: 'checkout/change-cart-product',
            type: 'post',
            data: { producto, talla },
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.exito == '0') {
                    alert(respuesta.mensaje)
                } else {
                    $.pjax.reload({
                         container: '#pjax-products-check'
                        });
                }
            },
        });
    });

//    $('#cantidad-chamarras').change(function(){
//        alert('cambie');
//    })
    $('.minus2').click(function(){
        alert ($('.change-quantity.minus.EXTR').data('cantidad'));
        $('.change-quantity.minus.EXTR').trigger('click');
    })
    $('.plus2').click(function(){
        alert ($('.change-quantity.plus.EXTR').data('cantidad'));
        $('.change-quantity.plus.EXTR').trigger('click');
    })
    $('.checkout-block').on('click', '.change-quantity', function(){
        var cantidad = parseInt($(this).data('cantidad'));
        var producto = $(this).data('producto');
        var producto_clave = $(this).data('clave');
        var accion = '';
        if($(this).hasClass('plus')){
            cantidad++;
            accion = 'mas';
        } else{
            cantidad--;
            accion = 'menos';
            if(cantidad < 1){
                return;
            }
        }
        $.ajax({
            url: 'checkout/change-cart-product',
            type: 'post',
            data: { producto, cantidad },
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.exito == '0') {
                    alert(respuesta.mensaje)
                } else {
                    if (producto_clave != 'EXTR'){
                        $.pjax.reload({ container: '#pjax-products-check' });

                    } else {
                        $.pjax.reload({ container: '#pjax-products-check2' });

                    }
                    if (producto_clave != 'EXTR' && producto_clave != 'HOP'){
                        if(accion == 'mas'){
                            $('#cantidad-chamarras').val(parseInt($('#cantidad-chamarras').val())+1)
                        } else{
                            $('#cantidad-chamarras').val(parseInt($('#cantidad-chamarras').val())-1)
                        }
                    }
                }
                var moneda = '';
                var ip = $('#base-moneda').text();
                var pais = $('select#pais-id option').filter(function () { return $(this).html() == $('#select2-pais-id-container').html(); }).val();
                $('select#registroform-continente').val(pais);
                var valorDolar = 20;
                var continente = $('select#registroform-continente').find('option:selected').text();
                var cantidad_chamarras = $('#cantidad-chamarras').val()
                if(ip == ' MXN'){
                    if($('input[name="tipo_cupon"]').val() != 'ENV'){
                        if(pais == 42 ){
                            if(cantidad_chamarras > 2){
                                $('input[name="precio-envio"]').val(150+' MXN' );
                                $('.costo-envio').text(150+' MXN')
                            } else {
                                $('input[name="precio-envio"]').val(90+' MXN' );
                                $('.costo-envio').text(90+' MXN')
                            }
                            $('#mensaje-envio').text('2 a 7 días habiles');
                            $('.span-moneda').text('MXN');
                        } else{
                            if(cantidad_chamarras > 2){
                                $('input[name="precio-envio"]').val(600+' USD' );
                                $('.costo-envio').text(600+' USD')
                            } else {
                                $('input[name="precio-envio"]').val(500+' USD' );
                                $('.costo-envio').text(500+' USD')
                            }
                            $('#mensaje-envio').text('2 a 7 días habiles');
                            $('.span-moneda').text('MXN');
                        }
                    }
                    moneda = ' MXN';
                } else {
                    if($('input[name="tipo_cupon"]').val() != 'ENV'){
                        if(pais == 42 || pais == 32 || pais == 55){
                            switch(pais){
                                case '42': //México
                                    if(cantidad_chamarras < 3){
                                        $('input[name="precio-envio"]').val(4.5+' USD' );
                                        $('#mensaje-envio').text('2 a 7 días habiles');
                                        $('.span-moneda').text('USD');
                                        $('.costo-envio').text(4.5+' USD')
                                    } else {
                                        $('input[name="precio-envio"]').val(7.5+' USD' );
                                        $('#mensaje-envio').text('2 a 7 días habiles');
                                        $('.span-moneda').text('USD');
                                        $('.costo-envio').text(7.5+' USD')
                                    }
                                    break;
                                case '32':  //Canadá
                                    $('input[name="precio-envio"]').val(28+' USD');
                                    $('#mensaje-envio').text('8 días');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(28+' USD')
                                    break;
                                case '55': //Estados Unidos
                                    var i;
                                    var valor = 35;
                                    switch(cantidad_chamarras){
                                        case '1':
                                            valor = 9.9;
                                            break;
                                        case '2':
                                            valor = 10.7;
                                            break;
                                        case '3':
                                            valor = 12.6;
                                            break;
                                        case '4':
                                            valor = 13.6;
                                            break;
                                        case '5':
                                            valor = 17.9;
                                            break;
                                        case '6':
                                            valor = 18.9;
                                            break;
                                        case '7':
                                            valor = 21.5;
                                            break;
                                        case '8':
                                            valor = 22.5;
                                            break;
                                        case '9':
                                            valor = 24.9;
                                            break;
                                        case '10':
                                            valor = 25.9;
                                            break;
                                    }
    //                                var valor = 25;
    //                                for(i = 2; i <= cantidad_chamarras; i++){
    //                                    valor += 5;
    //                                }
                                    $('input[name="precio-envio"]').val(valor+' USD');
                                    $('#mensaje-envio').text('8 días');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(valor+' USD')
                                    break;
                            }
                        }else{
                            switch(continente){
                                case '3': //Asia
                                    $('input[name="precio-envio"]').val(45+' USD');
                                    $('#mensaje-envio').text('8 días');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(45+' USD')
                                    break;
                                case '5': //Europa
                                    $('input[name="precio-envio"]').val(40+' USD');
                                    $('#mensaje-envio').text('8 días');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(40+' USD')
                                    break;
                                case '7': //Sudamerica
                                    $('input[name="precio-envio"]').val(39+' USD');
                                    $('#mensaje-envio').text('8 días');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(39+' USD')
                                    break;
                                case '6': //Norteamerica
                                    $('input[name="precio-envio"]').val(39+' USD');
                                    $('#mensaje-envio').text('8 días');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(39+' USD')
                                    break;
                                default:
                                    $('input[name="precio-envio"]').val(45+' USD');
                                    $('#mensaje-envio').text('8 días');
                                    $('.span-moneda').text('USD');
                                    $('.costo-envio').text(45+' USD')
                                    break;
                            }
                        }
                    }
                }
            },
            error: function(){
                alert('Ocurrió un error inesperado');
            },
        });
    });

    $('#carrito-container').on('click', '.quantity-cell .boton',function(){
        var cantidad = parseInt($(this).siblings('.cantidad-bombers').text());
        var producto_carro = $(this).data('producto-carrito');
        if($(this).hasClass('plus')){
            cantidad ++;
            updateCartProduct(cantidad, null, producto_carro);
        } else if ($(this).hasClass('minus')){
            cantidad--;
            if(cantidad < 1){
                return;
            }
            updateCartProduct(cantidad, null, producto_carro);
        }
    })

    $('#carrito-container').on('change', '.dropdown-tallas',function () {
        var talla = $(this).val();
        var producto_carro = $(this).data('producto-carrito');
        updateCartProduct(null, talla, producto_carro);
    })

    $('#carrito-container').on('click', '.eliminar-producto',function(){
        dataLayer.push({
            'event': 'removeFromCart',
            'ecommerce': {
              'remove': {                               // 'remove' actionFieldObject measures.
                'products': [{                          //  removing a product to a shopping cart.
                    'name': $(this).closest('.producto-carro').find('.nombre_producto').val(),
                    'id': $(this).closest('.producto-carro').find('.sku_producto').val(),
                    'price': $(this).closest('.producto-carro').find('.precio_producto').val(),
                    'brand': 'VOCAMX',
                    'category': $(this).closest('.producto-carro').find('.categoria_producto').val(),
                    'variant': 'Negro',
                    'quantity': $(this).closest('.producto-carro').find('.cantidad_producto').val()
                }]
              }
            }
          });
        var talla = $(this).data('talla')
        var producto_carro = $(this).data('producto');
        deleteCartProduct(producto_carro, talla);
    })

    // if($('.visualizaciones-block').length){
    //     $('#carrito-container').on('click', '.dismiss-block', function () {
    //         $('.visualizaciones-block').removeClass('visible');
    //     })

    //     setTimeout(() => {
    //         $('.visualizaciones-block.desk').addClass('visible');
    //     }, 5000);

    //     $(window).scroll(function(){
    //         var hT = $('.pagar-btn').offset().top,
    //         hH = $('.pagar-btn').outerHeight(),
    //         wH = $(window).height(),
    //         wS = $(this).scrollTop();
    //         if (wS > (hT+hH-wH + 100)){
    //             $('.visualizaciones-block.mob').addClass('visible');
    //         }
    //     });
    // }

    $('.add-to-cart-btn').on('click', function(){
        $(this).addClass('hidden');
        $(this).closest('.producto-cell').find('.botones-tallas').addClass('visible');
    });

    $('.btn-carrito-hover').on('click', function(){
         var btn = $(this).closest('.producto-cell').find('.btn-sel-talla.selected');
         if(!btn.length){
             return;
         }
         var talla = btn.data('talla');
         var producto = btn.data('producto');
         var cantidad = 1;
         addToCartFromCollection(talla, producto, cantidad);
    });

    $('.btn-carrito-cancel').on('click', function () {
        $(this).closest('.producto-cell').find('.botones-tallas').removeClass('visible');
        $(this).closest('.producto-cell').find('.add-to-cart-btn').removeClass('hidden');
    });

    $('#fotoCustomM').on('change', function(){
        //$('#name-file').text('Imagen seleccionada: ');
        if (document.getElementById('fotoCustomM').files && document.getElementById('fotoCustomM').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sube-foto-bloque .imagen-subir').attr('src', e.target.result);
                //$('#imagen-cargada').show();
                $('#subida-exito').show();
            }
            reader.readAsDataURL(document.getElementById('fotoCustomM').files[0]);
        }
    });

    $('#fotoCustomD').on('change', function(){
        //$('#name-file').text('Imagen seleccionada: ');
        if (document.getElementById('fotoCustomD').files && document.getElementById('fotoCustomD').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sube-imagen-bloque .imagen-subir-escri').attr('src', e.target.result);
                //$('#imagen-cargada').show();
                $('#subida-exito-escri').show();
            }
            reader.readAsDataURL(document.getElementById('fotoCustomD').files[0]);
        }
    });


    $('#fotoCustomMobile').on('change', function(){
        //$('#name-file').text('Imagen seleccionada: ');
        if (document.getElementById('fotoCustomMobile').files && document.getElementById('fotoCustomMobile').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sube-foto-bloque .imagen-subir').attr('src', e.target.result);
                //$('#imagen-cargada').show();
                $('#subida-exito').show();
            }
            reader.readAsDataURL(document.getElementById('fotoCustomMobile').files[0]);
        }
    });

    $('#fotoCustomDesktop').on('change', function(){
        //$('#name-file').text('Imagen seleccionada: ');
        if (document.getElementById('fotoCustomDesktop').files && document.getElementById('fotoCustomDesktop').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sube-foto-bloque .imagen-subir').attr('src', e.target.result);
                //$('#imagen-cargada').show();
                $('#subida-exito').show();
            }
            reader.readAsDataURL(document.getElementById('fotoCustomDesktop').files[0]);
        }
    });

      $('#fotoCustomColeccion').on('change', function(){
        //$('#name-file').text('Imagen seleccionada: ');
        if (document.getElementById('fotoCustomColeccion').files && document.getElementById('fotoCustomColeccion').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sube-foto-coleccion .imagen-subir').attr('src', e.target.result);
                //$('#imagen-cargada').show();
                $('#subida-exito').show();
            }
            reader.readAsDataURL(document.getElementById('fotoCustomColeccion').files[0]);
        }
    });

//    if($('#carrito-index').length || $('#checkout-index').length){
//        setTimeout( function() {
//            $(".custom-social-proof").stop().slideToggle('fast');
//        }, 2000);
//
//        $(".custom-close").click(function() {
//            $(".custom-social-proof").stop().slideToggle('fast')
//        });
//    }


    if($('.checkout-block').length){
        onCheckout();
    }

    $('.btn-galeria').on('click', function(){
        $.magnificPopup.open({
            fixedContentPos: true,
            items: {
                src: '#popup-galeria-custom'
            },
            type: 'inline'
        });
    });

    if(window.location.hash && $('#bombers-coleccion').length) {
        goToByScroll(window.location.hash, 105);
    }

    $('.filtro').on('click',function(){
        $('.filtro').removeClass('selected');
        if ($(this).hasClass('selected')) {
            $('.estampa').removeClass('hidden');
        } else {
            if ($(this).hasClass('male')) {
                $('.estampa').addClass('hidden');
                $('.HOM').each(function(){
                    var texto = $(this).val();
                    $(texto + '.link-estampa').parent('.estampa').removeClass('hidden');
                })
            }else if ($(this).hasClass('female')) {
                $('.estampa').addClass('hidden');
                $('.MUJ').each(function(){
                    var texto = $(this).val();
                    $(texto + '.link-estampa').parent('.estampa').removeClass('hidden');
                })
            }else if ($(this).hasClass('letter')) {
                $('.estampa').addClass('hidden');
                $('.LET').each(function(){
                    var texto = $(this).val();
                    $(texto + '.link-estampa').parent('.estampa').removeClass('hidden');
                })
            }
            $(this).addClass('selected');
        }
    });

    $('.show-size-pic').on('click', function(){
        if( document.getElementById("customphotoform-fotocustom").files.length == 0 ){
            alert('Selecciona la foto a trazar.')
            return;
        }
        var elementos = $('#customphotoform-elementos').val();
        $.ajax({
            url: $('#base_path').val() + '/bombers/obtener-tallas-producto',
            type: 'post',
            data: { elementos },
            dataType: "json",
            success: function (respuesta) {
                if(respuesta){
                    $('.botones-talla').html('');
                    for(var i = 0; i < respuesta.length; i++) {
                        var obj = respuesta[i];
                        var boton =  $('<button/>',
                            {
                                text: obj.talla,
                                class: 'sel-size-pic',
                                'data-talla': obj.talla_id,
                                'type': 'button'
                            });
                        $('.botones-talla').append(boton)
                    }
                    $('.botones-tallas').addClass('visible');
                }
            },
        });
    });

    $('.add-cart-pic').on('click', function(){
        var form = document.querySelector('#trazos-form');
        var formData = new FormData(form);
        $.ajax({
            url: $('#base_path').val() + '/bombers/agrega-carrito-trazado',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(respuesta){
                $.magnificPopup.open({
                    items: {
                        src: '#popup-checkout',
                        type: 'inline'
                    },
                    closeBtnInside: true
                });
                $.ajax({
                    url: $('#base_path').val() + '/bombers/actualizar-carrito',
                    type: 'post',
                    dataType: 'json',
                    success: function (respuesta) {
                        $('.bolsa #carrito-span').text(respuesta.numero_productos);
                        $('.botones-tallas').removeClass('visible');
                    }
                });
            }
        });
    });

    if(($('#resumen-compra-bloque').length > 0) && ($('#noHope').length > 0)){
        updatePrices();
//
//        $.magnificPopup.open({
//            items: {
//                src: '#popup-extra-custom',
//                type: 'inline'
//            },
//            closeBtnInside: true
//        });
    }

    $('#trazos-form').on('click', '.sel-size-pic' ,function(){
        $('.sel-size-pic').each(function(){
            $(this).removeClass('selected');
        })
        $('#talla-hidden').val($(this).data('talla'));
        $(this).addClass('selected');
    });

    $('.add-to-cart-btn').on('click', function(){
        $(this).addClass('hidden');
        $(this).closest('.producto-cell').find('.botones-tallas').addClass('visible');
    });

    $('#customColeccion').on('change', function(e){
        file = e.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            $('#imagen_personalizada').val(reader.result);
            $('#img-coleccion-subida').attr('src',reader.result);
            $('#subida-exito').show();
        };
        reader.onerror = function (error) {
            alert('Ocurrió un error al cargar la imagen.');
        };
    });

    $('.tab-button').on('click', function() {
        var tab_id = '#' + $(this).data('tab');
        $('.tab-button').removeClass('active');
        $('.tab').addClass('oculto');
        $(this).addClass('active');
        $(tab_id).removeClass('oculto');
    });

    $('#newsletter-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = $(this).serialize();
        $.ajax({
            url: $('#base_path').val() + '/mailing/add-mail',
            type: form.attr("method"),
            data: formData,
            beforeSend: function () {
                $('#loader-mail').removeClass('hidden');
            },
            success: function (respuesta) {
                if(!$('#popup-mail').length) {
                    $("main").append("<div id='popup-mail' class='white-popup mfp-hide bigger-popup'></div>")
                }
                if(!$('#bloque-registro-chk').length){
                    $('#popup-mail').html(respuesta.message);
                    $.magnificPopup.open({
                        items: {
                            src: '#popup-mail',
                            type: 'inline'
                        },
                        closeBtnInside: true
                    });
                }
            },
            complete: function () {
                $('#loader-mail').addClass('hidden');
            }
        });
    })


    $('.add-custom-button.add').on('click', function() {
        $.ajax({
            url: $('#base_path').val() + '/checkout/add-extra-to-cart',
            type: 'POST',
            beforeSend: function () {
                $('#loader-extra-custom').removeClass('hidden');
            },
            success: function (response) {
                if(response.exito) {
                    $.pjax.defaults.timeout = false;
                    $.pjax.reload({
                        container: '#pjax-products-check'
                    });
                    $.pjax.reload({
                        container: '#pjax-products-check2'
                    });
                    $('.finish .message').text('Gracias. Nos pondremos en contacto contigo para definir tu personalización.');
                } else {
                    $('.finish .message').text('Error agregando personalización extra');
                }
                $('#popup-extra-custom .request,#popup-extra-custom .finish').toggleClass('hidden');
            },
            complete: function () {
                $('#loader-extra-custom').addClass('hidden');
            }
        });
    });

    $('.add-custom-button.not-add').on('click', function() {
        $.magnificPopup.close();
    });

    if($('#ver-producto-container').length > 0){
        setInterval(actualizarVisita, 5000);
    };


    $('.talla-sold2').click(function(){
        $('.bloque-cantidad').addClass('hidden')
        $('.producto-form-botones').addClass('hidden')
        $('.sold-hide').addClass('hidden')
        $('.sold-correo').removeClass('hidden')
        $('#btn-carrito, #btn-com, .btn-carrito-hover, .btn-carrito-cancel, #btn-com-custom').css('cursor', 'not-allowed')
        $('#btn-carrito, #btn-com, .btn-carrito-hover, .btn-carrito-cancel, #btn-com-custom').attr('disabled', true)
    })
    $('.talla-sold').click(function(){
        $('.botones-agregar').addClass('hidden')
        $('.sold-row').removeClass('hidden')
        $('.bloque-cantidad').addClass('hidden')
        $('.producto-form-botones').addClass('hidden')
        $('.sold-correo').removeClass('hidden')
        $('.btn-carrito-hover, .btn-carrito-cancel').css('cursor', 'not-allowed')
        $('.btn-carrito-hover, .btn-carrito-cancel').attr('disabled', true)
    })

    $('.talla-buy').click(function(){
        $('.botones-agregar').removeClass('hidden')
        $('.sold-row').addClass('hidden')
        $('.sold-hide').removeClass('hidden')
        $('.bloque-cantidad').removeClass('hidden')
        $('.producto-form-botones').removeClass('hidden')
        $('.sold-correo').addClass('hidden')
        $('#btn-carrito, #btn-com, .btn-carrito-hover, .btn-carrito-cancel, #btn-com-custom').css('cursor', 'pointer')
        $('#btn-carrito, #btn-com, .btn-carrito-hover, .btn-carrito-cancel, #btn-com-custom').attr('disabled', false)
    })

    $('.talla-sold2').click(function(){
        $('#soldcorreoform-talla_id').val($(this).attr('data-talla-id'))
    })

    $('.talla-sold').click(function(){
        $('#soldcorreoform-talla_id').val($(this).attr('data-talla'))
    })

    $('#btn-com').click(function(e){
        e.preventDefault();
        var form = $('#form-agrega-carrito');
        if($('#productoform-color_decoracion').length){
            if($('#productoform-color_decoracion').val() == '' || $('#productoform-medida_decoracion').val() == ''){
                alert('Por favor selecciona talla y medida.')
                return false;
            }
        }

        $.ajax({
            url: 'get-datos',
            type: 'post',
            data: form.serialize(),
            success: function(data) {
                var products = [];
                var content_ids = [];
                var contents = [];
                var value = 0;
                var items = 0;
                products.push({
                    'name': data.nombre,
                    'id': data.sku,
                    'price': parseFloat(data.price),
                    'brand': data.brand,
                    'category': data.categoria,
                    'variant': data.variante,
                    'quantity': data.cantidad
                });
                content_ids.push(data.sku)
                contents.push({
                    'id': data.sku,
                    'quantity': data.cantidad,
                    'item_price': parseFloat(data.price_unidad)
                })
                dataLayer.push({
                    'event': 'checkout',
                    'ecommerce': {
                        'checkout': {
                            'products': products,
                        }
                    },
                });
                fbq('track', 'InitiateCheckout', {
                    content_ids: content_ids,
                    contents: contents,
                    currency: 'MXN',
                    num_items: data.cantidad,
                    value: parseFloat(data.price),
                    content_type: content_ids.length > 1 ? 'product_group' : 'product'
                });
                form.submit();
                // setTimeout(function(){ alert(123);form.submit(); }, 3000);
            }
        });

    });
    // $('#form-agrega-carrito').on('beforeSubmit', function (e) {
    //     e.preventDefault();
    //     e.returnValue = false;
    //
    //     var form = $(this);
    //     if($('#productoform-color_decoracion').length){
    //         if($('#productoform-color_decoracion').val() == '' || $('#productoform-medida_decoracion').val() == ''){
    //             alert('Por favor selecciona talla y medida.')
    //             return false;
    //         }
    //     }
    //     $.ajax({
    //         url: 'get-datos',
    //         type: 'post',
    //         data: form.serialize(),
    //         success: function(data) {
    //             var products = [];
    //             var content_ids = [];
    //             var contents = [];
    //             var value = 0;
    //             var items = 0;
    //             products.push({
    //                 'name': data.nombre,
    //                 'id': data.sku,
    //                 'price': parseFloat(data.price),
    //                 'brand': data.brand,
    //                 'category': data.categoria,
    //                 'variant': data.variante,
    //                 'quantity': data.cantidad
    //             });
    //             content_ids.push(data.sku)
    //             contents.push({
    //                 'id': data.sku,
    //                 'quantity': data.cantidad,
    //                 'item_price': parseFloat(data.price_unidad)
    //             })
    //             dataLayer.push({
    //                 'event': 'checkout',
    //                 'ecommerce': {
    //                     'checkout': {
    //                         'products': products,
    //                     }
    //                 },
    //             });
    //             fbq('track', 'InitiateCheckout', {
    //                 content_ids: content_ids,
    //                 contents: contents,
    //                 currency: 'MXN',
    //                 num_items: data.cantidad,
    //                 value: parseFloat(data.price),
    //                 content_type: content_ids.length > 1 ? 'product_group' : 'product'
    //             });
    //             alert(213);
    //             this.off('submit');
    //             this.submit();
    //         }
    //     });
    // })
//    })


        $('#productoform-color_decoracion').on('change', function(){
        let color_id = $(this).val();
        $.ajax({
            url: $('#base_path').val()+'/decoracion/obtiene-medidas',
            type: 'POST',
            data: {
                'id': $('#id-decoracion').val(),
                'color': color_id
            },
            success: function(data){
                $('#productoform-medida_decoracion').html(data);
            },
        });
        let index_color = parseInt($('.foto').index($('.color-'+$(this).val())));
        if(index_color > 0){
            $('#fotos-producto').slick('slickGoTo',index_color);
        }
    });

    $('#productoform-medida_decoracion').on('change', function(){
        $('#precio-variante').text('$'+$(this).find('option:selected').data('precio'));
        $('#productoform-costo_variante').val($(this).find('option:selected').data('precio'));
    });

});

// document ready end

function actualizarVisita(){
    var visita = $('#valorVisita').val();
    $.ajax({
        url: $('#base_path').val()+'/bombers/actualizar-visita',
        type: 'POST',
        data: {visita},
        success: function(){
            console.log('exit')
        },
    });
}

function handleNewlinePlaceholder(selector, placeholder, notFocusClass){
    $(selector).val(placeholder);

    $(selector).focus(function () {
        if ($(this).val() === placeholder) {
            $(this).toggleClass(notFocusClass);
            $(this).val('');
        }
    });

    $(selector).blur(function () {
        if ($(this).val() === '') {
            $(this).toggleClass(notFocusClass);
            $(this).val(placeholder);
        }
    });
}

function copyToClipboard(containerID) {
    var range = document.createRange();
    range.selectNode(document.getElementById(containerID));
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand("copy")
}

function activaZoom(){
    $('#fotos-producto img, #fotos-producto .youtube-link').magnificPopup({
        type: 'image',
        closeBtnInside: true,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        gallery: {
            enabled: true,
            navigateByImgClick: false,
        },
        callbacks: {
            open: function(){
                $('.mfp-figure').on('click', function(event){
                    event.preventDefault();
                    zoom.to({
                        x: event.pageX,
                        y: event.pageY,
                        scale: 3
                    })
                })

                $('.mfp-content').swipe({
                    swipeLeft: function (event, direction, distance, duration, fingerCount) {
                        $('#fotos-producto img, #fotos-producto .youtube-link').magnificPopup('next');
                    },
                    swipeRight: function (event, direction, distance, duration, fingerCount) {
                        $('#fotos-producto img, #fotos-producto .youtube-link').magnificPopup('prev');
                    }
                });
            },
            close: function () {
                zoom.out();
            },
            elementParse: function (item) {
                if (item.el[0].className == 'youtube-link hidden') {
                    item.type = 'iframe';
                } else {
                    item.type = 'image';
                }
            }
        }
    });

    $('.grid-fotos-clientes .foto').magnificPopup({
        type: 'image',
        closeBtnInside: true,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        gallery: {
            enabled: true,
            navigateByImgClick: false,
        },
        callbacks: {
            open: function(){
                $('.mfp-content').swipe({
                    swipeLeft: function (event, direction, distance, duration, fingerCount) {
                        $('.grid-fotos-clientes .foto').magnificPopup('next');
                    },
                    swipeRight: function (event, direction, distance, duration, fingerCount) {
                        $('.grid-fotos-clientes .foto').magnificPopup('prev');
                    }
                });
            }
        }
    });
}

function addToCartFromCollection(talla, producto, cantidad){
    $.ajax({
        url: $('#base_path').val() + '/bombers/agrega-carrito',
        type: 'post',
        data: { producto, talla, cantidad },
        dataType: "json",
        beforeSend: function () {
            $('#loader-carrito').removeClass('hidden');
        },
        success: function (respuesta) {
            $.magnificPopup.open({
                items: {
                    src: '#popup-checkout',
                    type: 'inline'
                },
                closeBtnInside: true
            });
            $.ajax({
                url: $('#base_path').val() + '/bombers/actualizar-carrito',
                type: 'post',
                success: function (respuesta) {
                    $('.bolsa #carrito-span').text(respuesta.numero_productos);
                }
            });
        },
        complete: function () {
            $('#loader-carrito').addClass('hidden');
        }
    });
}

function deleteCartProduct(producto, talla){
    $.ajax({
        url: 'carrito/delete-cart-product',
        type: 'post',
        data: { producto, talla },
        dataType: 'json',
        success: function (respuesta) {
            if (respuesta.exito) {
                $.pjax.reload({ container: '#pjax-product-table' });
                $('#pjax-product-table').on('pjax:end', function () {
                    $('.img-link').magnificPopup({
                        type: 'image',
                        closeOnContentClick: false,
                        fixedContentPos: true,
                        closeOnBgClick: false,
                        mainClass: 'mfp-no-margins mfp-with-zoom',
                        image: {
                            verticalFit: true
                        },
                    });
                });
            } else {
                alert(respuesta.mensaje);
            }
        },
        error: function () {
            alert('Error');
        }
    });
}

function updateCartProduct(quantity = false, size = false, producto_carro){
    $.ajax({
        url: 'carrito/update-cart-product',
        type: 'post',
        data: { quantity , size , producto_carro },
        dataType: 'json',
        success: function (respuesta) {
            if(respuesta.exito){
                $.pjax.reload({ container: '#pjax-product-table' });
                $('#pjax-product-table').on('pjax:end', function () {
                    $('.img-link').magnificPopup({
                        type: 'image',
                        closeOnContentClick: false,
                        fixedContentPos: true,
                        closeOnBgClick: false,
                        mainClass: 'mfp-no-margins mfp-with-zoom',
                        image: {
                            verticalFit: true
                        },
                    });
                });
            } else {
                alert(respuesta.mensaje);
            }
        },
        error: function () {
            alert('Error');
        }
    });
}

function initMasonryGrid(mainSelector, itemSelector, columnWidth, percentPosition){
    $(mainSelector).masonry({
        itemSelector: itemSelector,
        columnWidth: columnWidth,
        percentPosition: percentPosition
    });
}

function checkOffset(){
    if ($('#resumen-compra-bloque').offset().top + $('#resumen-compra-bloque').height()>= $('.footer').offset().top - 10){
        $('#resumen-compra-bloque').addClass('resumen-altura-footer');
        $('#resumen-compra-bloque').removeClass('resumen');

    }
    if ($(document).scrollTop() + window.innerHeight < $('.footer').offset().top){
        $('#resumen-compra-bloque').removeClass('resumen-altura-footer');
        $('#resumen-compra-bloque').addClass('resumen');
    }

    if ($('#datos_personales-compra-bloque').offset().top + $('#datos_personales-compra-bloque').height()>= $('.footer').offset().top - 10){
        $('#datos_personales-compra-bloque').addClass('datos_personales-altura-footer');
        $('#datos_personales-compra-bloque').removeClass('datos_personales');

    }
    if ($(document).scrollTop() + window.innerHeight < $('.footer').offset().top){
        $('#datos_personales-compra-bloque').removeClass('datos_personales-altura-footer');
        $('#datos_personales-compra-bloque').addClass('datos_personales');
    }
}

function verificaCamposHabilitaFinalizar(){
    if(/*$('.envios input[name="PedidoForm[envio]"]:checked').length > 0 &&*/ $('.formas-pago input[name="metodo-pago"]:checked').length > 0 && $('#acepta-terminos-out').is(':checked')) {
        if($('.formas-pago input[name="metodo-pago"]:checked').val() == 'tarjeta'){
            if(checkInputCardFields()){
                $('#pre-finalizar').addClass('hidden');
                $('#finalizar-compra-out').removeAttr('disabled');
                $('#finalizar-compra-out').removeClass('hidden');

            }else{
                $('#finalizar-compra-out').addClass('hidden');
                $('#finalizar-compra-out').attr('disabled', 'disabled');
                $('#pre-finalizar').removeClass('hidden');
            };
        } else {
            $('#pre-finalizar').addClass('hidden');
            $('#finalizar-compra-out').removeAttr('disabled');
            $('#finalizar-compra-out').removeClass('hidden');
        }
    } else {
        $('#finalizar-compra-out').addClass('hidden');
        $('#finalizar-compra-out').attr('disabled', 'disabled');
        $('#pre-finalizar').removeClass('hidden');
    }
}

function checkInputCardFields(){
    if(!$('#numero-tarjeta').val() || !$('#nombre-tarjeta').val() || !$('#cvv-tarjeta').val() || !$('#mes-tarjeta').val() || !$('#anio-tarjeta').val()){
        return false;
    }
    return true;
}

function enviaDataPagoGuest(){
    var data = new FormData();
    data.append('metodo', $('input[name="metodo-pago"]:checked').val());
    data.append('RegistroForm[nombre]', $('input[name="RegistroForm[nombre]"]').val());
    data.append('RegistroForm[apellido]', $('input[name="RegistroForm[apellido]"]').val());
    data.append('RegistroForm[telefono]', $('input[name="RegistroForm[telefono]"]').val());
    if ($('#registroform-email').length > 0){
        data.append('RegistroForm[email]', $('#registroform-email').val());
    }
    data.append('RegistroForm[pais]', $('select#pais-id option').filter(function () { return $(this).html() == $('#select2-pais-id-container').html(); }).val());
    data.append('RegistroForm[estado]', $('select#estado-id option').filter(function () { return $(this).html() == $('#select2-estado-id-container').html(); }).val());
    data.append('RegistroForm[continente]', $('select#continente-id option').filter(function () { return $(this).html() == $('#select2-continente-id-container').html(); }).val());
    data.append('RegistroForm[ciudad]', $('input[name="RegistroForm[ciudad]"]').val());
    data.append('RegistroForm[cp]', $('input[name="RegistroForm[cp]"]').val());
    data.append('RegistroForm[calle]', $('input[name="RegistroForm[calle]"]').val());
    data.append('RegistroForm[direccion]', $('input[name="RegistroForm[direccion]"]').val());
    data.append('RegistroForm[externo]', $('input[name="RegistroForm[externo]"]').val());
    data.append('RegistroForm[interno]', $('input[name="RegistroForm[interno]"]').val());
    data.append('RegistroForm[entre_calles]', $('input[name="RegistroForm[entre_calles]"]').val());
    data.append('RegistroForm[referencias]', $('input[name="RegistroForm[referencias]"]').val());
    if($('#registroform-colonia_manual').val() == ''){
        data.append('RegistroForm[colonia]', $('#registroform-colonia').val());
    }else{
        data.append('RegistroForm[colonia]', $('#registroform-colonia_manual').val());
    }
    data.append('RegistroForm[municipio]', $('input[name="RegistroForm[municipio]"]').val());
//    data.append('PedidoForm[envio]', '');
    data.append('PedidoForm[cupon]', $('input[name="cupon_aplicado"]').val());
    if ($('#metodo-tarjeta').is(':checked')){

        data.append('TarjetaForm[mensualidades]', $('input[name="TarjetaForm[mensualidades]"]:checked').val());
        data.append('TarjetaForm[token]', $('input[name="TarjetaForm[token]"]').val());
        data.append('TarjetaForm[device_session_id]', $('input[name="TarjetaForm[device_session_id]"]').val());
        data.append('TarjetaForm[secure]', $('input[name="TarjetaForm[secure]"]').is(':checked') ? 1 : 0);
    }
    $.ajax({
        url: $('#base_path').val() + '/checkout/compra',
        type: 'post',
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (respuesta) {
            if(respuesta.success == false){
                alert(respuesta.message);
                $('#loader').fadeOut();
                $.magnificPopup.open({
                    items: {
                        src: '#pago-popup'
                    },
                    type: 'inline',
//                    modal: true,
//                    closeOnBgClick:true,
                });
            }else if (respuesta.success == true ){
                window.location.replace(respuesta.url);
            } else {
                $('#loader').fadeOut();
                alert(respuesta.message);
                window.location.reload();
            }
        },
        error: function(xhr, ajaxOptions, thrownError){
            $('#loader').fadeOut();
            alert(xhr.status + ' ' + thrownError);
        },
        complete: function(data){
            $('#loader-pago').addClass('hidden');
            // $('#registro-chk-btn').removeAttr('disabled');
            // $('#finalizar-compra-out').removeAttr('disabled');
        }
    });

}

function goToByScroll(selector, offset = 170) {
    $('html,body').animate({
        scrollTop: $(selector).offset().top - offset
    }, 'slow');
}

function guardarDiseno(){
    if(!$('#diseno_seleccionado').val()){
        alert('Debes seleccionar un modelo para tu bomber.');
        return 0;
    }
    if($('.bloque-input-mob').is(':visible')){
        $('.bloque-input-mob').addClass('hidden');
    }
    $('#loader').fadeIn();
    html2canvas(document.getElementById("bloque-bomber"),{'async':false}).then(function(canvas) {
        $('#personalizadaform-imagen').val(canvas.toDataURL("image/png"));
        $('#personalizada-form').submit();
        if($('.bloque-input-mob').hasClass('hidden')){
            $('.bloque-input-mob').removeClass('hidden');
        }
    });
}

function descargaDiseno(){
    if(!$('#diseno_seleccionado').val()){
        alert('Debes seleccionar un modelo para tu bomber.');
        return 0;
    }
    $('.bloque-input-mob').addClass('hidden');
    $('.btn-ayuda-bomber').addClass('hidden');
    $('.btn-galeria').addClass('hidden');
    $('.botones-filtros').addClass('hidden');
    $('#loader').fadeIn();
    $('#logo-marca_agua').addClass('visible');
    html2canvas(document.getElementById("bloque-bomber"),{'async':false}).then(function(canvas) {
        var link = document.createElement('a');
        if (typeof link.download === 'string') {
            link.href = canvas.toDataURL('image/jpg');
            link.download = 'bomber_vocamx.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            window.open(canvas.toDataURL());
        }
        $('#logo-marca_agua').removeClass('visible');
        $('#loader').fadeOut();
        $('.bloque-input-mob').removeClass('hidden');
        $('.btn-ayuda-bomber').removeClass('hidden');
        $('.btn-galeria').removeClass('hidden');
        $('.botones-filtros').removeClass('hidden');
        $('.img-generated').attr('src', canvas.toDataURL());
        $.magnificPopup.open({
            type: 'inline',
            fixedContentPos: true,
            items: {
                src: '#popup-generated-img'
            },
        });
    });
}

function validarEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function inicioPersonalizacion(){
    var alto_imagen = $('#canvas-personalizacion').height();
    var ancho_imagen = alto_imagen*.835;
    var img = new Image();
    img.onload = function() {
        context.mozImageSmoothingEnabled = false;
        context.webkitImageSmoothingEnabled = false;
        context.msImageSmoothingEnabled = false;
        context.imageSmoothingEnabled = false;

        context.drawImage(img, 35, 0, ancho_imagen, alto_imagen);
    };
    img.src = 'http://localhost'+$('#imagen-hombre').val();
    context.rect(20,20,150,100);
    context.stroke();
}

function cambiaPasoActivo(numero_paso){
    var pasos = [1,2,3,4,5];
    var indice = pasos.indexOf(numero_paso);
    if(indice > -1){
        pasos.splice(indice,1);
    }
    for(var i = 0; i < 4; i++){
        $('.paso-' + i).removeClass('is-active');
    }
    $('.paso-' + numero_paso.toString()).addClass('is-active');
}

function updatePrices(){
    var precio_productos = parseFloat($('input[name="precio-productos"]').val());
    var precio_perso = parseFloat($('input[name="precio-perso"]').val());
    var cantidadAltaProducto = parseFloat($('input[name="cantidadAltaProducto"]').val());
    var precio_envio = parseFloat($('input[name="precio-envio"]').val());
    var cantidadDescuento = parseFloat($('input[name="cantidad_descuento"]').val());
    var cupon = $('input[name="tipo_cupon"]').val();
    var descuentoAlta = 714 * cantidadAltaProducto;
    var descuento = 0;
    switch(cupon){
        case 'DES':
            descuento = cantidadDescuento;
        break;
        case 'DEP':
            descuento = precio_productos * (cantidadDescuento / 100);
        break;
        case 'ENV':
            // if (descuentoAlta > 0) {
            // descuento =  precio_productos * .20 + descuentoAlta;
            // }else{
            // descuento = precio_envio + precio_productos * .20;
            // }
        break;
        case 'SEG':
            descuento = (precio_envio + precio_productos) * .10;
        break;
    }
    var subtotal = precio_productos - descuento;
    var total = 0;
    if ((cupon == 'ENV' || cupon == 'CAL') && cupon != '') {
         total = subtotal + precio_perso;
    }else{
        total = subtotal + precio_envio + precio_perso;
    }

    if ($('input[name="tipo_cupon"]').val() == 'DES' || $('input[name="tipo_cupon"]').val() == 'SEG'){
        if ((descuentoAlta > 0 ) && (cupon != 'ENV')) {
            $('#span-envio').addClass('line-trough');
        }else{
            $('#span-envio').addClass('selected cupon');
        }
    }
    $('#span-subtotal').text(formatter.format(subtotal) );

    $('input[name="precio-total"]').val(total);
    $('#span-total').text(formatter.format(total));

    var input3 = $('input[name="TarjetaForm[mensualidades]"]').filter(function() { return this.value == '3' });
    var radioInline = input3.closest('.radio-inline');
    radioInline.text('3 meses sin intereses de ' + formatter.format(total/3));
    radioInline.prepend(input3);
    var input6 = $('input[name="TarjetaForm[mensualidades]"]').filter(function() { return this.value == '6' });
    var radioInline = input6.closest('.radio-inline');
    radioInline.text('6 meses sin intereses de ' + formatter.format(total/6));
    radioInline.prepend(input6);
    var input9 = $('input[name="TarjetaForm[mensualidades]"]').filter(function() { return this.value == '9' });
    var radioInline = input9.closest('.radio-inline');
    radioInline.text('9 meses sin intereses de ' + formatter.format(total/9));
    radioInline.prepend(input9);
    var input12 = $('input[name="TarjetaForm[mensualidades]"]').filter(function() { return this.value == '12' });
    var radioInline = input12.closest('.radio-inline');
    radioInline.text('12 meses sin intereses de ' + formatter.format(total/12));
    radioInline.prepend(input12);


    $('#span-cupon').text('-' + formatter.format(descuento));
    $('#span-ahorro').text(formatter.format(descuento));
    $('#span-subtotal-desc').text(formatter.format(subtotal) );
    if(precio_envio){
        $('#span-envio').text(formatter.format(precio_envio) );
    }
    if (total > 9999) {
        $('#metodo-limite').fadeOut();
    }
}



function selectShippingCoupon(){
    $('#seleccionar-envio').addClass('hidden');
    $('.mensaje-cupon-envios').removeClass('hidden');
}

function verificaNombreApellidos(){
    var nombre = $('#registroform-nombre').val();
    var apellido = $('#registroform-apellido').val();
    if(nombre == '' || apellido == ''){
        return false;
    }
    return true;
}

function verificaDireccion(){
    var vacios = [];
    if($('#registroform-colonia_manual').is(':visible') && $('#registroform-colonia_manual').val() == ''){
        vacios.push('#registroform-colonia_manual');
        jQuery('body,html').animate({
            scrollTop: $('#registroform-colonia_manual').offset().top - (jQuery('header').height() + $('#destacadas').height())
        }, 800);

    }
    if($('#pais-id').val() != 55){
        if($('#registroform-municipio').val() == ''){
            vacios.push('#registroform-municipio');
            jQuery('body,html').animate({
                scrollTop: $('#registroform-municipio').offset().top - (jQuery('header').height() + $('#destacadas').height())
            }, 800);
        }
    }
    if($('#registroform-ciudad').val() == ''){
        vacios.push('#registroform-ciudad');
        jQuery('body,html').animate({
            scrollTop: $('#registroform-ciudad').offset().top - (jQuery('header').height() + $('#destacadas').height())
        }, 800);
    }
    if(vacios.length > 0){
        vacios.forEach(function(vacio){
            $(vacio).parent().removeClass('has-success').addClass('has-error');
        });
        return false;
    }
    return true;
}

function randomIntFromInterval(min,max){
    return Math.floor(Math.random()*(max-min+1)+min);
}

function checkCCField() {
    if (!OpenPay.card.validateCardNumber($('#numero-tarjeta').val())) {
        $('.field-card-number').addClass('has-error');
        $('.field-card-number').find('.help-block').text('Número de tarjeta invalido.');
    } else {
        $('.field-card-number').removeClass('has-error');
        $('.field-card-number').find('.help-block').text('');
    }
}

function cc_format(value) {
    var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
    var matches = v.match(/\d{4,16}/g);
    var match = matches && matches[0] || ''
    var parts = []
    for (i=0, len=match.length; i<len; i+=4) {
      parts.push(match.substring(i, i+4))
    }
    if (parts.length) {
      return parts.join(' ')
    } else {
      return value
    }
  }

function pixelDeco(){
    var products = [];
    var content_ids = [];
    var contents = [];
    var value = 0;
    var items = 0;
    var existe = 0;
    $('.product-info').each(function(index, listItem){
        var nombre = $(listItem).find('.nombre_producto').val();
        var sku = $(listItem).find('.sku_producto').val();
        var precio = $(listItem).find('.precio_producto').val();
        var categoria = $(listItem).find('.categoria_producto').val();
        var cantidad = $(listItem).find('.cantidad_producto').val();
        var id_fb = $(listItem).find('.id_facebook_producto').val();
        if (categoria == 'Decoración Interior'){
            existe = 1;
            products.push({
                'name': nombre,
                'id': sku,
                'price': parseFloat(precio) * parseFloat(cantidad),
                'brand': 'VOCAMX',
                'category': categoria,
                'variant': 'Negro',
                'quantity': cantidad
            });
            content_ids.push(sku)
            contents.push({
            'id': sku,
            'quantity': cantidad,
            'item_price': precio
            })
            value = value + parseFloat(precio);
            items = items + parseInt(cantidad);
        }
    });
    if (existe == 1){
        dataLayer.push({
            'event': 'checkout',
            'ecommerce': {
                'checkout': {
                    'products': products,
                }
            },
        });
        fbq('track', 'InitiateCheckout', {
            content_ids: content_ids,
            contents: contents,
            currency: 'MXN',
            num_items: items,
            value: value,
            content_type: content_ids.length > 1 ? 'product_group' : 'product'
        });
    }
}


  function onCheckout() {
      var products = [];
      var content_ids = [];
      var contents = [];
      var value = 0;
      var items = 0;
      $('.product-info').each(function(index, listItem){
          var nombre = $(listItem).find('.nombre_producto').val();
          var sku = $(listItem).find('.sku_producto').val();
          var precio = $(listItem).find('.precio_producto').val();
          var categoria = $(listItem).find('.categoria_producto').val();
          var cantidad = $(listItem).find('.cantidad_producto').val();
          var id_fb = $(listItem).find('.id_facebook_producto').val();
          products.push({
            'name': nombre,
            'id': sku,
            'price': parseFloat(precio) * parseFloat(cantidad),
            'brand': 'VOCAMX',
            'category': categoria,
            'variant': 'Negro',
            'quantity': cantidad
          });
          content_ids.push(sku)
          contents.push({
            'id': sku,
            'quantity': cantidad,
            'item_price': precio
          })
          value = value + parseFloat(precio);
          items = items + parseInt(cantidad);
      });
    dataLayer.push({
      'event': 'checkout',
      'ecommerce': {
        'checkout': {
          'products': products,
       }
     },
    });
    fbq('track', 'InitiateCheckout', {
        content_ids: content_ids,
        contents: contents,
        currency: 'MXN',
        num_items: items,
        value: value,
        content_type: content_ids.length > 1 ? 'product_group' : 'product'
    });
  }

jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            return (
                key == 8 ||
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });

};
