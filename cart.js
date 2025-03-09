let cart = JSON.parse(localStorage.getItem('cart')) || [];

function updateCartDisplay() {
    const cartContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    cartContainer.innerHTML = "";

    let total = 0;

    if (cart.length === 0) {
        cartContainer.innerHTML = "<p>Your cart is empty.</p>";
        cartTotal.textContent = "PHP 0.00";
        return;
    }

    cart.forEach((item, index) => {
        let itemTotal = item.price * item.quantity;
        total += itemTotal;

        let cartItem = document.createElement("div");
        cartItem.classList.add("cart-item");

        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}" class="cart-item-image"> 
            <div class="cart-item-details">
                <p>${item.name}</p>
                <p>PHP ${item.price.toFixed(2)}</p>
            </div>
            <div class="cart-item-controls">
                <button onclick="changeQuantity(${index}, -1)">-</button>
                <span>${item.quantity}</span>
                <button onclick="changeQuantity(${index}, 1)">+</button>
            </div>
            <button class="remove-btn" onclick="removeItem(${index})">Remove</button>
        `;

        cartContainer.appendChild(cartItem);
    });

    cartTotal.textContent = `PHP ${total.toFixed(2)}`;
    localStorage.setItem('cart', JSON.stringify(cart));
}


function changeQuantity(index, amount) {
    if (cart[index].quantity + amount > 0) {
        cart[index].quantity += amount;
    } else {
        cart.splice(index, 1);
    }
    updateCartDisplay();
    updateTotalCost();  
}

function removeItem(index) {
    cart.splice(index, 1); // Remove the item
    localStorage.setItem('cart', JSON.stringify(cart)); // Save updated cart
    updateCartDisplay(); 
    updateTotalCost();  

    if (cart.length === 0) {
        localStorage.removeItem('cart'); // Completely clear the cart
        document.getElementById('cart-items').innerHTML = "<p>Your cart is empty.</p>";
        document.getElementById('cart-total').textContent = "PHP 0.00";
    }
}



function completeOrder() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    
    alert("Order Completed! Thank you for your patronage :D");
    localStorage.removeItem('cart');
    updateTotalCost();
    window.location.href = "index.html";
}

document.addEventListener("DOMContentLoaded", () => {
    updateCartDisplay();
    updateTotalCost();  
});
