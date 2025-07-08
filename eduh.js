
     
       
        function updateDateTime() {
            const now = new Date();
            const dateStr = now.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            const timeStr = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            
            document.getElementById('currentDate').textContent = dateStr;
            document.getElementById('clock').textContent = timeStr;
        }
        
        // Update immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);
        
        // Tab Switching
        document.querySelectorAll('.tablinks').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.tablinks').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Hide all tab content
                document.querySelectorAll('.tabcontent').forEach(tab => {
                    tab.classList.remove('active');
                });
                
                // Show the selected tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Dark Mode Toggle
        document.getElementById('modeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            this.textContent = document.body.classList.contains('dark-mode') 
                ? 'Toggle Light Mode' 
                : 'Toggle Dark Mode';
        });
        
        // Refresh the whole page
        document.getElementById('refreshPage').addEventListener('click', function() {
            location.reload();
        });
        
        // Reset Forms to the original format
        document.getElementById('resetForms').addEventListener('click', function() {
            document.querySelectorAll('form').forEach(form => {
                form.reset();
            });
            
        });
        
        // Set today as default for date fields
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.value = today;
        });
    

        
 


 
 
  document.querySelectorAll('.tablinks').forEach(button => {
    button.addEventListener('click', () => {
      const tab = button.getAttribute('data-tab');

      // Hide all tab contents
      document.querySelectorAll('.tabcontent').forEach(tc => {
        tc.style.display = 'none';
      });

      // Show selected tab
      document.getElementById(tab).style.display = 'block';

      // Remove active from all buttons, then activate clicked one
      document.querySelectorAll('.tablinks').forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
    });
  });
 