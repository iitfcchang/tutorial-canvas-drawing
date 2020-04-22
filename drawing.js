"use strict";

function init_drawing() {
  var canvas = $('#myCanvas');
  var w = $('#content').width();
  var h = $(window).height()*0.95-$('#saveBtn').outerHeight();
  canvas[0].width = w;
  canvas[0].height = h;
  var ctx = canvas[0].getContext('2d');

  ctx.fillStyle = 'white';
  ctx.fillRect(0, 0, w, h);

  canvas.on('mousedown', (e) => {
    drawing_start(ctx, e.offsetX, e.offsetY);
  }).on('mouseup', (e) => {
    drawing_move(ctx, e.offsetX, e.offsetY);
    is_drawing = false;
  }).on('mousemove', (e) => {
    drawing_move(ctx, e.offsetX, e.offsetY);
  }).on('mouseout', (e) => {
    is_drawing = false;
  }).on('touchstart', (e) => {
    drawing_start(ctx, e.targetTouches[0].clientX, e.targetTouches[0].clientY);
  }).on('touchend', (e) => {
    is_drawing = false;
  }).on('touchmove', (e) => {
    drawing_move(ctx, e.targetTouches[0].clientX, e.targetTouches[0].clientY);
  }).on('touchcancel', (e) => {
    is_drawing = false;
  });
  console.log('Ready!');
}

function save_drawing() {
    var img = $('#myCanvas')[0].toDataURL('image/jpeg', 0.5);
    //var n = $('<img>').attr('src', img);
    //$('body').append(n);
    $('#imgdata_field')[0].value = img;
    $('#saveForm').submit();
}

var is_drawing = false;

function drawing_start(ctx, x, y) {
  ctx.moveTo(x, y);
  is_drawing = true;
}

function drawing_move(ctx, x, y) {
  if (is_drawing) {
    ctx.lineTo(x, y);
    ctx.stroke();
  }
}
