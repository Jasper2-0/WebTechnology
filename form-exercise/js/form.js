$(document).ready(function () {
    
    var recalc = function(){recalcPrice();};
    
    $('.box').click(recalc).change(recalc).keyup(recalc);
    
    $("#orderForm").validate({
        debug:true,
        rules: {
            naam:{
                required:true

            },
            straat:{
                required:true
            },
            huisnummer:{
                required:true,
                number:true
            },
            toevoeging:{
                maxlength:5
            },
            postcode:{
                required:true,
                postalcodeNL:true
            },
            plaats:{
                required:true
            },
            telefoonnummer:{
                phoneNL:true
            },
            email:{
                required:true,
                email:true
            },
            alg:{
                required:true
            }
        },
        messages:{
            alg:{
                required:"U dient akkoord te gaan met de algemene voorwaarden."
            }
        },
		submitHandler: function(form) {
			form.submit();
		}
    });
});

function recalcPrice() {

    var boxAmount = sum(getBoxAmounts());
    var boxPrice = (boxAmount*6) + (boxAmount*20);
    
    updateBoxTotal(boxAmount);
    updateBoxPrice(boxPrice);
}

function updateBoxTotal(boxTotal) {
    $('#boxTotal').html(boxTotal);
}

function updateBoxPrice(boxPrice) {
    $('#boxPrice').html(boxPrice);
}

function getBoxAmounts() {
    var boxes = [];
    
    boxes.push(parseInt($('#redBox').val(), 10));
    boxes.push(parseInt($('#blueBox').val(), 10));
    boxes.push(parseInt($('#greyBox').val(), 10));
    boxes.push(parseInt($('#blackBox').val(), 10));
    
    return boxes;
}

function sum(arr) {
    var arrSum = 0;
    
    for(var i=0;i<arr.length;i++) {
        arrSum += arr[i];
    }
    return arrSum;
}