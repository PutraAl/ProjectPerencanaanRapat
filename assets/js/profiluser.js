const btn = document.getElementById("hamburgerBtn");
    const sidebar = document.querySelector(".sidebar");

    btn?.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });
    // ===========================
    // LOGIC UNTUK EDIT PROFIL
    // ===========================

    const editBtn = document.getElementById("btnEdit");
    const cancelBtn = document.getElementById("btnCancel");
    const saveBtn = document.getElementById("btnSave");
    const editActions = document.getElementById("editActions");

    const inputs = document.querySelectorAll("#profileForm input");

    // Simpan nilai awal (untuk tombol batal)
    let initialValues = {};

    editBtn.addEventListener("click", () => {

        // Simpan data awal
        inputs.forEach(input => {
            initialValues[input.id] = input.value;
        });

        // Aktifkan input
        inputs.forEach(input => {
            input.removeAttribute("readonly");
        });

        // Sembunyikan tombol Edit, tampilkan tombol Simpan & Batal
        editBtn.classList.add("d-none");
        editActions.classList.remove("d-none");
    });

    cancelBtn.addEventListener("click", () => {

        // Kembalikan nilai awal
        inputs.forEach(input => {
            input.value = initialValues[input.id];
            input.setAttribute("readonly", true);
        });

        // Kembalikan tampilan tombol
        editBtn.classList.remove("d-none");
        editActions.classList.add("d-none");
    });