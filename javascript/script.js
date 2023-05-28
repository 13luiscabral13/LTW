window.onload = function(e){
    var searchInputElement = document.getElementById("search");

    function showResult() {
        let str = searchInputElement.value;
        if (str.length == 0) {
            document.getElementById("searchResults").innerHTML = "";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            //console.log("readyState: " + this.readyState + " status: " + this.status);
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("searchResults").innerHTML = this.responseText;
            }
        }

        xmlhttp.open("get", "../includes/search_results.php?q=" + str, true);
        xmlhttp.send();

    }
    searchInputElement.addEventListener("keyup", showResult);
}
