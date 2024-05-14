<!DOCTYPE html>
<html>
<head>
    <title>Emotion Detection</title>
</head>
<body>

    <!-- emotion.blade.php -->
<form action="{{ route('predict.emotion') }}" method="post">
    @csrf
    <textarea name="input_text" rows="4" cols="50" placeholder="Enter your text here..."></textarea><br>
    <button type="submit">Predict Emotion</button>
</form>

@if(isset($predicted_emotion))
    <h2>Predicted Emotion: {{ $predicted_emotion }}</h2>
@endif

@if($errors->any())
    <h3>Error: {{ $errors->first() }}</h3>
@endif


</body>
</html>