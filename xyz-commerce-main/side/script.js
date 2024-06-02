//taking scroll container
let scrollCont = document.querySelector(".scroll-container");

//taking scroll amount
const scrollAmount = scrollCont.scrollWidth - scrollCont.offsetWidth;

//initializing for current position
let currentPosition = 0;

//initializing for speed of scroll
let speed = 4;

//initalizing for interval
let interval;

//scrolling left
function scrollLeftNav(event) {

    // Checking if interval already exists
    if (interval) {
        clearInterval(interval); // Clear any existing interval
    }

    //decreamenting current position
    interval = setInterval(() => {
        //checking if min position is achieved
        if (currentPosition > 0) {
            currentPosition--;
        }
        scroller();
    }, speed);

    //if scrollLeftSide is not being clicked
    if (event == 0) {
        clearInterval(interval);
    }
}

//scrolling right
function scrollRightNav(event) {

    // Checking if interval already exists
    if (interval) {
        clearInterval(interval); // Clear any existing interval
    }

    //increamenting current position
    interval = setInterval(() => {
        //checking if max position is achieved
        if (currentPosition < scrollAmount) {
            currentPosition++;
        }
        scroller();
    }, speed);

    //if scrollLeftSide is not being clicked
    if (event == 0) {
        clearInterval(interval);
    }
}

function scroller() {
    //changing position
    scrollCont.scrollLeft = currentPosition;
}

//taking nav
let nav = document.querySelector("nav");
//taking footer
let footer = document.querySelector("footer");
window.addEventListener("scroll", () => {
    //changing nav position
    if (window.scrollY > (nav.clientHeight * 2)) {
        nav.classList.add("sticky");
    } else {
        nav.classList.remove("sticky");
    };
    //if scroll has reached footer
    if (window.scrollY >= (document.body.clientHeight - (nav.clientHeight + footer.clientHeight))) {
        nav.style.transform = "translateY(-100%)";
    } else {
        nav.style.transform = "translateY(0%)"
    }
})