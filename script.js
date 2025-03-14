let cart = JSON.parse(localStorage.getItem("cart")) || [];

document.addEventListener("DOMContentLoaded", () => {
    updateTotalCost();
    if (document.getElementById("cart-items")) {
        updateCartDisplay();
    }
});

function openItem(name, price, image) {
    localStorage.setItem("itemName", name);
    localStorage.setItem("itemPrice", price);
    localStorage.setItem("itemImage", image);
    window.location.href = "item.html";
}
function filterCategory(category, title) {
    let items = document.querySelectorAll(".item"); // Get all menu items
    let categoryTitle = document.getElementById("category-title");

    // Update category title
    categoryTitle.innerText = title;

    // Loop through each item and show/hide based on category
    items.forEach(item => {
        if (category === "all" || item.classList.contains(category)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
}

function updateTotalCost() {
    let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    
    // Update total in `cart.html`
    let cartTotalElement = document.getElementById("cart-total");
    if (cartTotalElement) {
        cartTotalElement.textContent = `PHP ${total.toFixed(2)}`;
    }

    // ✅ Update total in `index.html`
    let indexTotalElement = document.getElementById("total-cost");
    if (indexTotalElement) {
        indexTotalElement.textContent = `PHP ${total.toFixed(2)}`;
    }
}

function addToCart() {
    let name = localStorage.getItem('itemName');
    let price = parseFloat(localStorage.getItem('itemPrice'));
    let quantity = parseInt(document.getElementById('quantity').value);
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let existingItem = cart.find(item => item.name === name);
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({ name, price, quantity });
    }

    localStorage.setItem('cart', JSON.stringify(cart));

    // ✅ Update total cost immediately after adding to cart
    updateTotalCost();

    window.location.href = 'index.html';
}


function updateCartDisplay() {
    const cartContainer = document.getElementById("cart-items");
    if (!cartContainer) return;

    cartContainer.innerHTML = "";
    if (cart.length === 0) {
        cartContainer.innerHTML = "<p>Your cart is empty.</p>";
        return;
    }

    cart.forEach((item, index) => {
        let cartItem = document.createElement("div");
        cartItem.innerHTML = `
            <p>${item.name} - PHP ${item.price.toFixed(2)} x ${item.quantity}</p>
            <button onclick="removeItem(${index})">Remove</button>
        `;
        cartContainer.appendChild(cartItem);
    });

    localStorage.setItem("cart", JSON.stringify(cart));
}

function removeItem(index) {
    cart.splice(index, 1);
    updateCartDisplay();
    updateTotalCost();
}

function checkout() {
    if (cart.length === 0) {
        return;
    }

    fetch("http://localhost/lykke_kafe/process_order.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cart: cart })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            localStorage.removeItem("cart");
            cart = [];
            updateCartDisplay();
            updateTotalCost();
            window.location.href = "welcome.html";
        }
    })
    .catch(error => console.error("Error:", error));
}

function completeOrder() {
    checkout(); 
}

