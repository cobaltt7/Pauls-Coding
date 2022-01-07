"use strict";

module.exports = async (req, res) => {
	const fetch = require("node-fetch");
	const db = new (require("@replit/database"))();
	const retronid = require("retronid");
	const ejs = require("ejs");
	require("dotenv").config();
	const regx = new RegExp(/\/key\/.+/g);
	const renderFile = function (req) {
		const { url } = req.query;
		let text,
			code = "";
		try {
			if (url !== undefined) {
				code = retronid.generate();
				ejs.renderFile(
					"./pages/authwithcode.ejs",
					{ code: code, url: url },
					{},
					function (err, str) {
						if (err) {
							throw err;
						}
						text = str;
					},
				);
			} else {
				throw (
					"Error: Please give a callback URI by adding " +
					"url= followed by the URI to the current URL."
				);
			}
		} catch (err) {
			ejs.renderFile(
				"./pages/error.ejs",
				{ error: err },
				{},
				function (_err, str) {
					code = "error";
					text = str;
				},
			);
		}
		return [text, code];
	};
	if (req.url === "/") {
		const rndr = renderFile(req);
		if (rndr[1] !== "error") {
			res.writeHead(200);
			res.start(rndr[0]);
			db.set(rndr[1], true);
			setTimeout(
				async (code) => {
					await db.set(code, false);
				},
				1500,
				rndr[1],
			);
		} else {
			res.writeHead(500);
			res.start(rndr[0]);
		}
	} else if (regx.test(req.url)) {
		var { key } = req.params;
		var { usernamee, projectid, commentid } = process.env;
		var count = await fetch(
			`https://api.scratch.mit.edu/users/${usernamee}` +
				`/projects/${projectid}/comments/`,
		).then((res) => res.json());
		var comments = await fetch(
			`https://api.scratch.mit.edu/users/${usernamee}/projects/` +
				`${projectid}/comments/${commentid}/replies` +
				`?limit=${count[0].reply_count}`,
		).then((res) => {
			return res.json();
		});
		var fresh = await db.get(key);
		comments.forEach(async (comment) => {
			if (comment.content === key) {
				var uname = comment.author.username;
				var verif = true;
				let data;
				if (req.query.url.includes("?")) {
					data = `&username=${uname}&verified=${verif}`;
				} else {
					data = `?username=${uname}&verified=${verif}`;
				}
				if (fresh) {
					await db.set(key, false);
					res.writeHead(302, { Location: `${req.query.url}${data}` });
					return res.start();
				} else {
					res.writeHead(302, { Location: `/?url=${req.query.url}` });
					return res.start();
				}
			}
		});
	}
};
