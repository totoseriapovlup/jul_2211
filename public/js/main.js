window.addEventListener('load', function(){
    showAllNotes();
    document.getElementById('new-note').onclick = function(){
        document.getElementById('all').style.display = 'none';
        document.getElementById('create').style.display = 'initial';
    };
    bindCreateForm();
});

function showAllNotes(){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                let response = xhr.response;
                let notes = JSON.parse(response);
                let tbody = document.querySelector('table#note-list>tbody');
                tbody.innerHTML = '';
                for(let note of notes){
                    // tbody.innerHTML += '<tr><td>' + note['name'] + '</td><td>' +
                    //     '<form class="del" action="/api/destroy">' +
                    //     '<input type="hidden" name="id" value="' + note['id'] + '"/>' +
                    //     '<input type="submit" value="delete"/>' +
                    //     '</form>' +
                    //     '</td></tr>';
                    tbody.innerHTML += '<tr><td>' + note['name'] + '</td><td><button class="del" type="button" data-id="' + note['id'] + '">Delete</button></td>';
                }
                //bindDeleteForms();
                bindDeleteButtons();
            }else{
                console.error('error during getting notes');
                alert('Notes does not received');
            }
        }
    };
    xhr.open('GET', '/api/index');
    xhr.send();
}

function bindCreateForm(){
    let createForm = document.querySelector('#create form');
    createForm.addEventListener('submit', function(e){
        let me = this;
        let fd = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if(xhr.readyState === 4){
                if(xhr.status === 201){
                    me.reset();
                    showAllNotes();
                    document.getElementById('all').style.display = 'initial';
                    document.getElementById('create').style.display = 'none';
                }else{
                    alert('Note does not created');
                }
            }
        };
        xhr.open('POST' , this.action);
        xhr.send(fd);
        e.preventDefault();
    });
}

function delNoteListener(e){
    let me = this;
    let fd = new FormData(this);
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4){
            if(xhr.status === 204){
                showAllNotes();
            }else{
                alert('Note does not deleted');
            }
        }
    };
    xhr.open('POST' , this.action);
    xhr.send(fd);
    e.preventDefault();
}

function bindDeleteForms(){
    let delForms = document.querySelectorAll('form.del');
    for(let delForm of delForms){
        delForm.onsubmit = delNoteListener;
    }
}

function delNoteBtnListener(e){
    let me = this;
    let data = new URLSearchParams('id='+this.dataset.id);
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4){
            if(xhr.status === 204){
                showAllNotes();
            }else{
                alert('Note does not deleted');
            }
        }
    };
    xhr.open('POST' , '/api/destroy');
    xhr.send(data);
    e.preventDefault();
}

function bindDeleteButtons(){
    let delBtns = document.querySelectorAll('button.del');
    for(let delBtn of delBtns){
        delBtn.onclick = delNoteBtnListener;
    }
}