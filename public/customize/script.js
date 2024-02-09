  // Fungsi untuk menampilkan loader
  function showLoader() {
    document.getElementById("loader").style.display = "flex";
  }

  // Fungsi untuk menyembunyikan loader
  function hideLoader() {
    document.getElementById("loader").style.display = "none";
  }

// Menambahkan event listener ke semua elemen dengan class "load"
document.querySelectorAll(".load").forEach(function(element) {
  element.addEventListener("click", function() {
    showLoader();
  });
});


// LOADER AT SHOW
  function showLoaderAtShow() {
    document.getElementById("loaderAtShow").style.display = "flex";
  }

  function hideLoaderAtShow() {
    document.getElementById("loaderAtShow").style.display = "none";
  }

document.querySelectorAll(".loadAtShow").forEach(function(element) {
  element.addEventListener("click", function() {
    showLoaderAtShow();
  });
});

function showLoaderAMoment() {
  document.getElementById("loaderAMoment").style.display = "flex";
}

function hideLoaderAMoment() {
  document.getElementById("loaderAMoment").style.display = "none";
}

// LOADER A MOMENT
function loadAMoment(){
  showLoaderAMoment();
  setTimeout(function() {
    hideLoaderAMoment();
  }, 5000);
}

document.querySelectorAll(".loadAMoment").forEach(function(element) {
  element.addEventListener("click", function() {
    showLoaderAMoment();
    setTimeout(function() {
      hideLoaderAMoment();
    }, 5000);
  });
});
