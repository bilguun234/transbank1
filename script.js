// Example: Show an alert when a link is clicked
document.querySelectorAll("nav a").forEach(link => {
    link.addEventListener("click", (event) => {
        alert(`You clicked on ${event.target.textContent}`);
    });
});
