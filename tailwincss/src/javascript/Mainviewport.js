document.addEventListener("DOMContentLoaded", function() {
    const mainviewport = document.getElementById('mainviewport');
    mainviewport.className = 'motel-info-container w-mainviewportwithrightpanel ml-40 flex flex-wrap justify-around bg-slate-700';
});

function changebg(bgurl)
{
    const mainviewport = document.getElementById('mainviewport');
    mainviewport.style.backgroundImage = `url(${bgurl})`;
}

function openrightpanel()
{
    const rightpanel = document.getElementById('sidebar-right');
    mainviewport.className = 'motel-info-container w-mainviewport ml-40 flex flex-wrap justify-around bg-slate-700';
    rightpanel.style.display = 'flex';
}
function closerightpanel()
{
    const rightpanel = document.getElementById('sidebar-right');
    const mainviewport = document.getElementById('mainviewport');
    mainviewport.className = 'motel-info-container w-mainviewportwithrightpanel ml-40 flex flex-wrap justify-around bg-slate-700';
    rightpanel.style.display = 'none';
}

function openRoomPost()
{
    const roompost = document.getElementById('roompost');
    window.location.href = '../php/roomPost.php';
}
function openAddPost()
{
    const addpost = document.getElementById('addpost');
    window.location.href = '../php/addPost.php';
}

function callPHPFunction(time) {
    fetch('../php/your_php_script.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'your_function_name' })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}