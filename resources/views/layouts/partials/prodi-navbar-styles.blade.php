<style>
.footer-overlay {
  background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85));
}

.footer-link {
  transition: all .3s ease;
}

.footer-link:hover {
  color: var(--accent);
  padding-left: 6px;
}

.nav-gradient {
  background: linear-gradient(
    to bottom,
    rgba(15,23,42,0.8),
    rgba(15,23,42,0.4),
    transparent
  );
}

.nav-link {
  text-decoration: none;
  transition: 0.3s;
}

.nav-link:hover {
  color: #f97316;
}

.dropdown:hover .dropdown-menu {
  display: block;
}

.dropdown-item {
  display: flex;
  align-items: center;
  padding: 10px 16px;
  transition: all .2s ease;
}

.dropdown-item:hover {
  background: #f1f5f9;
  padding-left: 20px;
  color: #f97316;
}

.nav-gray {
  background: rgba(31, 41, 55, 0.85);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}
</style>
