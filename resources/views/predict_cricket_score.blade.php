<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cricket Score Predictor</div>

                    <div class="card-body">
                        <form action="{{ route('predict-cricket-score') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="batting_team">Select Batting Team</label>
                                <select class="form-control" name="batting_team" required>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team }}">{{ $team }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bowling_team">Select Bowling Team</label>
                                <select class="form-control" name="bowling_team" required>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team }}">{{ $team }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">Select City</label>
                                <select class="form-control" name="city" required>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="current_score">Current Score</label>
                                <input type="number" class="form-control" name="current_score" required>
                            </div>
                            <div class="form-group">
                                <label for="overs">Overs Done (Works for over > 5)</label>
                                <input type="number" class="form-control" name="overs" required>
                            </div>
                            <div class="form-group">
                                <label for="wickets">Wickets Out</label>
                                <input type="number" class="form-control" name="wickets" required>
                            </div>
                            <div class="form-group">
                                <label for="last_five">Runs Scored in Last 5 Overs</label>
                                <input type="number" class="form-control" name="last_five" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Predict Score</button>
                        </form>

                        @if (isset($predicted_score))
                        <div class="mt-3">
                            <h5>Predicted Score:</h5>
                            <p>{{ $predicted_score }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>
