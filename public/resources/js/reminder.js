document.addEventListener("DOMContentLoaded", () => {
  $(".timepicker").pickatime({
    autoclose: true,
    twelvehour: true,
    vibrate: true,
    donetext: "OK",
    afterDone: (Element, Time) => {
      console.log(Element, Time);
    },
  });
});
