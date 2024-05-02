const sidebar = document.querySelector(".sidebar");
const mainBox = document.querySelector(".main-box-content");
const profile = document.querySelector(".profile-collapsed");
const logoutIcon = document.querySelector(".logout-icon");
const closeSidebarBtn = document.querySelector(".btn-close-sidebar");

let expanded = false;

function toggleSidebar() {
    const sidebarListItems = document.querySelectorAll(".collapsed");

    if (expanded) {
        profile.classList.toggle("d-none");
        sidebar.classList.remove("sidebar-expand");
        sidebar.classList.add("sidebar-collapse");

        logoutIcon.classList.toggle("logout-border");
        logoutIcon.classList.toggle("login-border");

        sidebarListItems.forEach((item) => {
            item.classList.toggle("d-none");
        });
        setTimeout(() => {
            mainBox.classList.toggle("d-none");
        }, 150);
    } else {
        mainBox.classList.toggle("d-none");
        sidebar.classList.add("sidebar-expand");
        sidebar.classList.remove("sidebar-collapse");
        profile.classList.toggle("d-none");

        logoutIcon.classList.toggle("logout-border");
        logoutIcon.classList.toggle("login-border");

        setTimeout(() => {
            sidebarListItems.forEach((item) => {
                item.classList.toggle("d-none");
            });
        }, 150);
    }
    expanded = !expanded;
}

closeSidebarBtn.addEventListener("click", toggleSidebar);

sidebar.addEventListener("click", (e) => {
    if (
        e.target.classList.contains("disable-expand") ||
        e.target.classList.contains("btn-close-sidebar")
    ) {
        return;
    }

    toggleSidebar();
});
