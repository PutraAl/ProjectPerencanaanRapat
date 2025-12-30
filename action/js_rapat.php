<script>
 const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sidebar = document.querySelector('.sidebar');
    const formRapatModal = new bootstrap.Modal(document.getElementById('formRapatModal'));
    const meetingForm = document.getElementById('meeting-form');

    let allPeserta = [
      <?php 
        $dataPeserta = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE role = 'peserta' ORDER BY nama ASC");
        $pesertaArray = [];
        while ($row = mysqli_fetch_assoc($dataPeserta)) {
          $pesertaArray[] = "{ id: {$row['id_user']}, nama: '{$row['nama']}' }";
        }
        echo implode(',', $pesertaArray);
      ?>
    ];

    let selectedPesertaIds = [];
    const pesertaInputField = document.getElementById('pesertaInputField');
    const pesertaDropdown = document.getElementById('pesertaDropdown');
    const pesertaTags = document.getElementById('pesertaTags');
    const pesertaSearch = document.getElementById('pesertaSearch');
    const pesertaList = document.getElementById('pesertaList');
    const pesertaEmpty = document.getElementById('pesertaEmpty');
    const btnSelectAll = document.getElementById('btnSelectAll');
    const btnDeselectAll = document.getElementById('btnDeselectAll');
    const pesertaSelectedCount = document.getElementById('pesertaSelectedCount');
    const pesertaSelectedList = document.getElementById('pesertaSelectedList');
    const pesertaHidden = document.getElementById('peserta-hidden');

    hamburgerBtn?.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !hamburgerBtn.contains(e.target)) {
          sidebar.classList.remove('active');
        }
      });
    });

    function renderPesertaList() {
      pesertaList.innerHTML = '';
      const searchTerm = pesertaSearch.value.toLowerCase();
      const availablePeserta = allPeserta.filter(p => 
        !selectedPesertaIds.includes(p.id) && 
        p.nama.toLowerCase().includes(searchTerm)
      );

      if (availablePeserta.length === 0) {
        pesertaEmpty.style.display = 'block';
      } else {
        pesertaEmpty.style.display = 'none';
        availablePeserta.forEach(peserta => {
          const item = document.createElement('div');
          item.className = 'peserta-item';
          item.innerHTML = `
            <input type="checkbox" id="peserta_${peserta.id}" value="${peserta.id}">
            <label for="peserta_${peserta.id}">${peserta.nama}</label>
          `;
          item.querySelector('input').addEventListener('change', () => togglePeserta(peserta.id));
          pesertaList.appendChild(item);
        });
      }
    }

    function togglePeserta(pesertaId) {
      const index = selectedPesertaIds.indexOf(pesertaId);
      if (index > -1) {
        selectedPesertaIds.splice(index, 1);
      } else {
        selectedPesertaIds.push(pesertaId);
      }
      updatePesertaDisplay();
    }

    function updatePesertaDisplay() {
      pesertaTags.innerHTML = '';
      selectedPesertaIds.forEach(id => {
        const peserta = allPeserta.find(p => p.id === id);
        if (peserta) {
          const tag = document.createElement('div');
          tag.className = 'peserta-tag';
          tag.innerHTML = `
            ${peserta.nama}
            <span class="remove-btn" onclick="removePeserta(${id})">✕</span>
          `;
          pesertaTags.appendChild(tag);
        }
      });

      if (selectedPesertaIds.length === 0) {
        pesertaSelectedCount.textContent = 'Pilih satu atau lebih peserta';
        pesertaSelectedList.innerHTML = '';
      } else {
        pesertaSelectedCount.innerHTML = `<strong>${selectedPesertaIds.length}</strong> peserta dipilih`;
        pesertaSelectedList.innerHTML = '';
        selectedPesertaIds.forEach(id => {
          const peserta = allPeserta.find(p => p.id === id);
          if (peserta) {
            const badge = document.createElement('span');
            badge.className = 'peserta-badge';
            badge.textContent = `✓ ${peserta.nama}`;
            pesertaSelectedList.appendChild(badge);
          }
        });
      }

      pesertaHidden.value = selectedPesertaIds.join(',');

      if (selectedPesertaIds.length > 0) {
        btnDeselectAll.style.display = 'flex';
      } else {
        btnDeselectAll.style.display = 'none';
      }

      renderPesertaList();
    }

    function removePeserta(pesertaId) {
      togglePeserta(pesertaId);
    }

    pesertaInputField.addEventListener('click', () => {
      pesertaDropdown.classList.toggle('open');
      pesertaInputField.classList.toggle('active');
      if (pesertaDropdown.classList.contains('open')) {
        pesertaSearch.focus();
      }
    });

    pesertaSearch.addEventListener('input', renderPesertaList);

    btnSelectAll.addEventListener('click', (e) => {
      e.preventDefault();
      const searchTerm = pesertaSearch.value.toLowerCase();
      const availablePeserta = allPeserta.filter(p => 
        !selectedPesertaIds.includes(p.id) && 
        p.nama.toLowerCase().includes(searchTerm)
      );
      availablePeserta.forEach(p => {
        if (!selectedPesertaIds.includes(p.id)) {
          selectedPesertaIds.push(p.id);
        }
      });
      updatePesertaDisplay();
    });

    btnDeselectAll.addEventListener('click', (e) => {
      e.preventDefault();
      selectedPesertaIds = [];
      updatePesertaDisplay();
    });

    document.addEventListener('click', (e) => {
      if (!e.target.closest('.peserta-selector-container')) {
        pesertaDropdown.classList.remove('open');
        pesertaInputField.classList.remove('active');
      }
    });

    function resetFormRapat() {
      meetingForm.action = '../action/tambah_rapat.php';
      document.getElementById('id_rapat_hidden').value = '';
      document.getElementById('formRapatLabel').textContent = 'Tambah Data Rapat Baru';
      document.getElementById('submitBtnModal').innerHTML = '💾 Simpan Data';
      document.getElementById('notulenContainer').style.display = 'none';
      meetingForm.reset();
      selectedPesertaIds = [];
      pesertaSearch.value = '';
      updatePesertaDisplay();
    }

    function loadEditDataFromButton(button) {
      const data = {
        id_rapat: button.getAttribute('data-id_rapat'),
        judul: button.getAttribute('data-judul'),
        deskripsi: button.getAttribute('data-deskripsi'),
        tanggal: button.getAttribute('data-tanggal'),
        waktu: button.getAttribute('data-waktu'),
        lokasi: button.getAttribute('data-lokasi'),
        status: button.getAttribute('data-status'),
        notulen: button.getAttribute('data-notulen'),
        peserta_ids: button.getAttribute('data-peserta_ids')
      };
      
      document.getElementById('id_rapat_hidden').value = data.id_rapat;
      document.getElementById('meeting-title').value = data.judul;
      document.getElementById('meeting-desc').value = data.deskripsi;
      document.getElementById('meeting-date').value = data.tanggal;
      document.getElementById('meeting-time').value = data.waktu;
      document.getElementById('meeting-location').value = data.lokasi;
      document.getElementById('meeting-status').value = data.status;
      document.getElementById('notulen').value = data.notulen;
      
      meetingForm.action = '../action/proses_edit_rapat.php';
      document.getElementById('formRapatLabel').textContent = 'Edit Data Rapat';
      document.getElementById('submitBtnModal').innerHTML = '💾 Update Data';
      document.getElementById('notulenContainer').style.display = 'block';
      
      selectedPesertaIds = data.peserta_ids ? data.peserta_ids.split(',').map(id => parseInt(id)) : [];
      pesertaSearch.value = '';
      updatePesertaDisplay();
    }

    function hapusRapat(id) {
      if (confirm('Yakin ingin menghapus rapat ini?')) {
        window.location.href = '../action/hapus_rapat.php?id=' + id;
      }
    }

    <?php if ($absensiMode): ?>
    document.addEventListener('DOMContentLoaded', function() {
      const absensiModalElement = document.getElementById('absensiModal');
      if (absensiModalElement) {
        const absensiModal = new bootstrap.Modal(absensiModalElement);
        absensiModal.show();
      }
    });
    <?php endif; ?>

</script>