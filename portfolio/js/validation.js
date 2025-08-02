// Form validation and submission handling
document.addEventListener('DOMContentLoaded', function() {
    
    // Signup form handling
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };
            
            fetch('signup.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('signup-message');
                if (data.success) {
                    messageDiv.className = 'text-success mb-2';
                    messageDiv.textContent = 'Registration successful! You can now sign in.';
                    signupForm.reset();
                } else {
                    messageDiv.className = 'text-danger mb-2';
                    messageDiv.textContent = data.error || 'Registration failed. Please try again.';
                }
            })
            .catch(error => {
                const messageDiv = document.getElementById('signup-message');
                messageDiv.className = 'text-danger mb-2';
                messageDiv.textContent = 'An error occurred. Please try again.';
                console.error('Error:', error);
            });
        });
    }
    
    // Contact form handling
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value
            };
            
            fetch('contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Message sent successfully!');
                    contactForm.reset();
                } else {
                    alert(data.error || 'Failed to send message. Please try again.');
                }
            })
            .catch(error => {
                alert('An error occurred. Please try again.');
                console.error('Error:', error);
            });
        });
    }
    
    // Signin form handling
    const signinForm = document.getElementById('signinForm');
    if (signinForm) {
        signinForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                username: document.getElementById('username').value,
                password: document.getElementById('password').value
            };
            
            fetch('signin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('signin-message');
                if (data.success) {
                    messageDiv.className = 'text-success mb-2';
                    messageDiv.textContent = 'Login successful!';
                    setTimeout(() => {
                        window.location.href = 'admin.php';
                    }, 1000);
                } else {
                    messageDiv.className = 'text-danger mb-2';
                    messageDiv.textContent = data.error || 'Login failed. Please check your credentials.';
                }
            })
            .catch(error => {
                const messageDiv = document.getElementById('signin-message');
                messageDiv.className = 'text-danger mb-2';
                messageDiv.textContent = 'An error occurred. Please try again.';
                console.error('Error:', error);
            });
        });
    }
}); 