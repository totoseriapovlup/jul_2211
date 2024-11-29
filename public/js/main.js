window.addEventListener('load', function(){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                let response = xhr.response;
                let notes = JSON.parse(response);
                console.log(notes);
            }else{
                console.error('error during getting notes');
                alert('Notes does not received');
            }
        }
    };
    xhr.open('GET', '/api/index');
    xhr.send();
});