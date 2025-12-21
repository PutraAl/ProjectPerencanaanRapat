// ========== SIDEBAR TOGGLE ==========
const hamburgerBtn = document.getElementById("hamburgerBtn");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");

// Toggle sidebar saat hamburger diklik
hamburgerBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
});

// Tutup sidebar saat menu item diklik
const menuItems = document.querySelectorAll(".menu-item a");
menuItems.forEach(item => {
    item.addEventListener("click", () => {
        if (window.innerWidth <= 1023) {
            sidebar.classList.remove("active");
        }
    });
});

// Tutup sidebar saat klik di luar sidebar
document.addEventListener("click", (e) => {
    const isClickInsideSidebar = sidebar.contains(e.target);
    const isClickOnHamburger = hamburgerBtn.contains(e.target);

    if (!isClickInsideSidebar && !isClickOnHamburger && window.innerWidth <= 1023) {
        sidebar.classList.remove("active");
    }
});

// ========== RESPONSIVE ADJUSTMENT ==========
window.addEventListener("resize", () => {
    if (window.innerWidth > 1023) {
        sidebar.classList.remove("active");
    }
});

// ========== DATATABLE RESPONSIVE ==========
// Inisialisasi DataTable dengan opsi responsive
if (document.getElementById('myTable')) {
    let table = new DataTable('#myTable', {
        responsive: true,
        pageLength: 10,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
        },
        columnDefs: [
            {
                targets: 0,
                width: "5%"
            },
            {
                targets: [5], // Kolom Action
                responsivePriority: 1,
                orderable: false
            },
            {
                targets: [1, 2], // Kolom Nama, Username
                responsivePriority: 2
            }
        ],
        dom: 'rtip' // Hapus search box bawaan jika perlu
    });

    // Optional: Custom action untuk responsive mode
    table.on('responsive-resize', function() {
        console.log('Table resize');
    });
}

// ========== CLOSE MODAL SAAT MOBILE ==========
document.addEventListener('show.bs.modal', function(e) {
    // Modal automatically closes sidebar
    if (window.innerWidth <= 1023) {
        sidebar.classList.remove("active");
    }
});