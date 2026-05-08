/**
 * eWitnessVault - Custom JavaScript
 * Handles UI alerts, form validation, password visibility, dark mode toggle, etc.
 * Author: Tinkamanyire Gilbert & Team
 */

document.addEventListener("DOMContentLoaded", function() {
  console.log("%c🚀 eWitnessVault System Initialized", "color: green; font-weight: bold;");

  // Fade out Laravel flash messages
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.style.transition = "opacity 1s";
      alert.style.opacity = "0";
      setTimeout(() => alert.remove(), 1000);
    }, 4000);
  });

  // Password visibility toggle
  document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
      const target = document.querySelector(this.dataset.target);
      if (target.type === "password") {
        target.type = "text";
        this.innerHTML = "🙈";
      } else {
        target.type = "password";
        this.innerHTML = "👁️";
      }
    });
  });

  // Theme toggle (Dark / Light mode)
  const themeBtn = document.getElementById("themeToggle");
  if (themeBtn) {
    themeBtn.addEventListener("click", () => {
      document.body.classList.toggle("dark-mode");
      const mode = document.body.classList.contains("dark-mode") ? "Dark" : "Light";
      localStorage.setItem("theme", mode);
      alert(`${mode} mode activated`);
    });

    // Load preferred mode
    if (localStorage.getItem("theme") === "Dark") {
      document.body.classList.add("dark-mode");
    }
  }

  // Client-side form validation
  const forms = document.querySelectorAll('form.needs-validation');
  forms.forEach(form => {
    form.addEventListener('submit', function(e) {
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        alert("⚠️ Please fill out all required fields correctly.");
      }
      form.classList.add('was-validated');
    });
  });

  // Sidebar toggle (for dashboard)
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebar = document.querySelector(".sidebar");
  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed");
    });
  }

  // Logout confirmation
  const logoutBtn = document.getElementById("logoutBtn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", (e) => {
      if (!confirm("Are you sure you want to log out?")) {
        e.preventDefault();
      }
    });
  }

  // Real-time clock for dashboard header
  const clock = document.getElementById("clock");
  if (clock) {
    setInterval(() => {
      const now = new Date();
      clock.textContent = now.toLocaleTimeString();
    }, 1000);
  }

  // Smooth scroll to top
  const scrollBtn = document.getElementById("scrollTop");
  if (scrollBtn) {
    scrollBtn.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // Display file name after choosing file in upload form
  const fileInput = document.getElementById("evidenceFile");
  const fileLabel = document.getElementById("fileLabel");
  if (fileInput && fileLabel) {
    fileInput.addEventListener("change", function() {
      fileLabel.textContent = this.files.length > 0 ? this.files[0].name : "Choose a file";
    });
  }

  // Connection status monitoring
  window.addEventListener("offline", () => {
    alert("⚠️ You are offline. Some features may not work.");
  });

  window.addEventListener("online", () => {
    console.log("✅ Back online.");
  });
});
