var accordion = document.getElementsByClassName("accordion");
for (a of accordion) {
  a.addEventListener("click", function () {
    this.classList.toggle("active");
  });
}
