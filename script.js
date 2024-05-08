function confirmlogout(){
    if (confirm("Are you sure to log out?")==true){
        window.location="logout.php";
    }
}

function setPlaceholder(){
    var option = document.getElementById("searchop").value;
    if (option === "issue_date"||option === "return_date"){
        document.getElementById("searchbar").placeholder = "YYYY-MM-DD";
    }else{
        document.getElementById("searchbar").placeholder = "Search..";
    }
}