function updateBadges() {
    fetch('getCountCart.php')
        .then(res => res.text())
        .then(c => document.querySelector('.carts').innerText = c);

    //  fetch('getCountCompare.php')
    //     .then(res => res.text())
    //     .then(c => document.querySelector('#comapreData').innerText = c);
}

setInterval(updateBadges, 10000);
updateBadges();

function addToCart(pid) {
    fetch('addToCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: "product_id=" + pid
    })
        .then(res => res.text())
        .then(() => updateBadges())
        .catch(err => console.error('Error adding to cart:', err));

}

function updateQty(id, qty) {
    fetch('EditCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: "product_id=" + id + "&qty=" + qty
    })
        .then(res => res.text())
        .then(() => {
            updateBadges();
            location.reload(); // Reload the page to reflect changes
        })
        .catch(err => console.error('Error updating quantity:', err));
}

function deleteItem(id) {
    if (!confirm("Are you sure you want to delete this item?")) {
        return;
    }
    fetch('cartDelete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: "product_id=" + id
    }).then(res => res.text())
        .then(() => {
            updateBadges();
            location.reload(); // Reload the page to reflect changes
        })
        .catch(err => console.error('Error deleting item:', err));
}
// function addToCompare(pid) {
//     fetch('addToCompare.php',{
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         body: "product_id=" + pid
//     })
//     .then(res => res.text())
//     .then(() => updateBadges())
//     .catch(err => console.error('Error adding to compare:', err));
// }