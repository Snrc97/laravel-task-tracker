function showAlert({ title, text, icon, action }) {
    Swal.fire({
      title: title,
      text: text,
      icon: icon ?? "warning",
    }).then(() => {
        if (action) {
          action();
        }
    });
  }


function showSwQu({ title, text, icon, action }) {
    Swal.fire({
      title: title,
      text: text,
      icon: icon ?? "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Evet",
    }).then((result) => {
      if (result.isConfirmed) {
        if (action) {
          action();
        }
      }
    });
  }

  function showSwQuDeleteSure({ action }) {
    showSwQu({
      title: "Silmek istediğinize emin misiniz?",
      text: "Bu işlem geri döndürülemez!",
      action,
    });
  }