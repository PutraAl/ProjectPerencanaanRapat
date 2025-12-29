 // responsive hamburger
         const btn = document.getElementById("hamburgerBtn");
         const sidebar = document.querySelector(".sidebar");

         btn.addEventListener("click", () => {
             sidebar.classList.toggle("active");
         });

         // filter search
         function filterUndangan() {
             const input = document.getElementById('searchInput');
             const filter = input.value.toLowerCase();
             const cards = document.querySelectorAll('.meeting-card');

             cards.forEach(card => {
                 const title = card.querySelector('h3').innerText.toLowerCase();
                 const body = card.querySelector('.meeting-body').innerText.toLowerCase();

                 card.style.display = (title.includes(filter) || body.includes(filter)) ?
                     "" :
                     "none";
             });
         }

         // sidebar toggle
         function toggleSidebar() {
             document.getElementById("sidebar").classList.toggle("active");
         }

         // detail toggle
         function toggleDetail(id) {
             const content = document.getElementById(id);
             const button = event.target;

             content.classList.toggle('active');
             button.textContent = content.classList.contains('active') ?
                 'Sembunyikan Detail' :
                 'Tampilkan Detail';
         }
         function toggleDetails(id) {
             const content = document.getElementById(id);
             const button = event.target;

             content.classList.toggle('active');
             button.textContent = content.classList.contains('active') ?
                 'Sembunyikan Deskripsi' :
                 'Tampilkan Deskripsi';
         }