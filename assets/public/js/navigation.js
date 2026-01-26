(function () {
  function init(nav) {
    if (!nav || nav.__orivoInit) return;
    nav.__orivoInit = true;

    const checkbox = nav.querySelector(".orivo-navbar-blocks__toggle");
    const menu = nav.querySelector(".orivo-navbar-blocks__menu");
    if (!checkbox || !menu) return;

    const closeOutside = (nav.dataset.closeOutside || "yes") === "yes";
    const bp = parseInt(nav.dataset.breakpoint || "768", 10);

    // Dropdown icons are handled by PHP walker - no JS needed

    function isMobile() {
      return window.innerWidth <= bp;
    }

    function close() {
      checkbox.checked = false;
    }

    if (closeOutside) {
      document.addEventListener("click", (e) => {
        if (!isMobile()) return;
        if (!checkbox.checked) return;
        if (nav.contains(e.target)) return;
        close();
      }, true);
    }

    // close after click any link on mobile
    menu.addEventListener("click", (e) => {
      const a = e.target.closest("a");
      if (!a) return;
      if (!isMobile()) return;
      close();
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".orivo-navbar-blocks").forEach(init);
  });

  // Elementor editor support
  if (window.elementorFrontend && elementorFrontend.hooks) {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/orivo_navigation.default",
      function ($scope) {
        const nav = $scope[0].querySelector(".orivo-navbar-blocks");
        if (nav) init(nav);
      }
    );
  }
})();
