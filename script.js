function updateTotalCost() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

    let cartTotal = document.getElementById('cart-total');  
    let indexTotal = document.getElementById('total-cost'); 

    if (cartTotal) {
        cartTotal.textContent = `PHP ${total.toFixed(2)}`;
    }

    if (indexTotal) {
        indexTotal.textContent = `PHP ${total.toFixed(2)}`;
    }

    localStorage.setItem('cart', JSON.stringify(cart)); 
}



function addToCart(name, price, imageSrc) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let existingItem = cart.find(item => item.name === name);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ name, price, quantity: 1, image: imageSrc });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateTotalCost();
}




function openItem(name, price, image) {
    localStorage.setItem('itemName', name);
    localStorage.setItem('itemPrice', price);
    localStorage.setItem('itemImage', image);
    window.location.href = 'item.html';
}

function filterCategory(category, title) {
    let items = document.querySelectorAll('.item');
    document.getElementById('category-title').innerText = title;

    items.forEach(item => {
        if (category === 'all' || item.classList.contains(category)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
    } else {
        window.location.href = 'cart.html';
    }
}


function updateCartDisplay() {
    const cartContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    cartContainer.innerHTML = "";

    let total = 0;
    
    if (cart.length === 0) {
        cartContainer.innerHTML = "<p>Your cart is empty.</p>";
        cartTotal.textContent = "PHP 0.00";
        localStorage.removeItem('cart'); 
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
}

function removeItem(index) {
    cart.splice(index, 1);
    updateCartDisplay();
}

function completeOrder() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    
    alert("Order Completed! Thank you for shopping.");
    localStorage.removeItem('cart');
    window.location.href = "index.html";
}


document.addEventListener('DOMContentLoaded', () => {
    updateTotalCost();

    if (document.getElementById('cart-items')) {
        updateCartDisplay();
    }
});
