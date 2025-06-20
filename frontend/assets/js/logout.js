const btnLogin = document.getElementById("btn-login");

const LogOut = () => {
  btnLogin.addEventListener("click", () => {
    window.localStorage.clear();
    window.sessionStorage.clear();
    window.location.href = "http://localhost/app-photo-album";
  });
};

export default LogOut;
