function update_selected_categories(item, key) {
    alert(item);
    var selectBox = document.getElementById("select-box");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    document.location.href="index.php?"+key+"[]="+selectedValue;
}