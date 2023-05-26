//----------VALIDACION CON AJAX PARA COMPROBAR QUE LA CEDULA NO EXISTA
$(document).ready(function () {
var perm = /^([0-9])*$/;
    $('#ncedula').focusout(function () {
        if ($("#ncedula").val() == "" || !perm.test($("#ncedula").val()))
        {
            $('#msjver').html("<span style='color:#f00'>Ingrese solo numeros</span>");
            $('#btnreg').prop('disabled', true);
        } else {
        $.ajax({
            type: "POST",
            url: baseurl + "adminera/verificar_ncedula",
            data: "ncedula=" + $('#ncedula').val(),
            beforeSend: function () {
                $('#msjver').html('<span>Verificando...</span>');
            },
            success: function (respuesta) {
                if (respuesta == '<div style="display:none">1</div>') {
                    $('#msjver').html("<span style='color:#008000'>Correcto</span>");
                    $('#msjverbtn').html("<span></span>");
                    $('#btnreg').prop('disabled', false);
                } else {
                    $('#msjver').html('<span style="color:#f00">El numero de documento ya se enuentra registrado</span>');
                    $('#msjverbtn').html('<span style="color:#f00">El numero de documento ya se enuentra registrado</span>');
                    $('#btnreg').prop('disabled', true);
                }
            }

        });
        return false;
        }
    });
});
//----------VALIDACION CON AJAX PARA COMPROBAR QUE LA CEDULA NO EXISTA



$(document).ready(function () {
    //comprobamos si el usuario existe en la base de datos
    $('#form').submit(function () {
//        var fecha1= $("#fechas").val();
//        var fecha2= $("#fechass").val();
        if ($("#fechas").val() > $("#fechass").val())
        {
            
//            $('#btnregs').prop('disabled', true);
            $('#msjver').html("<span style='color:#f00'>La fecha no puede ser antes a la fecha de inicio</span>");
        return false;
        } else {
//            $('#btnregs').prop('disabled', false);
            $('#msjver').html("<span style='color:#0f0'>Ok</span>");
            return true;


            return false;
        }
    });
});

   


//----------VALIDACION PARA QUE INGRESE ALMENOS UN NUMERO DE CONTACTO

$(document).ready(function () {
    //comprobamos si el usuario existe en la base de datos
    $('#formava').submit(function () {
       var tel= $("#tel").val();
       var cel= $("#cel").val();
        if (cel==null)
        {
 
            $('#msjtel').html("<span style='color:#f00'>Ingrese un numero</span>");
        return false;
        } else {
//            $('#btnregs').prop('disabled', false);
            $('#msjtel').html("<span style='color:#0f0'>Ok</span>");
            return true;

        }
    });
});

/*funcion ajax para comprobar si el email existe en la base de datos*/
$(document).ready(function () {
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    $('#email').focusout(function () {
        if ($("#email").val() == "" || !emailreg.test($("#email").val()))
        {
            $('#msgEmail').html("<span style='color:#f00'>Ingrese un email correcto</span>");
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost/register_ajax/register/comprobar_email_ajax",
                data: "email=" + $('#email').val(),
                beforeSend: function () {
                    $('#msgEmail').html('Verificando...');
                },
                success: function (respuesta) {
                    if (respuesta == '<div style="display:none">1</div>')
                        $('#msgEmail').html("<span style='color:#0f0'>Email disponible</span>");
                    else
                        $('#msgEmail').html("<span style='color:#f00'>Email no disponible</span>");
                }
            });
            return false;
        }
    });
});




/*funcion ajax para comprobar si el email existe en la base de datos*/
$(document).ready(function () {
    var perm = /^[0-9]\d$/;
    $('#email').focusout(function () {
        if ($("#email").val() == "" || !perm.test($("#email").val()))
        {
            $('#msgEmail').html("<span style='color:#f00'>Ingrese un email correcto</span>");
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost/register_ajax/register/comprobar_email_ajax",
                data: "email=" + $('#email').val(),
                beforeSend: function () {
                    $('#msgEmail').html('Verificando...');
                },
                success: function (respuesta) {
                    if (respuesta == '<div style="display:none">1</div>')
                        $('#msgEmail').html("<span style='color:#0f0'>Email disponible</span>");
                    else
                        $('#msgEmail').html("<span style='color:#f00'>Email no disponible</span>");
                }
            });
            return false;
        }
    });
});