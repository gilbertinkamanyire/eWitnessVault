/**
 * eWitnessVault Dashboard Script
 * Handles dashboard stats, charts, live notifications, and interactivity.
 * Author: Tinkamanyire Gilbert & Team
 */

document.addEventListener("DOMContentLoaded", function () {
  console.log("%c📊 Dashboard Initialized", "color: blue; font-weight: bold;");

  // ---- Global Variables ----
  const statsEndpoint = "/api/dashboard/stats";
  const notificationsEndpoint = "/api/dashboard/notifications";

  // ---- DOM Elements ----
  const evidenceCount = document.getElementById("evidenceCount");
  const pendingCount = document.getElementById("pendingCount");
  const approvedCount = document.getElementById("approvedCount");
  const rejectedCount = document.getElementById("rejectedCount");
  const notificationList = document.getElementById("notificationList");
  const refreshButton = document.getElementById("refreshDashboard");

  // ---- Real-time stats fetch ----
  async function fetchDashboardStats() {
    try {
      const res = await fetch(statsEndpoint);
      const data = await res.json();

      if (data.success) {
        evidenceCount.textContent = data.total_evidence || 0;
        pendingCount.textContent = data.pending || 0;
        approvedCount.textContent = data.approved || 0;
        rejectedCount.textContent = data.rejected || 0;
      } else {
        console.warn("⚠️ Failed to load dashboard stats.");
      }
    } catch (err) {
      console.error("Error fetching stats:", err);
    }
  }

  // ---- Fetch Notifications ----
  async function fetchNotifications() {
    try {
      const res = await fetch(notificationsEndpoint);
      const data = await res.json();

      if (data.success) {
        notificationList.innerHTML = "";
        data.notifications.forEach(n => {
          const li = document.createElement("li");
          li.className = "notification-item";
          li.innerHTML = `
            <strong>${n.title}</strong><br>
            <small>${n.message}</small>
          `;
          notificationList.appendChild(li);
        });
      }
    } catch (err) {
      console.error("Error fetching notifications:", err);
    }
  }

  // ---- Manual Refresh Button ----
  if (refreshButton) {
    refreshButton.addEventListener("click", function () {
      console.log("Refreshing dashboard data...");
      fetchDashboardStats();
      fetchNotifications();
    });
  }

  // ---- Auto Refresh Every 30 Seconds ----
  setInterval(() => {
    fetchDashboardStats();
    fetchNotifications();
  }, 30000);

  // ---- Chart Display (requires Chart.js or ApexCharts) ----
  if (typeof Chart !== "undefined") {
    const ctx = document.getElementById("evidenceChart");
    if (ctx) {
      const chart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: ["Approved", "Pending", "Rejected"],
          datasets: [{
            data: [0, 0, 0],
            backgroundColor: ["#4CAF50", "#FFC107", "#F44336"],
          }],
        },
        options: {
          responsive: true,
          plugins: { legend: { position: "bottom" } },
        },
      });

      // Update chart dynamically
      async function updateChart() {
        const res = await fetch(statsEndpoint);
        const data = await res.json();
        if (data.success) {
          chart.data.datasets[0].data = [
            data.approved,
            data.pending,
            data.rejected
          ];
          chart.update();
        }
      }

      updateChart();
      setInterval(updateChart, 60000);
    }
  }

  // ---- Notification Sound ----
  const sound = new Audio("/sounds/notify.mp3");
  function playNotificationSound() {
    sound.play().catch(err => console.log("Muted by browser:", err));
  }

  // ---- Listen for new notifications (optional WebSocket integration) ----
  if ("WebSocket" in window) {
    const ws = new WebSocket("ws://localhost:6001");
    ws.onmessage = function (event) {
      const msg = JSON.parse(event.data);
      if (msg.type === "new_evidence") {
        playNotificationSound();
        alert(`📁 New evidence uploaded by ${msg.user}`);
        fetchNotifications();
        fetchDashboardStats();
      }
    };
  }

  // Initial load
  fetchDashboardStats();
  fetchNotifications();
});
