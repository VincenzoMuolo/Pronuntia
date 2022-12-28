function switch_caregiver() {
  document.getElementById("caregiver").style.display = "block";
  document.getElementById("logopedista").style.display = "none";
  document.getElementById("care").classList.toggle("active");
  if (document.getElementById("logo").classList.contains("active"))
    document.getElementById("logo").classList.toggle("active");
}
function switch_logopedista() {
  document.getElementById("caregiver").style.display = "none";
  document.getElementById("logopedista").style.display = "block";
  document.getElementById("logo").classList.toggle("active");
  if (document.getElementById("care").classList.contains("active"))
    document.getElementById("care").classList.toggle("active");
}
