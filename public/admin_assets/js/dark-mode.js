// Function to toggle dark mode and change icon
document.getElementById('darkModeToggle').addEventListener('click', function() {
    var darkModeEnabled = document.body.classList.contains('dark-mode');
    var darkModeCookie;
    if (darkModeEnabled) {
        document.body.classList.remove('dark-mode');
        document.getElementById('darkModeIcon').classList.remove('fa-moon');
        document.getElementById('darkModeIcon').classList.add('fa-sun');
        darkModeCookie = 'false';
        // Enable bg-gradient-primary class
        document.getElementById('accordionSidebar').classList.add('bg-gradient-primary');
    } else {
        document.body.classList.add('dark-mode');
        document.getElementById('darkModeIcon').classList.remove('fa-sun');
        document.getElementById('darkModeIcon').classList.add('fa-moon');
        darkModeCookie = 'true';
        // Disable bg-gradient-primary class
        document.getElementById('accordionSidebar').classList.remove('bg-gradient-primary');
    }
    // Update dark mode preference in cookie
    document.cookie = "dark_mode=" + darkModeCookie + "; expires=Thu, 01 Jan 2099 00:00:00 UTC; path=/";
});

// Apply dark mode styles based on the cookie value
var darkModeCookie = getCookie("dark_mode");
if (darkModeCookie === 'true') {
    document.body.classList.add('dark-mode');
    document.getElementById('darkModeIcon').classList.remove('fa-light fa-sun');
    document.getElementById('darkModeIcon').classList.add('fa-moon');
    // Disable bg-gradient-primary class
    document.getElementById('accordionSidebar').classList.remove('bg-gradient-primary');
}

// Function to get cookie value by name
function getCookie(name) {
    var cookieArr = document.cookie.split(';');
    for (var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split('=');
        if (name === cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}
