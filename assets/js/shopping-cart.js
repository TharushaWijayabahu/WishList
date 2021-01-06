$(document).ready(function() {

	let fadeTime = 300;
	const baseUrl = "http://localhost/2017296/PizzaNow/index.php/cart";
	const baseUrlSever = "https://w1697753.users.ecs.westminster.ac.uk/2017296/PizzaNow/index.php/cart";

	/* Assign actions */
	$('.product-quantity input').change( function() {
		let quantity = $(this).closest('.product-quantity').find('.quantity_val').val();
		let id = $(this).closest('.product-quantity').find('.item_id_val').val();
		let url = baseUrl + "/addQuantity";

		$('input[type="number"]').keydown(function (e) {
			e.preventDefault();
		});
		if(parseInt(quantity) === 0){
			alert('Please enter valid quantity')
		}else{
			$.ajax({
				url: url,
				method: "POST",
				data: {
					'id': id,
					'quantity': quantity
				},
				success: function() {
					location.reload();
				},
				error: function() {
					alert('please try again')
				}
			})
			updateQuantity(this);
		}
	});

	$('.product-removal button').click( function() {
		let id = $(this).data("id");
		let url = baseUrl + "/removeItem";
		$.ajax({
			url: url,
			method: "POST",
			data: {
				'id' : id
			},
			success: function() {
				location.reload();
			},
			error: function() {
				alert('please try again')
			}
		})
		removeItem(this);
	});

	$('.btn-customize-mobile button').click( function() {

		let url = baseUrl + "/addToCart";
		let item = {
			'type' : $(this).data("type"),
			'id' :$(this).data("id"),
			'name' :$(this).data("name"),
			'description' :$(this).data("description"),
			'imgUrl' :$(this).data("img_url"),
			'price' :$(this).data("price"),
			'qty' :$(this).data("qty"),
		}
		$.ajax({
			url: url,
			method: "POST",
			data: item,
			success: function() {
				window.location = '/2017296/PizzaNow/index.php/cart';
			},
			error: function() {
				alert('please try again');
			}
		})
	});

	/* Recalculate cart */
	function recalculateCart()
	{
		let subtotal = 0;

		/* Sum up row totals */
		$('.product').each(function () {
			subtotal += parseFloat($(this).children('.product-line-price').text());
		});
		let total = subtotal ;
		/* Update totals display */
		$('.totals-value').fadeOut(fadeTime, function() {
			$('#cart-subtotal').html(subtotal.toFixed(2));
			if(total === 0){
				$('.checkout').fadeOut(fadeTime);
			}else{
				$('.checkout').fadeIn(fadeTime);
			}
			$('.totals-value').fadeIn(fadeTime);
		});
	}


	/* Update quantity */
	function updateQuantity(quantityInput)
	{
		/* Calculate line price */
		let productRow = $(quantityInput).parent().parent();
		let price = parseFloat(productRow.children('.product-price').text());
		let quantity = $(quantityInput).val();
		let linePrice = price * quantity;
		/* Update line price display and recalc cart totals */
		productRow.children('.product-line-price').each(function () {
			$(this).fadeOut(fadeTime, function() {
				$(this).text(linePrice.toFixed(2));
				recalculateCart();
				$(this).fadeIn(fadeTime);
			});
		});
	}


	/* Remove item from cart */
	function removeItem(removeButton)
	{
		/* Remove row from DOM and recalc cart total */
		let productRow = $(removeButton).parent().parent();
		productRow.slideUp(fadeTime, function() {
			productRow.remove();
			recalculateCart();
		});
	}
});
