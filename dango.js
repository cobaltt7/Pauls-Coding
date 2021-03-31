(function () {
  const now = new Date().getTime() / 1000;
  if (!(now < 1617364800 && now > 1617192000)) {
    return;
  }

  const div = () => document.createElement("div");

  const noticeText = div();
  noticeText.className = "sa-dango-notice";
  const notifClose = Object.assign(document.createElement("span"), {
    className: "dango-notif-close",
    textContent: "x",
  });
  notifClose.onclick = () => {
    noticeText.style.display = "none";
    localStorage.setItem("scratchAddonsAprilFoolsModal2021", "true");
  };
  noticeText.appendChild(notifClose);
  const boldSpan = document.createElement("span");
  boldSpan.innerText = "Happy April Fools!";
  boldSpan.style.fontWeight = "bold";
  noticeText.appendChild(boldSpan);
  const normalSpan = document.createElement("span");
  normalSpan.innerHTML =
    "\nThanks to the <a href='https://scratchaddons.com'>Scratch Addons</a> developers <a href='https://scratch.mit.edu/users/TheColaber/'>@TheColaber</a>, <a href='https://scratch.mit.edu/users/World_Languages/'>@World_Languages</a>, and <a href='https://scratch.mit.edu/users/RedGuy7'>@RedGuy7</a> for writing the dango rain code.\nThanks to <a href='https://scratch.mit.edu/users/griffpatch/'>@griffpatch</a> for starting the meme.";
  noticeText.appendChild(normalSpan);

  let dangoContainer = div();
  dangoContainer.className = "sa-dangos";
  for (let i = 0; i < 20; i++) {
    const dango = div();
    dango.className = "sa-dango";
    dango.style.left = (i % 10) * 10 + "%";
    dango.style.animationDelay = `${Math.random() * 8}s, ${Math.random() * 8}s`;
    dangoContainer.append(dango);
  }

  document.querySelector("body").append(dangoContainer);
  if (!localStorage.getItem("scratchAddonsAprilFoolsModal2021"))
    document.querySelector("#content").append(noticeText);
})();
