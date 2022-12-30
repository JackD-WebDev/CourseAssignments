// CIS-14A-48204
// Jack Daly 🥷 
// CIS 14: Shopping Cart Lab
// Updated 11/17/22

let cart = [];
let total = 0;
const cartPopup = document.querySelector('.cart-popup');

const renderCart = (cart, total) => {
  const cartContainer = document.querySelector('.cart-container');
  cartContainer.innerHTML = cart.map((item) => {
    return `
      <div class="cart-item">
        <div class="cart-item-name">${item.description[0]} - ${item.description[1]}</div>
        <div class="cart-item-price">${item.quantity} @ $${item.price}</div>
        <div class="cart-item-total">$${item.price * item.quantity}</div>
      </div>
    `;
  }).join('');
  cartContainer.innerHTML += `
    <div class="cart-total">
      Total: $${total}
    </div>
  `;
}

document.querySelectorAll('.minus-btn').forEach((item) => {
  item.addEventListener('click', function() {
    const input = this.previousElementSibling;
    if (input.value > 0) {
      input.value--;
    }
  });
});

document.querySelectorAll('.plus-btn').forEach((item) => {
  item.addEventListener('click', function() {
    const input = this.nextElementSibling;
    input.value++;
  });
});

document.querySelectorAll('.delete-btn').forEach((item) => {
  item.addEventListener('click', function() {
    const product = this.parentElement.parentElement;
    product.remove();
  });
});

document.querySelectorAll('.like-btn').forEach(item =>   
  item.addEventListener('click', event => {
    item.classList.toggle('is-active');  
  })
);

const checkout = () => {
  const item = document.querySelectorAll('.item');

    if(item.length !== 0) {
      if(item[0] && item[0].querySelector('.quantity').getElementsByTagName('input')[0].value > 0) {
        const description1 = [item[0].querySelector('.description').getElementsByTagName('span')[0].innerHTML, item[0].querySelector('.description').getElementsByTagName('span')[1].innerHTML];
          
        const price1 = parseInt(item[0].querySelector('.total-price').innerHTML.substring(1));

        const quantity1 = item[0].querySelector('.quantity').getElementsByTagName('input')[0].value;

        let item1 = {
          description: description1,
          price: price1,
          quantity: quantity1
        };
        
        total += item1.price * parseInt(item1.quantity);
        cart.push(item1);
      }

    if(item[1] && item[1].querySelector('.quantity').getElementsByTagName('input')[0].value > 0) {
      const description2 = [item[1].querySelector('.description').getElementsByTagName('span')[0].innerHTML, item[1].querySelector('.description').getElementsByTagName('span')[1].innerHTML];
        
      const price2 = parseInt(item[1].querySelector('.total-price').innerHTML.substring(1));

      const quantity2 = item[1].querySelector('.quantity').getElementsByTagName('input')[0].value;

      let item2 = {
        description: description2,
        price: price2,
        quantity: quantity2
      };
      
      total += item2.price * parseInt(item2.quantity);
      cart.push(item2);
    }

    if(item[2] && item[2].querySelector('.quantity').getElementsByTagName('input')[0].value > 0) {
      const description3 = [item[2].querySelector('.description').getElementsByTagName('span')[0].innerHTML, item[2].querySelector('.description').getElementsByTagName('span')[1].innerHTML];

      const price3 = parseInt(item[2].querySelector('.total-price').innerHTML.substring(1));

      const quantity3 = item[2].querySelector('.quantity').getElementsByTagName('input')[0].value;

      let item3 = {
          description: description3,
          price: price3,
          quantity: quantity3
      };

      total += item3.price * parseInt(item3.quantity);
      cart.push(item3);
    }  
    JSON.stringify(cart);
    cartPopup.style.display = 'block';
  }

  renderCart(cart, total);
  cart = [];
  total = 0;
}

window.onclick = function(event) {
  if(event.target == cartPopup) {
    cartPopup.style.display = "none";
  }
}