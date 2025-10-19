<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rapat</title>
  <link rel="stylesheet" href="rapat.css" />
</head>
<body>
  <div class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="logo-section">
        <img src="../assets/img/poltek.png" alt="Logo" class="logo-img" />
        <hr class="divider" />
      </div>

      <nav class="nav-menu">
        <a href="./dashboard.html" class="menu-item">
          <span class="icon">🏠</span>
          <span class="label">Dashboard</span>
        </a>
        <a href="./rapat.html" class="menu-item active">
          <span class="icon">📄</span>
          <span class="label">Rapat</span>
        </a>
        <a href="./user.html" class="menu-item">
          <span class="icon">👤</span>
          <span class="label">User</span>
        </a>
      </nav>

      <div class="bottom-profile">
        <hr class="divider" />
        <a href="./profile.html" class="profile-link">
          <span class="icon">⚫</span>
          <span class="label">Profile</span>
        </a>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
      <div class="rapat-header">
        <h1 class="rapat-title">Jadwal Rapat</h1>
        <button class="add-btn" id="addBtn">＋</button>
      </div>

      <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
          <tr>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Ruangan</th>
            <th>Peserta Rapat</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Judul Rapat</td><td>12/10/2025</td><td>10:00</td><td>Ruang 101</td><td>Tim A</td>
            <td>
              <button class="view-btn">View</button>
              <button class="edit-btn">Edit</button>
            </td>
          </tr>
          <tr>
            <td>Evaluasi Bulanan</td><td>13/10/2025</td><td>13:00</td><td>Ruang 202</td><td>Tim B</td>
            <td>
              <button class="view-btn">View</button>
              <button class="edit-btn">Edit</button>
            </td>
          </tr>
          <tr>
            <td>Perencanaan Proyek</td><td>15/10/2025</td><td>09:00</td><td>Ruang 305</td><td>Tim C</td>
            <td>
              <button class="view-btn">View</button>
              <button class="edit-btn">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </main>
  </div>

  <!-- VIEW POPUP -->
  <div id="viewModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Detail Rapat</h2>
    </div>
  </div>

  <!-- ADD DATA POPUP -->
  <div id="popupModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Tambah Data</h2>

      <form id="rapatForm">
        <label for="judul">Judul Rapat</label>
        <input type="text" id="judul" name="judul" required>

        <label for="deskripsi">Deskripsi Rapat</label>
        <textarea id="deskripsi" name="deskripsi" rows="3" required></textarea>

        <label for="peserta">Peserta Rapat</label>
        <input type="text" id="peserta" name="peserta" required>

        <label for="status">Status Rapat</label>
        <input type="text" id="status" name="status" required>

        <label for="tanggal">Tanggal Rapat</label>
        <input type="date" id="tanggal" name="tanggal" required>

        <button type="submit" class="save-btn">Simpan</button>
      </form>
    </div>
  </div>

  <!-- EDIT DATA POPUP -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Edit Data</h2>

      <form id="editForm">
        <label for="editJudul">Judul Rapat</label>
        <input type="text" id="editJudul" required>

        <label for="editPeserta">Peserta Rapat</label>
        <input type="text" id="editPeserta" required>

        <label for="editTanggal">Tanggal Rapat</label>
        <input type="date" id="editTanggal" required>

        <button type="submit" class="save-btn">Simpan Perubahan</button>
      </form>
    </div>
  </div>

  <script>
  // === ADD MODAL ===
  const addModal = document.getElementById("popupModal");
  const addBtn = document.getElementById("addBtn");
  const addCloseBtn = addModal.querySelector(".close-btn");

  addBtn.addEventListener("click", () => addModal.style.display = "flex");
  addCloseBtn.addEventListener("click", () => addModal.style.display = "none");

  window.addEventListener("click", (e) => {
    if (e.target === addModal) addModal.style.display = "none";
  });

  document.getElementById("rapatForm").addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Data berhasil disimpan!");
    addModal.style.display = "none";
    this.reset();
  });

  // === VIEW MODAL ===
  const viewModal = document.getElementById("viewModal");
  const viewCloseBtn = viewModal.querySelector(".close-btn");

  document.querySelectorAll(".view-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const row = e.target.closest("tr");
      const cells = row.querySelectorAll("td");

      const judul = cells[0].textContent;
      const tanggal = cells[1].textContent;
      const waktu = cells[2].textContent;
      const ruangan = cells[3].textContent;
      const peserta = cells[4].textContent;

      // Remove old data
      viewModal.querySelectorAll("p").forEach(p => p.remove());

      // Add new data
      viewModal.querySelector("h2").insertAdjacentHTML("afterend", `
        <p><strong>Judul:</strong> ${judul}</p>
        <p><strong>Tanggal:</strong> ${tanggal}</p>
        <p><strong>Waktu:</strong> ${waktu}</p>
        <p><strong>Ruangan:</strong> ${ruangan}</p>
        <p><strong>Peserta:</strong> ${peserta}</p>
      `);

      viewModal.style.display = "flex";
    });
  });

  viewCloseBtn.addEventListener("click", () => viewModal.style.display = "none");
  window.addEventListener("click", (e) => {
    if (e.target === viewModal) viewModal.style.display = "none";
  });

  // === EDIT MODAL ===
  const editModal = document.getElementById("editModal");
  const editCloseBtn = editModal.querySelector(".close-btn");
  let currentRow = null;

  document.querySelectorAll(".edit-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      currentRow = e.target.closest("tr");
      const cells = currentRow.querySelectorAll("td");

      document.getElementById("editJudul").value = cells[0].textContent;
      document.getElementById("editPeserta").value = cells[4].textContent;
      document.getElementById("editTanggal").value = formatDateForInput(cells[1].textContent);

      editModal.style.display = "flex";
    });
  });

  editCloseBtn.addEventListener("click", () => editModal.style.display = "none");
  window.addEventListener("click", (e) => {
    if (e.target === editModal) editModal.style.display = "none";
  });

  document.getElementById("editForm").addEventListener("submit", function (e) {
    e.preventDefault();
    if (currentRow) {
      const cells = currentRow.querySelectorAll("td");
      cells[0].textContent = document.getElementById("editJudul").value;
      cells[1].textContent = formatDateForDisplay(document.getElementById("editTanggal").value);
      cells[4].textContent = document.getElementById("editPeserta").value;
    }
    alert("Perubahan berhasil disimpan!");
    editModal.style.display = "none";
  });

  function formatDateForInput(dateStr) {
    const [day, month, year] = dateStr.split("/");
    return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
  }

  function formatDateForDisplay(dateStr) {
    const [year, month, day] = dateStr.split("-");
    return `${day}/${month}/${year}`;
  }
  </script>
</body>
</html>
