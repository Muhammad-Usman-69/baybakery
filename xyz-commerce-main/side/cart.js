let quantities = document.querySelectorAll(".product-quantity");
let plusAll = document.querySelectorAll(".plus");
let minusAll = document.querySelectorAll(".minus");
let items = document.querySelectorAll(".item");
let oldPrices = document.querySelectorAll(".old-price")
let prices = document.querySelectorAll(".price");
let selectBtn = document.querySelectorAll(".select");
let totalItem = document.querySelector(".totalItem");
let discountPrice = document.querySelector(".discount");
let total = document.querySelector(".total");
let deliveryPrices = document.querySelectorAll(".delivery");
let totalDelivery = document.querySelector(".delivery-price")

selectBtn.forEach((btn, index) => {
    let quantity = quantities[index];
    let minus = minusAll[index];
    let plus = plusAll[index];

    plus.addEventListener("click", () => {
        quantity.innerHTML++;
        updateTotal();  
    });

    minus.addEventListener("click", () => {
        if (quantity.innerHTML > 1) {
            quantity.innerHTML--;
            updateTotal();
        }
    });

    btn.addEventListener("input", () => {
        updateTotal();
    });
});

function updateTotal() {
    let totalQuantity = 0;
    let totalPrice = 0;
    let discount = 0;
    selectBtn.forEach((btn, index) => {
        let quantity = quantities[index];
        let price = Number(prices[index].innerHTML);
        let oldPrice = Number(oldPrices[index].innerHTML);

        if (btn.checked) {
            //increamenting quantities
            totalQuantity += Number(quantity.innerHTML);
            totalPrice += price * Number(quantity.innerHTML);
            discount += (oldPrice - price) * Number(quantity.innerHTML);
        }

        
    });

    //taking delivery price
    let delPrice = 0;
    //giving delivery price
    deliveryPrices.forEach(deliveryPrice => {
        if (deliveryPrice.checked == true) {
            delPrice += deliveryPrice.value * totalQuantity;
            totalPrice = totalPrice + delPrice;
        }
    }) 
    
    //changing total quantity
    totalItem.innerHTML = totalQuantity;
    //changing total price
    total.innerHTML = totalPrice;
    //changing discount
    discountPrice.innerHTML = discount;
    //changing delivery price
    totalDelivery.innerHTML = delPrice;
}