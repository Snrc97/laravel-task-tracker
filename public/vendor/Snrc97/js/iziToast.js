function showToast(success = false, msg = null) {
    if (success) {
      iziToast.success({
        position: "topCenter",
        message: msg ?? "İşlem Başarılı",
      });
    } else {
      iziToast.error({
        position: "topCenter",
        message: msg ?? "İşlem Başarısız",
      });
    }
  }