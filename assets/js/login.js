 const inputs = document.querySelectorAll('.form-control');
    
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        if (input.value.trim() !== '') {
          input.classList.add('active-input');
        } else {
          input.classList.remove('active-input');
        }
      });
    });

    // Ripple effect pada button
    const loginBtn = document.querySelector('.btn-login');
    loginBtn.addEventListener('click', function(e) {
      const ripple = document.createElement('span');
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;
      
      ripple.style.width = ripple.style.height = size + 'px';
      ripple.style.left = x + 'px';
      ripple.style.top = y + 'px';
    });