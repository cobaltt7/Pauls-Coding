function sortList(list) {
	var i, switching, b, shouldSwitch;
	switching = true;
	while (switching) {
		switching = false;
		b = list.getElementsByTagName("li");
		for (i = 0; i < b.length - 1; i++) {
			shouldSwitch = false;
			if (
				b[i].innerHTML.toLowerCase() > b[i + 1].innerHTML.toLowerCase()
			) {
				shouldSwitch = true;
				break;
			}
		}

		if (shouldSwitch) {
			b[i].parentNode.insertBefore(b[i + 1], b[i]);
			switching = true;
		}
	}
}

function list(split, list) {
//	for (let count = 0; count < list.children.length; count++) {
//		list.children[count].children[0].innerText = list.children[
//			count
//		].children[0]
//			.getAttribute("href")
//			.split(split)[0];
//		list.children[count].setAttribute(
//			"class",
//			list.children[count].children[0]
//				.getAttribute("href")
//				.split(split)[1],
//		);
//	}
}
