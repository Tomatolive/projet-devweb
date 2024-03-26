window.onload = function() {
    let today = new Date();
    let date18 = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    let formattedDate = date18.toISOString().split('T')[0];
    document.getElementById('ddn').max = formattedDate;
}
