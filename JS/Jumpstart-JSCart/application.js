var JSCart = {
  update_cart_item_count : function () {
    var cart_items = $('div.cart_item');
    var total = 0;
    if (cart_items.length > 0) {
      cart_items.each(function(){
        var qty = parseInt($(this).find('span.qty').text());
        total += qty;
        $('span#cart_quantity').text(total);
      });
    } else {
      $('span#cart_quantity').text('0');
    }
  },
  update_cart_total : function () {
    var cart_items = $('div.cart_item');
    var total = 0;
    if (cart_items.length > 0) {
      cart_items.each(function(){
        var qty = parseInt($(this).find('span.qty').text());
        var price = parseFloat($(this).find('span.price').text());
        var item_price = qty * price;
        total += item_price;
        $('span#cart_price').text(total.toFixed(2));
      });
    } else {
      $('span#cart_price').text('0');
    }
  },
  update_cart : function () {
    this.update_cart_item_count();
    this.update_cart_total();
  }
};


$(function(){
  //Alphabetize the items in the inventory
  raw_inventory.sort(function(a, b){
    if (a.name < b.name) { return -1;}
    if (a.name > b.name) { return 1;}
    return 0;
  });

  var ri = $(raw_inventory), prototype_item = $('#prototype_item'), cart_item = $('#prototype_cart');
  prototype_item.detach();
  cart_item.detach();

  ri.each(function(){
    var prototype_item_clone = prototype_item.clone();

    prototype_item_clone.find('h3').text(this.name);
    prototype_item_clone.find('span.price').text(this.price);
    prototype_item_clone.find('span.qty').text(this.stock);
    prototype_item_clone.attr('id', 'product_'+this.product_id);
    $('#inventory').append(prototype_item_clone);

    prototype_item_clone.find('a').on('click', function(e){
      e.preventDefault(); e.stopPropagation();
      var cart_item_clone = cart_item.clone(), current_div = $(this).closest('div');
      cart_item_clone.find('h3').text(current_div.find('h3').text());
      cart_item_clone.find('span.price').text(current_div.find('span.price').text());
      cart_item_clone.find('span.qty').text(current_div.find('span.qty').text());
      cart_item_clone.attr('id', current_div.attr('id'));
      $('div.totals').before(cart_item_clone);

      JSCart.update_cart();

      // var qty = $('span#cart_quantity').text();
      // $('span#cart_quantity').text(parseInt(qty) + 1);
      // // console.log(qty);
    });
  });

  //Add a clickable link that clears the cart
  $('a#clear_cart').on('click', function(e){
    e.preventDefault(); e.stopPropagation();
    var cart_items = $('div.cart_item');
    cart_items.each(function(){
      $(this).detach();
    });
    JSCart.update_cart();
  });

  //Add a keyboard shortcut that clears the cart, ctrl + alt + k
  $('body').keyup(function(e){
    if (e.altKey && e.ctrlKey && e.which === 75) {
      $('a#clear_cart').click();
    }
  });
});