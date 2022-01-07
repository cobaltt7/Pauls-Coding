(async () => {
	const { lighthouseCheck } = require("@foo-software/lighthouse-check");
	const results = await lighthouseCheck({
		emulatedFormFactor: "all",
		locale: "en",
		urls: [
			"https://auth.onedot.cf",
			"https://auth.onedot.cf/auth?url=https%3A%2F%2Fauth.onedot.cf%2F",
			"https://auth.onedot.cf/auth/email?url=https%3A%2F%2Fauth.onedot.cf%2F",
			"https://auth.onedot.cf/auth/replit?url=https%3A%2F%2Fauth.onedot.cf%2F",
		],
		verbose: true,
		prCommentEnabled: false,
		isGitHubAction: true,
	});

	/** @type {import("../../types").lighthouseResult} */
	const data = results;
	if (data.code !== "SUCCESS") throw new Error(`code: ${data.code}`);
	let output =
		"# This week’s Lighthouse scores\n" +
		"| URL | Device | Accessibility | Best Practices | Performace " +
		"| Progressive Web App | SEO | PageSpeed Insights |\n" +
		"| - | - | - | - | - | - | - | - |\n";

	for (const result of data.data) {
		output +=
			`| ${result.url} | ${result.emulatedFormFactor} | ${Object.values(
				result.scores,
			)
				.map(
					(number) =>
						`${
							number < 50 ? "🔴" : number < 90 ? "🟡" : "🟢"
						} ${number}`,
				)
				.join(
					" | ",
				)} | [More information](https://developers.google.com/speed/pagespeed/insights/` +
			`?url=${encodeURIComponent(result.url)}&tab=${
				result.emulatedFormFactor
			}) |\n`;
	}
	console.log(output);
})();
