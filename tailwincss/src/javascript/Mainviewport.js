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