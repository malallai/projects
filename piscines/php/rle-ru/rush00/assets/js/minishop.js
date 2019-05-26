function update_selected_categories(item, key) {
    var selectBox = document.getElementById("select-box");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    console.log(item);
    //document.location.href="index.php?"+key+"[]="+selectedValue;
}