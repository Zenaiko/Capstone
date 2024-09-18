// Tab switching logic
const tabs = document.querySelectorAll('.tab');
const indicator = document.querySelector('.tab-indicator');
const scrollableTabs = document.querySelector('.scrollable-tabs');

tabs.forEach(tab => {
    tab.addEventListener('click', (e) => {
        // Remove active class from all tabs
        tabs.forEach(t => t.classList.remove('active'));

        // Add active class to clicked tab
        e.target.classList.add('active');

        // Update indicator position
        updateIndicatorPosition(e.target);
        
        // Change content based on the tab
        changeTabContent(e.target.dataset.tab);
    });
});

