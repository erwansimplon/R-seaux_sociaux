<?php function js_move() { ?>
	<script type="text/javascript" src="http://code.interactjs.io/v1.2.6/interact.min.js"></script>
	<script type="text/javascript">
	for (var ii = 0; ii <= 500; ii++){

			interact('.msg_box' + ii)
				.draggable({
					// enable inertial throwing
					inertia: true,
					// keep the element within the area of it's parent
					restrict: {
						restriction: "body",
						endOnly: true,
						elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
					},
					// enable autoScroll
					autoScroll: false,

					// call this function on every dragmove event
					onmove: dragMoveListener,
					// call this function on every dragend event

				});
	};
				function dragMoveListener (event) {
					var target = event.target,
							// keep the dragged position in the data-x/data-y attributes
							x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
							y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

					// translate the element
					target.style.webkitTransform =
					target.style.transform =
						'translate(' + x + 'px, ' + y + 'px)';

					// update the posiion attributes
					target.setAttribute('data-x', x);
					target.setAttribute('data-y', y);
				}

				// this is used later in the resizing and gesture demos
				window.dragMoveListener = dragMoveListener;

			</script>
<?php
}
?>
