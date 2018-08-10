// from http://www.mediacollege.com/internet/javascript/number/round.html
function roundNumber(number,decimals) {
  var newString;// The new rounded number
  decimals = Number(decimals);
  if (decimals < 1) {
    newString = (Math.round(number)).toString();
  } else {
    var numString = number.toString();
    if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
      numString += ".";// give it one at the end
    }
    var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
    var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
    var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
    if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
      if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
        while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
          if (d1 != ".") {
            cutoff -= 1;
            d1 = Number(numString.substring(cutoff,cutoff+1));
          } else {
            cutoff -= 1;
          }
        }
      }
      d1 += 1;
    } 
    if (d1 == 10) {
      numString = numString.substring(0, numString.lastIndexOf("."));
      var roundedNum = Number(numString) + 1;
      newString = roundedNum.toString() + '.';
    } else {
      newString = numString.substring(0,cutoff) + d1.toString();
    }
  }
  if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
    newString += ".";
  }
  var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
  for(var i=0;i<decimals-decs;i++) newString += "0";
  //var newNumber = Number(newString);// make it a number if you like
  return newString; // Output the result to the form field (change for your purposes)
}

function update_parcial() {
    var subtotal = 0;
    $('.precio').each(function(i){
        precio = $(this).html().replace(" €","");
        //precio = $(this).html();
        if (!isNaN(precio)) subtotal += parseFloat(precio);
    });

    subtotal = roundNumber(subtotal,2);
    $('#subtotal').html(subtotal+" &euro;");

    iva = $.trim($("#iva").val());
    total_iva = roundNumber(((subtotal * Number(iva)) / 100 ),2);
    parcial = Number(subtotal) + Number(total_iva);
    parcial = roundNumber(parcial,2);

    $('#parcial').html(parcial+" &euro;");
    $('.total-iva').html(total_iva+" &euro;");
    //$('.total_fac').html(total+" &euro;");
    update_total_fac();
}

function update_total_fac() {
    var parcial;
    if($("#parcial").html())
        parcial = $("#parcial").html().replace(" €","");
    var total_fac;
    if($(".total_fac").html())
        total_fac = $(".total_fac").html().replace(" €","");
    var retencion = $("#retencion").val();
    var cuota = $("#cuota").val()=="" ? 0 : $("#cuota").val();
    var total_retencion = roundNumber((Number(parcial) * retencion) / 100,2);
    total_fac = Number(parcial) - total_retencion;
    total_fac = total_fac.toFixed(2) - parseFloat(cuota);
    total_fac = roundNumber(total_fac,2);

    $('.total_fac').html(total_fac+" &euro;");
    $('.total-retencion').html(total_retencion+" &euro;");
    $("input[name='total_factura']").val(total_fac);
}

function update_precio() {
    var row = $(this).parents('.item-row');
    var row_id = $(this).parents('.item-row').attr("data-id");
    var precio = parseFloat(row.find('.coste').val()) * parseInt(row.find('.kg').val());
    precio = roundNumber(precio,2);
    isNaN(precio) ? row.find('.precio').html("N/D") : row.find('.precio').html(precio + " &euro;");
    var values = {"id":row_id,"concepto":row.find('.item-concept textarea').val(),"precio":row.find('.coste').val(),"kg":row.find('.kg').val(),"importe":precio}

    $.ajax({
        type: "POST",
        url: "../../lineas/edit",
        data: values,
        dataType: "json",
        cache: false
    }).done(function(data) {
        update_parcial();
    }).fail(function(data) {
        alert("ERROR al actualizar la línea actual de factura. Por favor, inténtelo más tarde.");
    });
}

function bind_bill() {
  $(".coste").blur(update_precio);
  $(".kg").blur(update_precio);
  $(".item-concept textarea").blur(update_precio);
}

$(document).ready(function() {

    $('input').click(function(){
        $(this).select();
    });

    $('body').on('click',"input[name='submit_lines']", function(){
        var comment = $(".comment textarea").val();
        var cuota = $("textarea#cuota").val();
        var ret = $("textarea#retencion").val();
        var iva = $("textarea#iva").val();
        $("input[name='iva']").val(iva);
        $("input[name='retencion']").val(ret);
        $("input[name='comentario']").val(comment);
        $("input[name='cuota']").val(cuota);
    });

    //Add a new line to the current invoice
    $("#addrow_bill").click(function(){
        var orden = $("tr.item-row").length+1;
        var values = {"idfactura":$("input#idfactura").val(),"orden":orden,"concepto":"___Concepto___","precio":0.00,"kg":1};

        $.ajax({
            type: "POST",
            url: "../../lineas/create",
            data: values,
            dataType: "json",
            cache: false
        }).done(function(data) {
            if($(".delete").length == 0){
                $("tr#hiderow").before('<tr class="item-row" data-id="' + data.id + '"><td class="item-concept"><div class="delete-wpr"><textarea>___Concepto___</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td><td><textarea class="coste">0.00</textarea> &euro;</td><td><textarea class="kg">1</textarea></td><td><span class="precio">0.00 &euro;</span></td></tr>');
            }
            else {
                $(".item-row:last").after('<tr class="item-row" data-id="' + data.id + '"><td class="item-concept"><div class="delete-wpr"><textarea>___Concepto___</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td><td><textarea class="coste">0.00</textarea> &euro;</td><td><textarea class="kg">1</textarea></td><td><span class="precio">0.00 &euro;</span></td></tr>');
            }
            if ($(".delete").length > 0) $(".delete").show();
            bind_bill();
        }).fail(function(data) {
            alert("ERROR al insertar una nueva línea de factura. Por favor, inténtelo más tarde.");
        });
    });

    bind_bill();

    //Delete invoice line
    $('body').on('click',".delete",function(){
        var value = {"id":$(this).parents(".item-row").attr("data-id")};

        $.ajax({
            type: "POST",
            url: "../../lineas/delete",
            data: value,
            dataType: "json",
            cache: false
        }).done(function(data) {
            //$(this).parents('.item-row').remove();
            $( "tr[data-id="+data.id+"]").remove();
            update_parcial();
        }).fail(function(data) {
            alert("ERROR al borrar línea de factura seleccionada. Por favor, inténtelo más tarde.");
        });

        if ($(".delete").length < 2) $(".delete").hide();
    });

    $('body').on('blur',"#iva",function(){
        update_parcial();
    });

    $('body').on('blur',"#retencion",function(){
        update_total_fac();
    });

    $('body').on('blur',"#cuota",function(){
        update_total_fac();
    });

    update_parcial();
});