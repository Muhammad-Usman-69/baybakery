if (document.querySelector(".banner")) {
    const bannerContainer = document.querySelector(".banner");
    const bannerImg = document.querySelectorAll(".banner img");

    const scrollAmount = bannerContainer.offsetWidth;
    let currentPosition = 0;
    let clickTime = Date.now();

    function scrollImgRight() {
        clickTime = Date.now();
        currentPosition += scrollAmount;
        bannerContainer.scrollLeft = currentPosition;

        if (currentPosition == (scrollAmount * bannerImg.length)) {
            bannerContainer.scrollLeft = 0;
            currentPosition = 0;
        }
    }

    function scrollImgLeft() {
        clickTime = Date.now();
        currentPosition -= scrollAmount;
        bannerContainer.scrollLeft = currentPosition;
    }

    setInterval(() => {
        if (Date.now() - clickTime >= 4000) {
            scrollImgRight();
        }
    }, 1);
}

if (document.querySelector(".sale_info")) {
    setInterval(updateCountdown, 1000);
}

user = document.querySelector(".user");
function showUser() {
    user.classList.toggle("hidden");
}

function updateCountdown() {
    let curDate = Date.now();
    const desDate = new Date("2030/1/1");
    let milliDesDate = desDate.getTime();
    let newDate = milliDesDate - curDate;

    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;

    // const days = Math.floor(newDate / day);
    const hours = Math.floor((newDate % day) / hour);
    const minutes = Math.floor((newDate % hour) / minute);
    const seconds = Math.floor((newDate % minute) / second);

    // const paddedDays = days < 10 ? `0${days}` : days;
    const paddedHours = hours < 10 ? `0${hours}` : hours;
    const paddedMinutes = minutes < 10 ? `0${minutes}` : minutes;
    const paddedSeconds = seconds < 10 ? `0${seconds}` : seconds;

    document.querySelector(".hours").innerHTML = paddedHours;
    document.querySelector(".minutes").innerHTML = paddedMinutes;
    document.querySelector(".seconds").innerHTML = paddedSeconds;
}

if (document.querySelector(".quantity-number")) {
    let quantity = document.querySelector(".quantity-number");
    let plus = document.querySelector(".plus");
    let minus = document.querySelector(".minus");

    plus.addEventListener("click", () => {
        quantity.innerHTML++;
    });

    minus.addEventListener("click", () => {
        if (quantity.innerHTML > 1) {
            quantity.innerHTML--;
        }
    });
}

if (document.querySelector(".form")) {
    let inputs = document.querySelectorAll(".input");
    let labels = document.querySelectorAll(".label");

    inputs.forEach((input, index) => {
        let label = labels[index];
        input.addEventListener("input", () => {
            if (input.value !== "") {
                label.classList.add("filled");
                input.classList.add("border-blue-500");
            } else {
                label.classList.remove("filled");
                input.classList.remove("border-blue-500");
            }
        })
    })
}

if (document.querySelector(".prod-cart")) {
    let quantities = document.querySelectorAll(".product-quantity");
    let plusAll = document.querySelectorAll(".plus");
    let minusAll = document.querySelectorAll(".minus");
    let items = document.querySelectorAll(".item");
    let prices = document.querySelectorAll(".price");
    let selectBtn = document.querySelectorAll(".select");
    let selectAll = document.querySelector(".selectAll");
    let totalItem = document.querySelectorAll(".totalItem");
    let totalPriceBf = document.querySelector(".totalPrice");
    let finalPrice = document.querySelector(".finalPrice");
    let deliveryCharge = document.querySelectorAll(".deliveryPrice");
    let totalDelivery = document.querySelector(".delivery");

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
        let oneChecked = false;
        let totalDel = 0;

        selectBtn.forEach((btn, index) => {
            let quantity = quantities[index];
            let price = Number(prices[index].innerHTML);
            let delPrice = Number(deliveryCharge[index].innerHTML);

            if (btn.checked) {
                totalQuantity += Number(quantity.innerHTML);
                totalPrice += price * Number(quantity.innerHTML);
                totalDel += Number(delPrice) * Number(quantity.innerHTML);

                oneChecked = true;
            }

            setTimeout(() => {
                if (btn.checked == false) {
                    selectAll.checked = false;
                }
            }, 1);
        });

        totalItem.forEach((total) => {
            total.innerHTML = totalQuantity;
        });

        totalPriceBf.innerHTML = (totalPrice).toFixed(2);

        if (oneChecked) {
            totalDelivery.innerHTML = totalDel.toFixed(2);
            finalPrice.innerHTML = (totalPrice + totalDel).toFixed(2);
        } else {
            finalPrice.innerHTML = "0.00";
            totalDelivery.innerHTML = "0.00";
        }
    }

    function selectAllProd() {
        selectBtn.forEach((btn) => {
            if (selectAll.checked == true) {
                btn.checked = true;
                updateTotal();
            } else {
                btn.checked = false;
                updateTotal();
            }
        })
    }
}