// JS for Dashboard Page
document.addEventListener('DOMContentLoaded', function() {
    // Example: load dashboard stats via AJAX
    fetch('/api/dashboard/stats')
        .then(res => res.json())
        .then(data => {
            document.getElementById('totalUsers').innerText = data.totalUsers;
            document.getElementById('totalEvidence').innerText = data.totalEvidence;
        })
        .catch(err => console.error('Error fetching dashboard stats:', err));
});
