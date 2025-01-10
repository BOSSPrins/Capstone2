document.addEventListener("DOMContentLoaded", () => {
    console.log("Unique logout modal script is running");

    const modalHTML = `
    <div id="uniqueLogoutModal" class="unique-modal">
        <div class="unique-modal-content">
            <span class="unique-close-btn" id="uniqueCloseModal">&times;</span>
            <p>Are you sure you want to logout?</p>
            <div class="unique-modal-actions">
                <button id="uniqueCancelBtn" class="unique-btn unique-cancel-btn">Cancel</button>
                <a href="Logout.php" class="unique-btn unique-logout-btn">Logout</a>
            </div>
        </div>
    </div>`;

    // Inject modal
    const modalContainer = document.getElementById('uniqueLogoutModalContainer');
    modalContainer.innerHTML = modalHTML;

    const modal = document.getElementById('uniqueLogoutModal');
    const logoutTrigger = document.getElementById('uniqueLogoutTrigger');
    const closeModal = document.getElementById('uniqueCloseModal');
    const cancelBtn = document.getElementById('uniqueCancelBtn');

    if (!logoutTrigger || !modal) {
        console.error("Required elements not found");
        return;
    }

    // Trigger modal display
    logoutTrigger.addEventListener('click', (e) => {
        e.preventDefault();
        modal.style.display = 'flex';
        console.log("Unique modal is now showing");
    });

    // Close modal
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        console.log("Unique modal is now hidden");
    });

    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        console.log("Unique modal is now hidden");
    });

    // Outside click to close
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
            console.log("Unique modal is now hidden");
        }
    });
});
