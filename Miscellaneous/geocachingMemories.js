if (location.href.startsWith("https://www.geocaching.com/my/logs.aspx")) {
	var parentVar = document.getElementsByTagName("tbody")[0];
	var child = document.createElement("tr");
	child.style.display = "none";
	parentVar.insertBefore(child, parentVar.firstChild);

	var filter = (new Date().toLocaleString("default", {
		month: "2-digit",
	}),
	"/",
	new Date()
		.toLocaleString("default", {
			day: "2-digit",
		})
		.toString(),
	"/").toUpperCase();

	var table = document.getElementsByTagName("table")[0];
	var tr = table.getElementsByTagName("tr");

	for (var i = 1; i < tr.length; i++) {
		tr[i].style.display = "none";
		var cell = tr[i].getElementsByTagName("td")[2];
		if (cell) {
			if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			}
		}
	}
} else {
	alert(
		"Please click the bookmark on https://www.geocaching.com/my/logs.aspx",
	);
}
