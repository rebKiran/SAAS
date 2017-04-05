$().ready(function () {
    $("#add_to_cart").click(function () {
		var btn_val = $(this).text();
		
		
        if ($('#qty').val() === '' || $('#qty').val() === '0') {
            $('#qty').css({"border-color": "red"});
            $('#qty').focus();
            return false;
        }
		
        if ($('#size').val() === '' || $('#size').val() === '0') {
            $('#size').css({"border-color": "red"});
            $('#size').focus();
            return false;
        }
		var name = $('#name').val();
		name = name.trim();
        $.ajax({
            type: "POST",
            url: base_url + 'add_to_cart',
            data: {
                id: $('#product_id').val(),
                qty: $('#qty').val(),
                price: $('#price').val(),
                name: name,
                desc: $('#desc').val(),
                product_img: $('#product_img').val(),
                color: $('#color').val()
            },
            dataType: 'json',
            success: function (data)
            {
				
                if (data.status === '1') {
                    $("#msg").html("<font style='color:green'>"+data.msg+"<i class='fa fa-check' aria-hidden='true'></i></font>");
					
					if('Donate' == btn_val ) { 
						window.location.href = base_url+'cart/checkout'
					} else {
						window.location.href = base_url+'cart'
					}	
                }

            }
        });
    });
	
	$(".add_to_cart").click(function () {
		var btn_val = $(this).text();
		
		if('Donate' == btn_val ) { 
			/*if('undefined' == $("input[name='radios1']:checked").val() ) {
				return false;
			}*/	
			
			var price = $(this).parent("div").parent("div").find("input").val();
			if('' == price){
				alert('Please enter amount');
				return false;
			}
			
		}
        if ($('#qty').val() === '' || $('#qty').val() === '0') {
            $('#qty').css({"border-color": "red"});
            $('#qty').focus();
            return false;
        }
		
        if ($('#size').val() === '' || $('#size').val() === '0') {
            $('#size').css({"border-color": "red"});
            $('#size').focus();
            return false;
        }
		var name = $('#name').val();
		name = name.trim();
        $.ajax({
            type: "POST",
            url: base_url + 'add_to_cart_project',
            data: {
                id: $('#product_id').val(),
				project_id: $('#product_id').val(),
                qty: $('#qty').val(),
                price: price,
                name: name,
                desc: $('#desc').val(),
                product_img: $('#product_img').val(),
                color: $('#color').val()
            },
            dataType: 'json',
            success: function (data)
            {
				
                if (data.status === '1') {
                    $("#msg").html("<font style='color:green'>"+data.msg+"<i class='fa fa-check' aria-hidden='true'></i></font>");
					
					if('Donate' == btn_val ) { 
						window.location.href = base_url+'cart/checkout'
					} else {
						window.location.href = base_url+'cart'
					}	
                }

            }
        });
    });

});


function removeItem(rowid) {
    $.ajax({
        type: "POST",
        url: base_url + 'remove_item_cart',
        data: {
            rowid: rowid
        },
        dataType: 'json',
        success: function (data)
        {
            if (data.status === '1') {
                $("#successmsg").html('<div class="alert alert-success"><strong>Item removed from cart.</div>');
                 setTimeout(function () {
                    window.location.reload(1);
                }, 1000);
            }

        }
    });
}

function updateCart(qty, rowid) {

    $.ajax({
        type: "POST",
        url: base_url + 'update_cart',
        data: {
            rowid: rowid,
            qty: qty
        },
        dataType: 'json',
        success: function (data)
        {
            if (data.status === '1') {
                $("#successmsg").html('<div class="alert alert-success"><strong>Your cart has been updated.</div>');
                setTimeout(function () {
                    window.location.reload(1);
                }, 2000);
            }

        }
    });
}

$().ready(function () {
    $("#validCoupon").click(function () {
        if ($('#couponcode').val() === '') {
            $('#couponcode').css({"border-color": "red"});
            $('#couponcode').focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: base_url + 'validateCoupon',
            data: {
                code: $('#couponcode').val()
            },
            dataType: 'json',
            success: function (data)
            {
                //alert(data);
                if (data.status === '0') {
                    $("#msg").html('<font style=color:red>'+data.msg+'</font>');
                }else{
                    $("#msg").html('<font style=color:green>'+data.msg+'</font>');
                    $("#totamt").text(data.discounted_amount);
                }

            }
        });
    });

});
