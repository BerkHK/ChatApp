const searchBar = document.querySelector('.users .search input'),
searchBtn = document.querySelector('.users .search button'),
usersList = document.querySelector('.users .users-list');

searchBtn.onclick = ()=>{
  searchBar.classList.toggle('active');
  searchBar.focus();
  searchBtn.classList.toggle('active');
}

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value;
    //şimdi ajax yazalım
    let xhr = new XMLHttpRequest(); //xmlhttprequest objesi oluşturduk
    xhr.open("POST", "php/search.php", true); //post requesti gönderdik
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          console.log(data);
        }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm="+searchTerm);
}

setInterval(()=>{
  //şimdi ajax yazalım
  let xhr = new XMLHttpRequest(); //xmlhttprequest objesi oluşturduk
  xhr.open("GET", "php/users.php", true); //post requesti gönderdik
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  }
  xhr.send();
}, 500); //500ms de bir çalışacak