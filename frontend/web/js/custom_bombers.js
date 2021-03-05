jQuery(document).ready(function($){
    $(document).keypress(function(e) {
        if(e.which == 13 || e.wich == 0) {
            if($('#captura-instagram.visible').length){
                $('#captura-instagram').removeClass('visible');
            }
        }
    });

    if($('#bloque-personalizacion').length){
        $('#texto-personalizado').on('click', function(){
            $('#texto-personalizado .texto-personalizado').focus();
        });

        $('#agregar-instagram a').on('click', function(){
            $('#captura-instagram').toggleClass('visible');
            if(Number($('#captura-instagram.visible').length) == 1){
                $('#instagram').focus();
            }else{
                $('#instagram').blur();
            }
        });

        $('#select-modelo').on('change', function(){
            var modelo = $(this).val();
            $('.imagen-modelo').removeClass('seleccionado');
            $('#modelo-'+modelo).addClass('seleccionado');
            $('#bloque-personalizacion').removeClass('mostrando-H');
            $('#bloque-personalizacion').removeClass('mostrando-M');
            $('#bloque-personalizacion').addClass('mostrando-'+modelo);
        });

        $('.color').on('click', function(){
            $('.color').removeClass('seleccionado');
            $(this).addClass('seleccionado');
            //segmentarTexto($(this).attr('id'));
            segmentarTexto($(this).attr('id'));
        });

        $('#alineacion-texto a').on('click', function(){
            $('#selector-alineacion').toggleClass('visible');
        });

        $('#selector-alineacion a').on('click', function(){
            var alineacion = $(this).data('alineacion');
            $('#alineacion-texto img').removeClass('seleccionado');
            $('#alineacion-texto .alinea-'+alineacion).addClass('seleccionado');
            $('#texto-personalizado').removeClass('centro');
            $('#texto-personalizado').removeClass('izquierda');
            $('#texto-personalizado').removeClass('derecha');
            $('#texto-personalizado').addClass(alineacion);
            $('#texto-personalizado div').css('left', 0);
        });

        $('#texto-grande').on('click', function(){
            var size = $('#texto-personalizado .texto-personalizado').css('font-size');
            size = Number(size.substring(0, size.length - 2))+1;
            if(size < 25)
                //segmentarTexto(null,'size',size+'px');
                $('#texto-personalizado .texto-personalizado').css('font-size',size);
        });

        $('#texto-chico').on('click', function(){
            var size = $('#texto-personalizado .texto-personalizado').css('font-size');
            size = Number(size.substring(0, size.length - 2))-1;
            if(size > 5)
                $('#texto-personalizado .texto-personalizado').css('font-size',size);
        });

        $('#grosor-grande').on('click', function(){
            var weight = $('#texto-personalizado .texto-personalizado').css('font-weight');
            weight = Number(weight);
            if(weight < 900)
                weight += 100;
            $('#texto-personalizado .texto-personalizado').css('font-weight',weight);
        });

        $('#grosor-chico').on('click', function(){
            var weight = $('#texto-personalizado .texto-personalizado').css('font-weight');
            weight = Number(weight);
            if(weight > 100)
                weight -= 100;
            $('#texto-personalizado .texto-personalizado').css('font-weight',weight);
        });

        $('#guardar').on('click', function(){
            exportarPng();
        });

        $('.seleccion-fuente').on('click', function(){
            var fuente = $(this).data('fuente');
            $('#texto-personalizado').removeClass('fuente-akashi');
            $('#texto-personalizado').removeClass('fuente-arial');
            $('#texto-personalizado').removeClass('fuente-arialnarrow');
            $('#texto-personalizado').removeClass('fuente-advertising');
            $('#texto-personalizado').removeClass('fuente-beethoven');
            $('#texto-personalizado').removeClass('fuente-gangofthree');
            $('#texto-personalizado').removeClass('fuente-haettenschweiler');
            $('#texto-personalizado').removeClass('fuente-komikaaxis');
            $('#texto-personalizado').removeClass('fuente-oldenglish');
            $('#texto-personalizado').removeClass('fuente-supreme');
            $('#texto-personalizado .texto-personalizado').css('font-weight','400');
            $('#texto-personalizado .texto-personalizado').css('font-size','15px');
            segmentarTexto('fuente-'+fuente);
        });

        $('#abrir-extras').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
                beforeOpen: function() {
                    if($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });

        $('.opcion-extra').on('click', function(){
            var opcion = $(this).data('opcion');
            $('.opcion-extra').removeClass('seleccionado');
            $(this).addClass('seleccionado');
        });

        $('#texto-personalizado div').draggable({
            containment: "#texto-personalizado",
            scroll: false
        }).click(function() {
            $(this).draggable( {disabled: false});
        }).dblclick(function() {
            $(this).draggable({ disabled: true });
        });

        $('#texto-personalizado div').on('keyup', function(){
            var ancho_contenedor = Number($('#texto-personalizado').width());
            var ancho_texto = Number($('#texto-personalizado div').width());
            var left = $('#texto-personalizado div').css('left');
            left = Number(left.substring(0, left.length - 2));
            if(ancho_contenedor-(ancho_texto+left) < 0){
                $('#texto-personalizado div').css('left', ancho_contenedor-ancho_texto);
            }
        });

        $('#instagram').on('keyup input', function(){
            var instagram = $.trim($(this).val());
            if(instagram.length > 0){
                if(instagram.length > 12){
                    instagram = instagram.substring(0, left.length - 1)
                }
                $('#agregar-instagram a').text('@'+instagram);
            }else{
                $('#agregar-instagram a').text('+');
            }
        });

        $('#cerrar-instagram').on('click', function(){
            $('#captura-instagram').removeClass('visible');
        });

        $('#carga-archivo').on('click', function(){
            $('#archivo-cargado').click();
        });

        $('#archivo-cargado').on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = new Image;
                    img.onload = function(){
                        $('#carga-archivo img').remove();
                        $('#carga-archivo').removeClass('imagen-horizontal');
                        $('#imagen-cargada').removeClass('imagen-horizontal');
                        $('#carga-archivo').removeClass('imagen-vertical');
                        $('#imagen-cargada').removeClass('imagen-vertical');
                        $('#carga-archivo').append('<img src="'+e.target.result+'" />');
                        if($('#imagen-cargada img').length){
                            $('#imagen-cargada img').attr('src', e.target.result);
                            $('#imagen-cargada').removeClass('imagen-horizontal');
                            $('#imagen-cargada').removeClass('imagen-vertical');
                            $('#imagen-cargada').resizable('destroy');
                            $('#imagen-cargada').removeAttr('style');
                        }else{
                            $('#imagen-cargada').prepend('<img id="imagen-cargada" src="'+e.target.result+'" />')
                        }
                        var r = gcd(Number($('#imagen-cargada img').width()),Number($('#imagen-cargada img').height()));
                        $('#imagen-cargada').resizable({
                            containment: "#texto-personalizado",
                            aspectRatio: ($('#imagen-cargada img').width()/r) / ($('#imagen-cargada img').height()/r)
                        });
                        $('#carga-archivo').addClass('imagen-cargada');
                        console.log('Width: '+img.width+'Height: '+img.height);
                        if(img.width > img.height){
                            console.log(1);
                            $('#carga-archivo').addClass('imagen-horizontal');
                            $('#imagen-cargada').addClass('imagen-horizontal');
                        }else{
                            console.log(2);
                            $('#carga-archivo').addClass('imagen-vertical');
                            $('#imagen-cargada').addClass('imagen-vertical');
                        }
                    }
                    img.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});

function segmentarTexto(clase) {
    var sel, range, node;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = window.getSelection().getRangeAt(0);

            var html = '<span class="'+clase+'">' + range + '</span>'
            range.deleteContents();

            var el = document.createElement("div");
            el.innerHTML = html;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
                lastNode = frag.appendChild(node);
            }
            range.insertNode(frag);
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        range.collapse(false);
        range.pasteHTML(html);
    }
}

