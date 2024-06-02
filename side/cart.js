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
let hiddenContainer = document.querySelector(".hidden-inputs");

selectBtn.forEach((btn, index) => {
  let quantity = quantities[index];
  let minus = minusAll[index];
  let plus = plusAll[index];

  plus.addEventListener("click", () => {
    document.querySelector(
      ".alert"
    ).innerHTML = `<div class="bg-red-100 border border-red-400 hover:bg-red-50 text-red-700 px-4 py-3 rounded space-x-4 flex items-center justify-between fixed bottom-5 right-5 ml-5 transition-all duration-200 z-20"
    role="alert">
            <strong class="font-bold text-sm">Can't add more than one currently.</strong>
            <span onclick="hideAlert(this);">
                <svg class="fill-current h-6 w-6 text-red-600 border-2 border-red-700 rounded-full" role="button"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>`;
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
    let value = btn.value;

    if (btn.checked) {
      //increamenting quantities
      totalQuantity += Number(quantity.innerHTML);
      totalPrice += price * Number(quantity.innerHTML);
      discount += (oldPrice - price) * Number(quantity.innerHTML);
      //check if containe already has it
      if (
        !hiddenContainer.innerHTML.includes(
          `<input type="hidden" name="item[]" value="${value}">`
        )
      ) {
        hiddenContainer.innerHTML += `<input type="hidden" name="item[]" value="${value}">`;
      }
    }
  });

  //taking delivery price
  let delPrice = 0;
  //giving delivery price
  deliveryPrices.forEach((deliveryPrice) => {
    if (deliveryPrice.checked == true) {
      delPrice += deliveryPrice.value * totalQuantity;
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
  totalDelivery.forEach((total) => (total.value = delPrice));
}
