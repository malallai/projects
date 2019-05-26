function update_selected_categories() {
    var selectBox = document.getElementById("select-box");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    alert(selectedValue);
}