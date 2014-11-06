function updateSubCategories() {
	//var $categoryselect = $("#appcategoryinput");
	var $category = $("#appcategoryinput option:selected").text();
	//var $category = categoryselect.options[categoryselect.selectedIndex].text;
	var $subcategoryselect = $("#appsubcategoryinput");
	
	if ($category == "Arts and Entertainment") {
		$subcategoryselect.empty();
		var newOptions = {"Books and Literature":"1-1", "Celebrity Fan/Gossip":"1-2", "Fine Art":"1-3", "Humor":"1-4", "Movies":"1-5", "Music":"1-6", "Television":"1-7"};
		var subcatsel = "<option value=''>Please Select Sub-Category</option>";
		
		$.each(newOptions, function(key, value) {   
			subcatsel+= "<option value='" + value + "'>" + key + "</option>"
			
			//$('#appsubcategoryinput')
			//.append($("<option></option>")
			//.attr("value",key)
			//.text(value)); 
		});
		
		$subcategoryselect.html(subcatsel);
		$subcategoryselect.uniform();
		//$('#appsubcategoryinput').selectmenu("refresh",true);
	}
}