$(function () {
  const setLabel = (min, max) => {
    const minLabel = $(`#slider-min-label`);
    minLabel.text(min+'%');
    const minSlider = $(`#slider-div .min-slider-handle`);
    const minRect = minSlider[0].getBoundingClientRect();
    minLabel.offset({
      left: minRect.left + 20,
    });
    // ///////////
    const maxLabel = $(`#slider-max-label`);
    maxLabel.text(max+'%');
    const maxSlider = $(`#slider-div .max-slider-handle`);
    const maxRect = maxSlider[0].getBoundingClientRect();
    maxLabel.offset({
      left: maxRect.left - 25,
    });
    // let betweenHandlers = $("#between-handlers");
    // betweenHandlers.offset({  left: maxRect.left+10 });
    // betweenHandlers.width(minRect.left-maxRect.left + "px");
  };

  const setLabels = (values) => {
    setLabel(values[0], values[1]);
  };

  $("#ex2")
    .slider({ scale: "linear" })
    .on("slide", function (ev) {
      setLabels(ev.value);
    });
  setLabels($("#ex2").attr("data-value").split(","));
});
