const tombolCari = document.querySelector(".tombol-cari");
const keyword = document.querySelector(".keyword");
const container = document.querySelector(".container");

// hilangkan tombol cari
tombolCari.style.display = "none";

// event ketika kita menuliskan keyword
keyword.addEventListener("keyup", function () {
  // jalankan ajax
  // xmlhttprequest
  // const xhr = new XMLHttpRequest();

  // xhr.onreadystatechange = function () {
  //   if (xhr.readyState == 4 && xhr.status == 200) {
  //     container.innerHTML = xhr.responseText;
  //   }
  // };

  // xhr.open('get', 'ajax/ajax_cari.php?keyword=' + keyword.value);
  // xhr.send();

  // fetch
  fetch("ajax/ajax_cari.php?keyword=" + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));
});

// preview image
// const gambar = document.querySelector('.gambar');
// gambar.addEventListener('onchange', function(){
//   const imgPreview = document.querySelector('.img-preview');

//   const oFReader = new FileReader();
//   oFReader.readAsDataURL(gambar.files[0]);

//   oFReader.onload = function (oFREvent) {
//     imgPreview.src = oFREvent.target.result;
//   };
// });

function imagePreview() {
  const gambar = document.querySelector(".gambar");
  const imgPreview = document.querySelector(".img-preview");

  const oFReader = new FileReader();
  oFReader.readAsDataURL(gambar.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}

const navbarNav = document.querySelector(".navbar-nav");

document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

// klik diluar sidebar untuk menghilangkan nav
const hamburger = document.querySelector("#hamburger-menu");

document.addEventListener("click", function (e) {
  if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});
