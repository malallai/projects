function update_selected_categories(item, key) {
    var selectBox = item;
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    document.location.href="index.php?"+key+"[]="+selectedValue;
}