$(function(){
	var $write = $('#write'),
		shift = false,
		capslock = false;
	
	$('#keyboard li').click(function(){
		var $this = $(this),
			character = $this.html(); // If it's a lowercase letter, nothing happens to this variable
		
		// Shift keys
		if ($this.hasClass('left-shift') || $this.hasClass('right-shift')) {
			$('.letter').toggleClass('uppercase');
			$('.symbol span').toggle();
			
			shift = (shift === true) ? false : true;
			capslock = false;
			return false;
		}
		
		// Caps lock
		if ($this.hasClass('capslock')) {
			$('.letter').toggleClass('uppercase');
			capslock = true;
			return false;
		}
		
		// Delete
		if ($this.hasClass('delete')) {
			var html = $write.val();
			
			$write.val(html.substr(0, html.length - 1));
			return false;
		}

		// Teclado en pantalla totem
		if ($this.hasClass('uno')) character = '1';
		if ($this.hasClass('dos')) character = '2';
		if ($this.hasClass('tres')) character = '3';
		if ($this.hasClass('cuatro')) character = '4';
		if ($this.hasClass('cinco')) character = '5';
		if ($this.hasClass('seis')) character = '6';
		if ($this.hasClass('siete')) character = '7';
		if ($this.hasClass('ocho')) character = '8';
		if ($this.hasClass('nueve')) character = '9';
		if ($this.hasClass('cero')) character = '0';
		if ($this.hasClass('key')) character = 'K';
		
		// Special characters
		if ($this.hasClass('symbol')) character = $('span:visible', $this).html();
		if ($this.hasClass('space')) character = ' ';
		if ($this.hasClass('tab')) character = "\t";
		if ($this.hasClass('return')) character = "\n";
		
		// Uppercase letter
		if ($this.hasClass('uppercase')) character = character.toUpperCase();
		
		// Remove shift once a key is clicked.
		if (shift === true) {
			$('.symbol span').toggle();
			if (capslock === false) $('.letter').toggleClass('uppercase');
			
			shift = false;
		}
		
		// Add the character
		$write.val($write.val() + character);
	});
});