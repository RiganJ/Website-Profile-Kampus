<script>
document.addEventListener("DOMContentLoaded", function () {
  if (window.lucide) {
    lucide.createIcons();
  }

  const mobileBtn = document.getElementById("mobileBtn");
  const mobileMenu = document.getElementById("mobileMenu");
  if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener("click", function () {
      mobileMenu.classList.toggle("hidden");
    });
  }

  let lastScroll = 0;
  const navbar = document.getElementById("navbar");
  if (!navbar) {
    return;
  }

  window.addEventListener("scroll", function () {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 10) {
      navbar.style.transform = "translateY(0)";
      navbar.classList.remove("nav-gray", "shadow-lg");
      navbar.classList.add("nav-gradient");
      lastScroll = currentScroll;
      return;
    }

    if (currentScroll > lastScroll) {
      navbar.style.transform = "translateY(-120%)";
    } else {
      navbar.style.transform = "translateY(0)";
      navbar.classList.remove("nav-gradient");
      navbar.classList.add("nav-gray", "shadow-lg");
    }

    lastScroll = currentScroll;
  });
});
</script>
