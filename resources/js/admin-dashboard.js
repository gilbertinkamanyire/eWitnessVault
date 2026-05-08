/**
 * eWitnessVault - Admin Dashboard JavaScript
 * Handles admin dashboard specific functionality
 */

import { showAlert, formatDate, confirmAction } from './utils.js';

/**
 * Initialize admin dashboard
 */
export function initAdminDashboard() {
    console.log('Admin Dashboard initialized');

    // Initialize stat cards animations
    initStatCards();

    // Initialize table interactions
    initTableInteractions();

    // Initialize action buttons
    initActionButtons();
}

/**
 * Animate stat cards on load
 */
function initStatCards() {
    const statCards = document.querySelectorAll('[class*="stat-card"], .relative.group');

    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

/**
 * Initialize table row interactions
 */
function initTableInteractions() {
    const tableRows = document.querySelectorAll('tbody tr');

    tableRows.forEach(row => {
        row.addEventListener('click', function (e) {
            // Don't trigger if clicking on a button or link
            if (e.target.closest('button') || e.target.closest('a')) {
                return;
            }

            // Add subtle highlight effect
            this.style.backgroundColor = 'rgba(245, 158, 11, 0.1)';
            setTimeout(() => {
                this.style.backgroundColor = '';
            }, 300);
        });
    });
}

/**
 * Initialize action buttons with confirmation
 */
function initActionButtons() {
    // Approve buttons
    const approveButtons = document.querySelectorAll('button[title="Approve"]');
    approveButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            const userName = this.closest('tr').querySelector('.text-white').textContent;
            if (!confirm(`Approve ${userName}?`)) {
                e.preventDefault();
            }
        });
    });

    // Reject buttons
    const rejectButtons = document.querySelectorAll('button[title="Reject"]');
    rejectButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            const userName = this.closest('tr').querySelector('.text-white').textContent;
            if (!confirm(`Reject ${userName}? This action cannot be undone.`)) {
                e.preventDefault();
            }
        });
    });
}

/**
 * Refresh dashboard stats via AJAX
 */
export async function refreshDashboardStats() {
    try {
        const response = await fetch('/api/admin/stats');
        const data = await response.json();

        // Update stat values with animation
        updateStatValue('totalUsers', data.totalUsers);
        updateStatValue('verifiedUsers', data.verifiedUsers);
        updateStatValue('pendingVerification', data.pendingVerification);
        updateStatValue('totalEvidence', data.totalEvidence);

        showAlert('Dashboard stats updated', 'success', 2000);
    } catch (error) {
        console.error('Failed to refresh stats:', error);
        showAlert('Failed to refresh stats', 'danger');
    }
}

/**
 * Update stat value with animation
 */
function updateStatValue(elementId, newValue) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const currentValue = parseInt(element.textContent);
    const increment = newValue > currentValue ? 1 : -1;
    const duration = 500;
    const steps = Math.abs(newValue - currentValue);
    const stepDuration = duration / steps;

    let current = currentValue;
    const timer = setInterval(() => {
        current += increment;
        element.textContent = current;

        if (current === newValue) {
            clearInterval(timer);
        }
    }, stepDuration);
}

/**
 * Filter table by search term
 */
export function filterTable(searchTerm, tableId = 'usersTable') {
    const table = document.getElementById(tableId);
    if (!table) return;

    const rows = table.querySelectorAll('tbody tr');
    const term = searchTerm.toLowerCase();

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
    });
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAdminDashboard);
} else {
    initAdminDashboard();
}

