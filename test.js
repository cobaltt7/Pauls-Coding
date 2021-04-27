(async () => {
	matches = await db.list("RETRIEVE_");
	var res = [];
	for (var match of matches) {
		try {
			res.push(await db.get(match));
		} catch (e) {
			res.push(e);
		}
	}

	return res;
})();
