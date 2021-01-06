$(document).ready(function () {
	let selectedTopping = [];
	let selectedPizza = [];
	let total = 0;
	let baseUrl = "http://localhost/2017296/PizzaNow/index.php/cart";
	let baseUrlServer = "https://w1697753.users.ecs.westminster.ac.uk/2017296/PizzaNow/index.php/cart";

	$(".customize-pizza-topping").on("click", function () {
		let topping = {
			'toppingId': $(this).data('topping_id'),
			'toppingName': $(this).data('topping_name'),
			'toppingPrice': $(this).data('topping_price'),
		}
		let index = selectedTopping.findIndex(x => x.toppingId === topping.toppingId);

		if (index === -1) {
			selectedTopping.push(topping);
		} else {
			selectedTopping.splice(index, 1);
			if (selectedTopping.length === 0) {
				topping.toppingName = 'please select your toppings'
			}
		}
		$(this).toggleClass('item-selected', this.checked);
		$(this).parent('.customization').toggleClass('d-block');
		$('#selected-topping').html(selectedTopping.map(x => x.toppingName) + ' selected');
		calculatePizzaTotal(this);
	});

	$(".customize-pizza").click(function () {
		let pizza = {
			'pizzaId': $(this).data('pizza_id'),
			'pizzaName': $(this).data('pizza_name'),
			'pizzaSize': $(this).data('pizza_size'),
			'pizzaPrice': $(this).data('pizza_price'),
			'pizzaDescription': $(this).data('pizza_description'),
			'pizzaImgUrl': $(this).data('pizza_img_url'),
			'is_selected': true
		}
		let index = selectedPizza.findIndex(x => x.pizzaId === pizza.pizzaId);
		if (index === -1) {
			selectedPizza.push(pizza);
		} else {
			if (index === 0 && selectedPizza.length === 0) {
				pizza.pizzaSize = 'Please select size';
				pizza.is_selected = true
				selectedPizza.splice(index, 1);
			} else {
				pizza.is_selected = true;
				selectedPizza.splice(index, 1);
				selectedPizza.push(pizza);
			}
		}

		$('#selected-size').html(pizza.pizzaSize + ' selected');
		calculatePizzaTotal(this);
	});


	$('.pizza-quantity input').change(function () {
		let quantity = $(this).closest('.pizza-quantity').find('.quantity_val').val();
		$('input[type="number"]').keydown(function (e) {
			e.preventDefault();
		});
		if (parseInt(quantity) === 0) {
			alert('please enter valid quantity');
		}
		calculatePizzaTotal(this);
	})

	$('.btn-customize-pizza button').click(function () {

		if (selectedPizza.length < 1) {
			alert('Please select pizza size');
		} else {
			let quantity = $('.quantity_val').val();
			let url = baseUrl + "/addToCart";

			let item = {
				'type': 'PIZZA',
				'id': selectedPizza[0].pizzaId,
				'name': selectedPizza[0].pizzaName,
				'description': selectedPizza[0].pizzaDescription,
				'imgUrl': selectedPizza[0].pizzaImgUrl,
				'price': selectedPizza[0].pizzaPrice,
				'size': selectedPizza[0].pizzaSize,
				'selectedTopping': selectedTopping,
				'qty': quantity,
				'itemTotal': total / quantity,
				'total': total,
			}
			$.ajax({
				url: url,
				method: "POST",
				data: item,
				success: function (data) {
					window.location = '/2017296/PizzaNow/index.php/cart';
				},
				error: function () {
					alert('Please try again');
				}
			})
		}
	});

	function calculatePizzaTotal() {
		let toppingPrice = selectedTopping.map(x => parseFloat(x.toppingPrice));
		let pizzaPrice = selectedPizza.map(x => parseFloat(x.pizzaPrice));
		let totTopping = toppingPrice.reduce((a, b) => a + b, 0);
		let totPizza = pizzaPrice.reduce((a, b) => a + b, 0);
		let quantity = $('.quantity_val').val();

		total = (totTopping + totPizza) * parseInt(quantity);
		$('.total-value').html(total.toFixed(2));
	}

});
