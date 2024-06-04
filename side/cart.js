let quantities = document.querySelectorAll(".product-quantity");
let plusAll = document.querySelectorAll(".plus");
let minusAll = document.querySelectorAll(".minus");
let items = document.querySelectorAll(".item");
let oldPrices = document.querySelectorAll(".old-price");
let prices = document.querySelectorAll(".price");
let selectBtn = document.querySelectorAll(".select");
let totalItem = document.querySelector(".totalItem");
let discountPrice = document.querySelector(".discount");
let total = document.querySelectorAll(".total");
let deliveryPrices = document.querySelectorAll(".delivery");
let totalDelivery = document.querySelectorAll(".delivery-price");
let hiddenContainerItems = document.querySelector(".hidden-item-inputs");
let hiddenContainerNums = document.querySelector(".hidden-num-inputs");

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

  //resseting container
  hiddenContainerItems.innerHTML = "";
  hiddenContainerNums.innerHTML = "";

  selectBtn.forEach((btn, index) => {
    let quantity = quantities[index];
    let price = Number(prices[index].innerHTML);
    let oldPrice = Number(oldPrices[index].innerHTML);
    let value = btn.value;

    if (btn.checked) {
      //increamenting quantities
      totalQuantity += Number(quantity.innerHTML);
      totalPrice += price * Number(quantity.innerHTML);
      discount += (oldPrice - price) * Number(quantity.innerHTML);
      //inserting item
      hiddenContainerItems.innerHTML += `<input type="hidden" name="item[]" value="${value}">`;
      //inserting num
      hiddenContainerNums.innerHTML += `<input type="hidden" name="num[]" value="${quantity.innerHTML}">`;
    }
  });

  //taking delivery price
  let delPrice = 0;
  //giving delivery price
  deliveryPrices.forEach((deliveryPrice) => {
    if (deliveryPrice.checked == true) {
      delPrice = Number(deliveryPrice.value);
      totalPrice = totalPrice + delPrice;
    }
  });

  //changing total quantity
  totalItem.innerHTML = totalQuantity;
  //changing total price
  total.forEach((total) => (total.value = totalPrice));
  //changing discount
  discountPrice.innerHTML = discount;
  //changing delivery price
  totalDelivery.forEach((total) => {
    total.value = delPrice;
  });
}

let scrolling;

//validing checkout
let form = document.querySelector("#checkout");

form.addEventListener("submit", (event) => {
  //preventing submit
  event.preventDefault();

  //check payment method
  let online = document.querySelector(".online").checked;

  //if cash on delivery
  if (!online) {
    form.submit();
    return;
  }

  //adding delivery
  document.getElementById("final-checkout").classList.toggle("hidden");
});

let paymentForm = document.querySelector("#payment-form");

paymentForm.addEventListener("submit", (event) => {
  //preventing submit
  event.preventDefault();

  //submitting form
  form.submit();
})