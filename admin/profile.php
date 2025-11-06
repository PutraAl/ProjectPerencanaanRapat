<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    /* === Reset and base === */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Times New Roman', Times, serif;
    }

    .container {
      display: flex;
      width: 100%;
    }

    /* === Sidebar === */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 220px;
      background-color: #eaeaea;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 20px 0;
    }

    .logo-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 10px 0;
    }

    .logo-img {
      width: 150px;
      height: auto;
      margin-bottom: 8px;
    }

    .divider {
      width: 80%;
      height: 1px;
      background-color: #bbb;
      border: none;
      margin: 10px auto;
    }

    .nav-menu {
      margin-top: 20px;
      width: 100%;
      display: flex;
      flex-direction: column;
      padding: 0 20px;
      gap: 15px;
    }

    .menu-item {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: black;
      padding: 10px;
      border-radius: 4px;
      transition: background 0.3s;
    }

    .menu-item .icon {
      margin-right: 10px;
      font-size: 18px;
    }

    .menu-item.active,
    .menu-item:hover {
      background-color: #7c7c7c;
      color: white;
    }

    .bottom-profile {
      margin-top: auto;
      padding: 10px 20px;
    }

    .profile-link {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: black;
      margin-top: 10px;
    }

    .profile-link .icon {
      margin-right: 10px;
      font-size: 20px;
    }

    /* === Main Content === */
    .main-content {
      margin-left: 220px;
      flex: 1;
      padding: 30px;
      overflow-y: auto;
    }

    .profile-header {
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      margin-bottom: 30px;
    }

    .profile-title {
      text-align: center;
      flex: 1;
      font-size: 28px;
      font-weight: bold;
    }

    .edit-btn {
      position: absolute;
      right: 0;
      background-color: #7c7c7c;
      color: white;
      border: none;
      border-radius: 50%;
      font-size: 20px;
      width: 35px;
      height: 35px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .edit-btn:hover {
      background-color: #5a5a5a;
    }

    /* === Profile Card === */
    .profile-card {
      max-width: 500px;
      margin: 0 auto;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 25px;
      text-align: center;
    }

    .profile-card img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .profile-card h3 {
      margin-bottom: 8px;
    }

    .profile-card p {
      margin: 4px 0;
    }

    /* === Popup Modal === */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-content {
      background-color: #fff;
      padding: 25px;
      border-radius: 8px;
      width: 400px;
      max-width: 90%;
      position: relative;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 22px;
      cursor: pointer;
      color: #555;
    }

    .modal-content h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .modal-content form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .modal-content label {
      font-weight: bold;
    }

    .modal-content input {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    .save-btn {
      background-color: #7c7c7c;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s;
      margin-top: 10px;
    }

    .save-btn:hover {
      background-color: #5a5a5a;
    }
  </style>
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
        <a href="dashboard.php" class="menu-item ">
          <span class="icon">🏠</span>
          <span class="label">Dashboard</span>
        </a>
        <a href="rapat.php" class="menu-item">
          <span class="icon">📄</span>
          <span class="label">Rapat</span>
        </a>
        <a href="user.php" class="menu-item">
          <span class="icon">👤</span>
          <span class="label">User</span>
        </a>
      </nav>

      <div class="bottom-profile">
        <hr class="divider" />
        <a href="./profile.php" class="menu-item active">
          <span class="icon">⚫</span>
          <span class="label">Profile</span>
        </a>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
      <div class="profile-header">
        <h1 class="profile-title">Profile</h1>
        <button class="edit-btn" id="editBtn">✎</button>
      </div>

      <div class="profile-card">
        <img src="https://via.placeholder.com/120" alt="Profile Picture">
        <h3 id="nameDisplay">Yoda Pratama</h3>
        <p id="emailDisplay">Yodapratama@gmail.com</p>
        <p id="positionDisplay">Staff</p>
      </div>
    </main>
  </div>

  <!-- EDIT POPUP -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Edit Profile</h2>
      <form id="editForm">
        <label for="name">Nama</label>
        <input type="text" id="name" value="Yoda Pratama">

        <label for="email">Email</label>
        <input type="email" id="email" value="Yodapratama@gmail.com">

        <label for="position">Jabatan</label>
        <input type="text" id="position" value="Staff">

        <button type="submit" class="save-btn">Simpan</button>
      </form>
    </div>
  </div>

  <script>
    const editBtn = document.getElementById("editBtn");
    const editModal = document.getElementById("editModal");
    const closeBtn = editModal.querySelector(".close-btn");

    editBtn.addEventListener("click", () => {
      editModal.style.display = "flex";
    });

    closeBtn.addEventListener("click", () => {
      editModal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
      if (e.target === editModal) {
        editModal.style.display = "none";
      }
    });

    document.getElementById("editForm").addEventListener("submit", (e) => {
      e.preventDefault();
      document.getElementById("nameDisplay").textContent = document.getElementById("name").value;
      document.getElementById("emailDisplay").textContent = document.getElementById("email").value;
      document.getElementById("positionDisplay").textContent = document.getElementById("position").value;
      editModal.style.display = "none";
      alert("Profile updated successfully!");
    });
  </script>
</body>
</html>
