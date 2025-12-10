 const btn = document.getElementById("hamburgerBtn");
            const sidebar = document.querySelector(".sidebar");

            btn.addEventListener("click", () => {
                sidebar.classList.toggle("active");
            });