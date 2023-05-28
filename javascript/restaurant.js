function openCart() {
    if (document.getElementById("cartContainer").className == "cartContainer cartContainerOpen") 
        document.getElementById("cartContainer").className = "cartContainer cartContainerClosed"
    else {
        document.getElementById("cartContainer").className = "cartContainer cartContainerOpen"
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        }

        xmlhttp.open("get", "../includes/get_orders.php", true);
        xmlhttp.send();
    }
}

function addToCart(id) {
    console.log(id);
    console.log(id.getAttribute("data-rId"));

    document.getElementById("cartContainer").innerHTML += id.getAttribute("data-name")  + "<br>";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Added to session");
        }
    }

    xmlhttp.open("get", "../includes/add_order.php?rId=" + id.getAttribute("data-rId") + "&dishId=" + id.getAttribute("data-dishId"), true);
    xmlhttp.send();

}

