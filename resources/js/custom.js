// General JavaScript functions for the eWitness Vault

// Alert helper
function showAlert(message, type = 'success') {
    const alertBox = document.createElement('div');
    alertBox.className = `alert alert-${type}`;
    alertBox.innerText = message;
    document.body.prepend(alertBox);

    setTimeout(() => {
        alertBox.remove();
    }, 3000);
}

// Confirm deletion
function confirmDelete(callback) {
    if (confirm("Are you sure you want to delete this item?")) {
        callback();
    }
}

// Example: initialize tooltips (if using Bootstrap)
document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
