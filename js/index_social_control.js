/* Minimal JS to toggle list and close on outside click */
(function () {
  const container = document.getElementById("socials");
  const toggle = document.getElementById("toggleBtn");
  const list = document.getElementById("socialList");

  function open(v) {
    container.classList.toggle("open", v);
    const expanded = container.classList.contains("open");
    toggle.setAttribute("aria-expanded", expanded);
    container.setAttribute("aria-expanded", expanded);
    list.setAttribute("aria-hidden", !expanded);
  }

  toggle.addEventListener("click", (e) => {
    e.stopPropagation();
    open(!container.classList.contains("open"));
  });

  // close when clicking elsewhere
  document.addEventListener("click", (e) => {
    if (!container.contains(e.target)) open(false);
  });

  // allow Esc to close
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") open(false);
  });
})();
