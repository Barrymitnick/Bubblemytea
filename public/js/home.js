function showProduct(product) {
    document.getElementsByClassName('product-details-title')[0].innerHTML = product.Name;
    document.getElementsByClassName('product-details-description')[0].innerHTML = product.Description;
    document.getElementsByClassName('product-details-price')[0].innerHTML = product.Price + ' €';
    document.getElementsByClassName('product-details-image')[0].setAttribute('src', product.Image);
    document.getElementById('number').innerHTML = '1';
    document.getElementById('hideProductId').setAttribute('value', product.Id);
    $('#product-details-modal').modal('show');
}

function plus() {
    const val = document.getElementById('number').textContent;
    document.getElementById('number').innerHTML = parseInt(val) + 1;
    document.getElementById('hideQty').setAttribute('value', parseInt(val) + 1);
}

function minus() {
    const val = document.getElementById('number').textContent;
    if (val > 1) {
        document.getElementById('number').innerHTML = parseInt(val) - 1;
        document.getElementById('hideQty').setAttribute('value', parseInt(val) - 1);
    }
}
