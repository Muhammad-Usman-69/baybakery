<nav class="flex h-[72px] bg-blue-500 text-sm relative">
    <a href="/" class="logo w-[72px] grid place-items-center cursor-pointer">
        <img class="w-[70px] h-14" src="images/main/logo.png" alt="">
    </a>
    <ul class="flex space-x-2 justify-center items-center text-white">
        <li>
            <a href="info.php?t=about" class="bg-blue-600 p-2 px-3 rounded-full hover:bg-blue-700">About</a>
        </li>
        <li>
            <a href="info.php?t=contact" class="bg-blue-600 p-2 px-3 rounded-full hover:bg-blue-700">Contact Us</a>
        </li>
        <li>
            <a href="info.php?t=faq" class="bg-blue-600 p-2 px-3 rounded-full hover:bg-blue-700">FAQ</a>
        </li>
    </ul>
    <form action="search.php" method="get"
        class="search absolute top-[72px] w-full h-14 bg-blue-600 flex items-center justify-center md:static md:w-3/5 md:h-[72px] md:bg-transparent">
        <input type="search" name="q" placeholder="Search" class="h-6 py-5 px-3 rounded-l-md focus:outline-none w-1/2"
            autocomplete="off" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
                echo $_GET["q"];
            } ?>">
        <button>
            <img src="images/main/search.png" alt="" class="bg-blue-100 h-10 p-2 rounded-r-md active:bg-blue-200">
        </button>
        <?php
        if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
            include("partials/_dbconnect.php");
            $muman_id = $_SESSION["muman_id"];
            $sql = "SELECT * FROM `cart` WHERE `muman_id` = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $muman_id);
            mysqli_stmt_execute($stmt);
            $result_cart = mysqli_stmt_get_result($stmt);
            $num_cart = mysqli_num_rows($result_cart);
            echo '<a href="cart.php" class="w-12 ml-6 p-2 pr-3 bg-blue-600 rounded-full md:hover:bg-blue-700 relative">
            <img src="images/main/cart.png" alt="" class="invert">
            <span class="text-xs absolute top-4 right-[4px] text-white p-1">' . $num_cart . '</span></a>';
        } else {
            echo '<a href="cart.php" class="w-12 ml-6 p-2 bg-blue-600 rounded-full md:hover:bg-blue-700 relative">
            <img src="images/main/cart.png" alt="" class="invert"></a>';
        }
        ?>
    </form>
    <div class="top-1/2 translate-y-[-50%] right-4 absolute rounded-full z-10">
        <img onclick="showUser()" src="images/main/account.png"
            class="cursor-pointer w-10 bg-[#f7941c] hover:bg-[#ff8f10e5] active:bg-[#f7941c] rounded-full">
        <div class="user hidden absolute right-0 top-14 bg-[#0c3880] p-2 rounded-md">
            <span
                class="border-[transparent_transparent_#0c3880_transparent] border-[10px] content-[0] border-solid absolute -top-5 right-3"></span>
            <div class="space-y-2 w-48 flex flex-col z-20">
                <?php
                if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                    echo '<div class="px-2 py-1.5 text-sm text-white">
                    <p>' . $_SESSION["name"] . '</p>
                    <p class="font-medium truncate">' . $_SESSION["email"] . '</p>
                        </div>
                    <div class="h-[0.1px] border-t border-[#e5e7eb]"></div>
                    <button 
                        data-modal-target="logout-modal" data-modal-toggle="logout-modal" class="border-blue-500 border py-2 bg-slate-50 text-[#0c3880] rounded-md hover:bg-slate-100 active:bg-slate-200 font-semibold">Log
                        out</button>';
                } else {
                    echo '<button data-modal-target="log-modal"         data-modal-toggle="log-modal" class="border-blue-500 border py-2 bg-slate-50 text-[#0c3880] rounded-md hover:bg-slate-100 active:bg-slate-200 font-semibold">Log in</button>
                    <button data-modal-target="sign-modal"                 data-modal-toggle="sign-modal" class="border-blue-500 border py-2 bg-slate-50 text-[#0c3880] rounded-md hover:bg-slate-100 active:bg-slate-200 font-semibold">Sign up</button>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<?php
if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
    include("partials/_lo-modal.php");
} else {
    include("partials/_s-modal.php");
    include("partials/_l-modal.php");
}
?>