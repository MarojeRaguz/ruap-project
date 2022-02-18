<!DOCTYPE html>
<html lang="en">

<head>
	<title>sapm checker</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
	<div class="spam-checker-container">
		<div class="form-container">
			<form class="form" >
				<span class="form-title">
					Spam checker
				</span>
				<div class="form-input-container">
					<span class="message">Message:</span>
					<textarea type="text" class="message-input" name="message" placeholder="Enter your message here...">{{ $message }}</textarea>
					<span class="focus-message-input"></span>
				</div>
				<div class="form-button-container">
					<button class="form-button">
						<span>
							Check
						</span>
					</button>
				</div>
			</form>
			@if ($resultString=="spam")
			<div class="spam-message">
				SPAM!!!!!
			</div>
			@endif
			@if ($resultString=="ham")
			<div class="ham-message">
				HAM 
			</div>
			@endif
			
		</div>
	</div>
</body>
</html>