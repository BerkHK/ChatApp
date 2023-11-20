const pswrdFiled = document.querySelector(
    ".form .field input[type='password']"
  ),
  toggleBtn = document.querySelector(".form .field i");

toggleBtn.onclick = () => {
  if (pswrdFiled.type == "password") {
    pswrdFiled.type = "text";
    toggleBtn.classList.add("active");
  } else {
    pswrdFiled.type = "password";
    toggleBtn.classList.remove("active");
  }
};