/*
function segmentarTexto(clase=null, estilo=null, valor_estilo=null){
    // var highlight = window.getSelection()
    // if(highlight != ''){
    //     var spn = $('<span />').addClass(clase).text(highlight),
    //     text = $('#texto-personalizado .texto-personalizado').text(),
    //     range = highlight.getRangeAt(0),
    //     startText = text.substring(0, range.startOffset),
    //     endText = text.substring(range.endOffset, text.length);
    //     alert(spn.clone().wrap('<div>').parent().html());
    //     $('#texto-personalizado .texto-personalizado').html(startText + spn.clone().wrap('<div>').parent().html() + endText);
    // }

    var span = document.createElement("span");
    if(clase != null){
        span.classList.add(clase);
    }else if(estilo != null && valor_estilo != null){
        if(estilo == 'size'){
            span.style.fontSize = valor_estilo;
        }else if(estilo = 'weight'){
            span.style.fontWeight = valor_estilo;
        }
    }
    if (window.getSelection) {
        var sel = window.getSelection();
        if (sel.rangeCount) {

            // containerEl = sel.getRangeAt(0).commonAncestorContainer;
            // parentEl = sel.getRangeAt(0).commonAncestorContainer;
            // if (parentEl.nodeType != 1) {
            //     parentEl = parentEl.parentNode;
            //     alert(parentEl.textContent);
            // }

            alert(sel);
            var range = sel.getRangeAt(0).cloneRange();
            alert(range);
            range.surroundContents(span);
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }
}
*/

function exportarPng(){
    domtoimage.toPng(document.getElementById('bloque-personalizacion'))
        .then(function (dataUrl) {
            var link = document.createElement('a');
            link.download = 'mi-bomber.png';
            link.href = dataUrl;
            document.body.appendChild(link);
            console.log('Fin');
            link.click();
        }
    );
}

function gcd (width, height) {
    return (height == 0) ? width : gcd (height, width%height);
}
