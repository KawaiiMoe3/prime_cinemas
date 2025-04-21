// ================================
// Global Variables
// ================================
let selections = window.selections || {}; // From Blade
let itemDetails = window.itemDetails || {}; // From Blade
let cartRoutes = window.cartRoutes || {};   // From Blade
let csrfToken = window.csrfToken || '';      // From Blade

let currentCartItemId = null;
let currentFoodItemId = null;
let currentSelections = { food: null, drink: null };
let currentQuantity = 1;

const foodOptions = window.foodOptionsList || [];
const drinkOptions = window.drinkOptionsList || [];

// ================================
// Helper Functions
// ================================
const showError = (title = 'Error', text = 'Something went wrong.') => {
    Swal.fire({ icon: 'error', title, text, confirmButtonColor: '#e50914' });
};

const showSuccess = (title = 'Success', text = '') => {
    Swal.fire({ icon: 'success', title, text, showConfirmButton: false, timer: 1500 });
};

const showConfirm = (title, text, confirmButtonText = 'Yes') => {
    return Swal.fire({
        title,
        text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e50914',
        cancelButtonColor: '#444',
        confirmButtonText
    });
};

// ================================
// Cart Management
// ================================
function updateCartCount() {
    fetch(cartRoutes.get)
        .then(res => res.json())
        .then(data => {
            const cartCount = document.getElementById('cart-count');
            const totalItems = data.cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
            cartCount.style.display = totalItems > 0 ? 'flex' : 'none';
        })
        .catch(() => console.error('Failed updating cart count'));
}

function renderCart() {
    fetch(cartRoutes.get)
        .then(res => res.json())
        .then(data => {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartEmptyMessage = document.getElementById('cart-empty');
            const cartTotalElement = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');
            const deleteAllBtn = document.getElementById('delete-all-btn');

            cartItemsContainer.innerHTML = '';

            if (data.cart.length === 0) {
                cartEmptyMessage.style.display = 'block';
                checkoutBtn.disabled = deleteAllBtn.disabled = true;
                cartTotalElement.textContent = '0.00';
                return;
            }

            cartEmptyMessage.style.display = 'none';
            checkoutBtn.disabled = deleteAllBtn.disabled = false;

            let total = 0;
            const table = document.createElement('table');
            table.className = 'table table-striped';
            table.innerHTML = `
                <thead><tr><th>Item</th><th>Qty</th><th>Unit Price (RM)</th><th>Subtotal (RM)</th><th>Action</th></tr></thead>
                <tbody></tbody>
                <tfoot><tr><td colspan="3" class="text-end"><strong>Total:</strong></td><td colspan="2"><strong>RM <span id="cart-final-total"></span></strong></td></tr></tfoot>
            `;

            data.cart.forEach(item => {
                const price = parseFloat(item.price) || 0;
                const subtotal = price * item.quantity;
                total += subtotal;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>${price.toFixed(2)}</td>
                    <td>${subtotal.toFixed(2)}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="confirmRemoveFromCart(${item.id})"><i class="fa-solid fa-trash"></i> Remove</button></td>
                `;
                table.querySelector('tbody').appendChild(row);
            });

            cartItemsContainer.appendChild(table);
            cartTotalElement.textContent = total.toFixed(2);
            document.getElementById('cart-final-total').textContent = total.toFixed(2);
        })
        .catch(() => showError('Failed to load cart'));
}

function addToCart(itemId) {
    const quantity = parseInt(document.getElementById(`quantity-${itemId}`).textContent);
    const payload = { item_id: itemId, quantity };

    if (selections[itemId] && (selections[itemId].food || selections[itemId].drink)) {
        payload.selections = selections[itemId];
    }

    fetch(cartRoutes.add, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) return showError('Oops...', data.error);
        renderCart();
        updateCartCount();
        showSuccess('Added to Cart!', `${itemDetails[itemId] || 'Item'} has been added.`);

        const modalElement = document.getElementById(`comboModal-${itemId}`) || document.getElementById(`snackModal-${itemId}`) || document.getElementById(`beverageModal-${itemId}`) || document.getElementById(`specialModal-${itemId}`);
        if (modalElement) {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();
        }
    })
    .catch(() => showError('Failed to add item'));
}

function confirmRemoveFromCart(cartItemId) {
    fetch(cartRoutes.get)
        .then(res => res.json())
        .then(data => {
            const item = data.cart.find(i => i.id === cartItemId);
            if (!item) return showError('Item not found in cart');

            showConfirm('Are you sure?', `Remove ${item.name}?`, 'Yes, remove it!').then(result => {
                if (result.isConfirmed) {
                    fetch(cartRoutes.remove, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                        body: JSON.stringify({ cart_item_id: cartItemId })
                    })
                    .then(res => res.json())
                    .then(() => {
                        showSuccess('Removed!');
                        renderCart();
                        updateCartCount();
                    })
                    .catch(() => showError('Failed to remove item'));
                }
            });
        })
        .catch(() => showError('Failed to load cart for removal'));
}

function confirmDeleteAll() {
    showConfirm('Are you sure?', 'Delete all items?').then(result => {
        if (result.isConfirmed) {
            fetch(cartRoutes.deleteAll, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(() => {
                showSuccess('Cart Cleared!');
                renderCart();
                updateCartCount();
            })
            .catch(() => showError('Failed to clear cart'));
        }
    });
}

function proceedToCheckout() {
    if (!window.isLoggedIn) {
        Swal.fire({
            title: 'Login Required',
            text: 'Please login to proceed with checkout!',
            icon: 'warning',
            confirmButtonText: 'Login Now',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#e50914',
            cancelButtonColor: '#444'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/login'; // or use named route if you prefer
            }
        });
        return; // Stop function here
    }

    fetch(cartRoutes.get)
        .then(res => res.json())
        .then(data => {
            if (data.cart.length === 0) return showError('Oops...', 'Your cart is empty!');
            window.location.href = '/checkout';
        })
        .catch(() => showError('Failed to check cart for checkout'));
}

// ================================
// Item Management (Options, Quantity, Edit)
// ================================
function selectOption(type, itemId, value, isInline = false) {
    if (isInline) {
        currentSelections[type] = value;
    } else {
        if (!selections[itemId]) {
            selections[itemId] = { food: null, drink: null }; // Auto create if missing!
        }
        selections[itemId][type] = value;
    }

    const containerId = isInline ? `edit-${type}-options` : `options-container-${type}-${itemId}`;
    document.querySelectorAll(`#${containerId} .option-item input[name="${type}-${itemId}"]`).forEach(opt => {
        const parent = opt.parentElement;
        if (opt.value === value) parent.classList.add('selected');
        else parent.classList.remove('selected');
    });

    if (!isInline && selections[itemId].food && selections[itemId].drink) {
        const btn = document.getElementById(`add-to-cart-${itemId}`);
        btn.style.opacity = '1';
        btn.style.pointerEvents = 'auto';
    }
}

function updateQuantity(itemId, change) {
    const el = document.getElementById(`quantity-${itemId}`);
    let qty = parseInt(el.textContent);
    el.textContent = Math.max(1, qty + change);
}

function updateEditQuantity(change) {
    currentQuantity = Math.max(1, currentQuantity + change);
    document.getElementById('edit-quantity').textContent = currentQuantity;
}

// ================================
// Initial Load
// ================================
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    renderCart();
});
