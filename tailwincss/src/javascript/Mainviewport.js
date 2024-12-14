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

function sortPostNewst() {
    fetch('../Post/sortPost.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'sortPostNew()' })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        const container = document.getElementById('mainviewport');
        data.forEach(row => {
            const date = new Date(row.created_at).toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });
            const postDiv = document.createElement('div');
            postDiv.className = 'motel-info text-clip mt-12 bg-green-200 p-4 m-4 border border-black block text-center text-black hover:bg-blue-500 hover:cursor-pointer rounded-2xl';
            postDiv.innerHTML = `
                <h1 class='font-bold capitalize text-5xl text-left'>${row.title}</h1>
                <img src='${row.images}' alt='' class='object-contain mt-4'>
                <div class='text-left text-pretty'>
                    <div>
                        <span class='font-bold'>Mô tả: </span>${row.description}
                    </div>
                    <div>
                        <span class='font-bold'>Người đăng: </span>${row.Username}
                    </div>
                    <div>
                        <span class='font-bold'>Giá: </span>${row.price}d/tháng
                    </div>
                    <div>
                        <span class='font-bold'>Diện tích: </span>${row.area}m2
                    </div>
                    <div>
                        <span class='font-bold'>Địa chỉ: </span>${row.address}
                    </div>
                    <div>
                        <span class='font-bold'>Ngày đăng: </span>${date}
                    </div>
                    <div>
                        <span class='font-bold'>Số điện thoại: </span>${row.phone}
                    </div>
                </div>
            `;
            container.appendChild(postDiv);
        });
        
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}