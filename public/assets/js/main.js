/**
 * Created by motillaPalace on 13/07/2015.
 */
$( document ).ready(function() {
    $("button[name='end']").click(function( event ) {
        if($("#form_idprov")[0].value=="0") {
            alert("Por favor, selecciona al proveedor que realiza la entrega.");
            return false;
        }
        return true;
    });
    
    $("button[name='more']").click(function( event ) {
        if($("#form_idprov")[0].value=="0") {
            alert("Por favor, selecciona al proveedor que realiza la entrega.");
            return false;
        }
        return true;
    });

    $("input#form_entrega_submit").click(function( event ) {
        if($("#form_provider")[0].value=="0") {
            alert("Por favor, selecciona a un proveedor para ver su ficha final.");
            return false;
        }
        return true;
    });

    $("input#form_anticipo_submit").click(function( event ) {
        if($("#form_provider")[0].value=="0") {
            alert("Por favor, selecciona el proveedor al que quieres calcular el anticipo.");
            return false;
        }
        return true;
    });

    $("button[name='factura_submit']").click(function( event ) {
        if($("#form_idprov")[0].value=="0") {
            alert("Por favor, selecciona el proveedor para poder ver sus facturas o crear una nueva.");
            return false;
        }
        return true;
    });
});
