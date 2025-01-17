let addBtn = document.getElementById('addBtn');
let cancelBtn = document.getElementById('cancel');
let elem = document.getElementById('form');

const body = document.querySelector("body"),
  modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if (getMode && getMode === "dark") {
  body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "close") {
  sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    localStorage.setItem("mode", "dark");
  } else {
    localStorage.setItem("mode", "light");
  }
});

sidebarToggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  if (sidebar.classList.contains("close")) {
    localStorage.setItem("status", "close");
  } else {
    localStorage.setItem("status", "open");
  }
});

addBtn.addEventListener("click", function() {
    if(elem.style.visibility == "hidden") {
        elem.style.visibility = "visible";
    }
});

cancelBtn.addEventListener("click", function() {
  if(elem.style.visibility == "visible") {
      elem.style.visibility= "hidden";
  }
});