const text = "Welcome to the AgriGuard";
        let index = 0;
        function typeEffect() {
            if (index < text.length) {
                document.getElementById("typingText").textContent += text.charAt(index);
                index++;
                setTimeout(typeEffect, 100);
            }
        }
        const textArray = [
            "Empowering Farmers with Data",
            "Smart Agriculture Solutions. Allows sharing of disease images and discussions.",
            "AI-Driven Crop Insights",
            "Sustainable Farming Practices",
            "Creating a digital foundation for integrating agriculture."
        ];
        
        let i = 0;
        
        function changeText() {
            const textElement = document.getElementById("changingText");
            textElement.style.opacity = "0"; // Fade out effect
        
            setTimeout(() => {
                textElement.innerText = textArray[i]; // Corrected variable name
                textElement.style.opacity = "1"; // Fade in effect
                i = (i + 1) % textArray.length;
            }, 500);
        }
        
        setInterval(changeText, 3000); // Change text every 3 seconds
        
        
        
        window.onload = typeEffect;
        // function openPopup(id) {
        //     closeAllPopups();
        //     document.getElementById(id).style.display = "block";
        // }     

function showRegister() {
    document.getElementById("loginForm").classList.add("hidden");
    document.getElementById("registerForm").classList.remove("hidden");
}

function showLogin() {
    document.getElementById("registerForm").classList.add("hidden");
    document.getElementById("loginForm").classList.remove("hidden");
}

document.addEventListener("DOMContentLoaded", function () {
    function showPopupMessage(message) {
        const popupMessage = document.getElementById("popupMessage");
        const popupMessageText = document.getElementById("popupMessageText");
        popupMessageText.innerText = message;
        popupMessage.classList.remove("hidden");
        popupMessage.classList.add("visible");
    }

    function closePopupMessage() {
        const popupMessage = document.getElementById("popupMessage");
        popupMessage.classList.remove("visible");
        popupMessage.classList.add("hidden");
    }

    document.getElementById("closePopupMessage").addEventListener("click", closePopupMessage);
    
    // Close popup message if clicked outside
    window.addEventListener("click", function (event) {
        const popupMessage = document.getElementById("popupMessage");
        if (event.target === popupMessage) {
            closePopupMessage();
        }
    });

    document.getElementById("loginBtn").addEventListener("click", function () {
        document.getElementById("popupForm").style.display = "flex";
    });

    document.getElementById("closePopup").addEventListener("click", function () {
        document.getElementById("popupForm").style.display = "none";
    });

    function showRegister() {
        document.getElementById("loginForm").classList.add("hidden");
        document.getElementById("registerForm").classList.remove("hidden");
    }

    function showLogin() {
        document.getElementById("registerForm").classList.add("hidden");
        document.getElementById("loginForm").classList.remove("hidden");
    }

    window.showPopupMessage = showPopupMessage;
    window.showRegister = showRegister;
    window.showLogin = showLogin;
});


// Handle language selection
// document.getElementById('languageSelect').addEventListener('change', function() {
//     // alert('Language changed to: ' + this.value);
// });

// Show popup form
document.getElementById("loginBtn").addEventListener("click", function() {
    document.getElementById("popupForm").style.display = "flex";
});

// Close popup form by clicking on the close button
document.getElementById("closePopup").addEventListener("click", function() {
    document.getElementById("popupForm").style.display = "none";
});


// Switch between login and registration form
document.getElementById("loginTab").addEventListener("click", function() {
    document.getElementById("loginForm").classList.remove("hidden");
    document.getElementById("registerForm").classList.add("hidden");
    this.classList.add("active");
    document.getElementById("registerTab").classList.remove("active");
});

document.getElementById("registerTab").addEventListener("click", function() {
    document.getElementById("registerForm").classList.remove("hidden");
    document.getElementById("loginForm").classList.add("hidden");
    this.classList.add("active");
    document.getElementById("loginTab").classList.remove("active");
});

// Show popup message function
function showPopupMessage(message) {
    const popupMessage = document.getElementById("popupMessage");
    const popupMessageText = document.getElementById("popupMessageText");
    popupMessageText.innerText = message;
    popupMessage.classList.add("visible");
}

// Close popup message function
function closePopupMessage() {
    const popupMessage = document.getElementById("popupMessage");
    popupMessage.classList.remove("visible");
}

// Close the login/registration popup message if the user clicks outside it
document.addEventListener("click", function(event) {
    const popupMessage = document.getElementById("popupMessage");
    if (event.target === popupMessage) {
        closePopupMessage();
    }
});
