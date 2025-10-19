document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item');
    const pages = document.querySelectorAll('.page');
    const pageTitle = document.querySelector('.page-title');
    const invitationCountSpan = document.getElementById('invitation-count');
    const invitationsGrid = document.getElementById('invitations-grid');
    
    // Inisialisasi hitungan undangan
    let invitationCount = invitationsGrid.children.length;
    invitationCountSpan.textContent = invitationCount;


    // 1. Logika Navigasi Sidebar
    // ----------------------------------------------------------------
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetPage = this.getAttribute('data-page');
            
            if (targetPage) {
                // Update menu aktif
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                
                // Tampilkan halaman yang sesuai
                pages.forEach(page => {
                    page.classList.remove('active');
                    if (page.id === targetPage) {
                        page.classList.add('active');
                        
                        // Update judul halaman
                        const menuText = this.querySelector('i').nextSibling.textContent.trim();
                        pageTitle.textContent = menuText;
                    }
                });
            } else if (this.textContent.includes('Keluar')) {
                // Logika keluar aplikasi (bisa diarahkan ke halaman login)
                alert('Anda telah keluar dari sistem.');
                // window.location.href = 'login.html'; 
            }
        });
    });

    // 2. Handler untuk tombol terima/tolak undangan
    // ----------------------------------------------------------------
    const invitationCards = document.querySelectorAll('.meeting-card');
    invitationCards.forEach(card => {
        const acceptButton = card.querySelector('.btn-primary');
        const declineButton = card.querySelector('.btn-outline');
        
        // Aksi Terima
        acceptButton.addEventListener('click', function() {
            const title = card.querySelector('h3').textContent;
            
            alert(`Anda telah menerima undangan: ${title}. Jadwal telah ditambahkan ke kalender Anda.`);
            
            // Perubahan visual setelah diterima
            card.style.opacity = '0.7';
            this.textContent = 'Diterima';
            this.disabled = true;
            declineButton.style.display = 'none';

            // Update hitungan
            invitationCount--;
            invitationCountSpan.textContent = invitationCount;
        });

        // Aksi Tolak
        declineButton.addEventListener('click', function() {
            const title = card.querySelector('h3').textContent;
            
            if (confirm(`Tolak undangan: ${title}? Undangan akan dihapus dari daftar.`)) {
                // Menghapus kartu dari DOM
                card.style.transition = 'opacity 0.5s, transform 0.5s';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9)';
                
                setTimeout(() => {
                    card.remove();
                    // Update hitungan
                    invitationCount--;
                    invitationCountSpan.textContent = invitationCount;
                }, 500);
            }
        });
    });


    // 3. Handler untuk simpan perubahan profil
    // ----------------------------------------------------------------
    const saveProfileButton = document.getElementById('save-profile-btn');
    if (saveProfileButton) {
        saveProfileButton.addEventListener('click', function() {
            alert('Perubahan profil berhasil disimpan!');
            // Di sini Anda bisa menambahkan logika POST data ke backend
        });
    }
    
    // Handler Ubah Password (contoh sederhana)
    const changePasswordButton = document.querySelector('#profile .card:nth-child(2) .btn-primary');
    if (changePasswordButton) {
        changePasswordButton.addEventListener('click', function() {
            alert('Permintaan ubah password sedang diproses. Silakan cek email Anda untuk verifikasi.');
        });
    }
});