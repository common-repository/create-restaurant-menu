

// update total item amount
function updatesitemamount(divid) {
    var btn1 = $('#'+divid+'-btn1');
    var btn2 = $('#'+divid+'-btn2');
    var basetitle = $('#'+divid+'-title');
    var baseprice1 = basetitle.attr('base-price1');
    var baseprice2 = basetitle.attr('base-price2');
//    console.log(baseprice2);
    var ptheaddval = $('#'+divid+'-primary').children("option:selected");
    if(ptheaddval.length) {
        ptheaddval = ptheaddval.attr('data-price');
        if(!ptheaddval) {
            ptheaddval = 0;
        } else {
            ptheaddval = parseFloat(ptheaddval);
        }
    } else {
        ptheaddval = 0;
    }
    var stheaddval = $('#'+divid+'-secondary').children("option:selected");
    if(stheaddval.length) {
        stheaddval = stheaddval.attr('data-price');
        if(!stheaddval) {
            stheaddval = 0;
        }
    } else {
        stheaddval = 0;
    }
    stheaddval = parseFloat(stheaddval);
    baseprice1 = parseFloat(baseprice1);
    
    var csymbol = basetitle.attr('currency');
    var totalcostnow1 = baseprice1+ptheaddval+stheaddval;
    totalcostnow1 = parseFloat(totalcostnow1).toFixed(2);
    btn1.html('&nbsp;<strong>'+csymbol+totalcostnow1+'</strong>');
    btn1.attr("data-price",totalcostnow1);
    if(baseprice2) {
        baseprice2 = parseFloat(baseprice2);
        var totalcostnow2 = baseprice2+ptheaddval+stheaddval;
        totalcostnow2 = parseFloat(totalcostnow2).toFixed(2);
        btn2.html('&nbsp;<strong>'+csymbol+totalcostnow2+'</strong>');
        btn2.attr("data-price",totalcostnow2);
    }
    
}