function smoothScroll(element) {
  document.querySelector(element).scrollIntoView({
    behavior: "smooth"
  });
}

function scroll() {
  if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    document.getElementById("up-button").style.display = "block";
  } else {
    document.getElementById("up-button").style.display = "none";
  }
}

window.onscroll = function() {
  scroll();
};

function scrollTop() {
  smoothScroll("header");
}

function reserve(car) {
  var select = document.getElementById("car");
  var options_selected = select.querySelectorAll("option[selected");
  options_selected.forEach(option => {
    option.removeAttribute("selected");
  });
  var option = select.querySelector('option[value="' + car + '"]');
  option.setAttribute("selected", "selected");
  smoothScroll("#reservation");
}

function calculate(price) {
  var result = document.getElementById("amount");
  result.innerHTML = "";
  var days = document.getElementById("days").value;
  var hours = document.getElementById("hours").value;
  var cost = days * 24 * price + hours * price;

  result.innerHTML = cost + " zł";
}

function calculate_price(price) {
  document
    .getElementById("days")
    .addEventListener("change", () => calculate(price));
  document
    .getElementById("hours")
    .addEventListener("change", () => calculate(price));
}
